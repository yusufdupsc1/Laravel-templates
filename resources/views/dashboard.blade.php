@extends('layouts.app')

@section('title', 'SchoolOps Dashboard')

@section('content')
    <section class="space-y-8">
        <div class="grid gap-4 lg:grid-cols-4">
            @foreach ($dashboard['financeCards'] as $card)
                <div class="rounded-2xl bg-gradient-to-br from-slate-50 to-slate-100 border border-slate-200 p-4 shadow-sm">
                    <p class="text-xs uppercase tracking-[0.18em] text-slate-500">{{ $card['label'] }}</p>
                    <p class="mt-2 text-2xl font-semibold text-slate-900">{{ $card['value'] }}</p>
                    <p class="text-xs text-slate-500">{{ $card['sub'] }}</p>
                </div>
            @endforeach
        </div>

        <div class="grid gap-6 lg:grid-cols-3">
            <div class="lg:col-span-2 space-y-4">
                <div class="rounded-3xl border border-slate-200 bg-gradient-to-r from-sky-50 via-white to-indigo-50 px-6 py-6 shadow-md">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="text-xs uppercase tracking-[0.18em] text-slate-500">Welcome to Admin Dashboard</p>
                            <h2 class="text-xl font-semibold text-slate-900">Your account is verified! Enjoy world-class school ops.</h2>
                        </div>
                        <div class="flex gap-2">
                            <button class="rounded-xl bg-white px-4 py-2 text-sm font-semibold text-slate-700 border border-slate-200 hover:bg-slate-50 shadow-sm">Try Demo</button>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-semibold text-slate-900">Statistics</p>
                        <span class="text-xs text-slate-500">Expenses vs Income</span>
                    </div>
                    <div class="mt-4 h-64">
                        <canvas id="attendanceChart"></canvas>
                    </div>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-semibold text-slate-900">Class statistics</p>
                        <span class="text-xs text-slate-500">Students by grade</span>
                    </div>
                    <div class="mt-4 h-64">
                        <canvas id="gradeChart"></canvas>
                    </div>
                </div>

                <div class="grid gap-4 md:grid-cols-3">
                    <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                        <p class="text-sm font-semibold text-slate-900">Today Absent Students</p>
                        <p class="mt-2 text-xs text-amber-500">Attendance not marked yet</p>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                        <p class="text-sm font-semibold text-slate-900">Today Present Employees</p>
                        <p class="mt-2 text-xs text-amber-500">Attendance not marked yet</p>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                        <p class="text-sm font-semibold text-slate-900">New Admissions</p>
                        <p class="mt-2 text-xs text-amber-500">No new admissions this month</p>
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm font-semibold text-slate-900">Estimated Fee This Month</p>
                    <p class="mt-3 text-3xl font-semibold text-rose-500">${{ number_format($dashboard['feesAmount']['paid'], 0) }}</p>
                    <p class="text-xs text-slate-500">Collections vs Remaining</p>
                    <div class="mt-3 flex flex-wrap items-center gap-3 text-xs">
                        <span class="rounded-full bg-emerald-50 px-3 py-1 font-semibold text-emerald-700">${{ number_format($dashboard['feesAmount']['paid'], 0) }} Collections</span>
                        <span class="rounded-full bg-rose-50 px-3 py-1 font-semibold text-rose-700">${{ number_format($dashboard['feesAmount']['pending'], 0) }} Remaining</span>
                    </div>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-gradient-to-br from-indigo-500 to-purple-500 p-5 text-white shadow-md">
                    <p class="text-sm font-semibold">Free SMS Gateway</p>
                    <p class="text-xs mt-1">Send unlimited free SMS on mobile numbers.</p>
                    <div class="mt-3 flex gap-2 text-xs">
                        <span class="rounded-full bg-white/20 px-3 py-1 font-semibold">Verified</span>
                        <span class="rounded-full bg-white/20 px-3 py-1 font-semibold">Unlimited</span>
                    </div>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm space-y-2 text-sm text-slate-700">
                    <div class="flex justify-between"><span>Today Present Students</span><span>{{ $dashboard['today']['studentsPresent'] }}%</span></div>
                    <div class="flex justify-between"><span>Today Present Employees</span><span>{{ $dashboard['today']['employeesPresent'] }}%</span></div>
                    <div class="flex justify-between"><span>This Month Fee Collection</span><span>{{ $dashboard['today']['feeCollection'] }}%</span></div>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-semibold text-slate-900">{{ $dashboard['calendar']['month'] }}</p>
                        <span class="text-xs text-slate-500">Calendar</span>
                    </div>
                    <div class="mt-4 grid grid-cols-7 text-center text-xs text-slate-500">
                        @foreach (['S','M','T','W','T','F','S'] as $day)
                            <div class="py-1 font-semibold">{{ $day }}</div>
                        @endforeach
                        @foreach ($dashboard['calendar']['weeks'] as $week)
                            @foreach ($week as $day)
                                <div class="py-1">
                                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-full {{ $day['is_today'] ? 'bg-gradient-to-r from-sky-500 to-indigo-500 text-white' : ($day['in_month'] ? 'text-slate-700' : 'text-slate-300') }}">
                                        {{ $day['day'] }}
                                    </span>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-5">
            <div class="lg:col-span-3 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-[0.18em] text-slate-500">Attendance</p>
                        <h3 class="text-xl font-semibold text-slate-900 mt-1">Weekly presence</h3>
                    </div>
                    <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">Live</span>
                </div>
                <div class="mt-4 h-64">
                    <canvas id="attendanceChart"></canvas>
                </div>
            </div>
            <div class="space-y-6 lg:col-span-2">
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs uppercase tracking-[0.18em] text-slate-500">Fees</p>
                            <h3 class="text-xl font-semibold text-slate-900 mt-1">Collection health</h3>
                        </div>
                        <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">This term</span>
                    </div>
                    <div class="mt-4 h-40">
                        <canvas id="feesChart"></canvas>
                    </div>
                    <div class="mt-3 grid grid-cols-3 gap-3 text-xs text-slate-700">
                        @foreach ($dashboard['fees']['values'] as $index => $value)
                            <div class="rounded-lg bg-slate-50 p-3 border border-slate-100">
                                <p class="text-slate-500">{{ $dashboard['fees']['labels'][$index] }}</p>
                                <p class="text-lg font-semibold text-slate-900">{{ $value }}%</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs uppercase tracking-[0.18em] text-slate-500">Performance</p>
                            <h3 class="text-xl font-semibold text-slate-900 mt-1">Grade mix</h3>
                        </div>
                        <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">Benchmarked</span>
                    </div>
                    <div class="mt-4 h-36">
                        <canvas id="gradeChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-3">
            <div class="lg:col-span-2 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-[0.18em] text-slate-500">Today</p>
                        <h3 class="text-xl font-semibold text-slate-900 mt-1">Class schedule</h3>
                    </div>
                    <button class="rounded-xl border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-slate-700 hover:bg-slate-50">Export CSV</button>
                </div>
                <div class="mt-4 overflow-hidden rounded-xl border border-slate-200">
                    <table class="min-w-full divide-y divide-slate-100 text-sm">
                        <thead class="bg-slate-50 text-slate-600">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold">Class</th>
                                <th class="px-4 py-3 text-left font-semibold">Teacher</th>
                                <th class="px-4 py-3 text-left font-semibold">Time</th>
                                <th class="px-4 py-3 text-left font-semibold">Room</th>
                                <th class="px-4 py-3 text-left font-semibold">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach ($dashboard['classes'] as $class)
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="px-4 py-3 font-semibold text-slate-900">{{ $class->name }}</td>
                                    <td class="px-4 py-3 text-slate-700">{{ $class->teacher }}</td>
                                    <td class="px-4 py-3 text-slate-700">{{ $class->time }}</td>
                                    <td class="px-4 py-3 text-slate-700">{{ $class->room }}</td>
                                    <td class="px-4 py-3">
                                        <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">{{ $class->status }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="space-y-6">
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs uppercase tracking-[0.18em] text-slate-500">Signals</p>
                            <h3 class="text-xl font-semibold text-slate-900 mt-1">Recent activity</h3>
                        </div>
                        <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">Last hour</span>
                    </div>
                    <div class="mt-4 space-y-4">
                        @foreach ($dashboard['activity'] as $item)
                            <div class="flex items-start gap-3">
                                <span class="mt-1 h-2.5 w-2.5 rounded-full bg-emerald-400 shadow-[0_0_0_6px] shadow-emerald-400/10"></span>
                                <div>
                                    <p class="text-sm font-semibold text-slate-900">{{ $item['title'] }}</p>
                                    <p class="text-xs text-slate-500">{{ $item['meta'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs uppercase tracking-[0.18em] text-slate-500">Students</p>
                            <h3 class="text-xl font-semibold text-slate-900 mt-1">High performers</h3>
                        </div>
                        <span class="rounded-full bg-purple-50 px-3 py-1 text-xs font-semibold text-purple-700">GPA watch</span>
                    </div>
                    <div class="mt-4 space-y-3">
                        @foreach ($dashboard['students'] as $student)
                            <div class="flex items-center justify-between rounded-xl border border-slate-200 bg-slate-50 p-4">
                                <div>
                                    <p class="font-semibold text-slate-900">{{ $student['name'] }}</p>
                                    <p class="text-xs text-slate-500">{{ $student['grade'] }}</p>
                                </div>
                                <div class="w-1/2">
                                    <div class="flex items-center justify-between text-xs text-slate-600">
                                        <span>GPA {{ $student['gpa'] }}</span>
                                        <span class="text-emerald-600">{{ $student['trend'] }}</span>
                                    </div>
                                    <div class="mt-2 h-2 w-full rounded-full bg-slate-200">
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
