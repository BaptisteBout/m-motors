<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>M-Motors | Excellence Automobile</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body
    class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col font-sans">

    <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6">
        <nav class="flex items-center justify-between gap-4">
            <div class="font-bold text-xl tracking-tighter text-blue-900 dark:text-white">
                M-MOTORS<span class="text-red-600">.</span>
            </div>
            <div class="flex gap-4">
                <a href="{{ route('vehicles.index') }}"
                    class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] border rounded-sm hover:bg-gray-50">
                    Accéder au catalogue
                </a>
            </div>
        </nav>
    </header>

    <div class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow">
        <main
            class="flex max-w-[335px] w-full flex-col-reverse lg:max-w-4xl lg:flex-row shadow-2xl rounded-xl overflow-hidden">

            <div
                class="text-[13px] leading-[20px] flex-1 p-6 pb-12 lg:p-20 bg-white dark:bg-[#161615] dark:text-[#EDEDEC]">
                <h1 class="mb-4 text-3xl font-bold tracking-tight text-blue-900 dark:text-white">L'avenir de votre
                    mobilité.</h1>
                <p class="mb-6 text-[#706f6c] dark:text-[#A1A09A] text-base">
                    Découvrez notre sélection exclusive de véhicules en achat direct ou en location longue durée.
                    M-Motors vous accompagne vers une gestion 100% dématérialisée de votre parc automobile.
                </p>

                <ul class="flex flex-col mb-8 space-y-4 text-sm font-medium">
                    <li class="flex items-center gap-3">
                        <span class="w-2 h-2 bg-red-600 rounded-full"></span>
                        Catalogue de véhicules Premium
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="w-2 h-2 bg-blue-900 rounded-full"></span>
                        Dossiers 100% en ligne
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="w-2 h-2 bg-gray-400 rounded-full"></span>
                        Suivi en temps réel
                    </li>
                </ul>

                <a href="{{ route('vehicles.index') }}"
                    class="inline-flex items-center justify-center w-full lg:w-auto px-8 py-4 bg-blue-900 text-white font-bold rounded-lg hover:bg-blue-800 transition-transform hover:scale-105 shadow-lg">
                    Explorer le catalogue
                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="商9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            <div class="relative flex-1 bg-blue-900 min-h-[300px] flex items-center justify-center overflow-hidden">
                <div
                    class="absolute inset-0 opacity-20 bg-[url('https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?auto=format&fit=crop&q=80')] bg-cover bg-center">
                </div>
                <div class="relative text-center p-8">
                    <div class="text-white text-4xl font-black italic tracking-tighter opacity-50 mb-2">SPEED & TRUST
                    </div>
                    <p class="text-blue-200 text-sm uppercase tracking-widest font-bold">M-Motors Expertise</p>
                </div>
            </div>
        </main>
    </div>

    <footer
        class="w-full lg:max-w-4xl max-w-[335px] py-6 text-center text-[#706f6c] text-[11px] uppercase tracking-widest">
        &copy; 2026 M-Motors Group &bull; Système de Surveillance Pulse Actif
    </footer>
</body>

</html>