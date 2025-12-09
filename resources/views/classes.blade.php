@extends('layouts.app')

@section('title', 'Classes | SchoolOps')

@section('content')
    <div class="space-y-8">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Classes</p>
                <h1 class="text-3xl font-semibold text-white">Daily schedule & coverage</h1>
                <p class="text-sm text-slate-300">Ensure every period has a teacher, room, and materials ready.</p>
            </div>
            <div class="flex gap-2">
                <button class="rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold text-slate-100 hover:bg-white/10">Publish bulletin</button>
                <a href="#add-class" class="rounded-xl bg-gradient-to-r from-sky-500 to-emerald-500 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-sky-500/20">Add class</a>
            </div>
        </div>

        <div id="add-class" class="rounded-2xl border border-white/5 bg-white/5 p-6 space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs uppercase tracking-[0.18em] text-slate-400">New class</p>
                    <h3 class="text-xl font-semibold text-white mt-1">Create session</h3>
                </div>
            </div>
            <form method="POST" action="{{ route('classes.store') }}" class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @csrf
                <label class="space-y-1 text-sm text-slate-200">
                    <span>Class name</span>
                    <input name="name" required class="w-full rounded-lg border border-white/10 bg-slate-950/60 px-3 py-2 text-white placeholder:text-slate-500 focus:ring-2 focus:ring-sky-500/60 focus:outline-none" />
                </label>
                <label class="space-y-1 text-sm text-slate-200">
                    <span>Teacher</span>
                    <input name="teacher" required class="w-full rounded-lg border border-white/10 bg-slate-950/60 px-3 py-2 text-white placeholder:text-slate-500 focus:ring-2 focus:ring-sky-500/60 focus:outline-none" />
                </label>
                <label class="space-y-1 text-sm text-slate-200">
                    <span>Time</span>
                    <input name="time" placeholder="08:00 - 09:30" required class="w-full rounded-lg border border-white/10 bg-slate-950/60 px-3 py-2 text-white placeholder:text-slate-500 focus:ring-2 focus:ring-sky-500/60 focus:outline-none" />
                </label>
                <label class="space-y-1 text-sm text-slate-200">
                    <span>Room</span>
                    <input name="room" required class="w-full rounded-lg border border-white/10 bg-slate-950/60 px-3 py-2 text-white placeholder:text-slate-500 focus:ring-2 focus:ring-sky-500/60 focus:outline-none" />
                </label>
                <label class="space-y-1 text-sm text-slate-200">
                    <span>Status</span>
                    <select name="status" class="w-full rounded-lg border border-white/10 bg-slate-950/60 px-3 py-2 text-white focus:ring-2 focus:ring-sky-500/60 focus:outline-none">
                        <option>In session</option>
                        <option>Starts soon</option>
                        <option>Ready</option>
                        <option>Assigned</option>
                        <option>Prep</option>
                    </select>
                </label>
                <div class="sm:col-span-2 lg:col-span-3 flex justify-end pt-2">
                    <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-sky-500 to-emerald-500 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-sky-500/20">
                        Save class
                    </button>
                </div>
            </form>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-2xl border border-white/5 bg-white/5 p-4">
                <p class="text-xs uppercase tracking-[0.18em] text-slate-400">Classes today</p>
                <p class="mt-2 text-2xl font-semibold text-white">{{ $metrics['total'] }}</p>
                <p class="text-xs text-emerald-300">Total scheduled</p>
            </div>
            <div class="rounded-2xl border border-white/5 bg-white/5 p-4">
                <p class="text-xs uppercase tracking-[0.18em] text-slate-400">Labs</p>
                <p class="mt-2 text-2xl font-semibold text-white">{{ $metrics['labs'] }}</p>
                <p class="text-xs text-sky-300">All staffed</p>
            </div>
            <div class="rounded-2xl border border-white/5 bg-white/5 p-4">
                <p class="text-xs uppercase tracking-[0.18em] text-slate-400">Coverage</p>
                <p class="mt-2 text-2xl font-semibold text-white">{{ $metrics['in_session'] }}</p>
                <p class="text-xs text-emerald-300">In session</p>
            </div>
            <div class="rounded-2xl border border-white/5 bg-white/5 p-4">
                <p class="text-xs uppercase tracking-[0.18em] text-slate-400">Sub requests</p>
                <p class="mt-2 text-2xl font-semibold text-white">{{ $metrics['prep'] }}</p>
                <p class="text-xs text-amber-300">Prep / pending</p>
            </div>
        </div>

        <div class="overflow-hidden rounded-2xl border border-white/5 bg-white/5">
            <div class="flex items-center justify-between px-4 py-3 border-b border-white/5">
                <p class="text-sm font-semibold text-white">Today</p>
                <div class="flex gap-2">
                    <button class="rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-xs font-semibold text-slate-100 hover:bg-white/10">Assign substitute</button>
                    <button class="rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-xs font-semibold text-slate-100 hover:bg-white/10">Print</button>
                </div>
            </div>
            <table class="min-w-full divide-y divide-white/5 text-sm">
                <thead class="bg-white/5 text-slate-300">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">Class</th>
                        <th class="px-4 py-3 text-left font-semibold">Teacher</th>
                        <th class="px-4 py-3 text-left font-semibold">Time</th>
                        <th class="px-4 py-3 text-left font-semibold">Room</th>
                        <th class="px-4 py-3 text-left font-semibold">Status</th>
                        <th class="px-4 py-3 text-left font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @foreach ($classes as $class)
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-4 py-3 font-semibold text-white">{{ $class->name }}</td>
                            <td class="px-4 py-3 text-slate-200">{{ $class->teacher }}</td>
                            <td class="px-4 py-3 text-slate-200">{{ $class->time }}</td>
                            <td class="px-4 py-3 text-slate-200">{{ $class->room }}</td>
                            <td class="px-4 py-3">
                                <span class="rounded-full bg-emerald-500/10 px-3 py-1 text-xs font-semibold text-emerald-200">{{ $class->status }}</span>
                            </td>
                            <td class="px-4 py-3 text-slate-200 space-x-2">
                                <details class="inline-block">
                                    <summary class="cursor-pointer text-sky-300 underline">Edit</summary>
                                    <form method="POST" action="{{ route('classes.update', $class) }}" class="mt-2 space-y-2">
                                        @csrf
                                        @method('PUT')
                                        <input name="name" value="{{ $class->name }}" class="w-full rounded-lg border border-white/10 bg-slate-950/60 px-3 py-2 text-white text-xs" />
                                        <input name="teacher" value="{{ $class->teacher }}" class="w-full rounded-lg border border-white/10 bg-slate-950/60 px-3 py-2 text-white text-xs" />
                                        <input name="time" value="{{ $class->time }}" class="w-full rounded-lg border border-white/10 bg-slate-950/60 px-3 py-2 text-white text-xs" />
                                        <input name="room" value="{{ $class->room }}" class="w-full rounded-lg border border-white/10 bg-slate-950/60 px-3 py-2 text-white text-xs" />
                                        <select name="status" class="w-full rounded-lg border border-white/10 bg-slate-950/60 px-3 py-2 text-white text-xs">
                                            <option {{ $class->status === 'In session' ? 'selected' : '' }}>In session</option>
                                            <option {{ $class->status === 'Starts soon' ? 'selected' : '' }}>Starts soon</option>
                                            <option {{ $class->status === 'Ready' ? 'selected' : '' }}>Ready</option>
                                            <option {{ $class->status === 'Assigned' ? 'selected' : '' }}>Assigned</option>
                                            <option {{ $class->status === 'Prep' ? 'selected' : '' }}>Prep</option>
                                        </select>
                                        <button class="w-full rounded-lg bg-gradient-to-r from-sky-500 to-emerald-500 px-3 py-2 text-xs font-semibold text-white">Save</button>
                                    </form>
                                </details>
                                <form method="POST" action="{{ route('classes.destroy', $class) }}" class="inline" onsubmit="return confirm('Delete this class?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="rounded-lg border border-white/10 bg-white/5 px-3 py-1 text-xs font-semibold text-rose-200 hover:bg-white/10">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="px-4 py-3">
                {{ $classes->links() }}
            </div>
        </div>
    </div>
@endsection
