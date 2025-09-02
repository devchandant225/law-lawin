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
            // First drop the existing enum constraint
            $table->dropColumn('post_type');
        });
        
        Schema::table('publications', function (Blueprint $table) {
            // Add the new enum with all four values
            $table->enum('post_type', ['publication', 'more-publication', 'service-location', 'language'])
                  ->default('publication')
                  ->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('publications', function (Blueprint $table) {
            // Drop the column
            $table->dropColumn('post_type');
        });
        
        Schema::table('publications', function (Blueprint $table) {
            // Restore the original enum with only two values
            $table->enum('post_type', ['publication', 'more-publication'])
                  ->default('publication')
                  ->after('status');
        });
    }
};
