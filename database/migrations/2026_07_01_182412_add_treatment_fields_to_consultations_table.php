<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('consultations', function (Blueprint $table) {

            $table->text('treatment_description')->nullable()->after('treatment_id');

            $table->longText('treatment_formula')->nullable()->after('treatment_description');

        });
    }

    public function down(): void
    {
        Schema::table('consultations', function (Blueprint $table) {

            $table->dropColumn([
                'treatment_description',
                'treatment_formula'
            ]);

        });
    }
};