<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function path()
    {
        return "/dashboard/patients/{$this->id}";
    }

    public function age()
    {
        return Carbon::parse($this->attributes['birthdate'])->age;
    }

    public function nurse()
    {
        return $this->belongsTo(User::class);
    }

    public function bloodPressure()
    {
        return $this->hasMany(BloodPressure::class, 'patient_id');
    }
}
