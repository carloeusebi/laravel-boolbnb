<?php

namespace Database\Seeders;

use App\Models\Card;
use Faker\Generator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Generator $faker): void
    {
        for ($i = 0; $i < 10; $i++) {
            $card = new Card();
            $card->user_id = 1;
            $card->first_name = $faker->firstName();
            $card->last_name = $faker->lastName();
            $card->number = $faker->numerify('################');
            $card->expire_date = $faker->dateTime();
            $card->security_code = $faker->randomNumber(3, true);
            $card->save();
        }
    }
}
