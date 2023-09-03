<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JobApplicationController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Job $job, Request $request)
    {
        // Retrieve the job's employer
        $employer = $job->employer;

        // Check if the authenticated user is the job owner (employer)
        if ($employer->user_id === $request->user()->id) {
            return redirect()->route('jobs.show', $job)
                ->with('error', 'You cannot apply to your own job.');
        }

        // This will authorize the user to apply for the job
        $this->authorize('apply', $job);

        // This will return the create.blade.php file from the views JobApplication folder
        return view('job_application.create', ['job' => $job]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Job $job, Request $request)
    {
        // This will authorize the user to apply for the job
        $this->authorize('apply', $job);

        // This will validate the expected_salary and cv fields
        $validatedData = $request->validate([
            'expected_salary' => 'required|min:1|max:1000000',
            'cv' => 'required|file|mimes:pdf|max:2048' // This will validate the cv field to be a pdf file and less than 2MB
        ]);

        $file = $request->file('cv'); // This will get the cv file from the request
        $path = $file->store('cvs', 'private'); // This will store the cv file in the private disk on folder cvs (storage/app/private/cvs)

        // Set the visibility of the CV file to 'public'
        Storage::setVisibility($path, 'public');

        // This will create a new job application for the user and validate the expected_salary field
        $jobApplication = $job->jobApplications()->create([
            'user_id' => $request->user()->id,
            'expected_salary' => $validatedData['expected_salary'],
            'cv_path' => $path
        ]);

        return redirect()->route('my-job-applications.index', $jobApplication)
            ->with('success', 'Job application submitted.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
