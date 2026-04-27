<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Atom Forge') }}</title>

        <!-- Fonts: Inter for clean SaaS feel -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @viteReactRefresh
        @vite(['resources/js/app.jsx'])
        
        <style>
            body { font-family: 'Inter', sans-serif; letter-spacing: -0.01em; }
        </style>
        @stack('styles')
    </head>
    <body class="antialiased text-slate-900 bg-slate-50" x-data="{ sidebarOpen: false }">
        @include('layouts.sidebar')

        <div class="md:ml-[280px] min-h-screen pt-[60px] transition-all duration-300">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white border-b border-slate-200">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="py-12">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    {{ $slot }}
                </div>
            </main>
        </div>

        <!-- Floating WhatsApp Support -->
        <a href="https://wa.me/918318754257" target="_blank" class="fixed bottom-8 right-8 z-50 bg-emerald-500 text-white p-4 rounded-full shadow-2xl hover:bg-emerald-600 transition-all transform hover:scale-110 flex items-center justify-center group" title="Chat with us on WhatsApp">
            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.246 2.248 3.484 5.232 3.484 8.412-.003 6.557-5.338 11.892-11.893 11.892-1.997-.001-3.951-.5-5.688-1.448l-6.309 1.656zm6.29-4.143c1.589.943 3.147 1.44 4.744 1.441 5.401 0 9.798-4.396 9.802-9.797 0-2.618-1.02-5.08-2.871-6.932-1.85-1.852-4.311-2.873-6.93-2.873-5.401 0-9.798 4.397-9.802 9.799 0 1.9.54 3.42 1.581 4.966l-.1.173-1.013 3.7.126.033 3.663-.957zm11.532-6.536c-.234-.117-1.385-.683-1.599-.761-.215-.078-.371-.117-.527.117-.156.234-.605.761-.742.918-.137.156-.273.176-.508.059-.234-.117-.988-.364-1.882-1.161-.695-.62-1.165-1.385-1.301-1.619-.137-.234-.015-.361.103-.477.106-.105.234-.273.351-.41.117-.137.156-.234.234-.391.078-.156.039-.293-.019-.41-.059-.117-.527-1.27-.723-1.738-.191-.462-.387-.399-.527-.406-.136-.007-.293-.009-.449-.009-.156 0-.41.059-.625.293-.215.234-.82.801-.82 1.953s.84 2.266.957 2.422c.117.156 1.653 2.523 4.004 3.538.559.241.996.386 1.337.494.56.178 1.069.153 1.472.093.449-.066 1.385-.566 1.581-1.113.195-.547.195-1.016.137-1.113-.058-.097-.214-.156-.448-.273z"></path>
            </svg>
            <span class="absolute right-full mr-4 bg-slate-900 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">WhatsApp Support</span>
        </a>
        @stack('scripts')
    </body>
</html>
