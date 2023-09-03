<x-layout>

    {{-- Breadcrumbs block --}}
    <x-breadcrumbs class="mb-4" :links="['Jobs' => route('jobs.index'), $job->title => '#']" />

    {{-- Job Details block --}}
    <section class="bg-gray-100 dark:bg-gray-800">
        <div class="max-w-screen-xl px-4 py-8 mx-auto space-y-12 lg:space-y-20 lg:py-10 lg:px-6">
            <div class="items-center gap-8 lg:grid lg:grid-cols-1 xl:gap-10">
                <h2 class="text-3xl font-extrabold tracking-tight text-gray-600 dark:text-white">Job Details
                </h2>
                {{-- :$job is a shorthand for :job="$job" :href="route('jobs.show', $job)" --}}
                <x-job-card :$job>
                    <p class="mb-4 text-sm text-slate-500">
                        {{-- {!! !!} is used to output HTML, nl2br() is a PHP function that converts new lines to <br> tags, e() is a helper function that escapes HTML characters --}}
                        {!! nl2br(e($job->description)) !!}
                    </p>

                    {{-- Check if the authenticated user is the job owner (employer) --}}
                    @if (auth()->check() && $job->employer->user_id === auth()->user()->id)
                        <div class="text-sm font-semibold text-center text-slate-500">
                            You cannot apply to your own company jobs
                        </div>
                    @else
                        {{-- If the user is allowed to apply for the job, show the apply button else show a message. CAN() directive uses the policies set for apply --}}
                        @can('apply', $job)
                            <x-link-button :href="route('job.application.create', $job)">
                                Apply
                            </x-link-button>
                        @else
                            @auth
                                <div class="text-sm font-semibold text-center text-slate-500">
                                    You already applied for this job
                                </div>
                            @else
                                <div class="text-sm font-semibold text-center text-slate-500">
                                    <a href="{{ route('login') }}"
                                        class="font-semibold text-gray-900 hover:underline dark:text-white decoration-indigo-500">Sign-in</a>
                                    to apply for this job
                                </div>
                            @endauth
                        @endcan
                    @endif
                </x-job-card>
            </div>
        </div>
    </section>


    {{-- More jobs from company block --}}
    <section class="bg-gray-100 dark:bg-gray-800">
        <div class="max-w-screen-xl px-4 py-8 mx-auto space-y-12 lg:space-y-20 lg:py-10 lg:px-6">
            <div class="items-center gap-8 lg:grid lg:grid-cols-1 xl:gap-10">
                <h2 class="text-3xl font-extrabold tracking-tight text-gray-600 dark:text-white">
                    More jobs from <span class="text-slate-500">{{ $job->employer->company_name }}</span>
                </h2>
                <x-card class="mb-4">
                    <div class="text-sm text-slate-500">
                        @if ($job->employer->jobs->count() > 1)
                            @foreach ($job->employer->jobs->where('id', '!=', $job->id) as $otherJob)
                                <div class="flex justify-between mb-4">
                                    <div>
                                        <div class="font-semibold text-slate-700">
                                            <a href="{{ route('jobs.show', $otherJob) }}">
                                                {{ $otherJob->title }}
                                            </a>
                                        </div>
                                        <div class="text-xs">
                                            {{ $otherJob->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                    <div class="text-xs">
                                        ${{ number_format($otherJob->salary) }}
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="my-10 text-sm text-center text-slate-500">
                                No other jobs available from this company, come back later!
                            </p>
                        @endif
                    </div>
                </x-card>
            </div>
        </div>
    </section>
</x-layout>
