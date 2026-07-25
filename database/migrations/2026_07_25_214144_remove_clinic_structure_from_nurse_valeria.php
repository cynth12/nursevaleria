<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Quitar relaciones con clínicas
        |--------------------------------------------------------------------------
        */

        if (Schema::hasColumn('patients', 'clinic_id')) {
            Schema::table('patients', function (Blueprint $table) {
                $table->dropForeign(['clinic_id']);
                $table->dropColumn('clinic_id');
            });
        }

        if (Schema::hasColumn('treatments', 'clinic_id')) {
            Schema::table('treatments', function (Blueprint $table) {
                $table->dropForeign(['clinic_id']);
                $table->dropColumn('clinic_id');
            });
        }

        if (Schema::hasColumn('import_files', 'clinic_id')) {
            Schema::table('import_files', function (Blueprint $table) {
                $table->dropForeign(['clinic_id']);
                $table->dropColumn('clinic_id');
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Quitar tablas multi-clínica
        |--------------------------------------------------------------------------
        */

        Schema::dropIfExists('clinic_user');
        Schema::dropIfExists('clinics');

        /*
        |--------------------------------------------------------------------------
        | Quitar campo de Super Admin
        |--------------------------------------------------------------------------
        */

        if (Schema::hasColumn('users', 'is_super_admin')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('is_super_admin');
            });
        }
    }

    public function down(): void
    {
        // Esta migración es una limpieza definitiva de Nurse Valeria.
        // No se reconstruye automáticamente la arquitectura multi-clínica.
    }
};