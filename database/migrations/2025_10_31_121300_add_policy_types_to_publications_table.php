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
        Schema::table('publications', function (Blueprint $table) {
            // First drop the existing enum column
            $table->dropColumn('post_type');
        });

        Schema::table('publications', function (Blueprint $table) {
            // Add the new enum with all the values
            $table->enum('post_type', [
                'publication', 
                'more-publication', 
                'terms-condition', 
                'privacy-policy', 
                'cookies-policy'
            ])->default('publication')->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('publications', function (Blueprint $table) {
            // First drop the extended enum
            $table->dropColumn('post_type');
        });

        Schema::table('publications', function (Blueprint $table) {
            // Restore the original enum
            $table->enum('post_type', ['publication', 'more-publication'])->default('publication')->after('status');
        });
    }
};