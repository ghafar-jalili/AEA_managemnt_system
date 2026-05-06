<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enrollment extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'course_id',
        'status',
        'enrolled_at',
        'admin_notes',
        'approved_at',
    ];

    protected $casts = [
        'enrolled_at' => 'datetime',
        'approved_at' => 'datetime',
    ];

    /**
     * Relationship: Student who enrolled
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: Enrolled course
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Check if enrollment is approved
     */
    public function isApproved()
    {
        return $this->status === 'approved' || $this->status === 'completed';
    }

    /**
     * Check if enrollment is pending
     */
    public function isPending()
    {
        return $this->status === 'pending';
    }
}
