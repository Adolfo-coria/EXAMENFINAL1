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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->foreignId('dentist_id')->constrained('dentists')->onDelete('cascade');
            $table->dateTime('appointment_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('reason'); // Motivo de la cita
            $table->text('notes')->nullable(); // Notas adicionales
            $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled'])->default('pending');
            $table->decimal('cost', 10, 2)->nullable(); // Costo de la consulta
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
