<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $first_name = 'Utente';
        $email = 'example@mail.it';
        $password = Hash::make('12345678');
        User::create([
            'email' => $email,
            'password' => $password,
            'first_name' => $first_name,
        ]);
    }
}
