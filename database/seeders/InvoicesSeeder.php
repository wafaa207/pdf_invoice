<?php

namespace Database\Seeders;

use App\Models\Invoice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Invoice::create([
            'number' => 'INV_' . str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT),
            'company_id' => 1,
            'user_id' => 1,
            'date_issued' => '2024-03-21',
            'due_date' => '2024-03-29',
            'discount' => 5.00,
            'tax' => 10.00,
            'subtotal' => 154.00,
            'total' => 159.00,
            'deposit_requested' => 15.90,
            'deposit_due' => 15.90,
        ]);
    }
}
