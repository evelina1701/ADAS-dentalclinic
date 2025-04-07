@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Manage Visits</h1>

    @if(session('success'))
      <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.visits.create') }}" class="btn btn-primary mb-3">Create New Visit</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Visit ID</th>
                <th>Patient ID</th>
                <th>Patient Name</th>
                <th>Patient Surname</th>
                <th>Personal Code</th>
                <th>Date & Time</th>
                <th>Specialist Name</th>
                <th>Specialist Surname</th>
                <th>Notes</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($visits as $visit)
                <tr>
                    <td>{{ $visit->id }}</td>
                    <td>{{ $visit->patient->patient_id }}</td>
                    <td>{{ $visit->patient->patient_name }}</td>
                    <td>{{ $visit->patient->patient_surname }}</td>
                    <td>{{ $visit->patient->patient_personal_code }}</td>
                    <td>{{ \Carbon\Carbon::parse($visit->visit_date_time)->format('Y-m-d H:i') }}</td>
                    <td>{{ $visit->specialist->name }}</td>
                    <td>{{ $visit->specialist->surname }}</td>
                    <td>{{ $visit->notes }}</td>
                    <td>
                        <a href="{{ route('admin.visits.edit', $visit->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.visits.destroy', $visit->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure you want to delete this visit?');">
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
