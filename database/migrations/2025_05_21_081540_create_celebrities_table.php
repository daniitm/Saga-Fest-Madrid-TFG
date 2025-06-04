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
        Schema::create('celebrities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surnames');
            $table->string('email');
            $table->string('biography');
            $table->string('photo')->default('imagen_perfil.png');
            $table->enum('category', ['Actores / Actrices', 'Dibujantes / Ilustradores', 'Guionistas / Creadores', 'Desarrolladores / Diseñadores', 'Productores / Directores / Compositores', 'Influencers / YouTubers / Streamers']);
            $table->string('website')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
