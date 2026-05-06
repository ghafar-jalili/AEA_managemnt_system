<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Course;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any courses.
     */
    public function viewAny(User $user): bool
    {
        return true; // All authenticated users can view courses
    }

    /**
     * Determine whether the user can view the course.
     */
    public function view(User $user, Course $course): bool
    {
        // Admin can view any course
        if ($user->isAdmin()) {
            return true;
        }

        // Teacher can view their own courses
        if ($user->isTeacher() && $user->id === $course->teacher_id) {
            return true;
        }

        // Students can view active courses
        return $course->status === 'active';
    }

    /**
     * Determine whether the user can create courses.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin() || $user->isTeacher();
    }

    /**
     * Determine whether the user can update the course.
     */
    public function update(User $user, Course $course): bool
    {
        // Admin can update any course
        if ($user->isAdmin()) {
            return true;
        }

        // Teacher can update their own courses
        return $user->isTeacher() && $user->id === $course->teacher_id;
    }

    /**
     * Determine whether the user can delete the course.
     */
    public function delete(User $user, Course $course): bool
    {
        // Only admin can delete courses
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can toggle course status.
     */
    public function toggleStatus(User $user, Course $course): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can manage course students.
     */
    public function manageStudents(User $user, Course $course): bool
    {
        // Admin can manage any course's students
        if ($user->isAdmin()) {
            return true;
        }

        // Teacher can manage their own course's students
        return $user->isTeacher() && $user->id === $course->teacher_id;
    }
}
