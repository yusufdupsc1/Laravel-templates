@extends('layouts.app')

@section('title', 'Attendance | SchoolOps')

@section('content')
    <div class="space-y-8">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Attendance</p>
                <h1 class="text-3xl font-semibold text-white">Daily presence & follow-ups</h1>
                <p class="text-sm text-slate-300">Monitor compliance, late arrivals, and unmarked sessions.</p>
            </div>
            <div class="flex gap-2">
                <button class="rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold text-slate-100 hover:bg-white/10">Lock classes</button>
                <button class="rounded-xl bg-gradient-to-r from-sky-500 to-emerald-500 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-sky-500/20">Send reminders</button>
            </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($summary as $item)
                <div class="rounded-2xl border border-white/5 bg-white/5 p-4">
                    <p class="text-xs uppercase tracking-[0.18em] text-slate-400">{{ $item['label'] }}</p>
                    <p class="mt-2 text-2xl font-semibold text-white">{{ $item['value'] }}</p>
                    <p class="text-xs text-slate-300">{{ $item['detail'] }}</p>
                </div>
            @endforeach
        </div>

        <div class="overflow-hidden rounded-2xl border border-white/5 bg-white/5">
            <div class="flex items-center justify-between px-4 py-3 border-b border-white/5">
                <p class="text-sm font-semibold text-white">By grade</p>
                <button class="rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-xs font-semibold text-slate-100 hover:bg-white/10">Export CSV</button>
            </div>
            <table class="min-w-full divide-y divide-white/5 text-sm">
                <thead class="bg-white/5 text-slate-300">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">Grade</th>
                        <th class="px-4 py-3 text-left font-semibold">Present</th>
                        <th class="px-4 py-3 text-left font-semibold">Late</th>
                        <th class="px-4 py-3 text-left font-semibold">Unmarked</th>
                        <th class="px-4 py-3 text-left font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @foreach ($grades as $grade)
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-4 py-3 font-semibold text-white">{{ $grade->grade }}</td>
                            <td class="px-4 py-3 text-slate-200">{{ $grade->present }}%</td>
                            <td class="px-4 py-3 text-slate-200">{{ $grade->late }}%</td>
                            <td class="px-4 py-3 text-slate-200">{{ $grade->unmarked }}</td>
                            <td class="px-4 py-3">
                                <details>
                                    <summary class="cursor-pointer text-sky-300 underline">{{ $grade->locked ? 'Locked' : 'Edit' }}</summary>
                                    @if ($grade->locked)
                                        <p class="text-xs text-slate-400 mt-1">Locked</p>
                                    @else
                                        <form method="POST" action="{{ route('attendance.update') }}" class="mt-2 space-y-2 text-xs text-slate-200">
                                            @csrf
                                            <input type="hidden" name="grades[{{ $loop->index }}][id]" value="{{ $grade->id }}">
                                            <label class="flex items-center gap-2">
                                                <span class="w-20">Present</span>
                                                <input type="number" name="grades[{{ $loop->index }}][present]" value="{{ $grade->present }}" min="0" max="100" class="flex-1 rounded-lg border border-white/10 bg-slate-950/60 px-2 py-1 text-white" />
                                            </label>
                                            <label class="flex items-center gap-2">
                                                <span class="w-20">Late</span>
                                                <input type="number" name="grades[{{ $loop->index }}][late]" value="{{ $grade->late }}" min="0" max="100" class="flex-1 rounded-lg border border-white/10 bg-slate-950/60 px-2 py-1 text-white" />
                                            </label>
                                            <label class="flex items-center gap-2">
                                                <span class="w-20">Unmarked</span>
                                                <input type="number" name="grades[{{ $loop->index }}][unmarked]" value="{{ $grade->unmarked }}" min="0" class="flex-1 rounded-lg border border-white/10 bg-slate-950/60 px-2 py-1 text-white" />
                                            </label>
                                            <label class="inline-flex items-center gap-2">
                                                <input type="checkbox" name="grades[{{ $loop->index }}][locked]" class="h-4 w-4" />
                                                <span>Lock after save</span>
                                            </label>
                                            <button class="w-full rounded-lg bg-gradient-to-r from-sky-500 to-emerald-500 px-3 py-2 text-xs font-semibold text-white">Save</button>
                                        </form>
                                    @endif
                                </details>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
