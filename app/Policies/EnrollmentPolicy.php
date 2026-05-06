<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Enrollment;
use Illuminate\Auth\Access\HandlesAuthorization;

class EnrollmentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any enrollments.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the enrollment.
     */
    public function view(User $user, Enrollment $enrollment): bool
    {
        // Admin can view any enrollment
        if ($user->isAdmin()) {
            return true;
        }

        // User can view their own enrollment
        if ($user->id === $enrollment->user_id) {
            return true;
        }

        // Teacher can view enrollments for their courses
        return $user->isTeacher() && $user->id === $enrollment->course->teacher_id;
    }

    /**
     * Determine whether the user can create enrollments.
     */
    public function create(User $user): bool
    {
        return $user->isStudent(); // Only students can enroll
    }

    /**
     * Determine whether the user can update the enrollment.
     */
    public function update(User $user, Enrollment $enrollment): bool
    {
        // Admin can update any enrollment
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can approve the enrollment.
     */
    public function approve(User $user, Enrollment $enrollment): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can reject the enrollment.
     */
    public function reject(User $user, Enrollment $enrollment): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the enrollment.
     */
    public function delete(User $user, Enrollment $enrollment): bool
    {
        // Admin can delete any enrollment
        if ($user->isAdmin()) {
            return true;
        }

        // User can delete their own enrollment (unenroll)
        return $user->id === $enrollment->user_id;
    }
}
