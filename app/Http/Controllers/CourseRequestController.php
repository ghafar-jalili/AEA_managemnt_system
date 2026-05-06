<?php

namespace App\Http\Controllers;

use App\Models\CourseRequest;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseRequestController extends Controller
{
    /**
     * Show the course request form.
     */
    public function showForm()
    {
        $teachers = User::where('role', 'teacher')->get(['id', 'name']);

        return view('course-request.form', compact('teachers'));
    }

    /**
     * Submit a course request.
     */
    public function submitRequest(Request $request)
    {
        $validated = $request->validate([
            'student_name' => 'required|string|max:255',
            'student_email' => 'required|email|max:255',
            'student_phone' => 'required|string|max:20',
            'course_name' => 'required|string|max:255',
            'preferred_teacher' => 'nullable|string|max:255',
            'custom_teacher_name' => 'nullable|string|max:255',
            'preferred_time' => 'required|string|max:255',
            'message' => 'nullable|string',
        ]);

        // Determine the final teacher name
        $teacherName = $validated['preferred_teacher'];
        if ($teacherName === 'custom') {
            $teacherName = $validated['custom_teacher_name'] ?? 'Not specified';
        }

        // Create the course request
        CourseRequest::create([
            'course_name' => $validated['course_name'],
            'student_name' => $validated['student_name'],
            'student_phone' => $validated['student_phone'],
            'student_id' => Auth::id(),
            'preferred_time' => $validated['preferred_time'],
            'preferred_teacher' => $teacherName,
            'additional_message' => $validated['message'] ?? null,
            'status' => 'pending',
        ]);
// Increment requests notification for all admin users
        $adminUsers = \App\Models\User::where('role', 'admin')->get();
        foreach ($adminUsers as $admin) {
            Notification::incrementCount($admin->id, 'requests');
        }

        
        return redirect()->route('course-request.form')
            ->with('success', "Your request for '{$validated['course_name']}' has been submitted. We'll contact you within 24-48 hours!");
    }

    /**
     * Quick course request from course card (logged-in user).
     */
    public function submitQuickRequest(Request $request)
    {
        $validated = $request->validate([
            'course_name' => 'required|string|max:255',
            'student_name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'father_name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'student_phone' => 'required|string|max:20|regex:/^[0-9]+$/',
            'preferred_time' => 'required|string|max:255',
        ], [
            'student_name.regex' => 'Name must contain only letters and spaces.',
            'father_name.regex' => 'Father name must contain only letters and spaces.',
            'student_phone.regex' => 'Phone number must contain only numbers.',
        ]);

        $user = Auth::user();

        // Find the course and increment interested count
        $course = \App\Models\Course::where('title', $validated['course_name'])->first();
        if ($course) {
            $course->increment('current_interested_count');
        }

        CourseRequest::create([
            'course_name' => $validated['course_name'],
            'student_name' => $validated['student_name'],
            'father_name' => $validated['father_name'],
            'student_phone' => $validated['student_phone'],
            'student_id' => $user->id,
            'preferred_time' => $validated['preferred_time'],
            'preferred_teacher' => 'Not specified',
            'additional_message' => null,
            'status' => 'pending',
        ]);

        // Increment requests notification for all admin users
        $adminUsers = \App\Models\User::where('role', 'admin')->get();
        foreach ($adminUsers as $admin) {
            \App\Models\Notification::incrementCount($admin->id, 'requests');
        }

        return back()->with('success', "Your request for '{$validated['course_name']}' has been submitted. We'll contact you within 24-48 hours!");
    }

    /**
     * Admin: Add student manually (name, father_name, phone, time).
     */
    public function adminAddStudentRequest(Request $request)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $validated = $request->validate([
            'course_name' => 'required|string|max:255',
            'student_name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'father_name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'student_phone' => 'required|string|max:20|regex:/^[0-9]+$/',
            'preferred_time' => 'required|string|max:255',
        ], [
            'student_name.regex' => 'Student name must contain only letters and spaces.',
            'father_name.regex' => 'Father name must contain only letters and spaces.',
            'student_phone.regex' => 'Phone number must contain only numbers.',
        ]);

        // Find the course and increment interested count
        $course = \App\Models\Course::where('title', $validated['course_name'])->first();
        if ($course) {
            $course->increment('current_interested_count');
        }

        // Create the course request
        CourseRequest::create([
            'course_name' => $validated['course_name'],
            'student_name' => $validated['student_name'],
            'father_name' => $validated['father_name'],
            'student_phone' => $validated['student_phone'],
            'student_id' => null,
            'preferred_time' => $validated['preferred_time'],
            'preferred_teacher' => 'Not specified',
            'additional_message' => 'Added by admin',
            'status' => 'pending',
        ]);

        return back()->with('success', "Student '{$validated['student_name']}' has been added to the request list for '{$validated['course_name']}'.");
    }
}
