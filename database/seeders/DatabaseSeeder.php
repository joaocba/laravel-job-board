<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // This will create a user
        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // This will create 300 users
        \App\Models\User::factory(300)->create();

        // Load all the users
        $users = \App\Models\User::all()->shuffle();

        // This will create 20 employers with unique user_id
        for ($i = 0; $i < 20; $i++) {
            \App\Models\Employer::factory()->create([
                'user_id' => $users->pop()->id // pop() returns the last element from the loaded collection of users
            ]);
        }

        // Load all the employers
        $employers = \App\Models\Employer::all();

        // This will create 100 jobs with unique employer_id
        for ($i = 0; $i < 100; $i++) {
            \App\Models\Job::factory()->create([
                'employer_id' => $employers->random()->id
            ]);
        }

        // \App\Models\User::factory(10)->create();

        // For each user, take random number of jobs from 0 to 4 and create job applications
        foreach ($users as $user) {
            // take random number of jobs from 0 to 4
            $jobs = \App\Models\Job::inRandomOrder()->take(rand(0, 4))->get();

            // create job applications for each job
            foreach ($jobs as $job) {
                \App\Models\JobApplication::factory()->create([
                    'job_id' => $job->id,
                    'user_id' => $user->id
                ]);
            }
        }
    }
}
