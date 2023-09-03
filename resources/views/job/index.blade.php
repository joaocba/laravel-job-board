<x-layout>
    {{-- Banner + Filters --}}
    <section class="bg-gradient-to-r from-blue-800 to-indigo-900 dark:bg-gray-900">
        <div
            class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28 lg:pb-10">
            <div class="mr-16 place-self-center lg:col-span-5">
                <h1
                    class="max-w-2xl mb-4 text-2xl font-extrabold leading-none tracking-tight text-white md:text-3xl xl:text-4xl dark:text-white">
                    Find Better Jobs Faster<br> with 1 click apply</h1>
                <p class="max-w-2xl mb-6 font-light text-gray-100 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">
                    Sign-in, filter the job to match your needs and click Apply to join instantly, you can also manage
                    your applications and even list new jobs.</p>
                <div class="space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center justify-center w-full px-5 py-3 mb-2 mr-2 text-sm font-semibold text-white bg-blue-700 border rounded-lg hover:bg-blue-800 sm:w-auto focus:outline-none focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        Sign-Up With Us
                    </a>
                </div>
            </div>
            <div class="hidden lg:mt-0 lg:col-span-7 lg:flex">
                <x-card class="mb-4 text-sm" x-data="">
                    <form x-ref="filters" id="filtering-form" action="{{ route('jobs.index') }}" method="GET">
                        <div class="grid grid-cols-2 gap-4 mb-4">

                            <div>
                                <div class="mb-1 font-semibold">Search</div>

                                <x-text-input name="search" value="{{ request('search') }}"
                                    placeholder="Search for any text" form-ref="filters" />
                            </div>

                            <div>
                                <div class="mb-1 font-semibold">Salary</div>

                                <div class="flex space-x-2">
                                    <x-text-input name="min_salary" value="{{ request('min_salary') }}"
                                        placeholder="From" form-ref="filters" />
                                    <x-text-input name="max_salary" value="{{ request('max_salary') }}" placeholder="To"
                                        form-ref="filters" />
                                </div>
                            </div>

                            <div>
                                <div class="mb-1 font-semibold">Experience</div>

                                {{-- array_combine() combines two arrays into one, array_map() applies a callback function to each element of an array, ucfirst() converts the first character of a string to uppercase. This allows to display the experience options with the first character in uppercase even when its value is lowercase. --}}
                                <x-radio-group name="experience" :options="array_combine(
                                    array_map('ucfirst', \App\Models\Job::$experience),
                                    \App\Models\Job::$experience,
                                )" />
                            </div>

                            <div>
                                <div class="mb-1 font-semibold">Category</div>

                                <x-radio-group name="category" :options="\App\Models\Job::$category" />
                            </div>
                        </div>

                        <x-button class="w-full">Filter</x-button>
                    </form>
                </x-card>
            </div>
        </div>
    </section>

    {{-- Available Jobs --}}
    <section class="bg-gray-100 dark:bg-gray-800">
        <div class="max-w-screen-xl px-4 py-8 mx-auto space-y-12 lg:space-y-20 lg:py-12 lg:px-6">
            <div class="items-center gap-8 lg:grid lg:grid-cols-1 xl:gap-16">
                <div class="text-gray-500 sm:text-lg dark:text-gray-400">
                    <h2 class="mb-4 text-3xl font-extrabold tracking-tight text-gray-600 dark:text-white">Available Jobs
                    </h2>
                    {{-- Display available jobs --}}
                    @foreach ($jobs as $job)
                        {{-- :$job is a shorthand for :job="$job" :href="route('jobs.show', $job)" --}}
                        <x-job-card class="mb-4" :$job>
                            <div>
                                {{-- :href is a shorthand for v-bind:href, which is used to bind an attribute to an expression --}}
                                <x-link-button :href="route('jobs.show', $job)">
                                    Show
                                </x-link-button>
                            </div>
                        </x-job-card>
                    @endforeach

                    {{-- Pagination for job listing --}}
                    <x-pagination :collection="$jobs" />
                </div>
            </div>
        </div>
    </section>
</x-layout>
