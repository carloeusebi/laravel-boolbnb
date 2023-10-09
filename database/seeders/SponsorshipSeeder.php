<?php

namespace Database\Seeders;

use App\Models\Sponsorship;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hour = 3600 * 1000;
        $sponsorships = [
            [
                'name' => 'Light',
                'price' => 2.99,
                'duration' => 24 * $hour,
            ],
            [
                'name' => 'Medium',
                'price' => 5.99,
                'duration' => 72 * $hour,
            ],
            [
                'name' => 'Large',
                'price' => 9.99,
                'duration' => 144 * $hour,
            ],
            [
                'name' => 'Test',
                'price' => 0.10,
                'duration' => 30000
            ]
        ];

        foreach ($sponsorships as $sponsorship) {
            Sponsorship::create($sponsorship);
        }
    }
}
