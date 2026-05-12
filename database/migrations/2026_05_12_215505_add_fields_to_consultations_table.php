<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('consultations', function (Blueprint $table) {
        $table->string('name', 150)->nullable();
        $table->string('last_name', 150)->nullable();
        $table->date('date_of_birth')->nullable();
        $table->string('phone', 20)->nullable();
        $table->string('email', 150)->nullable();
        $table->string('address', 255)->nullable();

        $table->string('emergency_name', 150)->nullable();
        $table->string('emergency_relationship', 100)->nullable();
        $table->string('emergency_phone', 20)->nullable();

        $table->boolean('pregnant')->nullable();
        $table->boolean('vitamins_intolerance')->nullable();
        $table->boolean('minerals_intolerance')->nullable();

        $table->string('allergy_medicine', 100)->nullable();
        $table->string('allergy_food', 150)->nullable();
        $table->string('reaction', 150)->nullable();

        $table->text('medications')->nullable();
        $table->text('supplements')->nullable();
        $table->text('physical_exam')->nullable();

        $table->boolean('consent_accepted')->nullable();
        $table->text('digital_signature')->nullable();
        $table->string('authorized_procedure', 255)->nullable();

        $table->integer('heart_rate')->nullable();
        $table->integer('oxygen_saturation')->nullable();
        $table->decimal('temperature', 5, 2)->nullable();
        $table->string('blood_pressure', 20)->nullable();

        $table->text('notes')->nullable();
        $table->string('iv_type', 255)->nullable();
        $table->text('symptoms')->nullable();
        $table->string('reason')->nullable();
        $table->text('referral_source')->nullable();
        $table->string('referral_other', 255)->nullable();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('consultations', function (Blueprint $table) {
        $table->dropColumn([
            'name','last_name','date_of_birth','phone','email','address',
            'emergency_name','emergency_relationship','emergency_phone',
            'pregnant','vitamins_intolerance','minerals_intolerance',
            'allergy_medicine','allergy_food','reaction',
            'medications','supplements','physical_exam',
            'consent_accepted','digital_signature','authorized_procedure',
            'heart_rate','oxygen_saturation','temperature','blood_pressure',
            'notes','iv_type','symptoms','reason','referral_source','referral_other'
        ]);
    });
    }
};
