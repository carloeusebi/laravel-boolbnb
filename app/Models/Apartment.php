<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    public function sponsorship()
    {
        return $this->belongsToMany(Sponsorship::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    //todo other relations
}