<x-layout>

    {{-- Register block --}}
    <section class="pt-14 bg-gradient-to-r from-blue-800 to-indigo-900 dark:bg-gray-900">
        <div class="max-w-screen-xl px-4 py-8 mx-auto space-y-12 lg:space-y-20 lg:py-16 lg:px-6">
            <div class="items-center gap-8 lg:grid lg:grid-cols-2 xl:gap-10">
                <h1 class="my-10 text-4xl font-semibold text-center text-white">
                    Create an account
                </h1>
                <x-card class="px-16 py-8">
                    <form action="{{ route('store') }}" method="POST">
                        @csrf

                        <div class="mb-8">
                            <x-label for="name" :required="true">Name</x-label>
                            <x-text-input name="name" />
                        </div>

                        <div class="mb-8">
                            <x-label for="email" :required="true">E-mail</x-label>
                            <x-text-input name="email" />
                        </div>

                        <div class="mb-8">
                            <x-label for="password" :required="true">Password</x-label>
                            <x-text-input name="password" type="password" />
                        </div>

                        <div class="mb-8">
                            <x-label for="password_confirmation" :required="true">Confirm Password</x-label>
                            <x-text-input name="password_confirmation" type="password" />
                        </div>

                        <x-button class="w-full bg-green-50">Register</x-button>
                        <div>
                            <p class="mt-8 text-sm font-semibold text-center text-slate-900">
                                Already have an account? <a href="{{ route('login') }}"
                                    class="text-indigo-600 hover:underline">Sign in</a>
                            </p>
                        </div>
                    </form>
                </x-card>
            </div>
        </div>
    </section>
</x-layout>
