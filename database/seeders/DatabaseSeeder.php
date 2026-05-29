<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use \App\Models\Vehicle;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Création d'un compte employé pour la démo du Back-office
        User::create([
            'name' => 'Admin M-Motors',
            'email' => 'admin@m-motors.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Création d'un client test pour la démo du Dossier Dématérialisé
        User::create([
            'name' => 'Jean Client',
            'email' => 'jean@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'client',
        ]);

        // On peut aussi générer 10 clients aléatoires pour montrer la scalabilité
        User::factory(10)->create();

        Vehicle::create([
            'brand' => 'Tesla',
            'model' => 'Model 3',
            'vin' => 'XYZ123456789',
            'price_purchase' => 45000,
            'price_rental_monthly' => 550.00,
            'acquisition_type' => 'achat',
            'status' => 'available',
            'is_new' => true,
        ]);

        Vehicle::create([
            'brand' => 'Renault',
            'model' => 'Clio 5',
            'vin' => 'ABC987654321',
            'price_purchase' => 18000,
            'price_rental_monthly' => 250.00,
            'acquisition_type' => 'achat',
            'status' => 'available',
            'is_new' => false,
        ]);
    }
}