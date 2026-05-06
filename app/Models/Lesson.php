<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'course_id',
        'title',
        'description',
        'youtube_video_id',
        'order',
        'is_free',
    ];

    protected $casts = [
        'is_free' => 'boolean',
    ];

    /**
     * Relationship: Parent course
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
