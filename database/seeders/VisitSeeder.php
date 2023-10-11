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
            $numberOfVisits = rand(5, 20);
            for ($i = 0; $i < $numberOfVisits; $i++) {
                Visit::create([
                    'apartment_id' => $apartment->id,
                    'date' => $faker->dateTimeBetween('-5 months'),
                    'ip_address' => $faker->ipv4(),
                ]);
            }
        }
    }
}
