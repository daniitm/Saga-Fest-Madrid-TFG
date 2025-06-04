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
        Schema::create('expositions', function (Blueprint $table) {
            $table->id();
            $table->enum('stand_category ', allowed: ['publishers', 'production companies / platforms', 'videogames', 'merchandising', 'artists / creators', 'cosplay', 'education', 'association']);
            $table->enum('stand_size', allowed: ['small', 'medium', 'large']);
            $table->boolean('wired_internet');
            $table->boolean('audio_sound_configuration');
            $table->string('special_requirements');
            $table->string('additional_information')->nullable();
            $table->foreignId('expositor_id')->constrained('expositors')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expositions');
    }
};
