<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    /**
     * Display all lessons for a course (Admin)
     */
    public function index(Course $course)
    {
        if (!Auth::user()->isAdmin() && $course->teacher_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        $lessons = Lesson::where('course_id', $course->id)
            ->orderBy('order')
            ->get();

        return view('admin.lessons.index', compact('course', 'lessons'));
    }

    /**
     * Show the form for creating a new lesson
     */
    public function create(Course $course)
    {
        if (!Auth::user()->isAdmin() && $course->teacher_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        $maxOrder = Lesson::where('course_id', $course->id)->max('order') ?? 0;

        return view('admin.lessons.create', compact('course', 'maxOrder'));
    }

    /**
     * Store a newly created lesson in storage
     */
    public function store(Request $request, Course $course)
    {
        if (!Auth::user()->isAdmin() && $course->teacher_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'youtube_video_id' => 'required|string|max:255',
            'order' => 'required|integer|min:1',
            'is_free' => 'boolean',
        ]);

        $validated['course_id'] = $course->id;
        $validated['is_free'] = $request->has('is_free');

        Lesson::create($validated);

        return redirect()->route('admin.lessons.index', $course)
            ->with('success', 'Lesson added successfully!');
    }

    /**
     * Show the form for editing the specified lesson
     */
    public function edit(Course $course, Lesson $lesson)
    {
        if (!Auth::user()->isAdmin() && $course->teacher_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        return view('admin.lessons.edit', compact('course', 'lesson'));
    }

    /**
     * Update the specified lesson in storage
     */
    public function update(Request $request, Course $course, Lesson $lesson)
    {
        if (!Auth::user()->isAdmin() && $course->teacher_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'youtube_video_id' => 'required|string|max:255',
            'order' => 'required|integer|min:1',
            'is_free' => 'boolean',
        ]);

        $validated['is_free'] = $request->has('is_free');

        $lesson->update($validated);

        return redirect()->route('admin.lessons.index', $course)
            ->with('success', 'Lesson updated successfully!');
    }

    /**
     * Remove the specified lesson from storage
     */
    public function destroy(Course $course, Lesson $lesson)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        $lesson->delete();

        return redirect()->route('admin.lessons.index', $course)
            ->with('success', 'Lesson deleted successfully!');
    }

    /**
     * SECURE: Display lesson for enrolled students only
     * FIRST 3 LESSONS ARE FREE FOR ALL USERS
     */
    public function show(Course $course, Lesson $lesson)
    {
        $user = Auth::user();

        // Check if lesson belongs to the course
        if ($lesson->course_id !== $course->id) {
            abort(404, 'Lesson not found in this course.');
        }

        // FIRST 3 LESSONS ARE FREE - No enrollment needed
        if ($lesson->order <= 3) {
            return $this->renderLessonView($course, $lesson);
        }

        // LESSON 4+ - Check enrollment and admin approval
        $isEnrolled = $user->enrollments()
            ->where('course_id', $course->id)
            ->whereIn('status', ['approved', 'completed'])
            ->exists();

        if (!$isEnrolled) {
            return redirect()->route('courses.public.show', $course)
                ->with('error', 'You must enroll in this course and wait for admin approval to access this lesson.');
        }

        return $this->renderLessonView($course, $lesson);
    }

    /**
     * Render lesson view with navigation data
     */
    private function renderLessonView(Course $course, Lesson $lesson)
    {
        // Get all lessons for navigation
        $lessons = Lesson::where('course_id', $course->id)
            ->orderBy('order')
            ->get();

        // Find previous and next lessons
        $currentIndex = $lessons->search(function ($l) use ($lesson) {
            return $l->id === $lesson->id;
        });

        $previousLesson = $currentIndex > 0 ? $lessons[$currentIndex - 1] : null;
        $nextLesson = $currentIndex < $lessons->count() - 1 ? $lessons[$currentIndex + 1] : null;

        return view('student.lesson', compact('course', 'lesson', 'lessons', 'previousLesson', 'nextLesson'));
    }

    /**
     * Reorder lessons
     */
    public function reorder(Request $request, Course $course)
    {
        if (!Auth::user()->isAdmin() && $course->teacher_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        $validated = $request->validate([
            'lesson_ids' => 'required|array',
            'lesson_ids.*' => 'integer|exists:lessons,id',
        ]);

        foreach ($validated['lesson_ids'] as $index => $lessonId) {
            Lesson::where('id', $lessonId)->update(['order' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }
}
