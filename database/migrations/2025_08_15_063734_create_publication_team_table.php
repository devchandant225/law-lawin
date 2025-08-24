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
        Schema::create('publication_team', function (Blueprint $table) {
            $table->id();
            $table->foreignId('publication_id')->constrained('publications')->onDelete('cascade');
            $table->foreignId('team_id')->constrained('teams')->onDelete('cascade');
            $table->string('role')->nullable(); // e.g., 'Author', 'Editor', 'Contributor'
            $table->timestamps();

            // Unique constraint to prevent duplicate assignments
            $table->unique(['publication_id', 'team_id']);
            
            // Indexes for performance
            $table->index('publication_id');
            $table->index('team_id');
            $table->index('role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publication_team');
    }
};
