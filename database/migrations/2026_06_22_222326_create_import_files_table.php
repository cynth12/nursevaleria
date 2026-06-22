<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('import_files', function (Blueprint $table) {
            $table->id();
            $table->string('file_name');       // nombre guardado en storage
            $table->string('original_name');    // nombre real del usuario
            $table->string('path');             // ruta del archivo
            $table->timestamps();               // created_at = fecha de subida
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('import_files');
    }
};