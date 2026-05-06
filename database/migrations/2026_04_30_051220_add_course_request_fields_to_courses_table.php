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
        Schema::table('courses', function (Blueprint $table) {
            // Check if columns don't exist before adding them
            if (!Schema::hasColumn('courses', 'minimum_students')) {
                $table->integer('minimum_students')->default(3)->after('status');
            }
            if (!Schema::hasColumn('courses', 'current_interested_count')) {
                $table->integer('current_interested_count')->default(0)->after('minimum_students');
            }
            if (!Schema::hasColumn('courses', 'scheduled_start_time')) {
                $table->string('scheduled_start_time')->nullable()->after('current_interested_count');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn(['minimum_students', 'current_interested_count', 'scheduled_start_time']);
        });
    }
};
