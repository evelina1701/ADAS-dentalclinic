@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Patient</h1>
    <form action="{{ route('admin.patients.update', $patient->patient_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mt-2">
            <label for="patient_name">Name</label>
            <input type="text" name="patient_name" value="{{ $patient->patient_name }}" class="form-control" required>
        </div>
        <div class="form-group mt-2">
            <label for="patient_surname">Surname</label>
            <input type="text" name="patient_surname" value="{{ $patient->patient_surname }}" class="form-control" required>
        </div>
        <div class="form-group mt-2">
            <label for="patient_personal_code">Personal Code</label>
            <input type="text" name="patient_personal_code" value="{{ $patient->patient_personal_code }}" class="form-control" required>
        </div>
        <div class="form-group mt-2">
            <label for="patient_email">Email</label>
            <input type="email" name="patient_email" value="{{ $patient->patient_email }}" class="form-control">
        </div>
        <div class="form-group mt-2">
            <label for="patient_mobile">Mobile</label>
            <input type="text" name="patient_mobile" value="{{ $patient->patient_mobile }}" class="form-control" required>
        </div>
        <div class="form-group mt-2">
            <label for="patient_address">Address</label>
            <textarea name="patient_address" class="form-control">{{ $patient->patient_address }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Update Patient</button>
    </form>
</div>
@endsection
