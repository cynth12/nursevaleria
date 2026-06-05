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
    Schema::table('consentimientos', function (Blueprint $table) {
        $table->unsignedBigInteger('consultation_id')->nullable()->after('patient_id');

        $table->foreign('consultation_id')
              ->references('id')
              ->on('consultations')
              ->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('consentimientos', function (Blueprint $table) {
            //
        });
    }
};
