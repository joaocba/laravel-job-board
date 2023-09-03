<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // This will authorize the user to view the jobs page even if they are not logged in, this uses the JobPolicy.php file
        $this->authorize('viewAny', Job::class);

        // This will return all the jobs from the database
        /* $jobs = Job::query(); */
        $filters = request()->only(
            'search',
            'min_salary',
            'max_salary',
            'experience',
            'category'
        );

        // This will return the index.blade.php file from the views Job folder
        /* return view('job.index', ['jobs' => $jobs->get()]); */
        return view(
            'job.index',
            ['jobs' => Job::with('employer')->latest()->filter($filters)->paginate(8)]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        // This will authorize the user to view the job page even if they are not logged in, this uses the JobPolicy.php file
        $this->authorize('view', $job);

        // This will return the show.blade.php file from the views Job folder
        return view(
            'job.show',
            ['job' => $job->load('employer.jobs')] // load() will load the employer and the jobs relationship
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
