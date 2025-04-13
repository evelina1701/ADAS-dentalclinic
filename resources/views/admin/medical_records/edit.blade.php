@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 py-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Medical Record</h1>
    <form action="{{ route('admin.medical_records.update', $medicalRecord->id) }}" method="POST" class="bg-white shadow rounded-md p-6">
        @csrf
        @method('PUT')
        
        <!-- Patient Personal Code Field (Read-only) -->
        <div class="mb-4">
            <label for="patient_personal_code" class="block text-sm font-medium text-gray-700">Patient Personal Code</label>
            <input type="text" id="patient_personal_code" value="{{ $medicalRecord->patient->patient_personal_code }}" readonly
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100 text-gray-700 cursor-not-allowed">
        </div>
        
        <!-- Record Date Field -->
        <div class="mb-4">
            <label for="record_date" class="block text-sm font-medium text-gray-700">Record Date</label>
            <input type="text" name="record_date" id="record_date" placeholder="YYYY-MM-DD" 
                   value="{{ \Carbon\Carbon::parse($medicalRecord->record_date)->format('Y-m-d') }}" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
        </div>
        
        <!-- Diagnosis Field -->
        <div class="mb-4">
            <label for="diagnosis" class="block text-sm font-medium text-gray-700">Diagnosis</label>
            <textarea name="diagnosis" id="diagnosis" rows="3" placeholder="Enter diagnosis"
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ $medicalRecord->diagnosis }}</textarea>
        </div>
        
        <!-- Treatment Field -->
        <div class="mb-4">
            <label for="treatment" class="block text-sm font-medium text-gray-700">Treatment</label>
            <textarea name="treatment" id="treatment" rows="3" placeholder="Enter treatment"
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ $medicalRecord->treatment }}</textarea>
        </div>
        
        <!-- Notes Field -->
        <div class="mb-6">
            <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
            <textarea name="notes" id="notes" rows="3" placeholder="Enter any additional notes"
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ $medicalRecord->notes }}</textarea>
        </div>
        
        <!-- Submit Button -->
        <button type="submit"
                class="w-full py-2 px-4 bg-green-600 text-gray-800 font-semibold text-center 
                    rounded-md shadow hover:bg-green-700 focus:outline-none focus:ring-2
                    focus:ring-green-600 focus:ring-offset-2 transition-colors duration-150">
            Update Medical Record
        </button>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        flatpickr("#record_date", {
            dateFormat: "Y-m-d"
        });
    });
</script>
@endpush
