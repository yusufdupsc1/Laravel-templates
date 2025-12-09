<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class FinanceController extends Controller
{
    public function index(): View
    {
        $invoices = Invoice::orderBy('due')->paginate(10);
        $collections = $this->collections($invoices->getCollection());
        $totals = [
            'count' => $invoices->total(),
            'amount' => $invoices->sum('amount'),
        ];

        return view('finance', [
            'collections' => $collections,
            'invoices' => $invoices,
            'budgets' => [
                ['name' => 'Labs & equipment', 'progress' => 68, 'amount' => '$24,000 / $35,000'],
                ['name' => 'Scholarships', 'progress' => 54, 'amount' => '$18,900 / $35,000'],
                ['name' => 'Facilities', 'progress' => 72, 'amount' => '$41,400 / $57,500'],
            ],
            'totals' => $totals,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'student' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'string', 'max:50'],
            'due' => ['required', 'date'],
        ]);

        Invoice::create($validated);
        Cache::forget('dashboard-data');

        return redirect()->route('finance.index')->with('status', 'Invoice added');
    }

    public function update(Request $request, Invoice $finance): RedirectResponse
    {
        $validated = $request->validate([
            'student' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'string', 'max:50'],
            'due' => ['required', 'date'],
        ]);

        $finance->update($validated);
        Cache::forget('dashboard-data');

        return redirect()->route('finance.index')->with('status', 'Invoice updated');
    }

    public function destroy(Invoice $finance): RedirectResponse
    {
        $finance->delete();
        Cache::forget('dashboard-data');

        return redirect()->route('finance.index')->with('status', 'Invoice removed');
    }

    private function collections(Collection $invoices): array
    {
        $total = $invoices->sum('amount') ?: 1;
        $paid = $invoices->where('status', 'Paid')->sum('amount');
        $pending = $invoices->where('status', 'Pending')->sum('amount');
        $overdue = $invoices->where('status', 'Overdue')->sum('amount');

        $percent = fn ($value) => round(($value / $total) * 100);

        return [
            ['label' => 'Paid', 'value' => $percent($paid) . '%', 'detail' => 'Settled this term', 'color' => 'from-emerald-500 to-emerald-400'],
            ['label' => 'Pending', 'value' => $percent($pending) . '%', 'detail' => 'Awaiting confirmation', 'color' => 'from-sky-500 to-cyan-400'],
            ['label' => 'Overdue', 'value' => $percent($overdue) . '%', 'detail' => 'Reminder queue', 'color' => 'from-amber-500 to-orange-400'],
        ];
    }
}
