<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_fmg_patients', function (Blueprint $table) {

            $table->id();

            $table->timestamp('registration_date')->nullable();

            // Información personal
            $table->string('name');
            $table->string('last_name');
            $table->date('date_of_birth');

            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();

            // Contacto de emergencia
            $table->string('emergency_name')->nullable();
            $table->string('emergency_relationship')->nullable();
            $table->string('emergency_phone')->nullable();

            // Medical History
            $table->boolean('pregnant')->default(false);
            $table->boolean('vitamins_intolerance')->default(false);
            $table->boolean('minerals_intolerance')->default(false);

            // Allergies
            $table->text('allergy_medicine')->nullable();
            $table->text('allergy_food')->nullable();
            $table->text('reaction')->nullable();

            // Medications
            $table->longText('medications')->nullable();

            // Supplements
            $table->longText('supplements')->nullable();

            // Physical exam
            $table->longText('physical_exam')->nullable();

            // Reason
            $table->text('reason')->nullable();

            // Symptoms
            $table->text('symptoms')->nullable();

            // Referral
            $table->text('referral_source')->nullable();
            $table->text('referral_other')->nullable();

            // Requested IV
            $table->string('iv_type')->nullable();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_fmg_patients');
    }
};

