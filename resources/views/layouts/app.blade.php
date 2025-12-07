<!DOCTYPE html>
<html lang="en" class="antialiased">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'NovaSchool Dashboard')</title>
    <meta name="theme-color" content="#0f172a">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-950 text-slate-100">
    <div class="relative min-h-screen flex bg-slate-950">
        <div class="absolute inset-0 opacity-60 pointer-events-none">
            <div class="absolute -left-24 top-10 h-72 w-72 rounded-full bg-sky-600/20 blur-3xl"></div>
            <div class="absolute right-0 bottom-0 h-80 w-80 rounded-full bg-emerald-500/10 blur-3xl"></div>
        </div>

        <aside id="sidebar" class="fixed z-30 inset-y-0 left-0 w-72 bg-slate-900/90 backdrop-blur-xl border-r border-white/5 transform md:translate-x-0 -translate-x-full transition-transform duration-200">
            <div class="flex items-center justify-between px-6 h-16 border-b border-white/5">
                <div>
                    <p class="text-xs uppercase tracking-[0.2em] text-slate-400">NovaSchool</p>
                    <p class="text-lg font-semibold text-white">Control Center</p>
                </div>
                <button data-toggle="sidebar" class="md:hidden text-slate-300 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="px-4 py-6 space-y-6">
                <div class="bg-gradient-to-r from-sky-500/10 to-emerald-500/10 border border-white/5 rounded-2xl p-4">
                    <p class="text-sm text-slate-300">Live system</p>
                    <p class="text-lg font-semibold text-white">School Management</p>
                    <p class="text-xs text-slate-400 mt-2">Realtime metrics, attendance, finance</p>
                </div>

                <nav class="space-y-1 text-sm font-medium">
                    @php
                        $links = [
                            ['label' => 'Overview', 'target' => '#overview', 'icon' => 'grid'],
                            ['label' => 'Students', 'target' => '#students', 'icon' => 'users'],
                            ['label' => 'Classes', 'target' => '#classes', 'icon' => 'calendar'],
                            ['label' => 'Attendance', 'target' => '#attendance', 'icon' => 'check'],
                            ['label' => 'Fees', 'target' => '#fees', 'icon' => 'wallet'],
                            ['label' => 'Events', 'target' => '#events', 'icon' => 'sparkles'],
                            ['label' => 'Messages', 'target' => '#messages', 'icon' => 'message'],
                            ['label' => 'Reports', 'target' => '#reports', 'icon' => 'chart'],
                        ];
                    @endphp
                    @foreach ($links as $link)
                        <a href="{{ $link['target'] }}" class="flex items-center gap-3 px-3 py-3 rounded-xl text-slate-200 hover:bg-white/5 transition">
                            <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/5 text-slate-200">
                                @switch($link['icon'])
                                    @case('grid')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6.5C4 5.12 5.12 4 6.5 4h2A2.5 2.5 0 0111 6.5v2A2.5 2.5 0 018.5 11h-2A2.5 2.5 0 014 8.5v-2zM13 6.5C13 5.12 14.12 4 15.5 4h2A2.5 2.5 0 0120 6.5v2A2.5 2.5 0 0117.5 11h-2A2.5 2.5 0 0113 8.5v-2zM4 15.5C4 14.12 5.12 13 6.5 13h2A2.5 2.5 0 0111 15.5v2A2.5 2.5 0 018.5 20h-2A2.5 2.5 0 014 17.5v-2zM13 15.5c0-1.38 1.12-2.5 2.5-2.5h2a2.5 2.5 0 012.5 2.5v2a2.5 2.5 0 01-2.5 2.5h-2a2.5 2.5 0 01-2.5-2.5v-2z" />
                                        </svg>
                                        @break
                                    @case('users')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14c-4.418 0-8 1.79-8 4v1h16v-1c0-2.21-3.582-4-8-4z" />
                                        </svg>
                                        @break
                                    @case('calendar')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 4v2m10-2v2m-9 4h8m-9 4h6M5 8h14a1 1 0 011 1v9a2 2 0 01-2 2H6a2 2 0 01-2-2V9a1 1 0 011-1z" />
                                        </svg>
                                        @break
                                    @case('check')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        @break
                                    @case('wallet')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 7h13a3 3 0 013 3v1a3 3 0 01-3 3H4V7zm0 0V6a2 2 0 012-2h8" />
                                        </svg>
                                        @break
                                    @case('sparkles')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v3m0 12v3m6-9h3M3 12h3m11.657-5.657L15.9 8.1M8.1 15.9l-2.757 2.757m0-10.514L8.1 8.1m7.8 7.8l2.757 2.757" />
                                        </svg>
                                        @break
                                    @case('message')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h8M8 14h5m6-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        @break
                                    @case('chart')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-4m6 4V7M3 17h18" />
                                        </svg>
                                        @break
                                @endswitch
                            </span>
                            <span>{{ $link['label'] }}</span>
                        </a>
                    @endforeach
                </nav>
            </div>
        </aside>

        <div class="flex-1 md:pl-72">
            <header class="sticky top-0 z-20 backdrop-blur-lg bg-slate-950/80 border-b border-white/5">
                <div class="px-4 sm:px-6 lg:px-8 h-16 flex items-center gap-4">
                    <button data-toggle="sidebar" class="md:hidden text-slate-300 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <div class="relative flex-1">
                        <input data-input="command-k" type="search" placeholder="Search students, classes, fees..." class="w-full bg-white/5 border border-white/5 rounded-xl py-2.5 pl-11 pr-3 text-sm text-white placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500/70">
                        <span class="absolute inset-y-0 left-3 flex items-center text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 18a7.5 7.5 0 006.15-3.35z" />
                            </svg>
                        </span>
                        <span class="absolute right-3 top-1/2 -translate-y-1/2 text-[11px] px-2 py-1 rounded-lg bg-white/5 border border-white/5 text-slate-300">⌘K</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <button class="h-10 w-10 flex items-center justify-center rounded-xl bg-white/5 border border-white/5 text-slate-200 hover:bg-white/10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </button>
                        <button class="h-10 w-10 flex items-center justify-center rounded-xl bg-gradient-to-br from-sky-500 to-emerald-500 text-white font-semibold shadow-lg shadow-sky-500/20">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4" />
                            </svg>
                        </button>
                        <div class="flex items-center gap-3 rounded-2xl bg-white/5 border border-white/5 px-3 py-2">
                            <div>
                                <p class="text-xs text-slate-400">Admin</p>
                                <p class="text-sm font-semibold text-white">Dr. Evelyn Bates</p>
                            </div>
                            <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-sky-500 to-emerald-500 flex items-center justify-center font-semibold text-white">EB</div>
                        </div>
                    </div>
                </div>
            </header>

            <main class="relative px-4 sm:px-6 lg:px-8 py-8">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
