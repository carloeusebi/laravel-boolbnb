<?php

namespace Database\Seeders;

use App\Models\Address;
use Faker\Generator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Generator $faker): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $address = new Address();
            $address->city = $faker->city();
            $address->street = $faker->streetName();
            $address->street_number = $faker->randomNumber(2);
            $address->zip = $faker->postcode();
            $address->lat = $faker->latitude();
            $address->long = $faker->longitude();
            $address->save();
        }
    }
}
