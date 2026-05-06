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
     * This migration properly handles the status column for both SQLite and MySQL.
     * It converts is_active (boolean) to status (string) if the status column doesn't exist.
     */
    public function up(): void
    {
        // Check if status column already exists (might have been added manually)
        if (Schema::hasColumn('courses', 'status')) {
            // Status column exists, just ensure it has the right values
            return;
        }

        // Add status column as string (works for both SQLite and MySQL)
        Schema::table('courses', function (Blueprint $table) {
            $table->string('status')->default('active')->after('youtube_playlist_id');
        });

        // Migrate data from is_active to status
        if (Schema::hasColumn('courses', 'is_active')) {
            // Convert boolean to string status
            DB::table('courses')
                ->where('is_active', true)
                ->update(['status' => 'active']);
            
            DB::table('courses')
                ->where('is_active', false)
                ->update(['status' => 'inactive']);

            // Drop the old is_active column
            Schema::table('courses', function (Blueprint $table) {
                $table->dropColumn('is_active');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Add back is_active column
        Schema::table('courses', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->after('youtube_playlist_id');
        });

        // Migrate data back
        DB::table('courses')
            ->where('status', 'active')
            ->update(['is_active' => true]);
        
        DB::table('courses')
            ->where('status', '!=', 'active')
            ->update(['is_active' => false]);

        // Drop status column
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
