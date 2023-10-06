<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Message extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['apartment_id', 'name', 'content', 'email'];


    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }

    public function getMessage()
    {
        return Str::limit($this->content, 40);
    }
}
