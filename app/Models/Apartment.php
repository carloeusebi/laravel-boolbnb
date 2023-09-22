<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Apartment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'slug', 'rooms', 'bedrooms', 'bathrooms', 'square_meters', 'image', 'description', 'is_published'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
