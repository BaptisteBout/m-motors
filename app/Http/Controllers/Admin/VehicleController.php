<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\Document;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    // R - Read : Afficher la liste des véhicules pour l'admin
    public function index()
    {
        $vehicles = Vehicle::latest()->paginate(10);
        return view('admin.vehicles.index', compact('vehicles'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        return view('admin.vehicles.create');
    }

    // C - Create : Enregistrer un nouveau véhicule en base MySQL
    public function store(Request $request)
    {
        // 1. On force la valeur de l'acquisition en minuscules pour valider "achat" ou "location" sans erreur
        if ($request->has('acquisition_type')) {
            $request->merge([
                'acquisition_type' => strtolower($request->input('acquisition_type'))
            ]);
        }

        // 2. On ajuste la validation pour rendre optionnels les champs absents de ton interface graphique
        $validated = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'vin' => 'nullable|string|max:255|unique:vehicles,vin',
            'price_purchase' => 'required|numeric|min:0',
            'price_rental_monthly' => 'nullable|numeric|min:0', // Changé en nullable si absent du formulaire
            'acquisition_type' => 'required|string|in:achat,location',
            'status' => 'required|string|max:255',
            'is_new' => 'nullable|boolean',                     // Changé en nullable
        ]);

        // Gestion propre de la case à cocher (si elle est absente, on met false)
        $validated['is_new'] = $request->has('is_new');

        Vehicle::create($validated);

        return redirect()->route('admin.vehicles.index')
            ->with('success', 'Véhicule ajouté avec succès !');
    }

    // Afficher le formulaire de modification
    public function edit(Vehicle $vehicle)
    {
        return view('admin.vehicles.edit', compact('vehicle'));
    }

    // U - Update : Mettre à jour les données du véhicule
    public function update(Request $request, Vehicle $vehicle)
    {
        // 1. On force également en minuscules lors de la modification
        if ($request->has('acquisition_type')) {
            $request->merge([
                'acquisition_type' => strtolower($request->input('acquisition_type'))
            ]);
        }

        // 2. Validation adaptée pour la mise à jour
        $validated = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'vin' => 'nullable|string|max:255|unique:vehicles,vin,' . $vehicle->id,
            'price_purchase' => 'required|numeric|min:0',
            'price_rental_monthly' => 'nullable|numeric|min:0', // Changé en nullable
            'acquisition_type' => 'required|string|in:achat,location',
            'status' => 'required|string|max:255',
            'is_new' => 'nullable|boolean',                     // Changé en nullable
        ]);

        $validated['is_new'] = $request->has('is_new');

        $vehicle->update($validated);

        return redirect()->route('admin.vehicles.index')
            ->with('success', 'Véhicule mis à jour !');
    }

    // D - Delete : Supprimer un véhicule du stock
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        return redirect()->route('admin.vehicles.index')
            ->with('success', 'Véhicule supprimé du système.');
    }

    public function uploadDocuments(Vehicle $vehicle)
    {
        return view('admin.vehicles.documents', compact('vehicle'));
    }

    public function storeDocument(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'document_type' => 'required|string|max:255', // ex: 'identity_card', 'payslip', 'registration'
            'vehicle_document' => 'required|file|mimes:pdf,png,jpg,jpeg|max:5120', // Max 5 Mo
        ]);

        if ($request->hasFile('vehicle_document')) {
            $file = $request->file('vehicle_document');

            $originalName = $file->getClientOriginalName();

            $path = $file->store('documents', 'public');

            Document::create([
                'application_id' => $vehicle->id,
                'document_type' => $request->input('document_type'),
                'file_path' => $path,
                'original_filename' => $originalName,
            ]);

            return redirect()->route('admin.vehicles.index')
                ->with('success', 'Le document "' . $originalName . '" a bien été téléversé et enregistré en base !');
        }

        return back()->withErrors(['vehicle_document' => 'Le fichier n\'a pas pu être chargé.']);
    }

    public function listApplications()
{
    // On récupère les documents ET leurs véhicules associés
    $documents = Document::with('vehicle')->orderBy('created_at', 'desc')->get();

    return view('admin.applications.index', compact('documents'));
}
}