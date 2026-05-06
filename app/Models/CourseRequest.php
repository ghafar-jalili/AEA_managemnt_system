<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseRequest extends Model
{
    protected $fillable = [
        'course_name',
        'student_name',
        'father_name',
        'student_phone',
        'student_id',
        'preferred_time',
        'preferred_teacher',
        'additional_message',
        'status'
    ];

    /**
     * Relationship: Student who made the request
     */
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    /**
     * Get count of requests for the same course
     */
    public function getCourseRequestCountAttribute()
    {
        return static::where('course_name', $this->course_name)
                     ->where('status', 'pending')
                     ->count();
    }

    /**
     * Scope: Only pending requests
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope: Group by course name
     */
    public function scopeGroupedByCourse($query)
    {
        return $query->select('course_name')
                     ->groupBy('course_name');
    }
}
