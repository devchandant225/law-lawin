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
        // First drop the foreign key constraint
        Schema::table('left_right_contents', function (Blueprint $table) {
            $table->dropForeign(['publication_id']);
        });

        // Add the new column with non-nullable constraint
        Schema::table('left_right_contents', function (Blueprint $table) {
            $table->unsignedBigInteger('post_id')->after('status');
        });

        // Copy data from old column to new column
        DB::statement('UPDATE left_right_contents SET post_id = publication_id');

        // Drop the old column
        Schema::table('left_right_contents', function (Blueprint $table) {
            $table->dropColumn('publication_id');
        });

        // Add the foreign key constraint
        Schema::table('left_right_contents', function (Blueprint $table) {
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the foreign key constraint
        Schema::table('left_right_contents', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
        });

        // Add the old column back
        Schema::table('left_right_contents', function (Blueprint $table) {
            $table->unsignedBigInteger('publication_id')->after('status');
        });

        // Copy data from new column to old column
        DB::statement('UPDATE left_right_contents SET publication_id = post_id');

        // Drop the new column
        Schema::table('left_right_contents', function (Blueprint $table) {
            $table->dropColumn('post_id');
        });

        // Add the old foreign key constraint
        Schema::table('left_right_contents', function (Blueprint $table) {
            $table->foreign('publication_id')->references('id')->on('publications')->onDelete('cascade');
        });
    }
};
