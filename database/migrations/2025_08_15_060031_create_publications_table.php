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
        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('feature_image')->nullable();
            $table->text('description')->nullable();
            $table->text('excerpt')->nullable();
            $table->enum('status', ['active', 'inactive', 'draft'])->default('draft');
            $table->integer('orderlist')->default(0);
            $table->string('metatitle')->nullable();
            $table->text('metadescription')->nullable();
            $table->text('metakeywords')->nullable();
            $table->json('google_schema')->nullable();
            $table->timestamps();

            $table->index(['status', 'orderlist']);
            $table->index('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publications');
    }
};
