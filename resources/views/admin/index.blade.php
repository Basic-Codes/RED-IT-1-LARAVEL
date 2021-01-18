<x-admin-master>
    @section('content')

    @if (auth()->user()->UserHasRole("admin"))
        <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
    @else
        <h1 class="h3 mb-4 text-gray-800">User doesn't has this role.</h1>
    @endif
    @endsection
</x-admin-master>