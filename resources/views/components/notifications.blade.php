<!-- Display success message -->
@if (session()->has('success'))
    <div role="alert" class="p-4 my-4 text-green-700 bg-green-100 border-l-4 border-green-300 rounded-md opacity-75">
        <p class="font-bold">Success!</p>
        <p>{{ session('success') }}</p>
    </div>
@endif

<!-- Display error message -->
@if (session()->has('error'))
    <div role="alert" class="p-4 my-4 text-red-700 bg-red-100 border-l-4 border-red-300 rounded-md opacity-75">
        <p class="font-bold">Error!</p>
        <p>{{ session('error') }}</p>
    </div>
@endif
