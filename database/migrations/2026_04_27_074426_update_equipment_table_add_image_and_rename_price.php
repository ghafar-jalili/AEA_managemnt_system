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
        Schema::table('equipment', function (Blueprint $table) {
            $table->string('image')->nullable()->after('quantity');
            
            // Rename rental_price_per_day to rental_price_per_month if it exists
            if (Schema::hasColumn('equipment', 'rental_price_per_day')) {
                $table->renameColumn('rental_price_per_day', 'rental_price_per_month');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('equipment', function (Blueprint $table) {
            $table->dropColumn('image');
            
            if (Schema::hasColumn('equipment', 'rental_price_per_month')) {
                $table->renameColumn('rental_price_per_month', 'rental_price_per_day');
            }
        });
    }
};
