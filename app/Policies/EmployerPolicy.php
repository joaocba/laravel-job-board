<?php

namespace App\Policies;

use App\Models\Employer;
use App\Models\User;
use App\Models\JobApplication;
use Illuminate\Auth\Access\Response;

class EmployerPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Employer $employer): bool
    {
        //
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // This represents if the user is an employer or not
        return null === $user->employer;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Employer $employer): bool
    {
        // This represents if the user is the owner of the employer accounts
        return $employer->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Employer $employer): bool
    {
        //
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Employer $employer): bool
    {
        //
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Employer $employer): bool
    {
        //
        return false;
    }



    /**
     * Determine whether the user can download a CV.
     */
    public function downloadCv(User $user, string $filename): Response
    {
        // Extract the filename without the "cvs/" prefix
        $pattern = '/^cvs\/(.+)$/';
        if (preg_match($pattern, $filename, $matches)) {
            $filenameWithoutPrefix = $matches[1];

            // Retrieve the job application associated with the filename
            $jobApplication = JobApplication::where('cv_path', 'private/cvs/' . $filenameWithoutPrefix)->first();

            // Check if the user is the employer associated with the job application
            if ($jobApplication && $jobApplication->job->employer->user_id === $user->id) {
                return Response::allow();
            }
        }

        return Response::deny('You are not authorized to download this CV.');
    }

}
