<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::create([
        'company_name' => 'Creative Company',
        'street_address' => 'zahran street',
        'city' => 'amman',
        'state' => 'Amman',
        'postal_code' => '11623',
        'country' => 'Jordan',
        'phone' => '0777777777'
        ]);
    }
}
