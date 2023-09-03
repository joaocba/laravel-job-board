<x-layout>

    {{-- Breadcrumbs block --}}
    <x-breadcrumbs :links="['My Jobs' => route('my-jobs.index'), 'Register new company' => '#' ]" class="mb-4" />

        {{-- My Jobs - Create Company block --}}
        <section class="bg-gray-100 dark:bg-gray-800">
            <div class="max-w-screen-xl px-4 py-8 mx-auto space-y-12 lg:space-y-20 lg:py-10 lg:px-6">
                <div class="items-center gap-8 lg:grid lg:grid-cols-1 xl:gap-10">
                    <h2 class="text-3xl font-extrabold tracking-tight text-gray-600 dark:text-white">Register company
                    </h2>
                    <x-card class="px-10 py-10 mx-16">
                        <form action="{{ route('employer.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <x-label for="company_name" :required="true">Company Name</x-label>
                                <x-text-input name="company_name" />
                            </div>

                            <x-button class="">Create</x-button>
                        </form>
                    </x-card>
                </div>
            </div>
        </section>
</x-layout>
