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
    Schema::table('patients', function (Blueprint $table) {
        // Fuente de referencia (ej. Instagram, Facebook, etc.)
        $table->string('referral_source')->nullable();

        // Texto libre para "Other"
        $table->string('referral_other')->nullable();
    });
}

public function down()
{
    Schema::table('patients', function (Blueprint $table) {
        $table->dropColumn('referral_source');
        $table->dropColumn('referral_other');
    });
}


};
