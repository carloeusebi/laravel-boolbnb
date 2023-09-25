<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Wi-Fi',
                'icon' => 'wifi',
            ],
            [
                'name' => 'Parcheggio',
                'icon' => 'square-parking',
            ],
            [
                'name' => 'Piscina',
                'icon' => 'person-swimming',
            ],
            [
                'name' => 'Portineria',
                'icon' => 'bell-concierge',
            ],
            [
                'name' => 'Sauna',
                'icon' => 'hot-tub-person',
            ],
            [
                'name' => 'Vista mare',
                'icon' => 'water',
            ],
            // add others
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
