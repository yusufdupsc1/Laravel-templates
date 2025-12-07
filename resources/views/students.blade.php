@extends('layouts.app')

@section('title', 'Students | SchoolOps')

@section('content')
    <div class="space-y-8">
        <div class="flex flex-col gap-3">
            <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Students</p>
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-3xl font-semibold text-white">Roster & guardians</h1>
                    <p class="text-sm text-slate-300">Track high performers, new intakes, and guardian contacts.</p>
                </div>
                <div class="flex gap-2">
                    <button class="rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold text-slate-100 hover:bg-white/10">Import CSV</button>
                    <button class="rounded-xl bg-gradient-to-r from-sky-500 to-emerald-500 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-sky-500/20">Add student</button>
                </div>
            </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-2xl border border-white/5 bg-white/5 p-4">
                <p class="text-xs uppercase tracking-[0.18em] text-slate-400">Active</p>
                <p class="mt-2 text-2xl font-semibold text-white">1,240</p>
                <p class="text-xs text-emerald-300">+3.2% vs last term</p>
            </div>
            <div class="rounded-2xl border border-white/5 bg-white/5 p-4">
                <p class="text-xs uppercase tracking-[0.18em] text-slate-400">New intakes</p>
                <p class="mt-2 text-2xl font-semibold text-white">54</p>
                <p class="text-xs text-sky-300">Current month</p>
            </div>
            <div class="rounded-2xl border border-white/5 bg-white/5 p-4">
                <p class="text-xs uppercase tracking-[0.18em] text-slate-400">Watchlist</p>
                <p class="mt-2 text-2xl font-semibold text-white">12</p>
                <p class="text-xs text-amber-300">Attendance / GPA</p>
            </div>
            <div class="rounded-2xl border border-white/5 bg-white/5 p-4">
                <p class="text-xs uppercase tracking-[0.18em] text-slate-400">Scholarships</p>
                <p class="mt-2 text-2xl font-semibold text-white">38</p>
                <p class="text-xs text-emerald-300">Up to date</p>
            </div>
        </div>

        <div class="overflow-hidden rounded-2xl border border-white/5 bg-white/5">
            <div class="flex items-center justify-between px-4 py-3 border-b border-white/5">
                <p class="text-sm font-semibold text-white">Students</p>
                <input type="search" placeholder="Search students..." class="w-60 rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-sm text-white placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500/60" />
            </div>
            <table class="min-w-full divide-y divide-white/5 text-sm">
                <thead class="bg-white/5 text-slate-300">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">Name</th>
                        <th class="px-4 py-3 text-left font-semibold">Grade</th>
                        <th class="px-4 py-3 text-left font-semibold">GPA</th>
                        <th class="px-4 py-3 text-left font-semibold">Status</th>
                        <th class="px-4 py-3 text-left font-semibold">Guardian</th>
                        <th class="px-4 py-3 text-left font-semibold">Contact</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @foreach ($students as $student)
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-4 py-3 font-semibold text-white">{{ $student['name'] }}</td>
                            <td class="px-4 py-3 text-slate-200">{{ $student['grade'] }}</td>
                            <td class="px-4 py-3 text-slate-200">{{ $student['gpa'] }}</td>
                            <td class="px-4 py-3">
                                <span class="rounded-full bg-emerald-500/10 px-3 py-1 text-xs font-semibold text-emerald-200">{{ $student['status'] }}</span>
                            </td>
                            <td class="px-4 py-3 text-slate-200">{{ $student['guardian'] }}</td>
                            <td class="px-4 py-3 text-slate-200">{{ $student['contact'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
