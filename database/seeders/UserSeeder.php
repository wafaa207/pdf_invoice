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
        User::create([
        'name' => 'wafaa',
        'email' => 'wafaamohammad207@gmail.com',
        'password' => Hash::make('password'),
        'street_address' => 'al-aqmar street',
        'city' => 'amman',
        'state' => 'Amman',
        'postal_code' => '11623',
        'country' => 'Jordan',
        'phone' => '0781191790'
        ]);
    }
}
