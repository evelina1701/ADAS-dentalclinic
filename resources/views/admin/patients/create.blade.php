@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 py-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Create New Patient</h1>
    <form action="{{ route('admin.patients.store') }}" method="POST" class="bg-white shadow rounded-md p-6">
        @csrf
        
        <!-- Patient Name Field -->
        <div class="mb-4">
            <label for="patient_name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="patient_name" id="patient_name"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                   required>
        </div>
        
        <!-- Patient Surname Field -->
        <div class="mb-4">
            <label for="patient_surname" class="block text-sm font-medium text-gray-700">Surname</label>
            <input type="text" name="patient_surname" id="patient_surname"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                   required>
        </div>
        
        <!-- Personal Code Field -->
        <div class="mb-4">
            <label for="patient_personal_code" class="block text-sm font-medium text-gray-700">Personal Code</label>
            <input type="text" name="patient_personal_code" id="patient_personal_code"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                   required>
        </div>
        
        <!-- Email Field -->
        <div class="mb-4">
            <label for="patient_email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="patient_email" id="patient_email"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
        </div>
        
        <!-- Mobile Field -->
        <div class="mb-4">
            <label for="patient_mobile" class="block text-sm font-medium text-gray-700">Mobile</label>
            <input type="text" name="patient_mobile" id="patient_mobile"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                   required>
        </div>
        
        <!-- Address Field -->
        <div class="mb-6">
            <label for="patient_address" class="block text-sm font-medium text-gray-700">Address</label>
            <textarea name="patient_address" id="patient_address" rows="3"
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                      placeholder="Enter address"></textarea>
        </div>
        
        <!-- Submit Button -->
        <button type="submit"
                class="w-full py-2 px-4 bg-green-600 text-gray-800 font-semibold text-center 
                    rounded-md shadow hover:bg-green-700 focus:outline-none focus:ring-2
                    focus:ring-green-600 focus:ring-offset-2 transition-colors duration-150">
            Create Patient
        </button>
    </form>
</div>
@endsection
