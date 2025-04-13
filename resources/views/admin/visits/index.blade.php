@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6">
    <!-- Header Row: Title and Create Button -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Manage Visits</h1>
        <a href="{{ route('admin.visits.create') }}" 
           class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-gray-800 hover:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring-blue-300">
            Create New Visit
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-4 p-4 rounded-md bg-green-50 border border-green-200 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    <!-- Card Container for Visits Table -->
    <div class="bg-white shadow rounded-md overflow-hidden">
        <!-- Card Header with Gradient Background -->
        <div class="p-4 border-b border-gray-200 bg-gradient-to-r from-blue-600 to-blue-500">
            <h2 class="text-lg font-medium text-gray-800">Visits List</h2>
        </div>
        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Visit ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Patient ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Patient Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Patient Surname</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Personal Code</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date & Time</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Specialist Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Specialist Surname</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Notes</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($visits as $visit)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $visit->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $visit->patient->patient_id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $visit->patient->patient_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $visit->patient->patient_surname }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $visit->patient->patient_personal_code }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($visit->visit_date_time)->format('Y-m-d H:i') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $visit->specialist->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $visit->specialist->surname }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $visit->notes }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <!-- Edit Button -->
                            <a href="{{ route('admin.visits.edit', $visit->id) }}"
                               class="inline-block px-3 py-1 mr-1 bg-yellow-500 text-gray-900 rounded-md hover:bg-yellow-600 transition-colors duration-150">
                                Edit
                            </a>
                            <!-- Delete Button -->
                            <form action="{{ route('admin.visits.destroy', $visit->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Are you sure you want to delete this visit?');"
                                        class="px-3 py-1 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors duration-150">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div><!-- end overflow-x-auto -->
    </div><!-- end card -->
</div>
@endsection
