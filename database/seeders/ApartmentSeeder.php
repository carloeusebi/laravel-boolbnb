<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\User;
use Faker\Generator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Generator $faker): void
    {
        // this is for earlier development, seeder will be redone in the future
        $NUMBER_OF_APARTMENTS = 20;

        Storage::makeDirectory('images');

        for ($i = 0; $i <= $NUMBER_OF_APARTMENTS; $i++) {
            $user = User::inRandomOrder()->first();

            Apartment::create([
                'user_id' => $user->id,
                'name' => "Apartment_$i",
                'slug' => Str::slug("Apartment_$i"),
                'address' => 'Via a caso',
                'thumbnail' => 'images/' . $faker->image(storage_path('app/public/images'), 250, 250, fullPath: false),
                'lat' => '41.000',
                'lon' => '40.000',
                'rooms' => rand(1, 5),
                'bedrooms' => rand(1, 5),
                'bathrooms' => rand(1, 5),
                'square_meters' => rand(40, 120),
            ]);
        }
    }
}
