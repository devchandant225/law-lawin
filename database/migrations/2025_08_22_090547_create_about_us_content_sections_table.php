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
        Schema::create('about_us_content_sections', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('desc_1')->nullable();
            $table->text('desc_2')->nullable();
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->enum('page_type', ['about-page', 'home-page']);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->integer('order_list')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us_content_sections');
    }
};
