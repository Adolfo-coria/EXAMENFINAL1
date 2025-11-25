<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dentist extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'license_number',
        'specialization',
        'biography',
        'office_location',
        'start_time',
        'end_time',
        'status',
    ];

    protected $casts = [
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
    ];

    // Relaciones
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    // Getters
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
