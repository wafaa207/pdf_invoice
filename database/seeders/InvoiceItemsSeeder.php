<?php

namespace Database\Seeders;

use App\Models\InvoiceItems;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InvoiceItems::create([
            'invoice_id' => 1,
            'description' => 'desc1',
            'rate' => 11.00,
            'quantity' => 1,
            'amount' => 11.00,
        ]);

        InvoiceItems::create([
            'invoice_id' => 1,
            'description' => 'desc2',
            'rate' => 22.00,
            'quantity' => 2,
            'amount' => 44.00,
        ]);

        InvoiceItems::create([
            'invoice_id' => 1,
            'description' => 'desc3',
            'rate' => 33.00,
            'quantity' => 3,
            'amount' => 99.00,
        ]);
    }
}
