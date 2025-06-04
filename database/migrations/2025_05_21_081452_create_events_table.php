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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('contact_person');
            $table->string('email');
            $table->string('phone');
            $table->string('website')->nullable();
            $table->enum('stand_category', allowed: ['Editoriales', 'Productoras / Plataformas', 'Videojuegos', 'Merchandising', 'Artistas / Creadores', 'Cosplay', 'Educación', 'Asociaciones']);
            $table->enum('stand_size', allowed: ['Pequeño', 'Medio', 'Grande']);
            $table->boolean('wired_internet');
            $table->boolean('audio_sound_configuration');
            $table->time('event_start_time');
            $table->time('event_end_time');
            $table->foreignId('schedule_id')->constrained('schedules')->onDelete('set null');
            $table->foreignId('space_id')->nullable()->constrained('spaces')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');

        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign(['space_id']);
            $table->dropForeign(['schedule_id']);
            $table->dropColumn(['space_id', 'schedule_id']);
        });
    }
};
