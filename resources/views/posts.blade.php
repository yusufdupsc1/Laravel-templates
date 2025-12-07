@extends('layouts.app')

@section('title', 'Posts')

@section('content')
<section class="max-w-5xl mx-auto px-4 py-12 space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm text-gray-500 uppercase tracking-wide">Learning step</p>
            <h1 class="text-3xl font-bold">Posts</h1>
            <p class="text-gray-600 text-sm mt-1">Route → controller → (DB or fallback) → Blade.</p>
        </div>
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $usingDatabase ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
            {{ $usingDatabase ? 'DB: sqlite' : 'DB driver missing → using sample data' }}
        </span>
    </div>

    <div class="grid gap-6 md:grid-cols-2">
        @forelse($posts as $post)
            <article class="bg-white shadow rounded-lg p-6 border border-gray-100">
                <div class="flex items-center justify-between mb-2">
                    <h2 class="text-xl font-semibold">{{ $post['title'] ?? $post->title }}</h2>
                    <span class="text-xs text-gray-500">{{ optional($post['created_at'] ?? $post->created_at)->format('Y-m-d') }}</span>
                </div>
                <p class="text-gray-700 text-sm leading-relaxed">{{ $post['body'] ?? $post->body }}</p>
            </article>
        @empty
            <p class="text-gray-600">No posts yet.</p>
        @endforelse
    </div>

    <div class="text-sm text-gray-500 space-y-1">
        <p><strong>How to switch to real data:</strong> install PHP sqlite driver, run <code>php artisan migrate --seed</code>, then reload.</p>
        <p><code>PageController@posts</code> tries the DB first; if it fails, it falls back to sample data.</p>
    </div>
</section>
@endsection
