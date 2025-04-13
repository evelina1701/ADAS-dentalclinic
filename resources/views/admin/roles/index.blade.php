@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6">
    <!-- Header Row -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Roles</h1>
        {{-- If you want a "Create New Role" button, uncomment and update the link below --}}
        {{-- <a href="{{ route('admin.roles.create') }}"
           class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring-blue-300">
            Create New Role
        </a> --}}
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-4 p-4 rounded-md bg-green-50 border border-green-200 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    <!-- Card Container for Roles Table -->
    <div class="bg-white shadow rounded-md overflow-hidden">
        <!-- Card Header with Gradient Background -->
        <div class="p-4 border-b border-gray-200 bg-gradient-to-r from-blue-600 to-blue-500">
            <h2 class="text-lg font-medium text-gray-800">Roles List</h2>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Permissions</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($roles as $role)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $role->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @foreach($role->permissions as $perm)
                                    <span class="inline-block bg-gray-200 text-gray-800 text-xs font-medium mr-1 px-2 py-1 rounded">
                                        {{ $perm->name }}
                                    </span>
                                @endforeach
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <a href="{{ route('admin.roles.edit', $role->id) }}" 
                                   class="inline-block px-3 py-1 bg-yellow-500 text-gray-900 rounded-md hover:bg-yellow-600 transition-colors duration-150">
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- Optional: Uncomment the following if you have pagination enabled --}}
        {{-- <div class="p-4 border-t border-gray-200 text-right">
            {{ $roles->links() }}
        </div> --}}
    </div>
</div>
@endsection
