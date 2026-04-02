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
        Schema::create('group_patients', function (Blueprint $table) {
    $table->id();
    $table->foreignId('group_id')->constrained('groups')->onDelete('cascade');
    $table->string('name');
    $table->date('date_of_birth')->nullable();
    $table->string('phone')->nullable();
    $table->string('email')->nullable();
    $table->string('address')->nullable();

    // Historial médico
    $table->boolean('pregnant')->default(0);
    $table->boolean('vitamins_intolerance')->default(0);
    $table->boolean('minerals_intolerance')->default(0);

    // Alergias
    $table->string('allergy_medicine')->nullable();
    $table->string('allergy_food')->nullable();
    $table->string('reaction')->nullable();

    // Medicamentos y suplementos
    $table->text('medications')->nullable();
    $table->text('supplements')->nullable();
    $table->text('physical_exam')->nullable();

    // Consentimiento
    $table->boolean('consent_accepted')->default(0);
    $table->string('digital_signature')->nullable();
    $table->string('authorized_procedure')->nullable();

    // Signos vitales
    $table->integer('heart_rate')->nullable();
    $table->integer('oxygen_saturation')->nullable();
    $table->decimal('temperature', 5, 2)->nullable();
    $table->string('blood_pressure')->nullable();

    // Notas
    $table->text('notes')->nullable();

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_patients');
    }
};
