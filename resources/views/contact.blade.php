@extends('layouts.app')

@section('title', 'Contact Us - MyWebsite')

@section('content')
<!-- Page Header -->
<div class="bg-gradient-to-r from-blue-500 to-purple-600 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl md:text-5xl font-bold text-center">Get In Touch</h1>
        <p class="text-center text-xl mt-4 text-blue-100">We'd love to hear from you</p>
    </div>
</div>

<!-- Contact Section -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Contact Form -->
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Send Us a Message</h2>
                <form class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                        <input type="text" id="name" name="name" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                               placeholder="John Doe">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <input type="email" id="email" name="email" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                               placeholder="john@example.com">
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                        <input type="tel" id="phone" name="phone" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                               placeholder="+1 (555) 123-4567">
                    </div>
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                        <input type="text" id="subject" name="subject" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                               placeholder="How can we help you?">
                    </div>
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                        <textarea id="message" name="message" rows="5" 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                                  placeholder="Tell us more about your project..."></textarea>
                    </div>
                    <button type="submit" 
                            class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                        Send Message
                    </button>
                </form>
            </div>

            <!-- Contact Information -->
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Contact Information</h2>
                <div class="space-y-6">
                    @foreach($contact_info as $info)
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-{{ $info['color'] }}-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                            @if($info['icon'] === 'location')
                            <svg class="w-6 h-6 text-{{ $info['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            @elseif($info['icon'] === 'phone')
                            <svg class="w-6 h-6 text-{{ $info['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            @elseif($info['icon'] === 'mail')
                            <svg class="w-6 h-6 text-{{ $info['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            @elseif($info['icon'] === 'clock')
                            <svg class="w-6 h-6 text-{{ $info['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            @endif
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-1">{{ $info['title'] }}</h3>
                            <p class="text-gray-600">
                                @foreach($info['details'] as $index => $detail)
                                    {{ $detail }}@if($index < count($info['details']) - 1)<br>@endif
                                @endforeach
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Map Placeholder -->
                <div class="mt-8 bg-gray-200 rounded-lg h-64 flex items-center justify-center">
                    <div class="text-center">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <p class="text-gray-500">Map Location</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
