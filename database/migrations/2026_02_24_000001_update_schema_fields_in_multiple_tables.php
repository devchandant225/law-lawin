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
            $table->json('schema_head')->nullable()->after('image');
            $table->text('schema_body')->nullable()->after('is_active');
        });

        // Copy data for meta_tags
        DB::table('meta_tags')->update([
            'schema_head' => DB::raw('schema_json_ld')
        ]);

        Schema::table('meta_tags', function (Blueprint $table) {
            $table->dropColumn('schema_json_ld');
        });

        // Update posts table
        Schema::table('posts', function (Blueprint $table) {
            $table->json('schema_head')->nullable()->after('layout');
            $table->text('schema_body')->nullable()->after('schema_head');
        });

        // Copy data for posts
        DB::table('posts')->update([
            'schema_head' => DB::raw('google_schema')
        ]);

        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('google_schema');
        });

        // Update publications table
        Schema::table('publications', function (Blueprint $table) {
            $table->json('schema_head')->nullable()->after('metakeywords');
            $table->text('schema_body')->nullable()->after('schema_head');
        });

        // Copy data for publications
        DB::table('publications')->update([
            'schema_head' => DB::raw('google_schema')
        ]);

        Schema::table('publications', function (Blueprint $table) {
            $table->dropColumn('google_schema');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse meta_tags
        Schema::table('meta_tags', function (Blueprint $table) {
            $table->json('schema_json_ld')->nullable()->after('image');
        });

        DB::table('meta_tags')->update([
            'schema_json_ld' => DB::raw('schema_head')
        ]);

        Schema::table('meta_tags', function (Blueprint $table) {
            $table->dropColumn(['schema_head', 'schema_body']);
        });

        // Reverse posts
        Schema::table('posts', function (Blueprint $table) {
            $table->json('google_schema')->nullable()->after('layout');
        });

        DB::table('posts')->update([
            'google_schema' => DB::raw('schema_head')
        ]);

        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['schema_head', 'schema_body']);
        });

        // Reverse publications
        Schema::table('publications', function (Blueprint $table) {
            $table->json('google_schema')->nullable()->after('metakeywords');
        });

        DB::table('publications')->update([
            'google_schema' => DB::raw('schema_head')
        ]);

        Schema::table('publications', function (Blueprint $table) {
            $table->dropColumn(['schema_head', 'schema_body']);
        });
    }
};
