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
        Schema::create('course_requests', function (Blueprint $table) {
            $table->id();
            $table->string('course_name');
            $table->string('student_name');
            $table->string('student_phone');
            $table->foreignId('student_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('preferred_time')->nullable();
            $table->enum('status', ['pending', 'notified', 'enrolled'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_requests');
    }
};
