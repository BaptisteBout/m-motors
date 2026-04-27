<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        Log::info('Recherche catalogue effectuée', [
            'type_filtre' => $request->query('type', 'tous'),
            'ip' => $request->ip()
        ]);

        // On récupère le type d'acquisition depuis l'URL (ex: ?type=location)
        $type = $request->query('type');

        // On filtre la requête si un type est spécifié
        $query = Vehicle::query();

        if ($type) {
            $query->where('acquisition_type', $type)
                ->orWhere('acquisition_type', 'both');
        }

        $vehicles = $query->get();

        // On retourne la vue avec les véhicules filtrés
        return view('vehicles.index', compact('vehicles'));
    }
}