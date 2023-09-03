<?php

namespace App\Policies;

use App\Models\Job;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class JobPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): bool
    {
        // Everyone can view all jobs
        return true;
    }

    // CUSTOM: For MyJobController.php
    public function viewAnyEmployer(User $user): bool
    {
        // Only the employer can view all jobs
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Job $job): bool
    {
        // Everyone can view a job
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Allow the user to create a job if they are an employer
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Job $job): bool|Response
    {
        // Check if the authenticated user is the owner/employer of the job
        if ($job->employer->user_id !== $user->id) {
            return false;
        }

        // Check if there are already applicants to the job then block the employer from updating the job. Use jobApplications() method to avoid fetching all the job applications, instead it will just use a count query to be more efficient
        if ($job->jobApplications()->count() > 0) {
            /* return Response::deny(
                'Cannot change the job with applications'
            ); */
        }

        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Job $job): bool
    {
        // Allow the user to delete a job if they are the owner/employer of the job
        return $job->employer->user_id === $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Job $job): bool
    {
        //
        return $job->employer->user_id === $user->id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Job $job): bool
    {
        //
        return $job->employer->user_id === $user->id;
    }

    public function apply(User $user, Job $job): bool
    {
        // A user can apply to a job if they haven't already applied
        return !$job->hasUserApplied($user);
    }
}
