<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = ['brand', 'model', 'price_purchase', 'acquisition_type', 'status'];

    /**
     * Logique de basculement Vente <=> Location
     * Maximise la préservation des données existantes
     */
    public function toggleAcquisitionMode()
    {
        $this->acquisition_type = ($this->acquisition_type === 'achat') ? 'location' : 'achat';
        
        // Si on passe en location, on peut calculer un loyer par défaut
        if ($this->acquisition_type === 'location') {
            $this->price_rental_monthly = ($this->price_purchase / 48) + 50;
        }

        return $this->save();
    }
}