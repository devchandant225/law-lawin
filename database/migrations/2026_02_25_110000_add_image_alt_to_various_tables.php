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
        // Update teams table
        Schema::table('teams', function (Blueprint $table) {
            if (!Schema::hasColumn('teams', 'image_alt')) {
                $table->string('image_alt')->nullable()->after('image');
            }
        });

        // Update portfolios table
        Schema::table('portfolios', function (Blueprint $table) {
            if (!Schema::hasColumn('portfolios', 'image_alt')) {
                $table->string('image_alt')->nullable()->after('image');
            }
        });

        // Update about_us_content_sections table
        Schema::table('about_us_content_sections', function (Blueprint $table) {
            if (!Schema::hasColumn('about_us_content_sections', 'image1_alt')) {
                $table->string('image1_alt')->nullable()->after('image1');
            }
            if (!Schema::hasColumn('about_us_content_sections', 'image2_alt')) {
                $table->string('image2_alt')->nullable()->after('image2');
            }
        });

        // Update pages table
        Schema::table('pages', function (Blueprint $table) {
            if (!Schema::hasColumn('pages', 'feature_image_alt')) {
                $table->string('feature_image_alt')->nullable()->after('feature_image');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->dropColumn('image_alt');
        });

        Schema::table('portfolios', function (Blueprint $table) {
            $table->dropColumn('image_alt');
        });

        Schema::table('about_us_content_sections', function (Blueprint $table) {
            $table->dropColumn(['image1_alt', 'image2_alt']);
        });

        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('feature_image_alt');
        });
    }
};
