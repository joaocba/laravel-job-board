<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use Illuminate\Http\Request;
use App\Models\Job;

class MyJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // This will authorize the user to view the My Jobs (Employer) page if they are an employer, this uses the JobPolicy.php file
        $this->authorize('viewAnyEmployer', Job::class);

        // Return the view for the My Jobs (Employer) page, display all the jobs managed by the employer
        return view(
            'my_job.index',
            [
                'jobs' => auth()->user()->employer // Get the employer from the authenticated user
                ->jobs() // Get the jobs from the employer
                ->with(['employer', 'jobApplications', 'jobApplications.user']) // Eager load the employer, job applications, and the user from the job applications
                ->latest() // Order the jobs by the latest
                ->withTrashed() // Show the jobs that are in the trash (soft deleted)
                ->paginate(5)
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // This will authorize the user to create a new job if they are an employer, this uses the JobPolicy.php file
        $this->authorize('create', Job::class);

        // Return the view for the Create Job (Employer) page
        return view('my_job.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobRequest $request)
    {
        // This will authorize the user to create a new job if they are an employer, this uses the JobPolicy.php file
        $this->authorize('create', Job::class);

/*         // Validate the data to create a new job for the employer
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'salary' => 'required|numeric|min:5000',
            'description' => 'required|string',
            'experience' => 'required|in:' . implode(',', Job::$experience), // push the array into a string from the Job model
            'category' => 'required|in:' . implode(',', Job::$category) // push the array into a string from the Job model
        ]); */

        // This will create a new job for the employer with the validated data associated with the employer, it already gets the validated data from the JobRequest class
        auth()->user()->employer->jobs()->create($request->validated());

        // Redirect the employer to the My Jobs page with a success message
        return redirect()->route('my-jobs.index')->with('success', 'Job was created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $myJob)
    {
        // This will authorize the user to edit the job if they are an employer, this uses the JobPolicy.php file
        $this->authorize('update', $myJob);

        // Return the view for the Edit Job (Employer) page with the job data in the $myJob variable
        return view('my_job.edit', [
            'job' => $myJob
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobRequest $request, Job $myJob)
    {
        // This will authorize the user to update the job if they are an employer, this uses the JobPolicy.php file
        $this->authorize('update', $myJob);

        // This will update the job with the validated data associated with the job, it already gets the validated data from the JobRequest class
        $myJob->update($request->validated());

        return redirect()->route('my-jobs.index')
            ->with('success', 'Job updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $myJob) // fetch the job
    {
        //Drop the constrains and foreing keys


        // Delete the job permanently
        $myJob->delete();

        return redirect()->route('my-jobs.index')
            ->with('success', 'Job deleted.');
    }
}
