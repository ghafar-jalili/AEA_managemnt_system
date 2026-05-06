<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $fillable = [
        'course_id',
        'name',
        'description',
        'owner_name',
        'owner_contact',
        'rental_price_per_month',
        'status',
        'quantity',
        'image',
    ];

    protected $casts = [
        'rental_price_per_month' => 'decimal:2',
    ];

    /**
     * Get image URL
     */
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return null;
    }

    /**
     * Relationship: Associated course (optional)
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Relationship: Equipment rentals
     */
    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}
