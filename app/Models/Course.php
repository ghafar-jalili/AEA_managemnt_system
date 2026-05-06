<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'teacher_id',
        'title',
        'description',
        'course_time',
        'price',
        'teacher_name',
        'thumbnail',
        'status',
        'youtube_playlist_id',
        'minimum_students',
        'current_interested_count',
        'scheduled_start_time',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    /**
     * Relationship: Course requests
     */
    public function requests()
    {
        return $this->hasMany(CourseRequest::class, 'course_name', 'title');
    }

    /**
     * Relationship: Course owner (teacher)
     */
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    /**
     * Relationship: Course lessons
     */
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    /**
     * Relationship: Course enrollments
     */
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    /**
     * Relationship: Course certificates
     */
    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    /**
     * Scope: Only active courses
     */
    public function scopeActive($query)
    {
        return $query->whereIn('status', ['active', 'will_start_soon']);
    }

    /**
     * Scope: Courses that will start soon
     */
    public function scopeWillStartSoon($query)
    {
        return $query->where('status', 'will_start_soon');
    }

    /**
     * Scope: Requestable courses
     */
    public function scopeRequestable($query)
    {
        return $query->whereIn('status', ['active', 'will_start_soon']);
    }

    /**
     * Scope: Search courses
     */
    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('teacher_name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        return $query;
    }

    /**
     * Get thumbnail URL
     */
    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail) {
            return asset('storage/' . $this->thumbnail);
        }
        return null;
    }

    /**
     * Get total enrolled students count (including pending)
     */
    public function getEnrolledStudentsCountAttribute()
    {
        return $this->enrollments()
            ->whereIn('status', ['pending', 'approved', 'completed'])
            ->count();
    }
}
