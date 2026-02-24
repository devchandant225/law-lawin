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
        // Update meta_tags table
        Schema::table('meta_tags', function (Blueprint $table) {
            if (!Schema::hasColumn('meta_tags', 'schema_head')) {
                $table->json('schema_head')->nullable()->after('image');
            }
            if (!Schema::hasColumn('meta_tags', 'schema_body')) {
                $table->json('schema_body')->nullable()->after('is_active');
            }
        });

        // Copy data for meta_tags if old column exists
        if (Schema::hasColumn('meta_tags', 'schema_json_ld')) {
            DB::table('meta_tags')->update([
                'schema_head' => DB::raw('schema_json_ld')
            ]);

            Schema::table('meta_tags', function (Blueprint $table) {
                $table->dropColumn('schema_json_ld');
            });
        }

        // Update posts table
        Schema::table('posts', function (Blueprint $table) {
            if (!Schema::hasColumn('posts', 'schema_head')) {
                $table->json('schema_head')->nullable()->after('layout');
            }
            if (!Schema::hasColumn('posts', 'schema_body')) {
                $table->json('schema_body')->nullable()->after('schema_head');
            }
        });

        // Copy data for posts if old column exists
        if (Schema::hasColumn('posts', 'google_schema')) {
            DB::table('posts')->update([
                'schema_head' => DB::raw('google_schema')
            ]);

            Schema::table('posts', function (Blueprint $table) {
                $table->dropColumn('google_schema');
            });
        }

        // Update publications table
        Schema::table('publications', function (Blueprint $table) {
            if (!Schema::hasColumn('publications', 'schema_head')) {
                $table->json('schema_head')->nullable()->after('metakeywords');
            }
            if (!Schema::hasColumn('publications', 'schema_body')) {
                $table->json('schema_body')->nullable()->after('schema_head');
            }
        });

        // Copy data for publications if old column exists
        if (Schema::hasColumn('publications', 'google_schema')) {
            DB::table('publications')->update([
                'schema_head' => DB::raw('google_schema')
            ]);

            Schema::table('publications', function (Blueprint $table) {
                $table->dropColumn('google_schema');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse meta_tags
        if (!Schema::hasColumn('meta_tags', 'schema_json_ld')) {
            Schema::table('meta_tags', function (Blueprint $table) {
                $table->json('schema_json_ld')->nullable()->after('image');
            });

            DB::table('meta_tags')->update([
                'schema_json_ld' => DB::raw('schema_head')
            ]);
        }

        Schema::table('meta_tags', function (Blueprint $table) {
            if (Schema::hasColumn('meta_tags', 'schema_head')) {
                $table->dropColumn('schema_head');
            }
            if (Schema::hasColumn('meta_tags', 'schema_body')) {
                $table->dropColumn('schema_body');
            }
        });

        // Reverse posts
        if (!Schema::hasColumn('posts', 'google_schema')) {
            Schema::table('posts', function (Blueprint $table) {
                $table->json('google_schema')->nullable()->after('layout');
            });

            DB::table('posts')->update([
                'google_schema' => DB::raw('schema_head')
            ]);
        }

        Schema::table('posts', function (Blueprint $table) {
            if (Schema::hasColumn('posts', 'schema_head')) {
                $table->dropColumn('schema_head');
            }
            if (Schema::hasColumn('posts', 'schema_body')) {
                $table->dropColumn('schema_body');
            }
        });

        // Reverse publications
        if (!Schema::hasColumn('publications', 'google_schema')) {
            Schema::table('publications', function (Blueprint $table) {
                $table->json('google_schema')->nullable()->after('metakeywords');
            });

            DB::table('publications')->update([
                'google_schema' => DB::raw('schema_head')
            ]);
        }

        Schema::table('publications', function (Blueprint $table) {
            if (Schema::hasColumn('publications', 'schema_head')) {
                $table->dropColumn('schema_head');
            }
            if (Schema::hasColumn('publications', 'schema_body')) {
                $table->dropColumn('schema_body');
            }
        });
    }
};
