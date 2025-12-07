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
                <button class="rounded-xl bg-gradient-to-r from-sky-500 to-emerald-500 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-sky-500/20">New invoice</button>
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

        <div class="grid gap-6 lg:grid-cols-2">
            <div class="overflow-hidden rounded-2xl border border-white/5 bg-white/5">
                <div class="flex items-center justify-between px-4 py-3 border-b border-white/5">
                    <p class="text-sm font-semibold text-white">Invoices</p>
                    <button class="rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-xs font-semibold text-slate-100 hover:bg-white/10">Export</button>
                </div>
                <table class="min-w-full divide-y divide-white/5 text-sm">
                    <thead class="bg-white/5 text-slate-300">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold">Student</th>
                            <th class="px-4 py-3 text-left font-semibold">Amount</th>
                            <th class="px-4 py-3 text-left font-semibold">Status</th>
                            <th class="px-4 py-3 text-left font-semibold">Due</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach ($invoices as $invoice)
                            <tr class="hover:bg-white/5 transition">
                                <td class="px-4 py-3 font-semibold text-white">{{ $invoice['student'] }}</td>
                                <td class="px-4 py-3 text-slate-200">{{ $invoice['amount'] }}</td>
                                <td class="px-4 py-3">
                                    <span class="rounded-full bg-emerald-500/10 px-3 py-1 text-xs font-semibold text-emerald-200">{{ $invoice['status'] }}</span>
                                </td>
                                <td class="px-4 py-3 text-slate-200">{{ $invoice['due'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
