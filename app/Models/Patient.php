<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'ci',
        'date_of_birth',
        'gender',
        'address',
        'city',
        'medical_history',
        'status',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    // Relaciones
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    // Getters
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
