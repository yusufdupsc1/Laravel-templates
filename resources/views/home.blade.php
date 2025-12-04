@extends('layouts.app')

@section('title', 'Home - MyWebsite')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-blue-500 to-purple-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">{{ $hero['title'] }}</h1>
            <p class="text-xl md:text-2xl mb-8 text-blue-100">{{ $hero['subtitle'] }}</p>
            <div class="flex justify-center gap-4">
                <a href="{{ route('about') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">{{ $hero['cta_primary'] }}</a>
                <a href="{{ route('contact') }}" class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition">{{ $hero['cta_secondary'] }}</a>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Why Choose Us?</h2>
            <p class="text-gray-600">We provide the best solutions for your needs</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($features as $feature)
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-{{ $feature['color'] }}-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    @if($feature['icon'] === 'lightning')
                    <svg class="w-8 h-8 text-{{ $feature['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    @elseif($feature['icon'] === 'lock')
                    <svg class="w-8 h-8 text-{{ $feature['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                    @elseif($feature['icon'] === 'thumb')
                    <svg class="w-8 h-8 text-{{ $feature['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path>
                    </svg>
                    @endif
                </div>
                <h3 class="text-xl font-semibold mb-2">{{ $feature['title'] }}</h3>
                <p class="text-gray-600">{{ $feature['description'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="bg-gray-100 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">{{ $cta['title'] }}</h2>
        <p class="text-gray-600 mb-8">{{ $cta['description'] }}</p>
        <a href="{{ route('contact') }}" class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition inline-block">{{ $cta['button_text'] }}</a>
    </div>
</div>
@endsection
