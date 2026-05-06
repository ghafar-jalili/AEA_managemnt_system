<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'user_id',
        'course_id',
        'certificate_number',
        'student_name',
        'course_name',
        'issue_date',
        'start_date',
        'is_verified',
    ];

    protected $casts = [
        'issue_date' => 'date',
        'start_date' => 'date',
        'is_verified' => 'boolean',
    ];

    /**
     * Relationship: Certificate owner
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: Associated course
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Generate unique certificate number
     */
    public static function generateCertificateNumber()
    {
        $prefix = 'AFG';
        $timestamp = now()->format('Ymd');
        $random = strtoupper(substr(md5(uniqid()), 0, 6));
        
        return "{$prefix}-{$timestamp}-{$random}";
    }
}
