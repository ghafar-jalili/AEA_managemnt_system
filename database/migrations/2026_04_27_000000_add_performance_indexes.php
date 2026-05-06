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
        // Add indexes to enrollments table
        Schema::table('enrollments', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('course_id');
            $table->index('status');
        });

        // Add indexes to certificates table
        Schema::table('certificates', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('course_id');
            $table->index('certificate_number');
        });

        // Add indexes to lessons table
        Schema::table('lessons', function (Blueprint $table) {
            $table->index('course_id');
            $table->index('order');
        });

        // Add indexes to equipment table
        Schema::table('equipment', function (Blueprint $table) {
            $table->index('course_id');
            $table->index('status');
        });

        // Add indexes to rentals table
        Schema::table('rentals', function (Blueprint $table) {
            $table->index('equipment_id');
            $table->index('user_id');
            $table->index('status');
        });

        // Add indexes to daily_lessons table
        Schema::table('daily_lessons', function (Blueprint $table) {
            $table->index('lesson_date');
            $table->index('is_active');
        });

        // Add indexes to users table
        Schema::table('users', function (Blueprint $table) {
            $table->index('role');
            $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('enrollments', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['course_id']);
            $table->dropIndex(['status']);
        });

        Schema::table('certificates', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['course_id']);
            $table->dropIndex(['certificate_number']);
        });

        Schema::table('lessons', function (Blueprint $table) {
            $table->dropIndex(['course_id']);
            $table->dropIndex(['order']);
        });

        Schema::table('equipment', function (Blueprint $table) {
            $table->dropIndex(['course_id']);
            $table->dropIndex(['status']);
        });

        Schema::table('rentals', function (Blueprint $table) {
            $table->dropIndex(['equipment_id']);
            $table->dropIndex(['user_id']);
            $table->dropIndex(['status']);
        });

        Schema::table('daily_lessons', function (Blueprint $table) {
            $table->dropIndex(['lesson_date']);
            $table->dropIndex(['is_active']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['role']);
            $table->dropIndex(['email']);
        });
    }
};
