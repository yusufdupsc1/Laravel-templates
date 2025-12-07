@extends('layouts.app')

@section('title', 'School Management Dashboard')

@section('content')
    <div class="space-y-10">
        <section id="overview" class="relative overflow-hidden rounded-3xl border border-white/5 bg-gradient-to-br from-sky-900/60 via-slate-900 to-slate-950 p-6 sm:p-8 shadow-2xl shadow-sky-900/30">
            <div class="absolute -right-10 -top-24 h-64 w-64 rounded-full bg-sky-500/20 blur-3xl"></div>
            <div class="absolute left-12 bottom-0 h-48 w-48 rounded-full bg-emerald-500/10 blur-3xl"></div>
            <div class="relative flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <span class="rounded-full bg-white/10 px-3 py-1 text-xs font-semibold text-sky-100">Realtime</span>
                        <span class="rounded-full bg-white/5 px-3 py-1 text-xs text-slate-200">Synced • 2m ago</span>
                    </div>
                    <div>
                        <p class="text-sm uppercase tracking-[0.25em] text-slate-400">NovaSchool Command</p>
                        <h1 class="text-3xl sm:text-4xl font-semibold text-white mt-2">School management control center</h1>
                        <p class="mt-3 max-w-3xl text-slate-300">Track enrolment, live attendance, fee health, and teaching coverage in one place. Crafted for modern schools with data-rich monitoring.</p>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <button class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-sky-500 to-emerald-500 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-sky-500/20">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v12m6-6H6" />
                            </svg>
                            New Intake
                        </button>
                        <button class="inline-flex items-center gap-2 rounded-xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm font-semibold text-slate-100 hover:bg-white/10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-6a2 2 0 012-2h7" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7l5 5-5 5" />
                            </svg>
                            Export report
                        </button>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 rounded-2xl border border-white/5 bg-white/5 p-4 text-sm text-slate-200">
                    <div>
                        <p class="text-xs text-slate-400">Today classes</p>
                        <p class="text-2xl font-semibold text-white">42</p>
                        <p class="text-xs text-emerald-400">+4 added</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400">Alerts resolved</p>
                        <p class="text-2xl font-semibold text-white">87%</p>
                        <p class="text-xs text-emerald-400">+8% vs last week</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400">Average GPA</p>
                        <p class="text-2xl font-semibold text-white">3.78</p>
                        <p class="text-xs text-emerald-400">Top quartile</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400">Guardian response</p>
                        <p class="text-2xl font-semibold text-white">91%</p>
                        <p class="text-xs text-sky-400">Last 24h</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="reports" class="grid gap-4 sm:gap-6 lg:grid-cols-4">
            @foreach ($dashboard['stats'] as $stat)
                <div class="rounded-2xl border border-white/5 bg-white/5 p-5 shadow-lg shadow-sky-900/10">
                    <div class="flex items-center justify-between">
                        <p class="text-xs uppercase tracking-[0.18em] text-slate-400">{{ $stat['badge'] }}</p>
                        <span class="h-2 w-2 rounded-full bg-emerald-400 shadow-[0_0_0_6px] shadow-emerald-400/10"></span>
                    </div>
                    <p class="mt-3 text-2xl font-semibold text-white">{{ $stat['value'] }}</p>
                    <p class="text-sm text-slate-300">{{ $stat['label'] }}</p>
                    <p class="mt-3 inline-flex rounded-full bg-emerald-500/10 px-3 py-1 text-xs font-semibold text-emerald-200">{{ $stat['change'] }}</p>
                </div>
            @endforeach
        </section>

        <section id="attendance" class="grid gap-6 lg:grid-cols-5">
            <div class="lg:col-span-3 rounded-2xl border border-white/5 bg-white/5 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-[0.18em] text-slate-400">Attendance</p>
                        <h3 class="text-xl font-semibold text-white mt-1">Live attendance trend</h3>
                    </div>
                    <span class="rounded-full bg-emerald-500/10 px-3 py-1 text-xs font-semibold text-emerald-200">Realtime</span>
                </div>
                <div class="mt-4 h-64">
                    <canvas id="attendanceChart"></canvas>
                </div>
                <div class="mt-4 grid grid-cols-3 gap-4 text-sm text-slate-200">
                    <div class="rounded-xl bg-white/5 p-3 border border-white/5">
                        <p class="text-xs text-slate-400">Present</p>
                        <p class="text-lg font-semibold text-white">95%</p>
                    </div>
                    <div class="rounded-xl bg-white/5 p-3 border border-white/5">
                        <p class="text-xs text-slate-400">Late</p>
                        <p class="text-lg font-semibold text-white">2.4%</p>
                    </div>
                    <div class="rounded-xl bg-white/5 p-3 border border-white/5">
                        <p class="text-xs text-slate-400">Excused</p>
                        <p class="text-lg font-semibold text-white">1.1%</p>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-2 space-y-6">
                <div id="fees" class="rounded-2xl border border-white/5 bg-white/5 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs uppercase tracking-[0.18em] text-slate-400">Finance</p>
                            <h3 class="text-xl font-semibold text-white mt-1">Fee health</h3>
                        </div>
                        <span class="rounded-full bg-sky-500/10 px-3 py-1 text-xs font-semibold text-sky-200">Auto-reconcile</span>
                    </div>
                    <div class="mt-4 h-40">
                        <canvas id="feesChart"></canvas>
                    </div>
                    <div class="mt-4 grid grid-cols-3 gap-3 text-xs text-slate-200">
                        <div class="rounded-lg bg-white/5 p-3 border border-white/5">
                            <p class="text-slate-400">Paid</p>
                            <p class="text-lg font-semibold text-white">{{ $dashboard['feesStatus']['values'][0] }}%</p>
                        </div>
                        <div class="rounded-lg bg-white/5 p-3 border border-white/5">
                            <p class="text-slate-400">Pending</p>
                            <p class="text-lg font-semibold text-white">{{ $dashboard['feesStatus']['values'][1] }}%</p>
                        </div>
                        <div class="rounded-lg bg-white/5 p-3 border border-white/5">
                            <p class="text-slate-400">Overdue</p>
                            <p class="text-lg font-semibold text-white">{{ $dashboard['feesStatus']['values'][2] }}%</p>
                        </div>
                    </div>
                </div>
                <div class="rounded-2xl border border-white/5 bg-white/5 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs uppercase tracking-[0.18em] text-slate-400">Performance</p>
                            <h3 class="text-xl font-semibold text-white mt-1">Grade distribution</h3>
                        </div>
                        <span class="rounded-full bg-amber-500/10 px-3 py-1 text-xs font-semibold text-amber-200">Benchmark</span>
                    </div>
                    <div class="mt-4 h-36">
                        <canvas id="gradeChart"></canvas>
                    </div>
                </div>
            </div>
        </section>

        <section id="events" class="grid gap-6 lg:grid-cols-3">
            <div class="lg:col-span-2 rounded-2xl border border-white/5 bg-white/5 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-[0.18em] text-slate-400">Campus</p>
                        <h3 class="text-xl font-semibold text-white mt-1">Upcoming events</h3>
                    </div>
                    <button class="rounded-xl border border-white/10 bg-white/5 px-3 py-1.5 text-xs font-semibold text-slate-100 hover:bg-white/10">Add event</button>
                </div>
                <div class="mt-4 space-y-3">
                    @foreach ($dashboard['events'] as $event)
                        <div class="rounded-xl border border-white/5 bg-slate-900/40 p-4">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-semibold text-white">{{ $event['title'] }}</p>
                                <span class="rounded-full bg-white/5 px-3 py-1 text-xs font-semibold text-slate-200">{{ $event['badge'] }}</span>
                            </div>
                            <p class="text-xs text-sky-200 mt-1">{{ $event['time'] }}</p>
                            <p class="text-sm text-slate-300 mt-2">{{ $event['description'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="space-y-6">
                <div class="rounded-2xl border border-white/5 bg-white/5 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs uppercase tracking-[0.18em] text-slate-400">Live activity</p>
                            <h3 class="text-xl font-semibold text-white mt-1">Control room</h3>
                        </div>
                        <span class="rounded-full bg-emerald-500/10 px-3 py-1 text-xs font-semibold text-emerald-200">Monitoring</span>
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
                <div id="messages" class="rounded-2xl border border-white/5 bg-white/5 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs uppercase tracking-[0.18em] text-slate-400">Comms</p>
                            <h3 class="text-xl font-semibold text-white mt-1">Alerts & messages</h3>
                        </div>
                        <button class="rounded-xl border border-white/10 bg-white/5 px-3 py-1.5 text-xs font-semibold text-slate-100 hover:bg-white/10">Archive</button>
                    </div>
                    <div class="mt-4 space-y-3">
                        @foreach ($dashboard['messages'] as $message)
                            <div class="rounded-xl border border-white/5 bg-slate-900/40 p-3">
                                <div class="flex items-center justify-between text-xs text-slate-300">
                                    <span class="font-semibold text-white">{{ $message['from'] }}</span>
                                    <span class="rounded-full bg-white/5 px-2 py-1 text-[11px] text-slate-200">High</span>
                                </div>
                                <p class="mt-2 text-sm font-semibold text-white">{{ $message['title'] }}</p>
                                <p class="text-xs text-slate-400 mt-1">{{ $message['body'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section id="classes" class="grid gap-6 xl:grid-cols-5">
            <div class="xl:col-span-3 rounded-2xl border border-white/5 bg-white/5 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-[0.18em] text-slate-400">Today</p>
                        <h3 class="text-xl font-semibold text-white mt-1">Class operations</h3>
                    </div>
                    <button class="rounded-xl border border-white/10 bg-white/5 px-3 py-1.5 text-xs font-semibold text-slate-100 hover:bg-white/10">Dispatch notice</button>
                </div>
                <div class="mt-4 overflow-hidden rounded-xl border border-white/5">
                    <table class="min-w-full divide-y divide-white/5 text-sm">
                        <thead class="bg-white/5 text-slate-300">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold">Class</th>
                                <th class="px-4 py-3 text-left font-semibold">Teacher</th>
                                <th class="px-4 py-3 text-left font-semibold">Time</th>
                                <th class="px-4 py-3 text-left font-semibold">Room</th>
                                <th class="px-4 py-3 text-left font-semibold">Fill</th>
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
                                    <td class="px-4 py-3 text-slate-200">{{ $class['fill'] }}</td>
                                    <td class="px-4 py-3">
                                        <span class="rounded-full bg-emerald-500/10 px-3 py-1 text-xs font-semibold text-emerald-200">{{ $class['status'] }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="students" class="xl:col-span-2 rounded-2xl border border-white/5 bg-white/5 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-[0.18em] text-slate-400">Leaders</p>
                        <h3 class="text-xl font-semibold text-white mt-1">Student spotlight</h3>
                    </div>
                    <span class="rounded-full bg-purple-500/10 px-3 py-1 text-xs font-semibold text-purple-200">Scholarship radar</span>
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
        </section>

        <script id="dashboard-data" type="application/json">
            {!! json_encode($dashboard['charts']) !!}
        </script>
    </div>
@endsection
