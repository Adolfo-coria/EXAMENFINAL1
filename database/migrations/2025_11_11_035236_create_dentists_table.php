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
        Schema::create('dentists', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('license_number')->unique(); // Número de cédula profesional
            $table->string('specialization'); // Especialidad
            $table->text('biography')->nullable();
            $table->string('office_location')->nullable();
            $table->time('start_time')->default('08:00'); // Hora inicio consulta
            $table->time('end_time')->default('17:00'); // Hora fin consulta
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dentists');
    }
};
