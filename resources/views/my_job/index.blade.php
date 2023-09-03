<x-layout>

    {{-- Breadcrumbs block --}}
    <x-breadcrumbs :links="['My Jobs' => '#']" class="mb-4" />

    {{-- My Jobs block --}}
    <section class="bg-gray-100 dark:bg-gray-800">
        <div class="max-w-screen-xl px-4 py-8 mx-auto space-y-12 lg:py-10 lg:px-6">
            <div class="flex items-center justify-between">
                <h2 class="text-3xl font-extrabold tracking-tight text-gray-600 dark:text-white">My Jobs
                </h2>
                <x-link-button href="{{ route('my-jobs.create') }}">Add New</x-link-button>
            </div>
            <div class="items-center gap-2 lg:grid lg:grid-cols-1">
                <x-notifications />
                @forelse ($jobs as $job)
                    <x-job-card :$job>
                        <div class="text-xs text-slate-500">
                            @forelse ($job->jobApplications as $application)
                                <div class="flex items-center justify-between mb-4">
                                    <div>
                                        <div>{{ $application->user->name }}</div>
                                        <div>
                                            Applied {{ $application->created_at->diffForHumans() }}
                                        </div>
                                        <div>
                                            <a href="{{ route('download-cv', $application->cv_path) }}" target="_blank" rel="noopener noreferrer">Download CV</a>
                                        </div>
                                    </div>

                                    <div>${{ number_format($application->expected_salary) }}</div>
                                </div>
                            @empty
                                <div class="mb-4">No applications yet</div>
                            @endforelse

                            <div class="flex space-x-2">
                                @if (!$job->deleted_at)
                                    <x-link-button href="{{ route('my-jobs.edit', $job) }}">Edit</x-link-button>
                                    <form action="{{ route('my-jobs.destroy', $job) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <x-button>Close</x-button>
                                    </form>
                                @endif


                            </div>
                        </div>
                    </x-job-card>
                @empty
                <div class="p-8 bg-white border border-blue-700 border-dashed rounded-md shadow-md lg:py-16">
                        <div class="font-semibold text-center">
                            No jobs yet
                        </div>
                        <div class="text-center">
                            Post your first job <a href="{{ route('my-jobs.create') }}"
                                class="font-semibold text-indigo-500 hover:underline">here!</a>
                        </div>
                    </div>
                @endforelse

                {{-- Pagination for job listing --}}
                <x-pagination :collection="$jobs" />
            </div>
        </div>
    </section>

</x-layout>
