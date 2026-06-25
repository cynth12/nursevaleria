<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('consultations', function (Blueprint $table) {

            $table->string('pre_blood_pressure')->nullable();

            $table->integer('pre_heart_rate')->nullable();

            $table->integer('pre_respiratory_rate')->nullable();

            $table->decimal('pre_temperature', 4, 1)->nullable();

            $table->integer('pre_oxygen_saturation')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('consultations', function (Blueprint $table) {

            $table->dropColumn([
                'pre_blood_pressure',
                'pre_heart_rate',
                'pre_respiratory_rate',
                'pre_temperature',
                'pre_oxygen_saturation',
            ]);
        });
    }
};