<!DOCTYPE html>
<html lang="en" class="antialiased h-full bg-[#f7f8fc]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SchoolOps is a production-ready Laravel starter for school operations dashboards across students, attendance, finance, and messaging.">
    <title>@yield('title', 'SchoolOps Dashboard')</title>
    <meta name="theme-color" content="#020617">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen text-slate-900">
    <div class="relative isolate min-h-screen flex">
        <div class="pointer-events-none absolute inset-0 overflow-hidden">
            <div class="absolute -left-10 top-[-10%] h-72 w-72 rounded-full bg-sky-200/30 blur-3xl"></div>
            <div class="absolute right-[-10%] bottom-[-10%] h-96 w-96 rounded-full bg-pink-200/30 blur-[120px]"></div>
        </div>
        <div id="toast-root" data-flash="{{ session('status') }}"></div>

        @php
            $nav = [
                ['name' => 'Dashboard', 'route' => 'dashboard', 'icon' => 'home'],
                ['name' => 'General Settings', 'route' => null, 'url' => '#', 'icon' => 'cog', 'plus' => true],
                ['name' => 'Classes', 'route' => 'classes.index', 'icon' => 'class'],
                ['name' => 'Subjects', 'route' => null, 'url' => '#', 'icon' => 'book', 'plus' => true],
                ['name' => 'Students', 'route' => 'students.index', 'icon' => 'users'],
                ['name' => 'Employees', 'route' => null, 'url' => '#', 'icon' => 'briefcase', 'plus' => true],
                ['name' => 'Accounts', 'route' => null, 'url' => '#', 'icon' => 'wallet', 'plus' => true],
                ['name' => 'Fees', 'route' => 'finance.index', 'icon' => 'fees'],
                ['name' => 'Salary', 'route' => null, 'url' => '#', 'icon' => 'salary'],
                ['name' => 'Attendance', 'route' => 'attendance', 'icon' => 'check'],
                ['name' => 'Timetable', 'route' => null, 'url' => '#', 'icon' => 'calendar', 'plus' => true],
                ['name' => 'Homework', 'route' => null, 'url' => '#', 'icon' => 'homework', 'plus' => true],
                ['name' => 'Behaviour & Skills', 'route' => null, 'url' => '#', 'icon' => 'skills', 'plus' => true],
                ['name' => 'Online Store & POS', 'route' => null, 'url' => '#', 'icon' => 'store', 'plus' => true],
                ['name' => 'WhatsApp', 'route' => null, 'url' => '#', 'icon' => 'whatsapp', 'locked' => true],
                ['name' => 'Messaging', 'route' => 'messages.index', 'icon' => 'inbox'],
                ['name' => 'SMS Services', 'route' => null, 'url' => '#', 'icon' => 'sms', 'plus' => true],
                ['name' => 'Live Class', 'route' => null, 'url' => '#', 'icon' => 'live', 'plus' => true],
                ['name' => 'Question Paper', 'route' => null, 'url' => '#', 'icon' => 'paper', 'plus' => true],
                ['name' => 'Exams', 'route' => null, 'url' => '#', 'icon' => 'exam', 'plus' => true],
                ['name' => 'Class Tests', 'route' => null, 'url' => '#', 'icon' => 'test', 'plus' => true],
                ['name' => 'Reports', 'route' => null, 'url' => '#', 'icon' => 'report', 'plus' => true],
                ['name' => 'Certificates', 'route' => null, 'url' => '#', 'icon' => 'certificate', 'plus' => true],
            ];
        @endphp

        <aside id="sidebar" class="fixed inset-y-0 left-0 z-20 w-72 bg-white/95 border-r border-slate-200 backdrop-blur-lg transform transition-transform duration-200 md:translate-x-0 -translate-x-full">
            <div class="flex items-center justify-between px-6 h-16 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-sky-500 to-indigo-500 text-white font-semibold shadow-lg shadow-sky-500/20">
                        SO
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-[0.2em] text-slate-400">SchoolOps</p>
                        <p class="text-sm font-semibold text-slate-900">Control</p>
                    </div>
                </div>
                <button data-toggle="sidebar" class="md:hidden text-slate-500 hover:text-slate-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <nav class="px-4 py-6 space-y-1 text-sm font-semibold text-slate-700">
                @foreach ($nav as $item)
                    @php
                        $active = $item['route'] ? request()->routeIs($item['route']) : false;
                        $url = $item['route'] ? route($item['route']) : ($item['url'] ?? '#');
                    @endphp
                    <a href="{{ $url }}" class="flex items-center justify-between rounded-xl px-3 py-2.5 transition {{ $active ? 'bg-sky-100 text-slate-900 shadow-inner shadow-sky-200' : 'text-slate-600 hover:bg-slate-100' }}">
                        <span class="flex items-center gap-3">
                            <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-slate-100 text-slate-600">
                                @switch($item['icon'])
                                    @case('home')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 11l9-7 9 7v8a2 2 0 01-2 2h-4a2 2 0 01-2-2V13H9v6a2 2 0 01-2 2H3z" /></svg>
                                        @break
                                    @case('cog')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.25 4.21c.46-1.04 2.04-1.04 2.5 0l.29.65a1.5 1.5 0 001.84.82l.7-.2c1.08-.32 2.1.7 1.77 1.78l-.2.69a1.5 1.5 0 00.82 1.84l.65.29c1.04.46 1.04 2.04 0 2.5l-.65.29a1.5 1.5 0 00-.82 1.84l.2.7c.33 1.08-.69 2.1-1.77 1.77l-.7-.2a1.5 1.5 0 00-1.84.82l-.29.65c-.46 1.04-2.04 1.04-2.5 0l-.29-.65a1.5 1.5 0 00-1.84-.82l-.7.2c-1.08.33-2.1-.69-1.77-1.77l.2-.7a1.5 1.5 0 00-.82-1.84l-.65-.29c-1.04-.46-1.04-2.04 0-2.5l.65-.29a1.5 1.5 0 00.82-1.84l-.2-.7c-.33-1.08.69-2.1 1.77-1.77l.7.2a1.5 1.5 0 001.84-.82l.29-.65z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                        @break
                                    @case('class')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 8h10M7 12h6m-9 4h14a2 2 0 002-2V6a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
                                        @break
                                    @case('book')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 19.5A2.5 2.5 0 016.5 22H20M4 19.5V4.5A2.5 2.5 0 016.5 2H20v18" /></svg>
                                        @break
                                    @case('users')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14c-4.418 0-8 1.79-8 4v1h16v-1c0-2.21-3.582-4-8-4z" /></svg>
                                        @break
                                    @case('briefcase')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 6a3 3 0 013-3h0a3 3 0 013 3h4a2 2 0 012 2v3a9 9 0 11-18 0V8a2 2 0 012-2h4z" /></svg>
                                        @break
                                    @case('wallet')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 7h13a3 3 0 013 3v1a3 3 0 01-3 3H4V7zm0 0V6a2 2 0 012-2h8" /></svg>
                                        @break
                                    @case('fees')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-2.21 0-4 1.343-4 3s1.79 3 4 3 4 1.343 4 3-1.79 3-4 3m0-12c2.21 0 4 1.343 4 3m-4-3V3m0 18v-2" /></svg>
                                        @break
                                    @case('salary')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7h18M3 12h18M3 17h18M6 7V5a2 2 0 012-2h8a2 2 0 012 2v2" /></svg>
                                        @break
                                    @case('check')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        @break
                                    @case('homework')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 4h12v12H4z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 8h4m-4 3h2m6-1h4v10H8v-2" /></svg>
                                        @break
                                    @case('skills')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v12m6-6H6" /></svg>
                                        @break
                                    @case('store')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16l-1 12H5L4 6z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 10h6M9 14h6" /></svg>
                                        @break
                                    @case('whatsapp')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 17l-2 4 4-2h8a4 4 0 004-4V9a4 4 0 00-4-4H7a4 4 0 00-4 4v6a4 4 0 004 4h0" /></svg>
                                        @break
                                    @case('inbox')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13.5V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7.5M3 13h4l2 3h6l2-3h4m-9 5h.01" /></svg>
                                        @break
                                    @case('sms')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16v8H5.17L4 15.17V6z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h8m-8 3h5" /></svg>
                                        @break
                                    @case('live')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14m0-4v4m0-4l-4-2v8l4-2" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8a1 1 0 011-1h5a1 1 0 011 1v8a1 1 0 01-1 1H4a1 1 0 01-1-1V8z" /></svg>
                                        @break
                                    @case('paper')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5h9m-9 4h9m-9 4h6M7 5h.01M7 9h.01M7 13h.01M5 3h11a2 2 0 012 2v14l-4-3-4 3-4-3-4 3V5a2 2 0 012-2z" /></svg>
                                        @break
                                    @case('exam')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6V4m0 2a2 2 0 110 4m0-4a2 2 0 100 4m-6 8h12a2 2 0 002-2v-3a2 2 0 00-2-2h-1l-1-2H8l-1 2H6a2 2 0 00-2 2v3a2 2 0 002 2z" /></svg>
                                        @break
                                    @case('test')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 9h8m-8 4h5M5 6h14v12H5V6z" /></svg>
                                        @break
                                    @case('report')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-6a2 2 0 012-2h7m-9 8v1a3 3 0 106 0v-1m-6 0h6M6 8V5a2 2 0 012-2h7.5L20 7.5V19a2 2 0 01-2 2h-2" /></svg>
                                        @break
                                    @case('certificate')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 4h10a2 2 0 012 2v9.5a2.5 2.5 0 11-5 0V6M7 4a2 2 0 00-2 2v12l3-2 3 2V6a2 2 0 00-2-2H7z" /></svg>
                                        @break
                                @endswitch
                            </span>
                            <span>{{ $item['name'] }}</span>
                            @if (!empty($item['locked']))
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-rose-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M12 15v2m-3-6V9a3 3 0 116 0v2m-9 1h12v7H6v-7z" /></svg>
                            @endif
                        </span>
                        <span class="text-xs text-slate-400">
                            @if (!empty($item['plus'])) +
                            @endif
                        </span>
                    </a>
                @endforeach
            </nav>
            <div class="px-4 pb-6">
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 text-center">
                    <p class="text-xs text-slate-500">Need More Advance?</p>
                    <p class="mt-1 text-sm font-semibold text-slate-900">Check our PRO version.</p>
                    <p class="text-xs text-slate-500 mt-1">An ultimate education management ERP with all advance features.</p>
                    <button class="mt-3 w-full rounded-full bg-rose-500 px-3 py-2 text-xs font-semibold text-white shadow hover:bg-rose-600">Try Demo</button>
                </div>
            </div>
        </aside>

        <div class="flex-1 md:pl-72">
            <header class="sticky top-0 z-10 border-b border-slate-200 bg-white/90 backdrop-blur">
                <div class="flex items-center justify-between px-4 sm:px-6 lg:px-10 h-16">
                    <div class="flex items-center gap-3">
                        <button data-toggle="sidebar" class="md:hidden text-slate-500 hover:text-slate-900">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                        <div class="hidden sm:flex items-center gap-2 text-xs text-slate-500">
                            <span class="h-2 w-2 rounded-full bg-emerald-400 shadow-[0_0_0_6px] shadow-emerald-400/20"></span>
                            Live systems healthy
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <button data-open="quick-find" class="hidden sm:inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50 shadow-sm">
                            <span class="text-xs text-slate-500">⌘K</span>
                            Quick find
                        </button>
                        <button class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-sky-500 to-indigo-500 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-sky-500/20">
                            New action
                        </button>
                    </div>
                </div>
            </header>

            <main class="relative px-4 sm:px-6 lg:px-10 py-10">
                @if (session('status'))
                    <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-900 shadow-sm">
                        <span class="font-semibold">Success:</span> {{ session('status') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-900 shadow-sm">
                        <p class="font-semibold">Please fix the following:</p>
                        <ul class="mt-2 space-y-1 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>

    <div id="quick-find" class="fixed inset-0 z-50 hidden bg-slate-950/40 backdrop-blur-sm">
        <div class="mx-auto mt-20 w-full max-w-xl rounded-2xl border border-slate-200 bg-white shadow-2xl shadow-sky-100">
            <div class="flex items-center gap-2 border-b border-slate-200 px-4 py-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.5 6a4.5 4.5 0 100 9 4.5 4.5 0 000-9zM21 21l-4.35-4.35"/></svg>
                <input id="quick-find-input" type="search" placeholder="Quick find..." class="w-full bg-transparent text-slate-900 placeholder:text-slate-400 focus:outline-none" autocomplete="off" />
                <button data-close="quick-find" class="text-slate-400 hover:text-slate-900" aria-label="Close quick find">✕</button>
            </div>
            <div class="max-h-72 overflow-y-auto px-2 py-3" id="quick-find-results">
                @foreach ($nav as $item)
                    <a href="{{ $item['route'] ? route($item['route']) : ($item['url'] ?? '#') }}" class="quick-find-item flex items-center gap-3 rounded-lg px-3 py-2 text-sm text-slate-800 hover:bg-slate-100" data-label="{{ strtolower($item['name']) }}">
                        <span class="text-slate-600">{{ $item['name'] }}</span>
                    </a>
                @endforeach
            </div>
            <div class="border-t border-slate-200 px-4 py-2 text-xs text-slate-500">Press Esc to close</div>
        </div>
    </div>
</body>
</html>
