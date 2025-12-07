<?php

namespace App\Http\Controllers;

class FinanceController extends Controller
{
    public function __invoke()
    {
        $collections = [
            ['label' => 'Paid', 'value' => '72%', 'detail' => 'Settled this term', 'color' => 'from-emerald-500 to-emerald-400'],
            ['label' => 'Pending', 'value' => '18%', 'detail' => 'Awaiting confirmation', 'color' => 'from-sky-500 to-cyan-400'],
            ['label' => 'Overdue', 'value' => '10%', 'detail' => 'Reminder queue', 'color' => 'from-amber-500 to-orange-400'],
        ];

        $invoices = [
            ['student' => 'Leah Porter', 'amount' => '$1,200', 'status' => 'Paid', 'due' => 'Sep 15'],
            ['student' => 'Hamza Ali', 'amount' => '$980', 'status' => 'Pending', 'due' => 'Sep 20'],
            ['student' => 'Maya Chen', 'amount' => '$1,050', 'status' => 'Overdue', 'due' => 'Sep 05'],
            ['student' => 'Ethan Carter', 'amount' => '$890', 'status' => 'Paid', 'due' => 'Sep 10'],
        ];

        $budgets = [
            ['name' => 'Labs & equipment', 'progress' => 68, 'amount' => '$24,000 / $35,000'],
            ['name' => 'Scholarships', 'progress' => 54, 'amount' => '$18,900 / $35,000'],
            ['name' => 'Facilities', 'progress' => 72, 'amount' => '$41,400 / $57,500'],
        ];

        return view('finance', compact('collections', 'invoices', 'budgets'));
    }
}
