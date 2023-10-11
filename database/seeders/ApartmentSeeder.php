<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\StorageAttributes;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv_file = fopen(base_path('database/seeders/apartments.csv'), 'r');
        $first_line = true;
        $thumbnails = scandir(base_path('storage/app/seed_thumbnails/images'));
        $thumbnails = array_slice($thumbnails, 2);

        Storage::makeDirectory('images');

        $services = Service::pluck('id');

        while (($data = fgetcsv($csv_file)) !== false) {

            if (!$first_line) {
                $apartment = new Apartment();

                $apartment->user_id = $data[1];
                $apartment->name = $data[2];
                $apartment->slug = $data[3];
                $apartment->description = $data[4];
                $apartment->address = $data[6];
                $apartment->lat = $data[7];
                $apartment->lon = $data[8];
                $apartment->rooms = $data[9];
                $apartment->bedrooms = $data[10];
                $apartment->bathrooms = $data[11];
                $apartment->square_meters = $data[12];
                $apartment->visible = true;

                // $content = file_get_contents(base_path('storage/app/seed_thumbnails/images/') . array_pop($thumbnails));

                $thumb = array_pop($thumbnails);
                File::copy(base_path('storage/app/seed_thumbnails/images/' . $thumb), public_path("storage/images/$thumb"));
                $apartment->thumbnail = 'images/' . $thumb;

                $apartment->save();

                foreach ($services as $serviceId) {
                    if (rand(0, 1))
                        $apartment->services()->attach($serviceId);
                }
            }

            $first_line = false;
        }
    }
}
