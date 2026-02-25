<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update teams table
        Schema::table('teams', function (Blueprint $table) {
            if (!Schema::hasColumn('teams', 'schema_head')) {
                $table->json('schema_head')->nullable()->after('googleschema');
            }
            if (!Schema::hasColumn('teams', 'schema_body')) {
                $table->json('schema_body')->nullable()->after('schema_head');
            }
        });

        // Copy data for teams if old column exists
        if (Schema::hasColumn('teams', 'googleschema')) {
            DB::table('teams')->update([
                'schema_head' => DB::raw('googleschema')
            ]);

            Schema::table('teams', function (Blueprint $table) {
                $table->dropColumn('googleschema');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse teams
        if (!Schema::hasColumn('teams', 'googleschema')) {
            Schema::table('teams', function (Blueprint $table) {
                $table->json('googleschema')->nullable()->after('metakeywords');
            });

            DB::table('teams')->update([
                'googleschema' => DB::raw('schema_head')
            ]);
        }

        Schema::table('teams', function (Blueprint $table) {
            if (Schema::hasColumn('teams', 'schema_head')) {
                $table->dropColumn('schema_head');
            }
            if (Schema::hasColumn('teams', 'schema_body')) {
                $table->dropColumn('schema_body');
            }
        });
    }
};
