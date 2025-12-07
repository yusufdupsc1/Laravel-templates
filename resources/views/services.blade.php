@extends('layouts.app')

@section('title', 'Services')

@section('content')
<section class="max-w-5xl mx-auto px-4 py-12">
    <h1 class="text-3xl font-bold mb-6">Services</h1>
    <div class="grid gap-6 md:grid-cols-3">
        @foreach($services as $service)
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-2">{{ $service['title'] }}</h2>
                <p class="text-gray-600 text-sm">{{ $service['desc'] }}</p>
            </div>
        @endforeach
    </div>
</section>
@endsection
