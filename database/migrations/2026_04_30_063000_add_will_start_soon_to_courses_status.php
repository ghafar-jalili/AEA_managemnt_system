<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * NOTE: This migration is now handled by 2026_05_06_120000_fix_courses_status_column.php
     * which properly handles both SQLite and MySQL.
     * 
     * The status column is now a string that accepts: 'active', 'inactive', 'will_start_soon'
     * Validation is handled in the Model and FormRequest classes.
     */
    public function up(): void
    {
        // No action needed - status column is already a string
        // The 'will_start_soon' value is validated at the application level
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No action needed
    }
};
