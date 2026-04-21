<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


<head>
    <meta name="robots" content="noindex, nofollow">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Management System</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800">

    <div class="min-h-screen flex flex-col">

        <!-- NAVBAR -->
        <header class="flex items-center justify-between px-6 py-4 max-w-6xl mx-auto w-full">

            <div class="flex items-center gap-3">
                <img src="/icons/icon-512.png" class="w-10 h-10 rounded-full">
                <span class="font-bold text-lg">Yifang</span>
            </div>

            <!-- RIGHT SIDE -->
            <div class="flex items-center gap-3">

                @auth
                    <span class="text-sm text-gray-600 hidden sm:block">
                        Hello, <span class="font-semibold">{{ auth()->user()->name }}</span>
                    </span>

                    <a href="{{ route('dashboard') }}"
                        class="px-4 py-2 bg-gray-900 text-white rounded-lg text-sm font-medium hover:opacity-90 transition">
                        Back
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 bg-gray-900 text-white rounded-lg text-sm font-medium hover:opacity-90 transition">
                        Login
                    </a>
                @endauth

            </div>

        </header>

        <!-- HERO -->
        <section class="flex-1 flex items-center">
            <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-10 items-center">

                <!-- LEFT -->
                <div class="space-y-6 text-center md:text-left">

                    <span class="text-sm text-blue-600 font-semibold">
                        Smart • Secure • Scalable
                    </span>

                    <h1 class="text-4xl md:text-5xl font-bold leading-tight">
                        Manage Your Company Database
                        <span class="text-blue-600">Effortlessly</span>
                    </h1>

                    <p class="text-gray-600 text-base md:text-lg">
                        A modern platform to organize, secure, and monitor your company data.
                        Built for performance, designed for simplicity.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-3 justify-center md:justify-start">

                        @auth
                            <a href="{{ route('dashboard') }}"
                                class="px-6 py-3 bg-gray-900 text-white rounded-xl font-semibold shadow hover:scale-[0.98] transition">
                                Go to Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="px-6 py-3 bg-gray-900 text-white rounded-xl font-semibold shadow hover:scale-[0.98] transition">
                                Get Started
                            </a>
                        @endauth

                        <a href="#features"
                            class="px-6 py-3 border border-gray-300 rounded-xl font-semibold hover:bg-gray-100 transition">
                            Learn More
                        </a>

                    </div>

                </div>

                <!-- RIGHT -->
                <div class="relative">

                    <div class="bg-white rounded-2xl shadow-xl p-5 space-y-4">

                        <div class="flex justify-between items-center">
                            <span class="font-semibold">Dashboard</span>
                            <span class="text-sm text-gray-400">Live</span>
                        </div>

                        <div class="grid grid-cols-3 gap-3">
                            <div class="bg-gray-100 p-3 rounded-xl text-center">
                                <p class="text-sm text-gray-500">Databases</p>
                                <p class="font-bold text-lg">248</p>
                            </div>

                            <div class="bg-gray-100 p-3 rounded-xl text-center">
                                <p class="text-sm text-gray-500">Tables</p>
                                <p class="font-bold text-lg">1,842</p>
                            </div>

                            <div class="bg-gray-100 p-3 rounded-xl text-center">
                                <p class="text-sm text-gray-500">Users</p>
                                <p class="font-bold text-lg">86</p>
                            </div>
                        </div>

                        <div class="bg-gray-100 rounded-xl h-24 flex items-center justify-center text-gray-400 text-sm">
                            Activity Chart
                        </div>

                    </div>

                    <div class="absolute -z-10 top-10 left-10 w-40 h-40 bg-blue-200 rounded-full blur-3xl opacity-40">
                    </div>

                </div>

            </div>
        </section>

        <!-- FOOTER -->
        <footer class="py-6 text-center text-sm text-gray-400">
            © {{ date('Y') }} Yifang. All rights reserved.
        </footer>

    </div>

</body>

</html>
