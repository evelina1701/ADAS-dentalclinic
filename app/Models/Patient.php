<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    // Set primary key if you want a custom name (patient_id)
    protected $primaryKey = 'patient_id';

    protected $fillable = [
        'patient_name',
        'patient_surname',
        'patient_personal_code',
        'patient_email',
        'patient_mobile',
        'patient_address',
    ];

    public function visits()
    {
        return $this->hasMany(Visit::class, 'patient_id', 'patient_id');
    }

    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class, 'patient_id', 'patient_id');
    }
}
