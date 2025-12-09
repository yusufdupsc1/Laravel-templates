<!DOCTYPE html>
<html lang="en" class="antialiased h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SchoolOps is a production-ready Laravel starter for school operations dashboards across students, attendance, finance, and messaging.">
    <title>@yield('title', 'SchoolOps Dashboard')</title>
    <meta name="theme-color" content="#020617">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-950 text-slate-50">
    <div class="relative isolate min-h-screen flex">
        <div class="pointer-events-none absolute inset-0 overflow-hidden">
            <div class="absolute -left-10 top-[-10%] h-72 w-72 rounded-full bg-sky-500/15 blur-3xl"></div>
            <div class="absolute right-[-10%] bottom-[-10%] h-96 w-96 rounded-full bg-emerald-500/10 blur-[120px]"></div>
        </div>
        <div id="toast-root" data-flash="{{ session('status') }}"></div>

        @php
            $nav = [
                ['name' => 'Dashboard', 'route' => 'dashboard', 'icon' => 'chart'],
                ['name' => 'Students', 'route' => 'students.index', 'icon' => 'users'],
                ['name' => 'Classes', 'route' => 'classes.index', 'icon' => 'calendar'],
                ['name' => 'Attendance', 'route' => 'attendance', 'icon' => 'check'],
                ['name' => 'Finance', 'route' => 'finance.index', 'icon' => 'wallet'],
                ['name' => 'Messages', 'route' => 'messages.index', 'icon' => 'inbox'],
                ['name' => 'Settings', 'route' => 'settings', 'icon' => 'cog'],
            ];
        @endphp

        <aside id="sidebar" class="fixed inset-y-0 left-0 z-20 w-72 bg-slate-950/90 border-r border-white/5 backdrop-blur-lg transform transition-transform duration-200 md:translate-x-0 -translate-x-full">
            <div class="flex items-center justify-between px-6 h-16 border-b border-white/5">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-sky-500 to-emerald-500 text-white font-semibold shadow-lg shadow-sky-500/20">
                        SO
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-[0.2em] text-slate-400">SchoolOps</p>
                        <p class="text-sm font-semibold text-white">Control</p>
                    </div>
                </div>
                <button data-toggle="sidebar" class="md:hidden text-slate-300 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <nav class="px-4 py-6 space-y-1 text-sm font-semibold text-slate-200">
                @foreach ($nav as $item)
                    @php $active = request()->routeIs($item['route']); @endphp
                    <a href="{{ route($item['route']) }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 transition {{ $active ? 'bg-white/10 text-white shadow-inner shadow-sky-500/10' : 'text-slate-300 hover:bg-white/5' }}">
                        <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/5">
                            @switch($item['icon'])
                                @case('chart')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-6a2 2 0 012-2h7m-9 8v1a3 3 0 106 0v-1m-6 0h6m6-4.5A9 9 0 113 12a9 9 0 0118 0z" /></svg>
                                    @break
                                @case('users')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14c-4.418 0-8 1.79-8 4v1h16v-1c0-2.21-3.582-4-8-4z" /></svg>
                                    @break
                                @case('calendar')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 4v2m10-2v2m-9 4h8m-9 4h6M5 8h14a1 1 0 011 1v9a2 2 0 01-2 2H6a2 2 0 01-2-2V9a1 1 0 011-1z" /></svg>
                                    @break
                                @case('check')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    @break
                                @case('wallet')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 7h13a3 3 0 013 3v1a3 3 0 01-3 3H4V7zm0 0V6a2 2 0 012-2h8" /></svg>
                                    @break
                                @case('inbox')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13.5V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7.5M3 13h4l2 3h6l2-3h4m-9 5h.01" /></svg>
                                    @break
                                @case('cog')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.25 4.21c.46-1.04 2.04-1.04 2.5 0l.29.65a1.5 1.5 0 001.84.82l.7-.2c1.08-.32 2.1.7 1.77 1.78l-.2.69a1.5 1.5 0 00.82 1.84l.65.29c1.04.46 1.04 2.04 0 2.5l-.65.29a1.5 1.5 0 00-.82 1.84l.2.7c.33 1.08-.69 2.1-1.77 1.77l-.7-.2a1.5 1.5 0 00-1.84.82l-.29.65c-.46 1.04-2.04 1.04-2.5 0l-.29-.65a1.5 1.5 0 00-1.84-.82l-.7.2c-1.08.33-2.1-.69-1.77-1.77l.2-.7a1.5 1.5 0 00-.82-1.84l-.65-.29c-1.04-.46-1.04-2.04 0-2.5l.65-.29a1.5 1.5 0 00.82-1.84l-.2-.7c-.33-1.08.69-2.1 1.77-1.77l.7.2a1.5 1.5 0 001.84-.82l.29-.65z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                    @break
                            @endswitch
                        </span>
                        <span>{{ $item['name'] }}</span>
                    </a>
                @endforeach
            </nav>
        </aside>

        <div class="flex-1 md:pl-72">
            <header class="sticky top-0 z-10 border-b border-white/5 bg-slate-950/80 backdrop-blur">
                <div class="flex items-center justify-between px-4 sm:px-6 lg:px-10 h-16">
                    <div class="flex items-center gap-3">
                        <button data-toggle="sidebar" class="md:hidden text-slate-300 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                        <div class="hidden sm:flex items-center gap-2 text-xs text-slate-400">
                            <span class="h-2 w-2 rounded-full bg-emerald-400 shadow-[0_0_0_6px] shadow-emerald-400/20"></span>
                            Live systems healthy
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <button data-open="quick-find" class="hidden sm:inline-flex items-center gap-2 rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold text-slate-100 hover:bg-white/10">
                            <span class="text-xs text-slate-300">⌘K</span>
                            Quick find
                        </button>
                        <button class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-sky-500 to-emerald-500 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-sky-500/20">
                            New action
                        </button>
                    </div>
                </div>
            </header>

            <main class="relative px-4 sm:px-6 lg:px-10 py-10">
                @if (session('status'))
                    <div class="mb-6 rounded-2xl border border-emerald-500/30 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-100">
                        {{ session('status') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="mb-6 rounded-2xl border border-rose-500/30 bg-rose-500/10 px-4 py-3 text-sm text-rose-50">
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

    <div id="quick-find" class="fixed inset-0 z-50 hidden bg-slate-950/80 backdrop-blur-sm">
        <div class="mx-auto mt-20 w-full max-w-xl rounded-2xl border border-white/10 bg-slate-900/90 shadow-2xl shadow-sky-500/10">
            <div class="flex items-center gap-2 border-b border-white/10 px-4 py-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.5 6a4.5 4.5 0 100 9 4.5 4.5 0 000-9zM21 21l-4.35-4.35"/></svg>
                <input id="quick-find-input" type="search" placeholder="Quick find..." class="w-full bg-transparent text-white placeholder:text-slate-500 focus:outline-none" autocomplete="off" />
                <button data-close="quick-find" class="text-slate-400 hover:text-white" aria-label="Close quick find">✕</button>
            </div>
            <div class="max-h-72 overflow-y-auto px-2 py-3" id="quick-find-results">
                @foreach ($nav as $item)
                    <a href="{{ route($item['route']) }}" class="quick-find-item flex items-center gap-3 rounded-lg px-3 py-2 text-sm text-slate-100 hover:bg-white/5" data-label="{{ strtolower($item['name']) }}">
                        <span class="text-slate-400">{{ $item['name'] }}</span>
                    </a>
                @endforeach
            </div>
            <div class="border-t border-white/10 px-4 py-2 text-xs text-slate-500">Press Esc to close</div>
        </div>
    </div>
</body>
</html>
