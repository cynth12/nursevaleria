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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();

            // Datos personales
            $table->string('name', 150);
            $table->date('date_of_birth')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('email', 150)->unique();

            // Contacto de emergencia
            $table->string('emergency_name', 150)->nullable();
            $table->string('emergency_relationship', 100)->nullable();
            $table->string('emergency_phone', 20)->nullable();

            // Historial médico
            $table->boolean('pregnant')->nullable(); // yes/no
            $table->boolean('vitamins_intolerance')->nullable(); // yes/no
            $table->boolean('minerals_intolerance')->nullable(); // yes/no

            // Alergias
            $table->string('allergy_medicine', 100)->nullable();
            $table->string('allergy_food', 150)->nullable();
            $table->string('reaction', 150)->nullable();

            // Medicamentos y suplementos
            $table->text('medications')->nullable();
            $table->text('supplements')->nullable();

            // Examen físico
            $table->text('physical_exam')->nullable();

            // Notas del administrador
            $table->text('notes')->nullable();
            // Fecha de registro automática 
            $table->timestamp('registration_date')->useCurrent(); 
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
