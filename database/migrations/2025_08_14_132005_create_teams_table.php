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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('designation')->nullable();
            $table->integer('orderlist')->default(0);
            $table->string('image')->nullable();
            $table->longText('description')->nullable();
            $table->string('tagline')->nullable();
            $table->text('experience')->nullable();
            $table->text('qualification')->nullable();
            $table->longText('additional_details')->nullable();
            $table->string('metatitle')->nullable();
            $table->text('metadescription')->nullable();
            $table->text('metakeywords')->nullable();
            $table->json('googleschema')->nullable();
            $table->string('facebooklink')->nullable();
            $table->string('linkedinlink')->nullable();
            $table->enum('status', ['active', 'inactive', 'draft'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
