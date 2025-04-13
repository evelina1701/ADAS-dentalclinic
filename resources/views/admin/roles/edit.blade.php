@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 py-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Role: {{ $role->name }}</h1>

    <form action="{{ route('admin.roles.update', $role->id) }}" method="POST" class="bg-white shadow rounded-md p-6">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Permissions</label>
            <!-- Use a grid layout for checkboxes. Adjust grid-cols-2 to grid-cols-3 or more as needed -->
            <div class="grid grid-cols-2 gap-2">
                @foreach($permissions as $permission)
                    <div class="flex items-center">
                        <input type="checkbox"
                               name="permissions[]"
                               value="{{ $permission->name }}"
                               id="perm_{{ $permission->id }}"
                               @if($role->hasPermissionTo($permission->name)) checked @endif
                               class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <label for="perm_{{ $permission->id }}" class="ml-2 text-sm text-gray-700">
                            {{ $permission->name }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <button type="submit"
                class="w-full py-2 px-4 bg-green-600 text-gray-800 font-semibold text-center 
                    rounded-md shadow hover:bg-green-700 focus:outline-none focus:ring-2
                    focus:ring-green-600 focus:ring-offset-2 transition-colors duration-150">
            Update Role
        </button>
    </form>
</div>
@endsection
