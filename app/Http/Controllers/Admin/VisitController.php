<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visit;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    // Display a list of visits
    public function index()
    {
        // Eager load patient and specialist relationships
        $visits = Visit::with(['patient', 'specialist'])->get();
        return view('admin.visits.index', compact('visits'));
    }

    // Show the form to create a new visit
    public function create()
    {
        $patients = Patient::all();
        $specialists = User::role('dentist')->get();

        return view('admin.visits.create', compact('patients', 'specialists'));
    }

    // Store the new visit in the database
    public function store(Request $request)
    {
        $request->validate([
            'patient_personal_code' => 'required|string|size:12|exists:patients,patient_personal_code',
            'specialist_id'         => 'required|exists:users,id',
            'visit_date_time'       => 'required|date_format:Y-m-d H:i',
            'notes'                 => 'nullable|string',
        ]);

        // Find patient by personal code
        $patient = Patient::where('patient_personal_code', $request->patient_personal_code)->firstOrFail();

        Visit::create([
            'patient_id'       => $patient->patient_id,
            'specialist_id'    => $request->specialist_id,
            'visit_date_time'  => $request->visit_date_time,
            'notes'            => $request->notes,
        ]);

        return redirect()->route('admin.visits.index')
                         ->with('success', 'Visit created successfully.');
    }

    // Show the form to edit an existing visit
    public function edit(Visit $visit)
    {
        // Pass patients and specialists if needed for dropdowns in the form.
        $patients = Patient::all();
        $specialists = User::role('dentist')->get();
        return view('admin.visits.edit', compact('visit', 'patients', 'specialists'));
    }

    // Update the visit in the database
    public function update(Request $request, Visit $visit)
    {
        $request->validate([
            'patient_personal_code' => 'required|string|size:12|exists:patients,patient_personal_code',
            'specialist_id'         => 'required|exists:users,id',
            'visit_date_time'       => 'required|date_format:Y-m-d H:i',
            'notes'                 => 'nullable|string',
        ]);

        // Find patient by personal code
        $patient = Patient::where('patient_personal_code', $request->patient_personal_code)->firstOrFail();

        $visit->update([
            'patient_id'       => $patient->patient_id,
            'specialist_id'    => $request->specialist_id,
            'visit_date_time'  => $request->visit_date_time,
            'notes'            => $request->notes,
        ]);

        return redirect()->route('admin.visits.index')
                         ->with('success', 'Visit updated successfully.');
    }

    // Delete a visit
    public function destroy(Visit $visit)
    {
        $visit->delete();
        return redirect()->route('admin.visits.index')
                         ->with('success', 'Visit deleted successfully.');
    }
}
