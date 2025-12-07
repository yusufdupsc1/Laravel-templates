@extends('layouts.app')

@section('title', 'SchoolOps Dashboard')

@section('content')
    <section class="space-y-10">
        <div class="rounded-3xl border border-white/5 bg-gradient-to-br from-white/5 via-slate-900 to-slate-950 px-6 py-8 shadow-2xl shadow-sky-900/30">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                <div class="space-y-3">
                    <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Live school operations</p>
                    <h1 class="text-3xl font-semibold text-white sm:text-4xl">Minimal, production-grade command deck</h1>
                    <p class="max-w-3xl text-sm text-slate-300 sm:text-base">Realtime readiness across students, attendance, finance, and teaching coverage. Built lean so you can ship fast and iterate safely.</p>
                    <div class="flex flex-wrap gap-3">
                        <button class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-sky-500 to-emerald-500 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-sky-500/20">Create intake</button>
                        <button class="inline-flex items-center gap-2 rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold text-slate-100 hover:bg-white/10">Download report</button>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 rounded-2xl border border-white/5 bg-white/5 p-4 text-sm text-slate-100">
                    @foreach ($dashboard['overview'] as $item)
                        <div>
                            <p class="text-xs text-slate-400">{{ $item['label'] }}</p>
                            <p class="text-2xl font-semibold text-white">{{ $item['value'] }}</p>
                            <p class="text-xs {{ $item['trend'][0] === '+' ? 'text-emerald-300' : 'text-amber-300' }}">{{ $item['trend'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="grid gap-4 sm:gap-6 lg:grid-cols-4">
            @foreach ($dashboard['stats'] as $stat)
                <div class="rounded-2xl border border-white/5 bg-white/5 p-5 shadow-lg shadow-sky-900/10">
                    <p class="text-xs uppercase tracking-[0.18em] text-slate-400">{{ $stat['label'] }}</p>
                    <p class="mt-2 text-2xl font-semibold text-white">{{ $stat['value'] }}</p>
                    <p class="text-sm text-slate-300">{{ $stat['caption'] }}</p>
                    <p class="mt-3 inline-flex rounded-full bg-emerald-500/10 px-3 py-1 text-xs font-semibold text-emerald-200">{{ $stat['trend'] }}</p>
                </div>
            @endforeach
        </div>

        <div class="grid gap-6 lg:grid-cols-5">
            <div class="lg:col-span-3 rounded-2xl border border-white/5 bg-white/5 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-[0.18em] text-slate-400">Attendance</p>
                        <h3 class="text-xl font-semibold text-white mt-1">Weekly presence</h3>
                    </div>
                    <span class="rounded-full bg-emerald-500/10 px-3 py-1 text-xs font-semibold text-emerald-200">Live</span>
                </div>
                <div class="mt-4 h-64">
                    <canvas id="attendanceChart"></canvas>
                </div>
            </div>
            <div class="space-y-6 lg:col-span-2">
                <div class="rounded-2xl border border-white/5 bg-white/5 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs uppercase tracking-[0.18em] text-slate-400">Fees</p>
                            <h3 class="text-xl font-semibold text-white mt-1">Collection health</h3>
                        </div>
                        <span class="rounded-full bg-white/5 px-3 py-1 text-xs font-semibold text-slate-200">This term</span>
                    </div>
                    <div class="mt-4 h-40">
                        <canvas id="feesChart"></canvas>
                    </div>
                    <div class="mt-3 grid grid-cols-3 gap-3 text-xs text-slate-200">
                        @foreach ($dashboard['fees']['values'] as $index => $value)
                            <div class="rounded-lg bg-white/5 p-3 border border-white/5">
                                <p class="text-slate-400">{{ $dashboard['fees']['labels'][$index] }}</p>
                                <p class="text-lg font-semibold text-white">{{ $value }}%</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="rounded-2xl border border-white/5 bg-white/5 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs uppercase tracking-[0.18em] text-slate-400">Performance</p>
                            <h3 class="text-xl font-semibold text-white mt-1">Grade mix</h3>
                        </div>
                        <span class="rounded-full bg-white/5 px-3 py-1 text-xs font-semibold text-slate-200">Benchmarked</span>
                    </div>
                    <div class="mt-4 h-36">
                        <canvas id="gradeChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-3">
            <div class="lg:col-span-2 rounded-2xl border border-white/5 bg-white/5 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-[0.18em] text-slate-400">Today</p>
                        <h3 class="text-xl font-semibold text-white mt-1">Class schedule</h3>
                    </div>
                    <button class="rounded-xl border border-white/10 bg-white/5 px-3 py-1.5 text-xs font-semibold text-slate-100 hover:bg-white/10">Export CSV</button>
                </div>
                <div class="mt-4 overflow-hidden rounded-xl border border-white/5">
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
                            @foreach ($dashboard['classes'] as $class)
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
            <div class="space-y-6">
                <div class="rounded-2xl border border-white/5 bg-white/5 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs uppercase tracking-[0.18em] text-slate-400">Signals</p>
                            <h3 class="text-xl font-semibold text-white mt-1">Recent activity</h3>
                        </div>
                        <span class="rounded-full bg-white/5 px-3 py-1 text-xs font-semibold text-slate-200">Last hour</span>
                    </div>
                    <div class="mt-4 space-y-4">
                        @foreach ($dashboard['activity'] as $item)
                            <div class="flex items-start gap-3">
                                <span class="mt-1 h-2.5 w-2.5 rounded-full bg-emerald-400 shadow-[0_0_0_6px] shadow-emerald-400/10"></span>
                                <div>
                                    <p class="text-sm font-semibold text-white">{{ $item['title'] }}</p>
                                    <p class="text-xs text-slate-400">{{ $item['meta'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="rounded-2xl border border-white/5 bg-white/5 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs uppercase tracking-[0.18em] text-slate-400">Students</p>
                            <h3 class="text-xl font-semibold text-white mt-1">High performers</h3>
                        </div>
                        <span class="rounded-full bg-purple-500/10 px-3 py-1 text-xs font-semibold text-purple-200">GPA watch</span>
                    </div>
                    <div class="mt-4 space-y-3">
                        @foreach ($dashboard['students'] as $student)
                            <div class="flex items-center justify-between rounded-xl border border-white/5 bg-slate-900/40 p-4">
                                <div>
                                    <p class="font-semibold text-white">{{ $student['name'] }}</p>
                                    <p class="text-xs text-slate-400">{{ $student['grade'] }}</p>
                                </div>
                                <div class="w-1/2">
                                    <div class="flex items-center justify-between text-xs text-slate-300">
                                        <span>GPA {{ $student['gpa'] }}</span>
                                        <span class="text-emerald-300">{{ $student['trend'] }}</span>
                                    </div>
                                    <div class="mt-2 h-2 w-full rounded-full bg-white/5">
                                        <div class="h-2 rounded-full bg-gradient-to-r from-sky-500 to-emerald-500" style="width: {{ $student['progress'] }}%"></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <script id="dashboard-data" type="application/json">
            {!! json_encode($dashboard['charts']) !!}
        </script>
    </section>
@endsection
