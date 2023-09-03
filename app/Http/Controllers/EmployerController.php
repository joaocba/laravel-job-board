<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployerController extends Controller
{

    public function __construct()
    {
        // This will authorize the employer resource
        $this->authorizeResource(Employer::class);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // This will return the create view
        return view('employer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Store employer for the current user logged in
        auth()->user()->employer()->create(
            $request->validate([
                'company_name' => 'required|min:3|unique:employers,company_name'
            ])
        );

        return redirect()->route('my-jobs.index')
            ->with('success', 'Your employer account was created!');
    }
}
