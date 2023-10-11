<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Apartment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['user_id', 'name', 'slug', 'description', 'thumbnail', 'address', 'rooms', 'bedrooms', 'bathrooms', 'square_meters', 'lat', 'lon'];

    /**
     * Localizes attributes with user-friendly italian labels.
     */
    static function labels(): array
    {
        return [
            'user_id' => 'Utente',
            'name' => 'Nome dell\'Appartamento',
            'description' => 'Descrizione',
            'thumbnail' => 'Thumbnail',
            'address' => 'Indirizzo',
            'rooms' => 'Stanze',
            'bedrooms' => 'Camere da letto',
            'bathrooms' => 'Bagni',
            'square_meters' => 'Metri quadri',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sponsorships()
    {
        return $this->belongsToMany(Sponsorship::class)->orderByPivot('expiration_date', 'desc')->withPivot('expiration_date');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }

    public function getSponsoredAttribute()
    {
        return $this->getSponsorshipExpirationAttribute();
    }

    public function getSponsorshipExpirationAttribute()
    {
        if ($this->sponsorships->count()) {
            $expirationDate = $this->sponsorships->first()->pivot->expiration_date;
            return Carbon::parse($expirationDate . 'UTC') > Carbon::now() ? $expirationDate : null;
        } else {
            return null;
        }
    }

    public function getPathImage()
    {
        return asset('storage/' . $this->thumbnail);
    }

    public function getDescription()
    {
        return Str::limit($this->description, 70);
    }

    //todo other relations
}
