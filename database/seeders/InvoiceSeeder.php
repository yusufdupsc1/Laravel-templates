<?php

namespace Database\Seeders;

use App\Models\Invoice;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    public function run(): void
    {
        $invoices = [
            ['student' => 'Leah Porter', 'amount' => 1200, 'status' => 'Paid', 'due' => now()->startOfMonth()->addDays(14)],
            ['student' => 'Hamza Ali', 'amount' => 980, 'status' => 'Pending', 'due' => now()->startOfMonth()->addDays(19)],
            ['student' => 'Maya Chen', 'amount' => 1050, 'status' => 'Overdue', 'due' => now()->startOfMonth()->addDays(4)],
            ['student' => 'Ethan Carter', 'amount' => 890, 'status' => 'Paid', 'due' => now()->startOfMonth()->addDays(9)],
        ];

        foreach ($invoices as $invoice) {
            Invoice::updateOrCreate(
                ['student' => $invoice['student'], 'due' => $invoice['due']],
                $invoice
            );
        }
    }
}
