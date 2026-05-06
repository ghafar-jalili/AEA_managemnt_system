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
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->nullable()->constrained('courses')->onDelete('set null');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('owner_name');
            $table->string('owner_contact')->nullable();
            $table->decimal('rental_price_per_day', 10, 2);
            $table->enum('status', ['available', 'rented', 'maintenance'])->default('available');
            $table->integer('quantity')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};
