<div>
    {{-- If the $allOption variable is set to true, display the All option --}}
    @if ($allOption)
        <label for="{{ $name }}" class="mb-1 flex items-center">
            <input type="radio" name="{{ $name }}" value="" @checked(!request($name)) />
            <span class="ml-2">All</span>
        </label>
    @endif

    {{-- Display the options except the All --}}
    @foreach ($optionsWithLabels as $label => $option)
        <label for="{{ $name }}" class="mb-1 flex items-center">
            <input type="radio" name="{{ $name }}" value="{{ $option }}"
                {{-- If the $value variable is set, use it, otherwise use the request($name) value --}}
                @checked($option === ($value ?? request($name))) />
            <span class="ml-2">{{ $label }}</span>
        </label>
    @endforeach

    {{-- Display errors messages for radio group fields --}}
    @error($name)
        <div class="mt-1 text-xs text-red-500">
            {{ $message }}
        </div>
    @enderror
</div>
