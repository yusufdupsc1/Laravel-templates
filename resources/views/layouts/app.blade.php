<!DOCTYPE html>
<html lang="en" class="antialiased h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SchoolOps Dashboard')</title>
    <meta name="theme-color" content="#020617">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-950 text-slate-50">
    <div class="relative isolate min-h-screen">
        <div class="pointer-events-none absolute inset-0 overflow-hidden">
            <div class="absolute -left-10 top-[-10%] h-72 w-72 rounded-full bg-sky-500/15 blur-3xl"></div>
            <div class="absolute right-[-10%] bottom-[-10%] h-96 w-96 rounded-full bg-emerald-500/10 blur-[120px]"></div>
        </div>

        <header class="sticky top-0 z-20 border-b border-white/5 bg-slate-950/80 backdrop-blur">
            <div class="mx-auto flex max-w-6xl items-center justify-between px-4 sm:px-6 lg:px-8 h-16">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-sky-500 to-emerald-500 text-white font-semibold shadow-lg shadow-sky-500/20">
                        SO
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-[0.2em] text-slate-400">SchoolOps</p>
                        <p class="text-sm font-semibold text-white">Live dashboard</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <button class="hidden sm:inline-flex items-center gap-2 rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold text-slate-100 hover:bg-white/10">
                        <span class="text-xs text-slate-300">⌘K</span>
                        Quick find
                    </button>
                    <button class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-sky-500 to-emerald-500 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-sky-500/20">
                        New action
                    </button>
                </div>
            </div>
        </header>

        <main class="relative mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 py-10">
            @yield('content')
        </main>
    </div>
</body>
</html>
