<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consentimientos', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('patient_id');
    $table->boolean('consent_accepted')->default(false);
    $table->string('digital_signature')->nullable();
    $table->date('consent_date')->nullable();
    $table->string('authorized_procedure', 150)->nullable();
    $table->string('nurse_name', 150)->nullable();
    $table->string('nurse_id', 50)->nullable();
    $table->timestamps();

    $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
});
    }

    public function down(): void
    {
        Schema::dropIfExists('consentimientos');
    }
};
