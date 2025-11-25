<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Appointment extends Model
{
    protected $fillable = [
        'patient_id',
        'dentist_id',
        'appointment_date',
        'start_time',
        'end_time',
        'reason',
        'notes',
        'status',
        'cost',
    ];

    protected $casts = [
        'appointment_date' => 'datetime',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
        'cost' => 'decimal:2',
    ];

    // Relaciones
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function dentist(): BelongsTo
    {
        return $this->belongsTo(Dentist::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
