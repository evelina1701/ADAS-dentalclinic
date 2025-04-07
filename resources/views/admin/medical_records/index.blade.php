@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Manage Medical Records</h1>

    @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.medical_records.create') }}" class="btn btn-primary mb-3">Create New Medical Record</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Record ID</th>
                <th>Patient Name</th>
                <th>Patient Surname</th>
                <th>Personal Code</th>
                <th>Record Date</th>
                <th>Diagnosis</th>
                <th>Treatment</th>
                <th>Notes</th>
                <th>Dentist Name</th>
                <th>Dentist Surname</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($medicalRecords as $record)
            <tr>
                <td>{{ $record->id }}</td>
                <td>{{ $record->patient->patient_name }}</td>
                <td>{{ $record->patient->patient_surname }}</td>
                <td>{{ $record->patient->patient_personal_code }}</td>
                <td>{{ \Carbon\Carbon::parse($record->record_date)->format('Y-m-d') }}</td>
                <td>{{ $record->diagnosis }}</td>
                <td>{{ $record->treatment }}</td>
                <td>{{ $record->notes }}</td>
                <td>{{ $record->specialist->name }}</td>
                <td>{{ $record->specialist->surname }}</td>
                <td>
                    <a href="{{ route('admin.medical_records.edit', $record->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.medical_records.destroy', $record->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" 
                            onclick="return confirm('Are you sure you want to delete this record?');">
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
