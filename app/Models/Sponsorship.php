<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    use HasFactory;

    public function apartments()
    {
        return $this->belongsToMany(Apartment::class);
    }

    public function getHoursAttribute()
    {
        return $this->duration / 3_600_000;
    }
}
