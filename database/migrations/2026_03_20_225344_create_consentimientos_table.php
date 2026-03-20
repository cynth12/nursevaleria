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
        Schema::create('consentimientos', function (Blueprint $table) {
    $table->id();
    $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');

    $table->string('nurse_name', 150)->nullable();
    $table->string('nurse_id', 50)->nullable();

    $table->string('authorized_procedure', 150)->nullable();
    $table->boolean('consent_accepted')->default(false);
    $table->text('digital_signature')->nullable();
    $table->date('consent_date')->nullable();

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consentimientos');
    }
};
