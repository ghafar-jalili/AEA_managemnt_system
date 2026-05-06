<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Certificate;
use App\Models\Notification;
use App\Http\Requests\Enrollment\AdminAddStudentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    /**
     * Enroll student in a course
     */
    public function enroll(Course $course)
    {
        $user = Auth::user();

        // Check if already enrolled
        $existingEnrollment = Enrollment::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->first();

        if ($existingEnrollment) {
            if ($existingEnrollment->status === 'approved' || $existingEnrollment->status === 'completed') {
                return back()->with('error', 'You are already enrolled in this course.');
            } elseif ($existingEnrollment->status === 'pending') {
                return back()->with('error', 'Your enrollment is pending admin approval.');
            } elseif ($existingEnrollment->status === 'rejected') {
                return back()->with('error', 'Your previous enrollment was rejected. Please contact admin.');
            }
        }

        // Create enrollment with PENDING status for paid courses
        Enrollment::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'status' => 'pending', // Requires admin approval
            'enrolled_at' => now(),
        ]);

        // Increment enrollments notification for all admin users
        $adminUsers = \App\Models\User::where('role', 'admin')->get();
        foreach ($adminUsers as $admin) {
            \App\Models\Notification::incrementCount($admin->id, 'enrollments');
        }

        return back()->with('success', 'Enrollment request submitted! Admin will review and approve your enrollment.');
    }

    /**
     * Unenroll from a course
     */
    public function unenroll(Course $course)
    {
        $user = Auth::user();

        $enrollment = Enrollment::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->first();

        if (!$enrollment) {
            return back()->with('error', 'You are not enrolled in this course.');
        }

        $enrollment->delete();

        return back()->with('success', 'Successfully unenrolled from ' . $course->title . '.');
    }

    /**
     * Mark course as completed and generate certificate
     */
    public function complete(Course $course)
    {
        $user = Auth::user();

        $enrollment = Enrollment::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->whereIn('status', ['active', 'approved'])
            ->first();

        if (!$enrollment) {
            return back()->with('error', 'You are not enrolled in this course.');
        }

        // Update enrollment status
        $enrollment->update(['status' => 'completed']);

        // Generate certificate if it doesn't exist
        $existingCertificate = Certificate::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->first();

        if (!$existingCertificate) {
            Certificate::create([
                'user_id' => $user->id,
                'course_id' => $course->id,
                'certificate_number' => Certificate::generateCertificateNumber(),
                'student_name' => $user->name,
                'course_name' => $course->title,
                'issue_date' => now(),
                'description' => 'Successfully completed the course: ' . $course->title,
                'is_verified' => true,
            ]);
        }

        return back()->with('success', 'Congratulations! Course completed. Certificate generated!');
    }

    /**
     * Display student's enrolled courses
     */
    public function myCourses()
    {
        $user = Auth::user();

        $enrollments = Enrollment::where('user_id', $user->id)
            ->with(['course.teacher', 'course.lessons'])
            ->latest()
            ->paginate(10);

        $certificatesByCourseId = Certificate::where('user_id', $user->id)
            ->whereIn('course_id', $enrollments->getCollection()->pluck('course_id'))
            ->get()
            ->keyBy('course_id');

        return view('student.courses', compact('enrollments', 'certificatesByCourseId'));
    }

    /**
     * Display student's certificates
     */
    public function myCertificates()
    {
        $user = Auth::user();

        $certificates = Certificate::where('user_id', $user->id)
            ->with('course')
            ->latest()
            ->paginate(10);

        return view('student.certificates', compact('certificates'));
    }

    /**
     * ADMIN: View all enrollments
     */
    public function adminIndex()
    {
        // Clear enrollments notification for the admin
        \App\Models\Notification::clearCount(auth()->id(), 'enrollments');

        $enrollments = Enrollment::with(['user', 'course'])
            ->latest()
            ->paginate(20);

        return view('admin.enrollments.index', compact('enrollments'));
    }

    /**
     * ADMIN: Approve enrollment
     */
    public function approve(Enrollment $enrollment)
    {
        // Use policy for authorization
        $this->authorize('approve', $enrollment);

        $enrollment->update([
            'status' => 'approved',
            'approved_at' => now(),
            'admin_notes' => request('admin_notes'),
        ]);

        return back()->with('success', 'Enrollment approved successfully!');
    }

    /**
     * ADMIN: Reject enrollment
     */
    public function reject(Enrollment $enrollment)
    {
        // Use policy for authorization
        $this->authorize('reject', $enrollment);

        $enrollment->update([
            'status' => 'rejected',
            'admin_notes' => request('admin_notes'),
        ]);

        return back()->with('success', 'Enrollment rejected.');
    }

    /**
     * ADMIN: Directly add a student to a course
     */
    public function adminAddStudent(AdminAddStudentRequest $request, Course $course)
    {
        // Authorization is handled in AdminAddStudentRequest
        $validated = $request->validated();

        $user = \App\Models\User::find($validated['user_id']);

        // Check if already enrolled
        $existing = Enrollment::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->first();

        if ($existing) {
            if (in_array($existing->status, ['approved', 'completed'])) {
                return back()->with('error', 'Student is already enrolled in this course.');
            }
            // Update pending/rejected to approved
            $existing->update([
                'status' => 'approved',
                'approved_at' => now(),
                'admin_notes' => 'Added directly by admin',
            ]);
            return back()->with('success', "{$user->name} has been successfully enrolled in '{$course->title}'.");
        }

        Enrollment::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'status' => 'approved',
            'enrolled_at' => now(),
            'approved_at' => now(),
            'admin_notes' => 'Added directly by admin',
        ]);

        return back()->with('success', "{$user->name} has been successfully added to '{$course->title}'.");
    }
}
