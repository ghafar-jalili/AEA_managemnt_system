<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $fillable = [
        'equipment_id',
        'user_id',
        'start_date',
        'end_date',
        'total_price',
        'status',
        'notes',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'total_price' => 'decimal:2',
    ];

    /**
     * Relationship: Rented equipment
     */
    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

    /**
     * Relationship: User who rented
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
