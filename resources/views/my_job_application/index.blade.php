<x-layout>

    {{-- Breadcrumbs block --}}
    <x-breadcrumbs class="mb-4" :links="['My Job Applications' => '#']" />

    {{-- My Applications block --}}
    <section class="bg-gray-100 dark:bg-gray-800">
        <div class="max-w-screen-xl px-4 py-8 mx-auto space-y-12 lg:space-y-20 lg:py-10 lg:px-6">
            <div class="items-center gap-4 lg:grid lg:grid-cols-1">
                <h2 class="mb-6 text-3xl font-extrabold tracking-tight text-gray-600 dark:text-white">My Applications
                </h2>
                <x-notifications />
                @forelse ($applications as $application)
                    <x-job-card :job="$application->job">
                        <div class="flex items-center justify-between text-sm text-slate-500">
                            <div>
                                <div>
                                    Applied {{ $application->created_at->diffForHumans() }}
                                </div>
                                <div>
                                    Other {{ Str::plural('applicant', $application->job->job_applications_count - 1) }}
                                    {{ $application->job->job_applications_count - 1 }}
                                </div>
                                <div>
                                    Your asking salary ${{ number_format($application->expected_salary) }}
                                </div>
                                <div>
                                    Average asking salary
                                    ${{ number_format($application->job->job_applications_avg_expected_salary) }}
                                </div>
                            </div>
                            <div>
                                <form action="{{ route('my-job-applications.destroy', $application) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <x-button>Cancel</x-button>
                                </form>
                            </div>
                        </div>
                    </x-job-card>
                @empty
                    <div class="p-8 bg-white border border-blue-700 border-dashed rounded-md shadow-md lg:py-16">
                        <div class="font-semibold text-center">
                            No job applications yet.
                        </div>
                        <div class="text-center">
                            Go find some jobs <a href="{{ route('jobs.index') }}"
                                class="font-semibold text-indigo-500 hover:underline">here!</a>
                        </div>
                    </div>
                @endforelse

                {{-- Pagination for job listing --}}
                <x-pagination :collection="$applications" />
            </div>
        </div>
    </section>

</x-layout>
