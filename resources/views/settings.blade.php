@extends('layouts.app')

@section('title', 'Settings | SchoolOps')

@section('content')
    <div class="space-y-8">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Settings</p>
                <h1 class="text-3xl font-semibold text-white">Controls & access</h1>
                <p class="text-sm text-slate-300">Security, notifications, and team access for school operations.</p>
            </div>
            <div class="flex gap-2">
                <button class="rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold text-slate-100 hover:bg-white/10">Audit log</button>
                <button class="rounded-xl bg-gradient-to-r from-sky-500 to-emerald-500 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-sky-500/20">Save changes</button>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-2">
            <div class="space-y-3">
                @foreach ($settings as $setting)
                    <div class="rounded-2xl border border-white/5 bg-white/5 p-4 flex items-start justify-between gap-4">
                        <div>
                            <p class="text-sm font-semibold text-white">{{ $setting['name'] }}</p>
                            <p class="text-xs text-slate-400">{{ $setting['description'] }}</p>
                        </div>
                        <label class="relative inline-flex h-6 w-11 cursor-pointer items-center">
                            <input type="checkbox" class="peer sr-only" {{ $setting['enabled'] ? 'checked' : '' }}>
                            <span class="absolute h-6 w-11 rounded-full bg-white/10 peer-checked:bg-sky-500 transition"></span>
                            <span class="absolute left-1 h-4 w-4 rounded-full bg-white transition peer-checked:translate-x-5"></span>
                        </label>
                    </div>
                @endforeach
            </div>
            <div class="rounded-2xl border border-white/5 bg-white/5 p-6 space-y-3">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-[0.18em] text-slate-400">Teams</p>
                        <h3 class="text-xl font-semibold text-white mt-1">Access groups</h3>
                    </div>
                    <button class="rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-xs font-semibold text-slate-100 hover:bg-white/10">Manage</button>
                </div>
                <div class="space-y-3">
                    @foreach ($teams as $team)
                        <div class="rounded-xl border border-white/5 bg-slate-900/40 p-4 flex items-center justify-between">
                            <div>
                                <p class="font-semibold text-white">{{ $team['name'] }}</p>
                                <p class="text-xs text-slate-400">{{ $team['members'] }} members</p>
                            </div>
                            <span class="rounded-full bg-white/5 px-3 py-1 text-xs font-semibold text-slate-200">{{ $team['role'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
