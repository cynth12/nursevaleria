<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->string('public_token', 64)
                ->nullable()
                ->unique()
                ->after('id');
        });

        // Generate a unique public token for existing groups
        $groups = DB::table('groups')
            ->whereNull('public_token')
            ->get();

        foreach ($groups as $group) {
            DB::table('groups')
                ->where('id', $group->id)
                ->update([
                    'public_token' => Str::random(40),
                ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->dropUnique(['public_token']);
            $table->dropColumn('public_token');
        });
    }
};