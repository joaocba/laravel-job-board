{{-- class() is a helper function that allows us to conditionally add classes to an element by default --}}

<article {{ $attributes->class(['rounded-md border border-slate-300 bg-white p-4 shadow-sm']) }}>
    {{ $slot }}
</article>
