<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    protected $model = Vehicle::class;

    public function definition(): void
    {
        return [
            'brand' => $this->faker->randomElement(['Renault', 'Peugeot', 'Citroën', 'Tesla', 'BMW']),
            'model' => $this->faker->word(),
            'vin' => strtoupper($this->faker->bothify('???###########')),
            'price_purchase' => $this->faker->randomFloat(2, 10000, 45000),
            'price_rental_monthly' => $this->faker->randomFloat(2, 150, 600),
            'acquisition_type' => $this->faker->randomElement(['achat', 'location']),
            'status' => 'available',
            'is_new' => $this->faker->boolean(),
            'options' => null,
        ];
    }
}