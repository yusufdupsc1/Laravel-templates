@extends('layouts.app')

@section('title', 'Messages | SchoolOps')

@section('content')
    <div class="space-y-8">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Messages</p>
                <h1 class="text-3xl font-semibold text-white">Signals & alerts</h1>
                <p class="text-sm text-slate-300">Finance, facilities, guardians, and staff updates in one view.</p>
            </div>
            <div class="flex gap-2">
                <button class="rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold text-slate-100 hover:bg-white/10">Archive</button>
                <a href="#compose" class="rounded-xl bg-gradient-to-r from-sky-500 to-emerald-500 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-sky-500/20">Compose</a>
            </div>
        </div>

        <div id="compose" class="rounded-2xl border border-white/5 bg-white/5 p-6 space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs uppercase tracking-[0.18em] text-slate-400">Compose</p>
                    <h3 class="text-xl font-semibold text-white mt-1">Post an alert</h3>
                </div>
            </div>
            <form method="POST" action="{{ route('messages.store') }}" class="grid gap-4 sm:grid-cols-2">
                @csrf
                <label class="space-y-1 text-sm text-slate-200">
                    <span>Author/Team</span>
                    <input name="author" required class="w-full rounded-lg border border-white/10 bg-slate-950/60 px-3 py-2 text-white placeholder:text-slate-500 focus:ring-2 focus:ring-sky-500/60 focus:outline-none" />
                </label>
                <label class="space-y-1 text-sm text-slate-200">
                    <span>Priority</span>
                    <select name="priority" class="w-full rounded-lg border border-white/10 bg-slate-950/60 px-3 py-2 text-white focus:ring-2 focus:ring-sky-500/60 focus:outline-none">
                        <option>Normal</option>
                        <option>High</option>
                    </select>
                </label>
                <label class="space-y-1 text-sm text-slate-200 sm:col-span-2">
                    <span>Subject</span>
                    <input name="subject" required class="w-full rounded-lg border border-white/10 bg-slate-950/60 px-3 py-2 text-white placeholder:text-slate-500 focus:ring-2 focus:ring-sky-500/60 focus:outline-none" />
                </label>
                <label class="space-y-1 text-sm text-slate-200 sm:col-span-2">
                    <span>Body</span>
                    <textarea name="body" rows="3" class="w-full rounded-lg border border-white/10 bg-slate-950/60 px-3 py-2 text-white placeholder:text-slate-500 focus:ring-2 focus:ring-sky-500/60 focus:outline-none"></textarea>
                </label>
                <div class="sm:col-span-2 flex justify-end pt-2">
                    <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-sky-500 to-emerald-500 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-sky-500/20">
                        Post message
                    </button>
                </div>
            </form>
        </div>

        <div class="grid gap-6 lg:grid-cols-3">
            <div class="lg:col-span-2 space-y-3">
                @foreach ($threads as $thread)
                    <div class="rounded-2xl border border-white/5 bg-white/5 p-4">
                        <div class="flex items-center justify-between text-xs text-slate-300">
                            <span class="font-semibold text-white">{{ $thread->author }}</span>
                            <div class="flex items-center gap-2">
                                <span class="rounded-full bg-white/5 px-2 py-1 text-[11px] text-slate-200">{{ $thread->priority }}</span>
                                <span>{{ $thread->created_at->diffForHumans() }}</span>
                                <form method="POST" action="{{ route('messages.destroy', $thread) }}" onsubmit="return confirm('Archive this message?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-rose-200 underline">Delete</button>
                                </form>
                            </div>
                        </div>
                        <p class="mt-2 text-sm font-semibold text-white">{{ $thread->subject }}</p>
                        <p class="text-xs text-slate-400 mt-1">{{ $thread->body }}</p>
                    </div>
                @endforeach
                <div class="px-2">
                    {{ $threads->links() }}
                </div>
            </div>
            <div class="space-y-3">
                <div class="rounded-2xl border border-white/5 bg-white/5 p-4">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-semibold text-white">Inbox</p>
                        <button class="rounded-lg border border-white/10 bg-white/5 px-3 py-1.5 text-xs font-semibold text-slate-100 hover:bg-white/10">View all</button>
                    </div>
                    <div class="mt-3 space-y-3">
                        @foreach ($inbox as $item)
                            <div class="rounded-xl border border-white/5 bg-slate-900/40 p-3">
                                <p class="text-xs text-slate-300">{{ $item->author }}</p>
                                <p class="text-sm font-semibold text-white">{{ $item->subject }}</p>
                                <p class="text-[11px] text-slate-400">{{ $item->created_at->diffForHumans() }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="rounded-2xl border border-white/5 bg-white/5 p-4">
                    <p class="text-sm font-semibold text-white">Quick actions</p>
                    <div class="mt-3 space-y-2 text-sm text-slate-200">
                        <button class="w-full rounded-lg bg-white/5 px-3 py-2 text-left hover:bg-white/10">Send attendance follow-up</button>
                        <button class="w-full rounded-lg bg-white/5 px-3 py-2 text-left hover:bg-white/10">Notify overdue guardians</button>
                        <button class="w-full rounded-lg bg-white/5 px-3 py-2 text-left hover:bg-white/10">Dispatch facility alert</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
