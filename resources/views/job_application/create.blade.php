<x-layout>

    {{-- Breadcrumbs block --}}
    <x-breadcrumbs class="mb-4" :links="['Jobs' => route('jobs.index'), $job->title => route('jobs.show', $job), 'Apply' => '#']" />

    {{-- Job Details block --}}
    <section class="bg-gray-100 dark:bg-gray-800">
        <div class="max-w-screen-xl px-4 py-8 mx-auto space-y-12 lg:space-y-20 lg:py-10 lg:px-6">
            <div class="flex justify-between gap-8 lg:grid lg:grid-cols-2 xl:gap-10">
                <div>
                    <h2 class="mb-6 text-3xl font-extrabold tracking-tight text-gray-600 dark:text-white">Job Details
                    </h2>
                    {{-- :$job is a shorthand for :job="$job" :href="route('jobs.show', $job)" --}}
                    <x-job-card :$job>
                        <p class="mb-4 text-sm text-slate-500">
                            {{-- {!! !!} is used to output HTML, nl2br() is a PHP function that converts new lines to <br> tags, e() is a helper function that escapes HTML characters --}}
                            {!! nl2br(e($job->description)) !!}
                        </p>
                    </x-job-card>
                </div>

                <div>
                    <h2 class="mb-6 text-3xl font-extrabold tracking-tight text-gray-600 dark:text-white">Apply to this job
                    </h2>
                    <x-card>
                        <form action="{{ route('job.application.store', $job) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <x-label for="expected_salary" :required="true">Expected Salary</x-label>
                                <x-text-input type="number" name="expected_salary" />
                            </div>

                            {{-- button to upload cv file --}}
                            <div class="mb-4">
                                <x-label for="cv" :required="true">Upload CV</x-label>
                                <x-text-input type="file" name="cv" />
                            </div>

                            <x-button>Apply</x-button>
                        </form>
                    </x-card>
                </div>
            </div>
        </div>
    </section>

</x-layout>
