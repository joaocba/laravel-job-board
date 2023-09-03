<x-card class="mb-4">
    <div class="mb-4 flex justify-between">
        <h2 class="text-lg font-semibold">{{ $job->title }}</h2>
        <div class="text-slate-500 font-semibold">
            ${{ number_format($job->salary) }}
        </div>
    </div>

    <div class="mb-4 flex justify-between text-sm text-slate-500 items-center">
        <div class="flex items-center space-x-4">
            <div class="flex items-center space-x-1">
                <div class="text-slate-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                      </svg>

                </div>
                <div>{{ $job->employer->company_name }}</div>
            </div>
            <div class="flex items-center space-x-1">
                <div class="text-slate-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                      </svg>

                </div>
                <div>{{ $job->location }}</div>
            </div>
            @if ($job->deleted_at)

                <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">Job Offer Closed</span>
            @endif
        </div>
        <div class="flex space-x-1 text-xs">
            {{-- Str::ucfirst() is a helper function that converts the first character of a string to uppercase --}}
            <x-tag>
                <a
                    href="{{ route('jobs.index', ['experience' => $job->experience]) }}">{{ Str::ucfirst($job->experience) }}</a>
            </x-tag>
            <x-tag>
                <a href="{{ route('jobs.index', ['category' => $job->category]) }}">{{ $job->category }}</a>
            </x-tag>
        </div>
    </div>

    {{ $slot }}
</x-card>
