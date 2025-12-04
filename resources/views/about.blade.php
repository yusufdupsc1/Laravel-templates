@extends('layouts.app')

@section('title', 'About Us - MyWebsite')

@section('content')
<!-- Page Header -->
<div class="bg-gradient-to-r from-blue-500 to-purple-600 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl md:text-5xl font-bold text-center">About Us</h1>
        <p class="text-center text-xl mt-4 text-blue-100">Learn more about our story and mission</p>
    </div>
</div>

<!-- About Content -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center mb-16">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-4">{{ $story['title'] }}</h2>
                @foreach($story['paragraphs'] as $paragraph)
                    <p class="text-gray-600 mb-4">{{ $paragraph }}</p>
                @endforeach
            </div>
            <div class="bg-gradient-to-br from-blue-400 to-purple-500 rounded-lg h-96 flex items-center justify-center">
                <span class="text-white text-6xl font-bold">🚀</span>
            </div>
        </div>

        <!-- Mission & Values -->
        <div class="bg-gray-50 rounded-lg p-8 md:p-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Our Mission & Values</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($values as $value)
                    <div class="text-center">
                        <div class="w-16 h-16 bg-{{ $value['color'] }}-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-white text-2xl">{{ $value['icon'] }}</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">{{ $value['title'] }}</h3>
                        <p class="text-gray-600">{{ $value['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Team Section -->
        <div class="mt-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Meet Our Team</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                @foreach($team as $member)
                    <div class="text-center">
                        <div class="w-32 h-32 bg-gradient-to-br from-{{ $member['color'] }}-400 to-{{ $member['color'] }}-600 rounded-full mx-auto mb-4 flex items-center justify-center">
                            <span class="text-white text-4xl">{{ $member['icon'] }}</span>
                        </div>
                        <h3 class="font-semibold text-lg">{{ $member['name'] }}</h3>
                        <p class="text-gray-600 text-sm">{{ $member['position'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
