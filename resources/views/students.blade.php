@extends('layouts.app')

@section('title', 'Students | SchoolOps')

@section('content')
    <div class="space-y-8">
        <div class="flex flex-col gap-3">
            <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Students</p>
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-3xl font-semibold text-white">Roster & guardians</h1>
                    <p class="text-sm text-slate-300">Track high performers, new intakes, and guardian contacts.</p>
                </div>
                <div class="flex gap-2">
                    <button class="rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold text-slate-100 hover:bg-white/10">Import CSV</button>
                    <a href="#add-student" class="rounded-xl bg-gradient-to-r from-sky-500 to-emerald-500 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-sky-500/20">Add student</a>
                </div>
            </div>
        </div>

        <div id="add-student" class="rounded-2xl border border-white/5 bg-white/5 p-6 space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs uppercase tracking-[0.18em] text-slate-400">New student</p>
                    <h3 class="text-xl font-semibold text-white mt-1">Add enrolment</h3>
                </div>
            </div>
            <form class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3" method="POST" action="{{ route('students.store') }}">
                @csrf
                <label class="space-y-1 text-sm text-slate-200">
                    <span>Name</span>
                    <input name="name" value="{{ old('name') }}" required class="w-full rounded-lg border border-white/10 bg-slate-950/60 px-3 py-2 text-white placeholder:text-slate-500 focus:ring-2 focus:ring-sky-500/60 focus:outline-none" />
                    @error('name') <span class="text-xs text-rose-300">{{ $message }}</span> @enderror
                </label>
                <label class="space-y-1 text-sm text-slate-200">
                    <span>Grade</span>
                    <input name="grade" value="{{ old('grade') }}" required class="w-full rounded-lg border border-white/10 bg-slate-950/60 px-3 py-2 text-white placeholder:text-slate-500 focus:ring-2 focus:ring-sky-500/60 focus:outline-none" />
                    @error('grade') <span class="text-xs text-rose-300">{{ $message }}</span> @enderror
                </label>
                <label class="space-y-1 text-sm text-slate-200">
                    <span>GPA</span>
                    <input name="gpa" type="number" step="0.01" min="0" max="4" value="{{ old('gpa', 3.5) }}" required class="w-full rounded-lg border border-white/10 bg-slate-950/60 px-3 py-2 text-white placeholder:text-slate-500 focus:ring-2 focus:ring-sky-500/60 focus:outline-none" />
                    @error('gpa') <span class="text-xs text-rose-300">{{ $message }}</span> @enderror
                </label>
                <label class="space-y-1 text-sm text-slate-200">
                    <span>Status</span>
                    <select name="status" class="w-full rounded-lg border border-white/10 bg-slate-950/60 px-3 py-2 text-white focus:ring-2 focus:ring-sky-500/60 focus:outline-none">
                        <option>Active</option>
                        <option>Watch</option>
                        <option>New</option>
                    </select>
                </label>
                <label class="space-y-1 text-sm text-slate-200">
                    <span>Guardian</span>
                    <input name="guardian" value="{{ old('guardian') }}" class="w-full rounded-lg border border-white/10 bg-slate-950/60 px-3 py-2 text-white placeholder:text-slate-500 focus:ring-2 focus:ring-sky-500/60 focus:outline-none" />
                </label>
                <label class="space-y-1 text-sm text-slate-200">
                    <span>Contact</span>
                    <input name="contact" value="{{ old('contact') }}" class="w-full rounded-lg border border-white/10 bg-slate-950/60 px-3 py-2 text-white placeholder:text-slate-500 focus:ring-2 focus:ring-sky-500/60 focus:outline-none" />
                </label>
                <div class="sm:col-span-2 lg:col-span-3 flex justify-end pt-2">
                    <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-sky-500 to-emerald-500 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-sky-500/20">
                        Save student
                    </button>
                </div>
            </form>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-2xl border border-white/5 bg-white/5 p-4">
                <p class="text-xs uppercase tracking-[0.18em] text-slate-400">Active</p>
                <p class="mt-2 text-2xl font-semibold text-white">{{ $metrics['active'] }}</p>
                <p class="text-xs text-emerald-300">Up to date</p>
            </div>
            <div class="rounded-2xl border border-white/5 bg-white/5 p-4">
                <p class="text-xs uppercase tracking-[0.18em] text-slate-400">New intakes</p>
                <p class="mt-2 text-2xl font-semibold text-white">{{ $metrics['new'] }}</p>
                <p class="text-xs text-sky-300">This term</p>
            </div>
            <div class="rounded-2xl border border-white/5 bg-white/5 p-4">
                <p class="text-xs uppercase tracking-[0.18em] text-slate-400">Watchlist</p>
                <p class="mt-2 text-2xl font-semibold text-white">{{ $metrics['watch'] }}</p>
                <p class="text-xs text-amber-300">Attendance / GPA</p>
            </div>
            <div class="rounded-2xl border border-white/5 bg-white/5 p-4">
                <p class="text-xs uppercase tracking-[0.18em] text-slate-400">Scholarships</p>
                <p class="mt-2 text-2xl font-semibold text-white">{{ $metrics['avgGpa'] }}</p>
                <p class="text-xs text-emerald-300">Average GPA</p>
            </div>
        </div>

        <div class="overflow-hidden rounded-2xl border border-white/5 bg-white/5">
                <div class="flex items-center justify-between px-4 py-3 border-b border-white/5">
                    <p class="text-sm font-semibold text-white">Students</p>
                <form method="GET" class="flex items-center gap-2">
                    <input type="search" name="q" value="{{ $search }}" placeholder="Search students..." class="w-60 rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-sm text-white placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500/60" />
                    <button class="rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-xs font-semibold text-slate-100 hover:bg-white/10">Search</button>
                    <a href="{{ route('students.export', request()->only('q')) }}" class="rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-xs font-semibold text-slate-100 hover:bg-white/10">Export CSV</a>
                </form>
            </div>
            <table class="min-w-full divide-y divide-white/5 text-sm">
                <thead class="bg-white/5 text-slate-300">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">Name</th>
                        <th class="px-4 py-3 text-left font-semibold">Grade</th>
                        <th class="px-4 py-3 text-left font-semibold">GPA</th>
                        <th class="px-4 py-3 text-left font-semibold">Status</th>
                        <th class="px-4 py-3 text-left font-semibold">Guardian</th>
                        <th class="px-4 py-3 text-left font-semibold">Contact</th>
                        <th class="px-4 py-3 text-left font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @foreach ($students as $student)
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-4 py-3 font-semibold text-white">{{ $student->name }}</td>
                            <td class="px-4 py-3 text-slate-200">{{ $student->grade }}</td>
                            <td class="px-4 py-3 text-slate-200">{{ $student->gpa }}</td>
                            <td class="px-4 py-3">
                                <span class="rounded-full bg-emerald-500/10 px-3 py-1 text-xs font-semibold text-emerald-200">{{ $student->status }}</span>
                            </td>
                            <td class="px-4 py-3 text-slate-200">{{ $student->guardian }}</td>
                            <td class="px-4 py-3 text-slate-200">{{ $student->contact }}</td>
                            <td class="px-4 py-3 text-slate-200 space-x-2">
                                <details class="inline-block">
                                    <summary class="cursor-pointer text-sky-300 underline">Edit</summary>
                                    <form method="POST" action="{{ route('students.update', $student) }}" class="mt-2 space-y-2">
                                        @csrf
                                        @method('PUT')
                                        <input name="name" value="{{ $student->name }}" class="w-full rounded-lg border border-white/10 bg-slate-950/60 px-3 py-2 text-white text-xs" />
                                        <input name="grade" value="{{ $student->grade }}" class="w-full rounded-lg border border-white/10 bg-slate-950/60 px-3 py-2 text-white text-xs" />
                                        <input name="gpa" type="number" step="0.01" min="0" max="4" value="{{ $student->gpa }}" class="w-full rounded-lg border border-white/10 bg-slate-950/60 px-3 py-2 text-white text-xs" />
                                        <select name="status" class="w-full rounded-lg border border-white/10 bg-slate-950/60 px-3 py-2 text-white text-xs">
                                            <option {{ $student->status === 'Active' ? 'selected' : '' }}>Active</option>
                                            <option {{ $student->status === 'Watch' ? 'selected' : '' }}>Watch</option>
                                            <option {{ $student->status === 'New' ? 'selected' : '' }}>New</option>
                                        </select>
                                        <input name="guardian" value="{{ $student->guardian }}" class="w-full rounded-lg border border-white/10 bg-slate-950/60 px-3 py-2 text-white text-xs" />
                                        <input name="contact" value="{{ $student->contact }}" class="w-full rounded-lg border border-white/10 bg-slate-950/60 px-3 py-2 text-white text-xs" />
                                        <button class="w-full rounded-lg bg-gradient-to-r from-sky-500 to-emerald-500 px-3 py-2 text-xs font-semibold text-white">Save</button>
                                    </form>
                                </details>
                                <form method="POST" action="{{ route('students.destroy', $student) }}" class="inline" onsubmit="return confirm('Delete this student?')">
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
                {{ $students->links() }}
            </div>
        </div>
    </div>
@endsection
