@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 py-6">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Create New Medical Record</h1>
    <form action="{{ route('admin.medical_records.store') }}" method="POST" class="bg-white shadow rounded-md p-6">
        @csrf
        
        <!-- Patient Personal Code Field -->
        <div class="mb-4">
            <label for="patient_personal_code" class="block text-sm font-medium text-gray-700">
                Patient Personal Code
            </label>
            <input type="text" name="patient_personal_code" id="patient_personal_code" placeholder="Enter 12-character code"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                   required>
        </div>
        
        <!-- Record Date Field -->
        <div class="mb-4">
            <label for="record_date" class="block text-sm font-medium text-gray-700">
                Record Date
            </label>
            <input type="text" name="record_date" id="record_date" placeholder="YYYY-MM-DD"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                   required>
        </div>
        
        <!-- Diagnosis Field -->
        <div class="mb-4">
            <label for="diagnosis" class="block text-sm font-medium text-gray-700">
                Diagnosis
            </label>
            <textarea name="diagnosis" id="diagnosis" rows="3"
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                      placeholder="Enter diagnosis"></textarea>
        </div>
        
        <!-- Treatment Field -->
        <div class="mb-4">
            <label for="treatment" class="block text-sm font-medium text-gray-700">
                Treatment
            </label>
            <textarea name="treatment" id="treatment" rows="3"
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                      placeholder="Enter treatment"></textarea>
        </div>
        
        <!-- Notes Field -->
        <div class="mb-6">
            <label for="notes" class="block text-sm font-medium text-gray-700">
                Notes
            </label>
            <textarea name="notes" id="notes" rows="3"
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                      placeholder="Enter any additional notes"></textarea>
        </div>
        
        <!-- Submit Button -->
        <button type="submit"
                class="w-full py-2 px-4 bg-green-600 text-gray-800 font-semibold text-center 
                    rounded-md shadow hover:bg-green-700 focus:outline-none focus:ring-2
                    focus:ring-green-600 focus:ring-offset-2 transition-colors duration-150">
            Create Medical Record
        </button>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Initialize Flatpickr for the record_date field
        flatpickr("#record_date", {
            dateFormat: "Y-m-d",
            minDate: "today"
        });
    });
</script>
<script>
    $(function() {
        // Initialize jQuery UI Autocomplete for the patient personal code field
        $("#patient_personal_code").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "{{ route('patients.fetchCodes') }}",
                    dataType: "json",
                    data: {
                        q: request.term
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minLength: 2,
            autoFocus: true
        });
    });
</script>
@endpush
