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
    Schema::table('group_patients', function (Blueprint $table) {
        $table->string('nurse_name', 150)->nullable();
        $table->string('nurse_id', 50)->nullable();
    });
}

public function down()
{
    Schema::table('group_patients', function (Blueprint $table) {
        $table->dropColumn(['nurse_name', 'nurse_id']);
    });
}

};
