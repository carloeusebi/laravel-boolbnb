<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Visit;
use Faker\Generator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VisitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Generator $faker): void
    {
        $apartments = Apartment::all();

        foreach ($apartments as $apartment) {
            $numberOfVisits = rand(1, 10);
            for ($i = 0; $i < $numberOfVisits; $i++) {
                Visit::create([
                    'apartment_id' => $apartment->id,
                    'date' => $faker->dateTimeBetween('-2 years'),
                    'ip_address' => $faker->ipv4(),
                ]);
            }
        }
    }
}
