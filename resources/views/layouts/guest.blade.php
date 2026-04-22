<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Atom Forge') }}</title>

    <!-- Fonts: Inter for high-visibility industrial feel -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @viteReactRefresh
    @vite(['resources/js/app.jsx'])
</head>

<body class="font-sans text-slate-900 antialiased bg-slate-50">
    <div class="min-h-screen flex flex-col justify-center items-center p-4 sm:p-6 relative overflow-hidden">
        <!-- Structural Grid Background -->
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none"
            style="background-image: radial-gradient(circle at 2px 2px, #6366f1 1px, transparent 0); background-size: 32px 32px;">
        </div>

        <div class="relative z-10 w-full flex flex-col items-center">
            <div class="mb-8">
                <a href="/" class="flex flex-col items-center gap-3">
                    <div class="p-4 bg-indigo-600 rounded-3xl shadow-xl shadow-indigo-600/20 rotate-3 hover:rotate-0 transition-all duration-300">
                        <x-application-logo class="w-10 h-10 fill-white" />
                    </div>
                    <span class="text-xl font-bold tracking-tight text-slate-900 mt-2">Atom<span class="text-indigo-600">Forge</span></span>
                </a>
            </div>

            <div class="w-full max-w-[95%] sm:max-w-md bg-white border border-slate-200 shadow-2xl shadow-slate-200/50 rounded-[2rem] overflow-hidden">
                <div class="px-8 py-10 sm:px-10 sm:py-12">
                    {{ $slot }}
                </div>
            </div>

            <div class="mt-10 text-center">
                <p class="text-slate-400 text-[10px] uppercase tracking-[0.3em] font-bold">
                    © {{ date('Y') }} Atom Forge <span class="mx-2">•</span> Industrial Systems
                </p>
            </div>
        </div>
    </div>
</body>

</html>
