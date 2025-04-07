@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Medical Record</h1>
    <form action="{{ route('admin.medical_records.update', $medicalRecord->id) }}" method="POST">
        @csrf
        @method('PUT')
        <!-- Display patient information (non-editable, if desired) -->
        <div class="form-group mt-2">
            <label>Patient Personal Code</label>
            <input type="text" class="form-control" value="{{ $medicalRecord->patient->patient_personal_code }}" readonly>
        </div>
        <!-- Record Date -->
        <div class="form-group mt-2">
            <label for="record_date">Record Date</label>
            <input type="text" name="record_date" id="record_date" class="form-control" value="{{ \Carbon\Carbon::parse($medicalRecord->record_date)->format('Y-m-d') }}" required>
        </div>
        <!-- Diagnosis -->
        <div class="form-group mt-2">
            <label for="diagnosis">Diagnosis</label>
            <textarea name="diagnosis" class="form-control">{{ $medicalRecord->diagnosis }}</textarea>
        </div>
        <!-- Treatment -->
        <div class="form-group mt-2">
            <label for="treatment">Treatment</label>
            <textarea name="treatment" class="form-control">{{ $medicalRecord->treatment }}</textarea>
        </div>
        <!-- Notes -->
        <div class="form-group mt-2">
            <label for="notes">Notes</label>
            <textarea name="notes" class="form-control">{{ $medicalRecord->notes }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Update Medical Record</button>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        flatpickr("#record_date", {
            dateFormat: "Y-m-d",
        });
    });
</script>
@endpush
