<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = [
        'patient_id',
        'specialist_id',
        'visit_date_time',
        'notes',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'patient_id');
    }

    public function specialist()
    {
        return $this->belongsTo(User::class, 'specialist_id')->withTrashed();
    }
}
