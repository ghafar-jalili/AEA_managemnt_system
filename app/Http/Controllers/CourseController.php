<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseRequest;
use App\Models\Enrollment;
use App\Models\Certificate;
use App\Http\Requests\Course\StoreCourseRequest;
use App\Http\Requests\Course\UpdateCourseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource (for users - only active courses).
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
        
        $courses = Course::query()
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            }, function ($query) {
                return $query->active();
            })
            ->search($search)
            ->with('teacher')
            ->withCount('enrollments')
            ->latest()
            ->paginate(6);

        $userEnrollmentsByCourseId = collect();
        $hasCourseRequestByCourseTitle = collect();
        if (Auth::check() && !Auth::user()->isAdmin()) {
            $courseIds = $courses->getCollection()->pluck('id');
            $courseTitles = $courses->getCollection()->pluck('title');

            $userEnrollmentsByCourseId = Enrollment::where('user_id', Auth::id())
                ->whereIn('course_id', $courseIds)
                ->get()
                ->keyBy('course_id');

            $hasCourseRequestByCourseTitle = CourseRequest::where('student_id', Auth::id())
                ->where('status', 'pending')
                ->whereIn('course_name', $courseTitles)
                ->get(['course_name'])
                ->groupBy('course_name')
                ->map(fn ($items) => $items->isNotEmpty());
        }

        return view('courses.index', compact(
            'courses',
            'search',
            'status',
            'userEnrollmentsByCourseId',
            'hasCourseRequestByCourseTitle'
        ));
    }

    /**
     * Display a listing for admin (all courses).
     */
    public function adminIndex(Request $request)
    {
        // Clear courses notification for the admin
        if (auth()->user()->role === 'admin') {
            \App\Models\Notification::clearCount(auth()->id(), 'courses');
        }

        $search = $request->input('search');
        $status = $request->input('status');
        
        $courses = Course::query()
            ->when($search, function ($query, $search) {
                return $query->search($search);
            })
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->with(['teacher', 'enrollments'])
            ->withCount('enrollments')
            ->latest()
            ->paginate(10);

        return view('admin.courses.index', compact('courses', 'search', 'status'));
    }

    /**
     * Get students for a course (AJAX endpoint).
     */
    public function getStudents(Course $course)
    {
        $students = $course->enrollments()
            ->with('user')
            ->get()
            ->map(function ($enrollment) {
                return [
                    'name' => $enrollment->user->name,
                    'email' => $enrollment->user->email,
                    'status' => $enrollment->status,
                    'enrolled_at' => $enrollment->enrolled_at ? $enrollment->enrolled_at->format('M d, Y') : 'N/A'
                ];
            });

        return response()->json(['students' => $students]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = \App\Models\User::where('role', 'teacher')->get();
        return view('admin.courses.create', compact('teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request)
    {
        // Authorization is handled in StoreCourseRequest
        $validated = $request->validated();

        // Handle file upload
        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('courses', 'public');
        }

        $validated['teacher_id'] = Auth::id();

        Course::create($validated);

        // Increment courses notification for all admin users
        $adminUsers = \App\Models\User::where('role', 'admin')->get();
        foreach ($adminUsers as $admin) {
            \App\Models\Notification::incrementCount($admin->id, 'courses');
        }

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        if ($course->status === 'inactive' && !Auth::user()?->isAdmin()) {
            abort(404);
        }

        // Load relationships to avoid N+1 queries
        $course->load(['lessons' => function ($query) {
            $query->orderBy('order');
        }]);

        $enrollment = null;
        $certificate = null;
        $hasCourseRequest = false;
        $freePreviewLesson = null;

        if (Auth::check()) {
            $enrollment = Enrollment::where('user_id', Auth::id())
                ->where('course_id', $course->id)
                ->first();

            $certificate = Certificate::where('user_id', Auth::id())
                ->where('course_id', $course->id)
                ->first();

            $hasCourseRequest = CourseRequest::where('student_id', Auth::id())
                ->where('course_name', $course->title)
                ->where('status', 'pending')
                ->exists();
        }

        if ($course->lessons->count() > 0) {
            $freePreviewLesson = $course->lessons
                ->where('is_free', true)
                ->sortBy('order')
                ->first();
        }

        return view('courses.show', compact(
            'course',
            'enrollment',
            'certificate',
            'hasCourseRequest',
            'freePreviewLesson'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        // Only admin or the teacher who created it can edit
        if (!Auth::user()->isAdmin() && $course->teacher_id !== Auth::id()) {
            abort(403);
        }

        $teachers = \App\Models\User::where('role', 'teacher')->get();
        return view('admin.courses.edit', compact('course', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        // Authorization is handled in UpdateCourseRequest
        $validated = $request->validated();

        // Handle file upload
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail
            if ($course->thumbnail) {
                Storage::disk('public')->delete($course->thumbnail);
            }
            
            $validated['thumbnail'] = $request->file('thumbnail')->store('courses', 'public');
        }

        $course->update($validated);

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        // Use policy for authorization
        $this->authorize('delete', $course);

        // Delete thumbnail if exists
        if ($course->thumbnail) {
            Storage::disk('public')->delete($course->thumbnail);
        }

        $course->delete();

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course deleted successfully!');
    }

    /**
     * Toggle course status (active/inactive).
     */
    public function toggleStatus(Course $course)
    {
        // Use policy for authorization
        $this->authorize('toggleStatus', $course);

        // Cycle through statuses: active -> will_start_soon -> inactive -> active
        $newStatus = match($course->status) {
            'active' => 'will_start_soon',
            'will_start_soon' => 'inactive',
            'inactive' => 'active',
            default => 'active',
        };

        $updateData = ['status' => $newStatus];
        
        // When changing from "will_start_soon" to "active", set start_date to now
        if ($course->status === 'will_start_soon' && $newStatus === 'active') {
            $updateData['start_date'] = now();
        }

        $course->update($updateData);

        return back()->with('success', 'Course status updated to: ' . ucfirst(str_replace('_', ' ', $newStatus)));
    }

    /**
     * Show wishlist courses (courses requested by students).
     */
    public function showWishlistCourses()
    {
        // Get grouped data for course requests
        $wishlistData = CourseRequest::select('course_name')
            ->where('status', 'pending')
            ->groupBy('course_name')
            ->get()
            ->map(function($item) {
                $count = CourseRequest::where('course_name', $item->course_name)
                    ->where('status', 'pending')
                    ->count();
                $times = CourseRequest::where('course_name', $item->course_name)
                    ->where('status', 'pending')
                    ->whereNotNull('preferred_time')
                    ->pluck('preferred_time')
                    ->unique();
                
                return [
                    'course_name' => $item->course_name,
                    'request_count' => $count,
                    'preferred_times' => $times,
                    'is_ready' => $count >= 3,
                ];
            });

        return view('courses.wishlist', compact('wishlistData'));
    }

    /**
     * Submit a course request.
     */
    public function requestCourse(Request $request)
    {
        $validated = $request->validate([
            'course_name' => 'required|string|max:255',
            'student_name' => 'required|string|max:255',
            'student_phone' => 'required|string|max:20',
            'preferred_time' => 'nullable|string|max:255',
        ]);

        // Check if this user already requested this course
        $existingRequest = null;
        if (Auth::check()) {
            $existingRequest = CourseRequest::where('course_name', $validated['course_name'])
                ->where('student_id', Auth::id())
                ->where('status', 'pending')
                ->first();
        }

        if ($existingRequest) {
            return back()->with('info', 'You have already requested this course. We will contact you soon!');
        }

        // Create the request
        $courseRequest = CourseRequest::create([
            'course_name' => $validated['course_name'],
            'student_name' => $validated['student_name'],
            'student_phone' => $validated['student_phone'],
            'student_id' => Auth::id(),
            'preferred_time' => $validated['preferred_time'],
            'status' => 'pending',
        ]);

        // Check if 3+ students requested this course
        $interestedCount = CourseRequest::where('course_name', $validated['course_name'])
            ->where('status', 'pending')
            ->count();

        $message = 'Your request has been submitted! We will contact you soon.';
        if ($interestedCount >= 3) {
            $message = "Great! {$interestedCount} students want this course. We'll start it soon and contact you!";
        }

        return back()->with('success', $message);
    }
}
