<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicalRecord extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'patient_id',
        'specialist_id',
        'record_date',
        'diagnosis',
        'treatment',
        'notes',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'patient_id');
    }

    public function specialist()
    {
        // If you're using soft deletes on User, you might want:
        return $this->belongsTo(User::class, 'specialist_id')->withTrashed();
    }
}
