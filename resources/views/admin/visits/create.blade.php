@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New Visit</h1>
    <form action="{{ route('admin.visits.store') }}" method="POST">
        @csrf

        <!-- Input for Patient Personal Code -->
        <div class="form-group mt-2">
            <label for="patient_personal_code">Patient Personal Code</label>
            <input type="text" name="patient_personal_code" id="patient_personal_code" class="form-control" placeholder="Enter 12-character code" required>
        </div>

        <!-- Dropdown for Specialist -->
        <div class="form-group mt-2">
            <label for="specialist_id">Specialist</label>
            <select name="specialist_id" class="form-control" required>
                @foreach($specialists as $specialist)
                    <option value="{{ $specialist->id }}">
                        {{ $specialist->name }} {{ $specialist->surname }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Date & Time for Visit -->
        <div class="form-group mt-2">
            <label for="visit_date_time">Visit Date & Time</label>
            <input type="text" name="visit_date_time" id="visit_date_time" class="form-control" placeholder="Select date & time" required>
        </div>

        <!-- Notes -->
        <div class="form-group mt-2">
            <label for="notes">Notes</label>
            <textarea name="notes" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-success mt-3">Create Visit</button>
    </form>
</div>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        flatpickr("#visit_date_time", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            //Optional: add more options, for example:
            minDate: "today",
            time_24hr: true,
            minuteIncrement: 30,
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
                    q: request.term // term typed by the user
                },
                success: function(data) {
                    response(data);
                }
            });
        },
        minLength: 2,  // start suggesting after 2 characters
        autoFocus: true
    });
});
</script>
@endpush

@endsection
