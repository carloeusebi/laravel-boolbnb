<?php

namespace Database\Seeders;

use App\Models\Apartment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator;
use Illuminate\Support\Str;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Generator $faker): void
    {
        for ($i = 0; $i < 50; $i++) {
            $apartment = new Apartment();

            // $apartment->user_id = 1;
            $apartment->name = $faker->text(60);
            $apartment->slug = Str::slug($apartment->title, '-');
            $apartment->rooms = $faker->randomNumber(2, false);
            $apartment->bedrooms = $faker->randomNumber(2, false);
            $apartment->bathrooms = $faker->randomNumber(2, false);
            $apartment->square_meters = $faker->randomNumber(2, false);
            $apartment->image = $faker->image(null, 640, 480);
            $apartment->description = $faker->paragraphs(15, true);
            $apartment->is_published = $faker->boolean();

            $apartment->save();
        }
    }
}
