<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Momento</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans bg-[#121212] text-gray-200">

    <header class="fixed top-0 left-0 w-full z-50 bg-black/30 backdrop-blur-sm">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <div class="flex-shrink-0">
                    <a href="/" class="text-2xl font-bold text-white">Phosamble</a>
                </div>

                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ url('/boards') }}" class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-md transition-colors">
                            My Boards
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="hidden sm:block px-4 py-1.5 text-sm text-gray-300 border border-gray-600 rounded-md hover:bg-gray-800 transition-colors">
                            Log In
                        </a>
                        <a href="{{ route('register') }}" class="px-4 py-1.5 text-sm font-semibold text-white bg-gradient-to-r from-purple-600 to-blue-500 rounded-md hover:opacity-90 transition-opacity">
                            Sign Up
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <main class="relative min-h-screen flex flex-col items-center justify-center overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-black/50"></div>

        <div class="relative z-10 flex flex-col items-center text-center p-6">

            <h1 class="text-6xl md:text-8xl font-extrabold tracking-tighter bg-gradient-to-b from-white to-gray-400 bg-clip-text text-transparent drop-shadow-sm">
                Phosamble
            </h1>

            <p class="mt-4 text-lg text-gray-400 max-w-lg">
                Capture and relive your most cherished moments with loved ones.
            </p>
        </div>
    </main>

    
            <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"></path>
        </svg>
    </button>

</body>
</html>