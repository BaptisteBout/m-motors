<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Vehicle;
use App\Models\User;

class VehicleManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_admin_can_create_a_vehicle()
    {
        // 1. On simule la connexion d'un admin
        $admin = User::factory()->create(['is_admin' => true]);

        // 2. On envoie les données du nouveau véhicule
        $response = $this->actingAs($admin)->post('/vehicles', [
            'brand' => 'Tesla',
            'model' => 'Model 3',
            'price' => 35000,
            'kilometers' => 10000,
            'description' => 'Super état, recharge gratuite.',
        ]);

        // 3. On vérifie que la voiture est bien dans la base MySQL
        $this->assertDatabaseHas('vehicles', [
            'brand' => 'Tesla',
            'model' => 'Model 3'
        ]);

        // 4. On vérifie qu'on est redirigé vers la liste
        $response->assertRedirect('/vehicles');
    }

    public function test_a_vehicle_can_be_updated()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $vehicle = Vehicle::factory()->create(['price' => 20000]);

        $response = $this->actingAs($admin)->put("/vehicles/{$vehicle->id}", [
            'brand' => $vehicle->brand,
            'model' => $vehicle->model,
            'price' => 18000, // Nouveau prix
        ]);

        $this->assertDatabaseHas('vehicles', [
            'id' => $vehicle->id,
            'price' => 18000
        ]);
    }

    public function test_user_can_search_vehicles_by_brand()
    {
        // On crée deux voitures
        Vehicle::factory()->create(['brand' => 'Peugeot']);
        Vehicle::factory()->create(['brand' => 'Renault']);

        // On simule la recherche sur le site
        $response = $this->get('/vehicles?search=Peugeot');

        // On vérifie que le texte "Peugeot" est là, mais pas "Renault"
        $response->assertStatus(200);
        $response->assertSee('Peugeot');
        $response->assertDontSee('Renault');
    }
}
