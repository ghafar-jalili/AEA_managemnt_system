<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use App\Models\ContactMessage;
use App\Models\Certificate;
use App\Models\CourseRequest;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        // Get basic stats
        $totalUsers = User::count();
        $totalCourses = Course::count();
        $totalEnrollments = Enrollment::count();
        $totalCertificates = Certificate::count();
        $unreadMessages = ContactMessage::where('is_read', false)->count();

        // Course requests ready to start (3+ requests)
        $pendingCourseRequests = CourseRequest::select('course_name')
            ->where('status', 'pending')
            ->groupBy('course_name')
            ->havingRaw('COUNT(*) >= 3')
            ->count();

        // Total individual pending course requests
        $totalPendingRequests = CourseRequest::where('status', 'pending')->count();

        // Courses with "will_start_soon" status that have 3+ interested students
        $coursesReadyToStart = Course::where('status', 'will_start_soon')
            ->where('current_interested_count', '>=', 3)
            ->get();

        // Get notification counts for each section
        $sections = ['courses', 'enrollments', 'certificates', 'messages', 'equipment', 'reports', 'users', 'requests'];
        $notifications = [];
        foreach ($sections as $section) {
            $notification = Notification::where('user_id', $userId)->where('section', $section)->first();
            $notifications[$section] = $notification ? $notification->count : 0;
        }

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalCourses',
            'totalEnrollments',
            'totalCertificates',
            'unreadMessages',
            'pendingCourseRequests',
            'totalPendingRequests',
            'coursesReadyToStart',
            'notifications'
        ));
    }

    public function reports()
    {
        // Clear reports notification for the admin
        \App\Models\Notification::clearCount(auth()->id(), 'reports');

        // Get all stats
        $totalUsers = User::count();
        $totalCourses = Course::count();
        $totalEnrollments = Enrollment::count();
        $totalCertificates = Certificate::count();

        // Users by role
        $usersByRole = User::select('role', DB::raw('count(*) as count'))
            ->groupBy('role')
            ->pluck('count', 'role')
            ->toArray();

        // Enrollments by status
        $enrollmentsByStatus = Enrollment::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // Monthly enrollments (last 12 months)
        $monthlyEnrollments = Enrollment::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('YEAR(created_at) as year'),
            DB::raw('count(*) as count')
        )
            ->where('created_at', '>=', now()->subMonths(12))
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Certificates by status
        $certificatesByStatus = [
            'Verified' => Certificate::where('is_verified', true)->count(),
            'Pending' => Certificate::where('is_verified', false)->count(),
        ];

        // Top courses by enrollment
        $topCourses = Course::withCount('enrollments')
            ->orderByDesc('enrollments_count')
            ->limit(10)
            ->get();

        // Courses by teacher
        $coursesByTeacher = Course::select('teacher_name', DB::raw('count(*) as count'))
            ->groupBy('teacher_name')
            ->orderByDesc('count')
            ->get();

        // Recent activity (last 20 enrollments)
        $recentActivity = Enrollment::with(['user', 'course'])
            ->latest()
            ->limit(20)
            ->get();

        return view('admin.reports', compact(
            'totalUsers',
            'totalCourses',
            'totalEnrollments',
            'totalCertificates',
            'usersByRole',
            'enrollmentsByStatus',
            'monthlyEnrollments',
            'certificatesByStatus',
            'topCourses',
            'coursesByTeacher',
            'recentActivity'
        ));
    }
}
