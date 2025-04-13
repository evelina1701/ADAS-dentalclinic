@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Users</h1>
        <a href="{{ route('admin.users.create') }}" 
           class="inline-flex items-center px-4 py-2 bg-blue-600 border 
                  border-transparent rounded-md font-semibold text-gray-800 
                  hover:bg-blue-700 focus:outline-none 
                  focus:border-blue-700 focus:ring-blue-300">
            {{-- Optional Icon: <svg ...></svg> --}}
            Create New User
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-4 p-4 rounded-md bg-green-50 border border-green-200 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table Container -->
    <div class="bg-white shadow rounded-md overflow-hidden">
        <div class="p-4 border-b border-gray-200">
            <h2 class="text-lg font-medium text-gray-800">Users List</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            ID
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Name
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Surname
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Role
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Email
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($users as $user)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $user->id }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $user->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $user->surname }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $user->roles->first()->name ?? 'No role' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <!-- Edit Button -->
                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                class="inline-block px-3 py-1 mr-1 bg-yellow-500 text-gray-900 
                                        rounded-md hover:bg-yellow-600 transition-colors duration-150">
                                    Edit
                                </a>
                                <!-- Delete Form -->
                                <form action="{{ route('admin.users.destroy', $user->id) }}" 
                                    method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this user?');"
                                            class="px-3 py-1 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors duration-150">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
