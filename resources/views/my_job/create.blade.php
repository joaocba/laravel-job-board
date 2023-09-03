<x-layout>

    {{-- Breadcrumbs block --}}
    <x-breadcrumbs :links="['My Jobs' => route('my-jobs.index'), 'Add new job' => '#' ]" class="mb-4" />

    {{-- My Jobs - Create Job block --}}
    <section class="bg-gray-100 dark:bg-gray-800">
        <div class="max-w-screen-xl px-4 py-8 mx-auto space-y-12 lg:space-y-20 lg:py-10 lg:px-6">
            <div class="items-center gap-8 lg:grid lg:grid-cols-1 xl:gap-10">
                <h2 class="text-3xl font-extrabold tracking-tight text-gray-600 dark:text-white">Register new job
                </h2>
                <x-card class="mb-8">
                    <form action="{{ route('my-jobs.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <x-label for="title" :required="true">Job Title</x-label>
                                <x-text-input name="title" />
                            </div>

                            <div>
                                <x-label for="location" :required="true">Location</x-label>
                                <x-text-input name="location" />
                            </div>

                            <div class="col-span-2">
                                <x-label for="salary" :required="true">Salary</x-label>
                                <x-text-input name="salary" type="number" />
                            </div>

                            <div class="col-span-2">
                                <x-label for="description" :required="true">Description</x-label>
                                <x-text-input name="description" type="textarea" />
                            </div>

                            <div>
                                <x-label for="experience" :required="true">Experience</x-label>
                                <x-radio-group name="experience" :value="old('experience')" :all-option="false"
                                :options="array_combine(
                                    array_map('ucfirst', \App\Models\Job::$experience), \App\Models\Job::$experience
                                )" />
                            </div>

                            <div>
                                <x-label for="category" :required="true">Category</x-label>
                                <x-radio-group name="category" :value="old('category')" :all-option="false" :options="\App\Models\Job::$category" />
                            </div>

                            <div class="col-span-2">
                                <x-button class="w-full">Create Job</x-button>
                            </div>

                        </div>
                    </form>
                </x-card>
            </div>
        </div>
    </section>
</x-layout>
