<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('spaces', function (Blueprint $table) {
            $table->id();
            $table->string('location_code'); // Ej: P0-1, C1-5, C2-10
            $table->enum('location_area', ['P0', 'C1', 'C2']); // Plaza o cabinas
            $table->enum('space_size', ['Pequeño', 'Medio', 'Grande']); // Tamaño del espacio
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spaces');
    }
};
