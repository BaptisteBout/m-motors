<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'brand',
        'model',
        'vin',
        'price_purchase',
        'price_rental_monthly',
        'acquisition_type',
        'status',
        'is_new',
        'options'
    ];

    protected $casts = [
        'is_new' => 'boolean',
        'options' => 'array',
        'price_purchase' => 'decimal:2',
        'price_rental_monthly' => 'decimal:2',
    ];

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