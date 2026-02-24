<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update meta_tags table
        Schema::table('meta_tags', function (Blueprint $table) {
            $table->renameColumn('schema_json_ld', 'schema_head');
            $table->text('schema_body')->nullable()->after('is_active');
        });

        // Update posts table
        Schema::table('posts', function (Blueprint $table) {
            $table->renameColumn('google_schema', 'schema_head');
            $table->text('schema_body')->nullable()->after('schema_head');
        });

        // Update publications table
        Schema::table('publications', function (Blueprint $table) {
            $table->renameColumn('google_schema', 'schema_head');
            $table->text('schema_body')->nullable()->after('schema_head');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('meta_tags', function (Blueprint $table) {
            $table->renameColumn('schema_head', 'schema_json_ld');
            $table->dropColumn('schema_body');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->renameColumn('schema_head', 'google_schema');
            $table->dropColumn('schema_body');
        });

        Schema::table('publications', function (Blueprint $table) {
            $table->renameColumn('schema_head', 'google_schema');
            $table->dropColumn('schema_body');
        });
    }
};
