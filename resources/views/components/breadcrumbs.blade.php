<section class="bg-gradient-to-r from-blue-800 to-indigo-900 dark:bg-gray-900">
    <div class="flex flex-wrap items-center max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:py-16 lg:pt-28 lg:pb-10">

        <nav {{ $attributes }}>
            <ul class="flex space-x-2 font-semibold text-white">
                <li>
                    <a href="/">Home</a>
                </li>

                {{-- Loop through the links array and output the label and link --}}
                @foreach ($links as $label => $link)
                    <li>»</li>
                    <li>
                        <a href="{{ $link }}">{{ $label }}</a>
                    </li>
                @endforeach
            </ul>
        </nav>

    </div>
</section>
