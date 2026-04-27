<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('brand');
            $table->string('model');
            $table->string('vin')->unique(); // Numéro de châssis pour l'unicité
            $table->decimal('price_purchase', 10, 2); // Prix de vente
            $table->decimal('price_rental_monthly', 10, 2)->nullable(); // Loyer calculé
            $table->enum('acquisition_type', ['achat', 'location', 'both'])->default('both');
            $table->enum('status', ['available', 'reserved', 'sold', 'rented'])->default('available');
            $table->boolean('is_new')->default(false); // Occasion par défaut
            $table->json('options')->nullable(); // Pour stocker Clim, GPS, etc.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
