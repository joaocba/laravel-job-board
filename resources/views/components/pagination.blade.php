@props(['collection'])

@if ($collection->count())
    <div class="mt-4 mb-10">
        {{-- Pagination for the collection that preserves the filters applied --}}
        {{ $collection->appends(request()->query())->links() }}
    </div>
@endif
