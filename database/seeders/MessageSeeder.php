<?php

namespace Database\Seeders;

use App\Models\Message;
use Faker\Generator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Generator $faker): void
    {
        for ($i = 0; $i < 20; $i++) {
            $message = new Message();

            // $message->apartment_id = 1;
            $message->title = $faker->text(30);
            $message->content = $faker->paragraphs(15, true);
            $message->email = $faker->email();

            $message->save();
        }
    }
}
