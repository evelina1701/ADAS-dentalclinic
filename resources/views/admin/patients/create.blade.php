@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New Patient</h1>
    <form action="{{ route('admin.patients.store') }}" method="POST">
        @csrf
        <div class="form-group mt-2">
            <label for="patient_name">Name</label>
            <input type="text" name="patient_name" class="form-control" required>
        </div>
        <div class="form-group mt-2">
            <label for="patient_surname">Surname</label>
            <input type="text" name="patient_surname" class="form-control" required>
        </div>
        <div class="form-group mt-2">
            <label for="patient_personal_code">Personal Code</label>
            <input type="text" name="patient_personal_code" class="form-control" required>
        </div>
        <div class="form-group mt-2">
            <label for="patient_email">Email</label>
            <input type="email" name="patient_email" class="form-control">
        </div>
        <div class="form-group mt-2">
            <label for="patient_mobile">Mobile</label>
            <input type="text" name="patient_mobile" class="form-control" required>
        </div>
        <div class="form-group mt-2">
            <label for="patient_address">Address</label>
            <textarea name="patient_address" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success mt-3">Create Patient</button>
    </form>
</div>
@endsection
