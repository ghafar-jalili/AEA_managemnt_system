<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyLesson extends Model
{
    protected $fillable = [
        'title',
        'description',
        'youtube_video_id',
        'lesson_date',
        'is_active',
    ];

    protected $casts = [
        'lesson_date' => 'date',
        'is_active' => 'boolean',
    ];

    /**
     * Scope: Only active lessons
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: Lessons for specific date
     */
    public function scopeForDate($query, $date)
    {
        return $query->whereDate('lesson_date', $date);
    }
}
