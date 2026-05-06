<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    $user = auth()->user();
    
    // Redirect based on user role
    if ($user->isAdmin()) {
        return redirect()->route('admin.dashboard');
    } elseif ($user->isTeacher()) {
        return redirect()->route('teacher.dashboard');
    } else {
        return redirect()->route('student.dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified', 'admin', 'throttle:60,1'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/reports', [\App\Http\Controllers\Admin\AdminDashboardController::class, 'reports'])->name('reports');
    
    // Contact Messages Management
    Route::get('/contact-messages', [\App\Http\Controllers\ContactController::class, 'adminIndex'])->name('contact-messages.index');
    Route::get('/contact-messages/{id}', [\App\Http\Controllers\ContactController::class, 'adminShow'])->name('contact-messages.show');
    Route::delete('/contact-messages/{id}', [\App\Http\Controllers\ContactController::class, 'adminDestroy'])->name('contact-messages.destroy');
    
    // Course Management
    Route::get('/courses', [\App\Http\Controllers\CourseController::class, 'adminIndex'])->name('courses.index');
    Route::get('/courses/create', [\App\Http\Controllers\CourseController::class, 'create'])->name('courses.create');
    Route::post('/courses', [\App\Http\Controllers\CourseController::class, 'store'])->name('courses.store');
    Route::get('/courses/{course}/edit', [\App\Http\Controllers\CourseController::class, 'edit'])->name('courses.edit');
    Route::put('/courses/{course}', [\App\Http\Controllers\CourseController::class, 'update'])->name('courses.update');
    Route::delete('/courses/{course}', [\App\Http\Controllers\CourseController::class, 'destroy'])->name('courses.destroy');
    Route::post('/courses/{course}/toggle-status', [\App\Http\Controllers\CourseController::class, 'toggleStatus'])->name('courses.toggle-status');
    Route::get('/courses/{course}/students', [\App\Http\Controllers\CourseController::class, 'getStudents'])->name('courses.students');
    
    // Lesson Management (Nested under courses)
    Route::get('/courses/{course}/lessons', [\App\Http\Controllers\LessonController::class, 'index'])->name('lessons.index');
    Route::get('/courses/{course}/lessons/create', [\App\Http\Controllers\LessonController::class, 'create'])->name('lessons.create');
    Route::post('/courses/{course}/lessons', [\App\Http\Controllers\LessonController::class, 'store'])->name('lessons.store');
    Route::get('/courses/{course}/lessons/{lesson}/edit', [\App\Http\Controllers\LessonController::class, 'edit'])->name('lessons.edit');
    Route::put('/courses/{course}/lessons/{lesson}', [\App\Http\Controllers\LessonController::class, 'update'])->name('lessons.update');
    Route::delete('/courses/{course}/lessons/{lesson}', [\App\Http\Controllers\LessonController::class, 'destroy'])->name('lessons.destroy');
    Route::post('/courses/{course}/lessons/reorder', [\App\Http\Controllers\LessonController::class, 'reorder'])->name('lessons.reorder');
    
    // Enrollment Management
    Route::get('/enrollments', [\App\Http\Controllers\EnrollmentController::class, 'adminIndex'])->name('enrollments.index');
    Route::post('/enrollments/{enrollment}/approve', [\App\Http\Controllers\EnrollmentController::class, 'approve'])->name('enrollments.approve');
    Route::post('/enrollments/{enrollment}/reject', [\App\Http\Controllers\EnrollmentController::class, 'reject'])->name('enrollments.reject');
    Route::post('/courses/{course}/add-student', [\App\Http\Controllers\EnrollmentController::class, 'adminAddStudent'])->name('courses.add-student');
    
    // Certificate Management
    Route::get('/certificates', [\App\Http\Controllers\CertificateController::class, 'adminIndex'])->name('certificates.index');
    Route::post('/certificates/{certificate}/approve', [\App\Http\Controllers\CertificateController::class, 'approve'])->name('certificates.approve');
    Route::post('/certificates/{certificate}/reject', [\App\Http\Controllers\CertificateController::class, 'reject'])->name('certificates.reject');
    
    // Equipment Management
    Route::get('/equipment', [\App\Http\Controllers\Admin\EquipmentController::class, 'index'])->name('equipment.index');
    Route::get('/equipment/create', [\App\Http\Controllers\Admin\EquipmentController::class, 'create'])->name('equipment.create');
    Route::post('/equipment', [\App\Http\Controllers\Admin\EquipmentController::class, 'store'])->name('equipment.store');
    Route::get('/equipment/{equipment}/edit', [\App\Http\Controllers\Admin\EquipmentController::class, 'edit'])->name('equipment.edit');
    Route::put('/equipment/{equipment}', [\App\Http\Controllers\Admin\EquipmentController::class, 'update'])->name('equipment.update');
    Route::delete('/equipment/{equipment}', [\App\Http\Controllers\Admin\EquipmentController::class, 'destroy'])->name('equipment.destroy');
    Route::get('/equipment/reports', [\App\Http\Controllers\Admin\EquipmentController::class, 'reports'])->name('equipment.reports');
    
    // User Management
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    
    // Course Request Management
    Route::get('/course-requests', [\App\Http\Controllers\Admin\CourseRequestController::class, 'index'])->name('course-requests.index');
    Route::post('/course-requests/{courseName}/create-course', [\App\Http\Controllers\Admin\CourseRequestController::class, 'createCourseFromRequest'])->name('course-requests.create-course');
    Route::post('/course-requests/{courseName}/notify', [\App\Http\Controllers\Admin\CourseRequestController::class, 'notifyAdmin'])->name('course-requests.notify');
});

Route::middleware(['auth', 'verified', 'teacher', 'throttle:60,1'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        $courseIds = $user->courses()->pluck('id');
        $totalEnrollments = $courseIds->isEmpty()
            ? 0
            : \App\Models\Enrollment::whereIn('course_id', $courseIds)->count();
        $lessonCount = $courseIds->isEmpty()
            ? 0
            : \App\Models\Lesson::whereIn('course_id', $courseIds)->count();

        return view('teacher.dashboard', compact('totalEnrollments', 'lessonCount'));
    })->name('dashboard');

    Route::get('/courses', function () {
        $courses = auth()->user()->courses()->withCount('enrollments')->with('lessons')->latest()->get();

        return view('teacher.courses', compact('courses'));
    })->name('courses.index');
});

Route::middleware(['auth', 'verified', 'throttle:60,1'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();

        $myCoursesCount = $user->enrollments()->count();
        $certificatesCount = $user->certificates()->count();
        $dailyLessonsCount = \App\Models\DailyLesson::where('is_active', true)->count();

        return view('student.dashboard', compact('myCoursesCount', 'certificatesCount', 'dailyLessonsCount'));
    })->name('dashboard');
    
    // Student course management
    Route::get('/my-courses', [\App\Http\Controllers\EnrollmentController::class, 'myCourses'])->name('courses');
    Route::get('/certificates', [\App\Http\Controllers\EnrollmentController::class, 'myCertificates'])->name('certificates');
    Route::post('/courses/{course}/enroll', [\App\Http\Controllers\EnrollmentController::class, 'enroll'])->name('enroll');
    Route::post('/courses/{course}/unenroll', [\App\Http\Controllers\EnrollmentController::class, 'unenroll'])->name('unenroll');
    Route::post('/courses/{course}/complete', [\App\Http\Controllers\EnrollmentController::class, 'complete'])->name('complete');
    Route::post('/enrollments/{enrollment}/claim-certificate', [\App\Http\Controllers\CertificateController::class, 'claim'])->name('claim.certificate');
    Route::get('/certificates/{certificate}/download', [\App\Http\Controllers\CertificateController::class, 'generatePdf'])->name('certificate.download');
    
    // Secure lesson viewing
    Route::get('/courses/{course}/lessons/{lesson}', [\App\Http\Controllers\LessonController::class, 'show'])->name('lesson.show');
});

// Public Routes
Route::get('/home', function () {
    $featuredCourses = \App\Models\Course::query()
        ->active()
        ->with('teacher')
        ->latest()
        ->take(3)
        ->get();
    
    return view('home', compact('featuredCourses'));
})->name('home');

Route::get('/', function () {
    return redirect()->route('courses.public.index');
});

Route::get('/about', function () {
    return view('public.about');
})->name('about');

// Public course listing (for all users)
Route::get('/courses', [\App\Http\Controllers\CourseController::class, 'index'])->name('courses.public.index');
Route::get('/courses/{course}', [\App\Http\Controllers\CourseController::class, 'show'])->name('courses.public.show');
Route::get('/courses/{course}/students', [\App\Http\Controllers\CourseController::class, 'getStudents'])->name('courses.public.students');
Route::get('/courses/wishlist', [\App\Http\Controllers\CourseController::class, 'showWishlistCourses'])->name('courses.wishlist');
Route::post('/courses/request', [\App\Http\Controllers\CourseController::class, 'requestCourse'])->name('courses.request');

// Course Request (authenticated users only)
Route::middleware(['auth', 'throttle:10,1'])->group(function () {
    Route::get('/request-course', [\App\Http\Controllers\CourseRequestController::class, 'showForm'])->name('course-request.form');
    Route::post('/request-course', [\App\Http\Controllers\CourseRequestController::class, 'submitRequest'])->name('course-request.submit');
    Route::post('/course-request/quick', [\App\Http\Controllers\CourseRequestController::class, 'submitQuickRequest'])->name('course-request.quick');
});

// Admin: Add student request manually
Route::middleware(['auth', 'admin'])->group(function () {
    Route::post('/admin/course-request/add-student', [\App\Http\Controllers\CourseRequestController::class, 'adminAddStudentRequest'])->name('admin.course-request.add-student');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Public pages: Contact, Equipment, Certificates (view only)
Route::get('/contact', function () {
    return view('public.contact');
})->name('contact');

Route::get('/equipment', function () {
    $equipment = \App\Models\Equipment::where('status', 'available')->get();
    return view('public.equipment', compact('equipment'));
})->name('equipment');

// Protected actions (require login)
Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'submit'])->middleware(['auth', 'throttle:5,1'])->name('contact.submit');
Route::post('/equipment/rent', [\App\Http\Controllers\ContactController::class, 'rentRequest'])->middleware(['auth', 'throttle:5,1'])->name('equipment.rent');

Route::get('/certificate/search', function (\Illuminate\Http\Request $request) {
    if ($request->has('certificate_number')) {
        return redirect()->route('certificate.verify', ['certificateNumber' => $request->certificate_number]);
    }
    return view('certificate.search');
})->name('certificate.search');
Route::get('/verify-certificate/{certificateNumber}', [\App\Http\Controllers\CertificateController::class, 'verify'])->name('certificate.verify');

require __DIR__.'/auth.php';
