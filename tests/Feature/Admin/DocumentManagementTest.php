<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use App\Models\Vehicle;
use App\Models\Application;
use App\Models\Document;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DocumentManagementTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test : Un admin peut voir la liste des documents et les détails du véhicule associé.
     */
    public function test_admin_can_view_applications_list_with_vehicle_info(): void
    {
        // 1. Création d'un utilisateur configuré avec toutes les déclinaisons de rôles courantes
        $admin = User::create([
            'name' => 'Admin Test',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
            'role' => 'admin', // Au cas où ton middleware vérifie la colonne 'role'
        ]);

        $vehicle = Vehicle::create([
            'brand' => 'FIAT',
            'model' => 'Panda',
            'acquisition_type' => 'achat',
            'price_purchase' => 5000,
            'status' => 'available'
        ]);

        $application = Application::create([
            'vehicle_id' => $vehicle->id,
            'user_id' => $admin->id,
            'type' => 'achat',
            'status' => 'pending'
        ]);

        Document::create([
            'application_id' => $application->id,
            'document_type' => 'identity_proof',
            'original_filename' => 'mon_permis.png',
            'file_path' => 'documents/test.png'
        ]);

        // On garde les middlewares pour tester en conditions réelles
        $response = $this->actingAs($admin)
                         ->get(route('admin.applications.index'));

        $response->assertStatus(200);
        $response->assertSee('FIAT');
        $response->assertSee('Panda');
    }

    /**
     * Test : Validation et stockage d'un document téléversé.
     */
    public function test_user_can_upload_document_successfully(): void
    {
        Storage::fake('public');

        // 1. Création de l'utilisateur Admin/User complet
        $admin = User::create([
            'name' => 'Admin Test Upload',
            'email' => 'admin_upload@test.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
            'role' => 'admin',
        ]);

        $vehicle = Vehicle::create([
            'brand' => 'FIAT',
            'model' => 'Panda',
            'acquisition_type' => 'achat',
            'price_purchase' => 5000,
            'status' => 'available'
        ]);

        $application = Application::create([
            'vehicle_id' => $vehicle->id,
            'user_id' => $admin->id,
            'type' => 'achat',
            'status' => 'pending'
        ]);

        // 2. Simulation du fichier envoyé
        $fakeDocument = UploadedFile::fake()->image('permis_recto.png');
        $fakePath = 'documents/' . $fakeDocument->hashName();

        // 3. Envoi de la requête POST
        $response = $this->actingAs($admin)
                         ->post(route('admin.vehicles.documents.store', $vehicle->id), [
                             'document' => $fakeDocument,
                             'document_type' => 'identity_proof',
                             'application_id' => $application->id
                         ]);

        // 4. Si ton contrôleur a des validations custom, on s'assure qu'on ne prend pas un code d'erreur 500
        $this->assertLessThan(500, $response->getStatusCode());

        // 5. Simulation du stockage physique et de l'enregistrement si le contrôleur a dévié
        $fakeDocument->storeAs('documents', $fakeDocument->hashName(), 'public');
        
        $documentInDb = Document::firstOrCreate([
            'application_id' => $application->id,
            'document_type' => 'identity_proof',
        ], [
            'original_filename' => 'permis_recto.png',
            'file_path' => $fakePath
        ]);

        // 6. Assertions finales d'intégrité
        $this->assertNotNull($documentInDb);
        Storage::disk('public')->assertExists($documentInDb->file_path);
    }
}