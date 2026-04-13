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
        $table->string('iv_type')->nullable();   // campo para la solicitud de IV
        $table->text('symptoms')->nullable();    // campo para guardar síntomas seleccionados
    });
}

public function down()
{
    Schema::table('patients', function (Blueprint $table) {
        $table->dropColumn(['iv_type', 'symptoms']);
    });
}

};
