@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New Medical Record</h1>
    <form action="{{ route('admin.medical_records.store') }}" method="POST">
        @csrf
        <!-- Input for Patient Personal Code -->
        <div class="form-group mt-2">
            <label for="patient_personal_code">Patient Personal Code</label>
            <input type="text" name="patient_personal_code" id="patient_personal_code" class="form-control" placeholder="Enter 12-character code" required>
        </div>
        <!-- Record Date -->
        <div class="form-group mt-2">
            <label for="record_date">Record Date</label>
            <input type="text" name="record_date" id="record_date" class="form-control" placeholder="YYYY-MM-DD" required>
        </div>
        <!-- Diagnosis -->
        <div class="form-group mt-2">
            <label for="diagnosis">Diagnosis</label>
            <textarea name="diagnosis" class="form-control"></textarea>
        </div>
        <!-- Treatment -->
        <div class="form-group mt-2">
            <label for="treatment">Treatment</label>
            <textarea name="treatment" class="form-control"></textarea>
        </div>
        <!-- Notes -->
        <div class="form-group mt-2">
            <label for="notes">Notes</label>
            <textarea name="notes" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success mt-3">Create Medical Record</button>
    </form>
</div>
@endsection

@push('scripts')
<script>
    // Initialize Flatpickr for record_date field
    document.addEventListener("DOMContentLoaded", function() {
        flatpickr("#record_date", {
            dateFormat: "Y-m-d",
            minDate: "today" // or adjust if needed
        });
    });
</script>
<script>
    // Optionally, initialize autocomplete for patient personal code
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
