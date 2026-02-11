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
        // For MySQL/MariaDB, we can use DB::statement to modify enum
        DB::statement("ALTER TABLE posts MODIFY COLUMN type ENUM('service', 'practice', 'news', 'blog', 'help_desk') DEFAULT 'blog'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE posts MODIFY COLUMN type ENUM('service', 'practice', 'news', 'blog') DEFAULT 'blog'");
    }
};
