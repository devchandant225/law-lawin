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
        Schema::table('publications', function (Blueprint $table) {
            // Drop the existing post_type column if it exists
            if (Schema::hasColumn('publications', 'post_type')) {
                $table->dropColumn('post_type');
            }
        });
        
        Schema::table('publications', function (Blueprint $table) {
            // Add the post_type column as VARCHAR instead of ENUM
            $table->string('post_type', 50)->default('publication')->after('status');
            $table->index('post_type'); // Add index for better performance
        });
        
        // Update existing records to ensure they have valid post_type values
        DB::table('publications')
            ->whereNull('post_type')
            ->orWhere('post_type', '')
            ->update(['post_type' => 'publication']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('publications', function (Blueprint $table) {
            $table->dropIndex(['post_type']);
            $table->dropColumn('post_type');
        });
        
        Schema::table('publications', function (Blueprint $table) {
            $table->enum('post_type', ['publication', 'more-publication', 'service-location', 'language'])
                  ->default('publication')
                  ->after('status');
        });
    }
};
