@extends('layouts.app')

@section('title', 'Finance | SchoolOps')

@section('content')
    <div class="space-y-8">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Finance</p>
                <h1 class="text-3xl font-semibold text-white">Collections & budgets</h1>
                <p class="text-sm text-slate-300">Fees, overdue handling, and allocations in one view.</p>
            </div>
            <div class="flex gap-2">
                <button class="rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold text-slate-100 hover:bg-white/10">Reconcile</button>
                <a href="#add-invoice" class="rounded-xl bg-gradient-to-r from-sky-500 to-emerald-500 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-sky-500/20">New invoice</a>
            </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-3">
            @foreach ($collections as $item)
                <div class="rounded-2xl border border-white/5 bg-white/5 p-4">
                    <p class="text-xs uppercase tracking-[0.18em] text-slate-400">{{ $item['label'] }}</p>
                    <p class="mt-2 text-2xl font-semibold text-white">{{ $item['value'] }}</p>
                    <p class="text-xs text-slate-300">{{ $item['detail'] }}</p>
                    <div class="mt-3 h-2 rounded-full bg-white/5">
                        <div class="h-2 rounded-full bg-gradient-to-r {{ $item['color'] }}" style="width: {{ $item['value'] }}"></div>
                    </div>
                </div>
            @endforeach
        </div>

        <div id="add-invoice" class="rounded-2xl border border-white/5 bg-white/5 p-6 space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs uppercase tracking-[0.18em] text-slate-400">Add invoice</p>
                    <h3 class="text-xl font-semibold text-white mt-1">Create fee record</h3>
                </div>
            </div>
            <form method="POST" action="{{ route('finance.store') }}" class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                @csrf
                <label class="space-y-1 text-sm text-slate-200">
                    <span>Student</span>
                    <input name="student" required class="w-full rounded-lg border border-white/10 bg-slate-950/60 px-3 py-2 text-white placeholder:text-slate-500 focus:ring-2 focus:ring-sky-500/60 focus:outline-none" />
                    @error('student') <span class="text-xs text-rose-300">{{ $message }}</span> @enderror
                </label>
                <label class="space-y-1 text-sm text-slate-200">
                    <span>Amount ($)</span>
                    <input type="number" name="amount" min="0" step="0.01" required class="w-full rounded-lg border border-white/10 bg-slate-950/60 px-3 py-2 text-white placeholder:text-slate-500 focus:ring-2 focus:ring-sky-500/60 focus:outline-none" />
                    @error('amount') <span class="text-xs text-rose-300">{{ $message }}</span> @enderror
                </label>
                <label class="space-y-1 text-sm text-slate-200">
                    <span>Status</span>
                    <select name="status" class="w-full rounded-lg border border-white/10 bg-slate-950/60 px-3 py-2 text-white focus:ring-2 focus:ring-sky-500/60 focus:outline-none">
                        <option>Pending</option>
                        <option>Paid</option>
                        <option>Overdue</option>
                    </select>
                </label>
                <label class="space-y-1 text-sm text-slate-200">
                    <span>Due date</span>
                    <input type="date" name="due" required class="w-full rounded-lg border border-white/10 bg-slate-950/60 px-3 py-2 text-white focus:ring-2 focus:ring-sky-500/60 focus:outline-none" />
                    @error('due') <span class="text-xs text-rose-300">{{ $message }}</span> @enderror
                </label>
                <div class="sm:col-span-2 lg:col-span-4 flex justify-end pt-2">
                    <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-sky-500 to-emerald-500 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-sky-500/20">
                        Save invoice
                    </button>
                </div>
            </form>
        </div>

        <div class="grid gap-6 lg:grid-cols-2">
            <div class="overflow-hidden rounded-2xl border border-white/5 bg-white/5">
                <div class="flex items-center justify-between px-4 py-3 border-b border-white/5">
                    <div>
                        <p class="text-sm font-semibold text-white">Invoices</p>
                        <p class="text-xs text-slate-400">{{ $totals['count'] }} records • ${{ number_format($totals['amount'], 2) }}</p>
                    </div>
                    <button class="rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-xs font-semibold text-slate-100 hover:bg-white/10">Export</button>
                </div>
                <table class="min-w-full divide-y divide-white/5 text-sm">
                    <thead class="bg-white/5 text-slate-300">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold">Student</th>
                            <th class="px-4 py-3 text-left font-semibold">Amount</th>
                            <th class="px-4 py-3 text-left font-semibold">Status</th>
                            <th class="px-4 py-3 text-left font-semibold">Due</th>
                            <th class="px-4 py-3 text-left font-semibold">Age</th>
                            <th class="px-4 py-3 text-left font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach ($invoices as $invoice)
                            <tr class="hover:bg-white/5 transition">
                                <td class="px-4 py-3 font-semibold text-white">{{ $invoice->student }}</td>
                                <td class="px-4 py-3 text-slate-200">${{ number_format($invoice->amount, 2) }}</td>
                                <td class="px-4 py-3">
                                    @php
                                        $statusColor = match ($invoice->status) {
                                            'Paid' => 'bg-emerald-500/10 text-emerald-200',
                                            'Overdue' => 'bg-amber-500/10 text-amber-200',
                                            default => 'bg-sky-500/10 text-sky-200',
                                        };
                                    @endphp
                                    <span class="rounded-full {{ $statusColor }} px-3 py-1 text-xs font-semibold">{{ $invoice->status }}</span>
                                </td>
                                <td class="px-4 py-3 text-slate-200">{{ \Illuminate\Support\Carbon::parse($invoice->due)->format('M d') }}</td>
                                <td class="px-4 py-3 text-slate-200">
                                    @php $days = now()->diffInDays(\Illuminate\Support\Carbon::parse($invoice->due), false); @endphp
                                    {{ $days >= 0 ? $days . ' days left' : abs($days) . ' days overdue' }}
                                </td>
                                <td class="px-4 py-3 space-x-2 text-slate-200">
                                    <details class="inline-block">
                                        <summary class="cursor-pointer text-sky-300 underline">Edit</summary>
                                        <form method="POST" action="{{ route('finance.update', $invoice) }}" class="mt-2 space-y-2">
                                            @csrf
                                            @method('PUT')
                                            <input name="student" value="{{ $invoice->student }}" class="w-full rounded-lg border border-white/10 bg-slate-950/60 px-3 py-2 text-white text-xs" />
                                            <input name="amount" type="number" step="0.01" value="{{ $invoice->amount }}" class="w-full rounded-lg border border-white/10 bg-slate-950/60 px-3 py-2 text-white text-xs" />
                                            <select name="status" class="w-full rounded-lg border border-white/10 bg-slate-950/60 px-3 py-2 text-white text-xs">
                                                <option {{ $invoice->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                                <option {{ $invoice->status === 'Paid' ? 'selected' : '' }}>Paid</option>
                                                <option {{ $invoice->status === 'Overdue' ? 'selected' : '' }}>Overdue</option>
                                            </select>
                                            <input type="date" name="due" value="{{ \Illuminate\Support\Carbon::parse($invoice->due)->format('Y-m-d') }}" class="w-full rounded-lg border border-white/10 bg-slate-950/60 px-3 py-2 text-white text-xs" />
                                            <button class="w-full rounded-lg bg-gradient-to-r from-sky-500 to-emerald-500 px-3 py-2 text-xs font-semibold text-white">Save</button>
                                        </form>
                                    </details>
                                    <form method="POST" action="{{ route('finance.destroy', $invoice) }}" class="inline" onsubmit="return confirm('Delete this invoice?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="rounded-lg border border-white/10 bg-white/5 px-3 py-1 text-xs font-semibold text-rose-200 hover:bg-white/10">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="px-4 py-3">
                    {{ $invoices->links() }}
                </div>
            </div>
            <div class="rounded-2xl border border-white/5 bg-white/5 p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-[0.18em] text-slate-400">Budgets</p>
                        <h3 class="text-xl font-semibold text-white mt-1">Allocation status</h3>
                    </div>
                    <button class="rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-xs font-semibold text-slate-100 hover:bg-white/10">Adjust</button>
                </div>
                <div class="space-y-3">
                    @foreach ($budgets as $budget)
                        <div class="rounded-xl border border-white/5 bg-slate-900/40 p-4">
                            <div class="flex items-center justify-between text-sm text-white">
                                <span class="font-semibold">{{ $budget['name'] }}</span>
                                <span class="text-slate-300">{{ $budget['amount'] }}</span>
                            </div>
                            <div class="mt-3 h-2 rounded-full bg-white/5">
                                <div class="h-2 rounded-full bg-gradient-to-r from-sky-500 to-emerald-500" style="width: {{ $budget['progress'] }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
