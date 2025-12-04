@extends('layouts.app')

@section('title', 'Testimonials - MyWebsite')

@section('content')
<!-- Page Header -->
<div class="bg-gradient-to-r from-blue-500 to-purple-600 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl md:text-5xl font-bold text-center">What Our Clients Say</h1>
        <p class="text-center text-xl mt-4 text-blue-100">Real feedback from real people</p>
    </div>
</div>

<!-- Testimonials Grid -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($testimonials as $testimonial)
            <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-{{ $testimonial['color'] }}-400 to-{{ $testimonial['color'] }}-600 rounded-full flex items-center justify-center mr-3">
                        <span class="text-white text-xl">{{ $testimonial['icon'] }}</span>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">{{ $testimonial['name'] }}</h3>
                        <p class="text-gray-600 text-sm">{{ $testimonial['position'] }}</p>
                    </div>
                </div>
                <div class="flex mb-3">
                    <span class="text-yellow-400">{{ str_repeat('★', $testimonial['rating']) }}</span>
                </div>
                <p class="text-gray-600">
                    "{{ $testimonial['review'] }}"
                </p>
            </div>
            @endforeach
        </div>

        <!-- Stats Section -->
        <div class="mt-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg p-8 md:p-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center text-white">
                @foreach($stats as $stat)
                <div>
                    <div class="text-4xl font-bold mb-2">{{ $stat['number'] }}</div>
                    <div class="text-blue-100">{{ $stat['label'] }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
