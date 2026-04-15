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
        $table->string('authorized_procedure')->nullable();
        $table->integer('heart_rate')->nullable();
        $table->integer('oxigen_saturation')->nullable();
        $table->decimal('temperature', 4, 1)->nullable();
        $table->string('blood_pressure')->nullable();
        $table->boolean('consent_accepted')->default(false);
        $table->text('digital_signature')->nullable();
    });
}

public function down()
{
    Schema::table('patients', function (Blueprint $table) {
        $table->dropColumn([
            'authorized_procedure',
            'heart_rate',
            'oxigen_saturation',
            'temperature',
            'blood_pressure',
            'consent_accepted',
            'digital_signature',
        ]);
    });
}
};
