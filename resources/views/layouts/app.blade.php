<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="AEA - Afghanistan Engineers Association - Master real engineering skills with expert-led courses">

        <link rel="icon" type="image/png" href="{{ asset('images/aea-logo.png') }}">
        <title>@yield('title', config('app.name', 'AEA'))</title>

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Alpine.js -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.3/dist/cdn.min.js"></script>

        <!-- GSAP & Animation Libraries -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/lenis@1.1.13/dist/lenis.min.js"></script>
        <script src="https://unpkg.com/split-type"></script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased h-full bg-slate-950 text-slate-100 overflow-x-hidden">
        <!-- Page Loader -->
        <div id="page-loader" class="fixed inset-0 z-[9999] bg-slate-950 flex items-center justify-center">
            <div class="text-center">
                <div class="relative w-24 h-24 mx-auto mb-6">
                    <div class="absolute inset-0 border-4 border-slate-800 rounded-full"></div>
                    <div class="absolute inset-0 border-4 border-blue-500 rounded-full border-t-transparent animate-spin"></div>
                    <img src="{{ asset('images/aea-logo.png') }}" alt="AEA" class="absolute inset-4 w-16 h-16 object-contain">
                </div>
                <div class="h-1 w-48 bg-slate-800 rounded-full overflow-hidden mx-auto">
                    <div id="loader-progress" class="h-full bg-gradient-to-r from-blue-500 to-purple-500 w-0 transition-all duration-1000"></div>
                </div>
            </div>
        </div>

        <!-- Scroll Progress -->
        <div id="scroll-progress" class="fixed top-0 left-0 h-0.5 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 z-[9998] w-0"></div>

        <!-- Animated Background -->
        <div class="fixed inset-0 z-0 pointer-events-none overflow-hidden">
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl animate-pulse delay-1000"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-slate-800/20 rounded-full blur-3xl"></div>
        </div>

        <div class="relative z-10 min-h-screen flex flex-col">
            @include('layouts.navigation')

            @isset($header)
                <header class="relative border-b border-slate-800/50 backdrop-blur-xl bg-slate-950/50">
                    <div class="max-w-7xl mx-auto px-4 mt-20 sm:px-6 lg:px-8">
                        <div class="py-6" data-animate="fade-down">
                            {{ $header }}
                        </div>
                    </div>
                </header>
            @endisset

            <main class="flex-1">
                {{ $slot }}
            </main>

            @include('layouts.footer')
        </div>

        <!-- Toast Container -->
        <div id="toast-container" class="fixed bottom-4 right-4 z-50 space-y-2"></div>

        @stack('scripts')
    </body>
</html>
