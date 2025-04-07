<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    // Display a list of patients
    public function index()
    {
        $patients = Patient::all();
        return view('admin.patients.index', compact('patients'));
    }

    // Show the form for creating a new patient
    public function create()
    {
        $patient = new Patient();
        //dd($patient);
        return view('admin.patients.create', compact('patient'));
    }

    // Store a newly created patient in the database
    public function store(Request $request)
    {
        $request->validate([
            'patient_name'           => 'required|string|max:255',
            'patient_surname'        => 'required|string|max:255',
            'patient_personal_code'  => 'required|string|size:12|unique:patients,patient_personal_code',
            'patient_mobile'         => 'required|string|max:50',
            'patient_email'          => 'nullable|email',
            'patient_address'        => 'nullable|string',
        ]);

        Patient::create($request->only([
            'patient_name',
            'patient_surname',
            'patient_personal_code',
            'patient_mobile',
            'patient_email',
            'patient_address',
        ]));

        return redirect()->route('admin.patients.index')
                         ->with('success', 'Patient created successfully.');
    }

    // Show the form for editing a patient
    public function edit(Patient $patient)
    {
        return view('admin.patients.edit', compact('patient'));
    }

    // Update the specified patient in the database
    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'patient_name'           => 'required|string|max:255',
            'patient_surname'        => 'required|string|max:255',
            'patient_personal_code'  => 'required|string|size:12|unique:patients,patient_personal_code,' . $patient->patient_id . ',patient_id',
            'patient_mobile'         => 'required|string|max:50',
            'patient_email'          => 'nullable|email',
            'patient_address'        => 'nullable|string',
        ]);

        $patient->update($request->only([
            'patient_name',
            'patient_surname',
            'patient_personal_code',
            'patient_mobile',
            'patient_email',
            'patient_address',
        ]));

        return redirect()->route('admin.patients.index')
                         ->with('success', 'Patient updated successfully.');
    }

    // Delete the specified patient (if allowed)
    public function destroy(Patient $patient)
    {
        // Optionally check if patient has related records before deletion
        if ($patient->medicalRecords()->exists()) {
            return redirect()->route('admin.patients.index')
                             ->with('error', 'Cannot delete patient with existing medical records.');
        }

        $patient->delete();

        return redirect()->route('admin.patients.index')
                         ->with('success', 'Patient deleted successfully.');
    }

    public function fetchCodes(Request $request)
    {
        $searchTerm = $request->query('q'); // the query string param, e.g. ?q=12345
        // Find patients whose personal code starts with or contains the search term
        $codes = Patient::where('patient_personal_code', 'like', $searchTerm . '%')
                        ->limit(10)
                        ->pluck('patient_personal_code'); // returns an array of strings

        return response()->json($codes);
    }

}
