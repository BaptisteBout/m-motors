<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Application;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    public function create(Vehicle $vehicle) {
        return view('applications.create', compact('vehicle'));
    }

    public function store(Request $request, Vehicle $vehicle) {
        // 1. Validation (Compétence C3.1 : Sécurité des données)
        $request->validate([
            'document' => 'required|mimes:pdf,jpg,png|max:2048',
        ]);

        // 2. Création du dossier
        $application = Application::create([
            'user_id' => 1, // Pour la démo, on force l'user 1 (notre client test)
            'vehicle_id' => $vehicle->id,
            'type' => $vehicle->acquisition_type,
            'status' => 'pending'
        ]);

        // 3. Stockage du fichier (Compétence C3.2 : Intégrité)
        if ($request->hasFile('document')) {
            $path = $request->file('document')->store('applications_docs', 'public');
            
            Document::create([
                'application_id' => $application->id,
                'document_type' => 'identity_proof',
                'file_path' => $path,
                'original_filename' => $request->file('document')->getClientOriginalName()
            ]);
        }

        return redirect()->route('vehicles.index')->with('success', 'Dossier déposé avec succès !');
    }
}