<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class MyJobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // This will return the jobs that the user applied for
        return view(
            'my_job_application.index',
            [
                'applications' => auth()->user()->jobApplications()
                    ->with([
                        // Get the count of the job applications
                        'job' => fn ($query) => $query->withCount('jobApplications')
                            ->withAvg('jobApplications', 'expected_salary')
                            ->withTrashed() // Show the jobs that are in the trash (soft deleted)
                            ->orderByRaw('isnull(deleted_at), deleted_at, created_at DESC'), // Order the jobs by non-deleted first, then deleted, then created
                         'job.employer'
                        ])
                    ->paginate(5)
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobApplication $myJobApplication)
    {
        // To debug the $myJobApplication variable
        //dd($myJobApplication);

        // This will delete the job application
        $myJobApplication->delete();

        // This will redirect the user back to the my-job-applications index page
        return redirect()->back()->with(
            'success', 'Job application removed'
        );
    }
}
