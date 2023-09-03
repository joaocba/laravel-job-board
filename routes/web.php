<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\MyJobApplicationController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\MyJobController;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// HANDLE FOR JOBS LISTINGS
// This will redirect the user to the /jobs index
Route::get('', fn() => to_route('jobs.index'));

// This is the route for the home page, it will show the index.blade.php file from the views Job folder
Route::resource('jobs', JobController::class) // This will create the route /jobs and will use the JobController class
    ->only(['index', 'show']); // This will only allow the index and show method to be used



// HANDLE FOR DOWNLOADING CVs
// This will create a route to download the CVs
Route::get('download-cv/{filename}', function ($filename) {
    // Use a regular expression to capture the filename without the "cvs/" prefix
    $pattern = '/^cvs\/(.+)$/';
    if (preg_match($pattern, $filename, $matches)) {
        $filenameWithoutPrefix = $matches[1];

        // Build the full path to the file
        $fullPath = 'private/cvs/' . $filenameWithoutPrefix;

        // Check if the file exists in the private storage
        if (Storage::exists($fullPath)) {
            // Set the appropriate MIME type for PDF files
            $headers = [
                'Content-Type' => 'application/pdf', // Modify the MIME type as needed
            ];

            // Return the file as a response
            return response()->file(storage_path('app/' . $fullPath), $headers);
        }
    }

    // Handle the case where the file doesn't exist or the format is incorrect
    abort(404);
})->where('filename', '^(cvs\/)?[^/]+$')->name('download-cv');



// HANDLE PAGES TO USER ACCOUNTS
// This will define the CUSTOM routes for the AuthController
Route::controller(AuthController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
});

// This will create the route /logout and will use the AuthController class to destroy the session
Route::delete('logout', fn() => to_route('auth.destroy'))
    ->name('logout');
Route::delete('auth', [AuthController::class, 'destroy'])
    ->name('auth.destroy');



// HANDLE PAGES THAT REQUIRE AUTHENTICATION
// This will create a group of routes that will be protected by the auth middleware (require the user to be logged in)
Route::middleware('auth')->group(function() {

    // Route to create a job application
    Route::resource('job.application', JobApplicationController::class)
        ->only(['create', 'store']); // This will only allow the create and store method to be used

    // Route to view and delete job applications
    Route::resource('my-job-applications', MyJobApplicationController::class)
        ->only(['index', 'destroy']); // This will only allow the index and destroy method to be used

    // Route to create an employer
    Route::resource('employer', EmployerController::class)
        ->only(['create', 'store']); // This will only allow the create and store method to be used

    // Route to jobs that the employer has created with middleware to check if the user is an employer
    Route::middleware('employer')
        ->resource('my-jobs', MyJobController::class);


});
