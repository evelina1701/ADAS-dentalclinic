<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MedicalRecord;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class MedicalRecordController extends Controller
{
    // List all medical records
    public function index()
    {
        // Eager load patient and specialist (dentist) relationships
        $medicalRecords = MedicalRecord::with(['patient', 'specialist'])->get();
        return view('admin.medical_records.index', compact('medicalRecords'));
    }

    // Show form for creating a new medical record
    public function create()
    {
        $patients = Patient::all();
        return view('admin.medical_records.create', compact('patients'));
    }

    // Store a new medical record
    public function store(Request $request)
    {
        $request->validate([
            // Validate that the patient's personal code exists in the patients table.
            'patient_personal_code' => 'required|string|size:12|exists:patients,patient_personal_code',
            'record_date' => 'required|date',
            'diagnosis'   => 'nullable|string',
            'treatment'   => 'nullable|string',
            'notes'       => 'nullable|string',
        ]);

        // Retrieve patient by personal code
        $patient = Patient::where('patient_personal_code', $request->patient_personal_code)->firstOrFail();

        // Determine the specialist.
        // If the logged-in user is a dentist, then use their id:
        $specialist_id = auth()->user()->id;

        MedicalRecord::create([
            'patient_id'    => $patient->patient_id,
            'specialist_id' => $specialist_id,
            'record_date'   => $request->record_date,
            'diagnosis'     => $request->diagnosis,
            'treatment'     => $request->treatment,
            'notes'         => $request->notes,
        ]);

        return redirect()->route('admin.medical_records.index')
                         ->with('success', 'Medical record created successfully.');
    }

    // Show form for editing a medical record
    public function edit(MedicalRecord $medicalRecord)
    {
        return view('admin.medical_records.edit', compact('medicalRecord'));
    }

    // Update a medical record
    public function update(Request $request, MedicalRecord $medicalRecord)
    {
        $request->validate([
            'record_date' => 'required|date',
            'diagnosis'   => 'nullable|string',
            'treatment'   => 'nullable|string',
            'notes'       => 'nullable|string',
        ]);

        $medicalRecord->update([
            'record_date' => $request->record_date,
            'diagnosis'   => $request->diagnosis,
            'treatment'   => $request->treatment,
            'notes'       => $request->notes,
        ]);

        return redirect()->route('admin.medical_records.index')
                         ->with('success', 'Medical record updated successfully.');
    }

    // Soft delete a medical record
    public function destroy(MedicalRecord $medicalRecord)
    {
        // Use soft delete (make sure MedicalRecord model uses SoftDeletes if needed)
        $medicalRecord->delete();

        return redirect()->route('admin.medical_records.index')
                         ->with('success', 'Medical record deleted (archived) successfully.');
    }
}
