@extends('layouts.app')

@section('title', 'Classes | SchoolOps')

@section('content')
    <div class="space-y-8">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Classes</p>
                <h1 class="text-3xl font-semibold text-white">Daily schedule & coverage</h1>
                <p class="text-sm text-slate-300">Ensure every period has a teacher, room, and materials ready.</p>
            </div>
            <div class="flex gap-2">
                <button class="rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold text-slate-100 hover:bg-white/10">Publish bulletin</button>
                <button class="rounded-xl bg-gradient-to-r from-sky-500 to-emerald-500 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-sky-500/20">Add class</button>
            </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-2xl border border-white/5 bg-white/5 p-4">
                <p class="text-xs uppercase tracking-[0.18em] text-slate-400">Classes today</p>
                <p class="mt-2 text-2xl font-semibold text-white">42</p>
                <p class="text-xs text-emerald-300">0 unassigned</p>
            </div>
            <div class="rounded-2xl border border-white/5 bg-white/5 p-4">
                <p class="text-xs uppercase tracking-[0.18em] text-slate-400">Labs</p>
                <p class="mt-2 text-2xl font-semibold text-white">6</p>
                <p class="text-xs text-sky-300">All staffed</p>
            </div>
            <div class="rounded-2xl border border-white/5 bg-white/5 p-4">
                <p class="text-xs uppercase tracking-[0.18em] text-slate-400">Coverage</p>
                <p class="mt-2 text-2xl font-semibold text-white">99%</p>
                <p class="text-xs text-emerald-300">Live</p>
            </div>
            <div class="rounded-2xl border border-white/5 bg-white/5 p-4">
                <p class="text-xs uppercase tracking-[0.18em] text-slate-400">Sub requests</p>
                <p class="mt-2 text-2xl font-semibold text-white">3</p>
                <p class="text-xs text-amber-300">Pending approval</p>
            </div>
        </div>

        <div class="overflow-hidden rounded-2xl border border-white/5 bg-white/5">
            <div class="flex items-center justify-between px-4 py-3 border-b border-white/5">
                <p class="text-sm font-semibold text-white">Today</p>
                <div class="flex gap-2">
                    <button class="rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-xs font-semibold text-slate-100 hover:bg-white/10">Assign substitute</button>
                    <button class="rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-xs font-semibold text-slate-100 hover:bg-white/10">Print</button>
                </div>
            </div>
            <table class="min-w-full divide-y divide-white/5 text-sm">
                <thead class="bg-white/5 text-slate-300">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">Class</th>
                        <th class="px-4 py-3 text-left font-semibold">Teacher</th>
                        <th class="px-4 py-3 text-left font-semibold">Time</th>
                        <th class="px-4 py-3 text-left font-semibold">Room</th>
                        <th class="px-4 py-3 text-left font-semibold">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @foreach ($classes as $class)
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-4 py-3 font-semibold text-white">{{ $class['name'] }}</td>
                            <td class="px-4 py-3 text-slate-200">{{ $class['teacher'] }}</td>
                            <td class="px-4 py-3 text-slate-200">{{ $class['time'] }}</td>
                            <td class="px-4 py-3 text-slate-200">{{ $class['room'] }}</td>
                            <td class="px-4 py-3">
                                <span class="rounded-full bg-emerald-500/10 px-3 py-1 text-xs font-semibold text-emerald-200">{{ $class['status'] }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
