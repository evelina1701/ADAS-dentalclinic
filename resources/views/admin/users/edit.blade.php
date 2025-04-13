@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 py-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit User</h1>
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="bg-white shadow rounded-md p-6">
        @csrf
        @method('PUT')
        
        <!-- Name Field -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" id="name" value="{{ $user->name }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                   required>
        </div>
        
        <!-- Surname Field -->
        <div class="mb-4">
            <label for="surname" class="block text-sm font-medium text-gray-700">Surname</label>
            <input type="text" name="surname" id="surname" value="{{ $user->surname }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                   required>
        </div>
        
        <!-- Email Field -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ $user->email }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                   required>
        </div>
        
        <!-- Role Dropdown -->
        <div class="mb-4">
            <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
            <select name="role" id="role"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    required>
                @foreach($roles as $role)
                    <option value="{{ $role }}"
                        {{ $user->roles->first() && $user->roles->first()->name === $role ? 'selected' : '' }}>
                        {{ ucfirst($role) }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <!-- Password Field -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password (leave blank if not changing)</label>
            <input type="password" name="password" id="password"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
        </div>
        
        <!-- Confirm Password Field -->
        <div class="mb-6">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
        </div>
        
        <!-- Submit Button -->
        <button type="submit"
                class="w-full py-2 px-4 bg-green-600 text-gray-800 font-semibold text-center 
                    rounded-md shadow hover:bg-green-700 focus:outline-none focus:ring-2
                    focus:ring-green-600 focus:ring-offset-2 transition-colors duration-150">
            Update User
        </button>
    </form>
</div>
@endsection
