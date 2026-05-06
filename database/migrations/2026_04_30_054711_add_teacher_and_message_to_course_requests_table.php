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
        Schema::table('course_requests', function (Blueprint $table) {
            $table->string('preferred_teacher')->nullable()->after('preferred_time');
            $table->text('additional_message')->nullable()->after('preferred_teacher');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course_requests', function (Blueprint $table) {
            $table->dropColumn(['preferred_teacher', 'additional_message']);
        });
    }
};
