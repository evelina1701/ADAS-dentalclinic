@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Manage Patients</h1>

    @if(session('success'))
      <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @elseif(session('error'))
      <div class="alert alert-danger mt-3">{{ session('error') }}</div>
    @endif

    <a href="{{ route('admin.patients.create') }}" class="btn btn-primary mb-3">Create New Patient</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Patient ID</th>
                <th>Name</th>
                <th>Surname</th>
                <th>Personal Code</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($patients as $patient)
           <tr>
             <td>{{ $patient->patient_id }}</td>
             <td>{{ $patient->patient_name }}</td>
             <td>{{ $patient->patient_surname }}</td>
             <td>{{ $patient->patient_personal_code }}</td>
             <td>{{ $patient->patient_email }}</td>
             <td>{{ $patient->patient_mobile }}</td>
             <td>{{ $patient->patient_address }}</td>
             <td>
                <a href="{{ route('admin.patients.edit', $patient->patient_id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('admin.patients.destroy', $patient->patient_id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger"
                        onclick="return confirm('Are you sure you want to delete this patient?');">
                        Delete
                    </button>
                </form>
             </td>
           </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
