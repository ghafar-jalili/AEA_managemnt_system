<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseRequest;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Notification;

class CourseRequestController extends Controller
{
    /**
     * Display all course requests grouped by course.
     */
    public function index()
    {
        // Clear requests notification for the admin
        Notification::clearCount(auth()->id(), 'requests');

        $teachers = User::where('role', 'teacher')->get(['id', 'name']);

        // Get all unique course names with their request counts
        $courseRequests = CourseRequest::select('course_name', DB::raw('count(*) as request_count'))
            ->where('status', 'pending')
            ->groupBy('course_name')
            ->orderByDesc('request_count')
            ->get();

        // Get detailed requests for each course
        $coursesData = [];
        foreach ($courseRequests as $request) {
            $coursesData[$request->course_name] = [
                'course_name' => $request->course_name,
                'request_count' => $request->request_count,
                'is_ready' => $request->request_count >= 3,
                'requests' => CourseRequest::where('course_name', $request->course_name)
                    ->where('status', 'pending')
                    ->orderBy('created_at', 'desc')
                    ->get(),
            ];
        }

        // Stats
        $stats = [
            'total_requests' => CourseRequest::where('status', 'pending')->count(),
            'courses_ready' => collect($coursesData)->where('is_ready', true)->count(),
            'pending_courses' => collect($coursesData)->where('is_ready', false)->count(),
        ];

        return view('admin.course-requests.index', compact('coursesData', 'stats', 'teachers'));
    }

    /**
     * Create a course from course requests.
     */
    public function createCourseFromRequest(Request $request, $courseName)
    {
        $validated = $request->validate([
            'teacher_id' => 'required|exists:users,id',
            'price' => 'required|numeric|min:0',
            'scheduled_start_time' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Get the teacher's name
        $teacher = \App\Models\User::find($validated['teacher_id']);

        DB::beginTransaction();
        try {
            // Create the course
            $course = Course::create([
                'teacher_id' => $validated['teacher_id'],
                'title' => $courseName,
                'description' => $validated['description'] ?? "Course for {$courseName}",
                'price' => $validated['price'],
                'teacher_name' => $teacher->name,
                'status' => 'will_start_soon',
                'minimum_students' => 3,
                'current_interested_count' => CourseRequest::where('course_name', $courseName)
                    ->where('status', 'pending')
                    ->count(),
                'scheduled_start_time' => $validated['scheduled_start_time'],
            ]);

            // Get all pending requests for this course
            $pendingRequests = CourseRequest::where('course_name', $courseName)
                ->where('status', 'pending')
                ->get();

            // Enroll students who are registered users
            foreach ($pendingRequests as $req) {
                if ($req->student_id) {
                    Enrollment::create([
                        'user_id' => $req->student_id,
                        'course_id' => $course->id,
                        'status' => 'approved',
                        'enrolled_at' => now(),
                        'approved_at' => now(),
                    ]);

                    // Update request status
                    $req->update(['status' => 'enrolled']);
                }
            }

            DB::commit();

            return redirect()->route('admin.course-requests.index')
                ->with('success', "Course '{$courseName}' created successfully with {$pendingRequests->count()} students enrolled!");

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to create course: ' . $e->getMessage());
        }
    }

    /**
     * Mark requests as notified.
     */
    public function notifyAdmin($courseName)
    {
        CourseRequest::where('course_name', $courseName)
            ->where('status', 'pending')
            ->update(['status' => 'notified']);

        return back()->with('success', "Admin has been notified about '{$courseName}' requests.");
    }
}
