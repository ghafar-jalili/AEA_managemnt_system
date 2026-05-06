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
        Schema::table('enrollments', function (Blueprint $table) {
            // Change status enum to include pending and rejected
            $table->dropColumn('status');
        });
        
        Schema::table('enrollments', function (Blueprint $table) {
            $table->enum('status', ['pending', 'approved', 'rejected', 'completed'])->default('pending')->after('course_id');
            $table->text('admin_notes')->nullable()->after('status');
            $table->timestamp('approved_at')->nullable()->after('admin_notes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('enrollments', function (Blueprint $table) {
            $table->dropColumn(['status', 'admin_notes', 'approved_at']);
            $table->enum('status', ['active', 'completed', 'cancelled'])->default('active');
        });
    }
};
