<x-layout>

    {{-- Breadcrumbs block --}}
    <x-breadcrumbs :links="['My Jobs' => route('my-jobs.index'), 'Edit Job: ' . $job->title => '#' ]" class="mb-4" />

        {{-- My Jobs - Edit Job block --}}
        <section class="bg-gray-100 dark:bg-gray-800">
            <div class="max-w-screen-xl px-4 py-8 mx-auto space-y-12 lg:space-y-20 lg:py-10 lg:px-6">
                <div class="items-center gap-8 lg:grid lg:grid-cols-1 xl:gap-10">
                    <h2 class="text-3xl font-extrabold tracking-tight text-gray-600 dark:text-white">Edit job
                    </h2>
                    <x-card class="mb-8">
                        <form action="{{ route('my-jobs.update', $job) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <x-label for="title" :required="true">Job Title</x-label>
                                    <x-text-input name="title" :value="$job->title" />
                                </div>

                                <div>
                                    <x-label for="location" :required="true">Location</x-label>
                                    <x-text-input name="location" :value="$job->location" />
                                </div>

                                <div class="col-span-2">
                                    <x-label for="salary" :required="true">Salary</x-label>
                                    <x-text-input name="salary" type="number" :value="$job->salary" />
                                </div>

                                <div class="col-span-2">
                                    <x-label for="description" :required="true">Description</x-label>
                                    <x-text-input name="description" type="textarea" :value="$job->description" />
                                </div>

                                <div>
                                    <x-label for="experience" :required="true">Experience</x-label>
                                    <x-radio-group name="experience" :value="$job->experience" :all-option="false"
                                    :options="array_combine(
                                        array_map('ucfirst', \App\Models\Job::$experience), \App\Models\Job::$experience
                                    )" />
                                </div>

                                <div>
                                    <x-label for="category" :required="true">Category</x-label>
                                    <x-radio-group name="category" :value="$job->category" :all-option="false" :options="\App\Models\Job::$category" />
                                </div>

                                <div class="col-span-2">
                                    <x-button class="w-full">Edit Job</x-button>
                                </div>

                            </div>
                        </form>
                    </x-card>
                </div>
            </div>
        </section>
</x-layout>
