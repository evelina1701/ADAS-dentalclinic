@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 py-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Create New Visit</h1>
    <form action="{{ route('admin.visits.store') }}" method="POST" class="bg-white shadow rounded-md p-6">
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

        <!-- Specialist Dropdown -->
        <div class="mb-4">
            <label for="specialist_id" class="block text-sm font-medium text-gray-700">
                Specialist
            </label>
            <select name="specialist_id" id="specialist_id"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                    required>
                @foreach($specialists as $specialist)
                    <option value="{{ $specialist->id }}">
                        {{ $specialist->name }} {{ $specialist->surname }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Date & Time Field -->
        <div class="mb-4">
            <label for="visit_date_time" class="block text-sm font-medium text-gray-700">
                Visit Date & Time
            </label>
            <input type="text" name="visit_date_time" id="visit_date_time" placeholder="Select date & time"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                   required>
        </div>

        <!-- Notes Field -->
        <div class="mb-6">
            <label for="notes" class="block text-sm font-medium text-gray-700">
                Notes
            </label>
            <textarea name="notes" id="notes" rows="3" placeholder="Enter any additional notes" 
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
        </div>

        <!-- Submit Button -->
        <button type="submit"
                class="w-full py-2 px-4 bg-green-600 text-gray-800 font-semibold text-center 
                    rounded-md shadow hover:bg-green-700 focus:outline-none focus:ring-2
                    focus:ring-green-600 focus:ring-offset-2 transition-colors duration-150">
            Create Visit
        </button>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        flatpickr("#visit_date_time", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            minDate: "today",
            time_24hr: true,
            minuteIncrement: 30
        });
    });
</script>

<script>
$(function() {
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
