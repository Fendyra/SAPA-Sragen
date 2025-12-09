<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SAPA Sragen')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Header/Navigation -->
    <header class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-900 rounded-full flex items-center justify-center">
                            <span class="text-white font-bold text-xl">S</span>
                        </div>
                        <span class="text-xl font-semibold text-gray-900">SAPA SRAGEN</span>
                    </a>
                </div>

                <!-- Navigation Menu -->
                <nav class="hidden md:flex space-x-8">
                    @auth
                        <a href="{{ route('dashboard') }}"
                            class="px-3 py-2 text-sm font-semibold {{ request()->routeIs('dashboard') ? 'text-teal-600' : 'text-gray-700 hover:text-teal-600' }}">
                            Dashboard
                        </a>
                        <a href="{{ route('reports.create') }}"
                            class="px-3 py-2 text-sm font-semibold {{ request()->routeIs('reports.create') ? 'text-teal-600' : 'text-gray-700 hover:text-teal-600' }}">
                            Buat Aduan
                        </a>
                        <a href="{{ route('reports.index') }}"
                            class="px-3 py-2 text-sm font-semibold {{ request()->routeIs('reports.index') ? 'text-teal-600' : 'text-gray-700 hover:text-teal-600' }}">
                            Riwayat Saya
                        </a>
                        <a href="{{ route('reports.public') }}"
                            class="px-3 py-2 text-sm font-semibold {{ request()->routeIs('reports.public') ? 'text-teal-600' : 'text-gray-700 hover:text-teal-600' }}">
                            Aduan Publik
                        </a>
                        <a href="{{ route('about') }}"
                            class="px-3 py-2 text-sm font-semibold {{ request()->routeIs('about') ? 'text-teal-600' : 'text-gray-700 hover:text-teal-600' }}">
                            Tentang Kami
                        </a>
                    @else
                        <a href="{{ route('home') }}"
                            class="px-3 py-2 text-sm font-semibold {{ request()->routeIs('home') ? 'text-teal-600' : 'text-gray-700 hover:text-teal-600' }}">
                            Beranda
                        </a>
                        <a href="{{ route('reports.public') }}"
                            class="px-3 py-2 text-sm font-semibold {{ request()->routeIs('reports.public') ? 'text-teal-600' : 'text-gray-700 hover:text-teal-600' }}">
                            Aduan Publik
                        </a>
                        <a href="{{ route('about') }}"
                            class="px-3 py-2 text-sm font-semibold {{ request()->routeIs('about') ? 'text-teal-600' : 'text-gray-700 hover:text-teal-600' }}">
                            Tentang Kami
                        </a>
                        <a href="{{ route('login') }}"
                            class="px-3 py-2 text-sm font-semibold text-gray-700 hover:text-teal-600">
                            Masuk
                        </a>
                    @endauth
                </nav>

                <!-- User Actions -->
                <div class="flex items-center space-x-4">
                    @auth
                        <div class="relative inline-block text-left">
                            <button type="button" class="flex items-center space-x-2 text-gray-700 hover:text-gray-900"
                                id="user-menu-button">
                                <div class="w-8 h-8 bg-teal-600 rounded-full flex items-center justify-center">
                                    <span
                                        class="text-white text-sm font-medium">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                </div>
                                <span class="text-sm font-medium">{{ auth()->user()->name }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                        </div>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-900">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                            class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 border border-gray-300 rounded-md hover:bg-gray-50">
                            Masuk / Daftar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-teal-700 to-blue-900 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Brand -->
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
                            <span class="text-blue-900 font-bold text-xl">S</span>
                        </div>
                        <span class="text-xl font-semibold">SAPA SRAGEN</span>
                    </div>
                    <p class="text-sm text-gray-200 leading-relaxed">
                        Sistem informasi layanan aspirasi dan pengaduan online masyarakat Kabupaten Sragen. Sampaikan
                        keluhan Anda, pantau prosesnya secara transparan.
                    </p>
                </div>

                <!-- Tautan -->
                <div>
                    <h3 class="font-semibold text-lg mb-4">Tautan</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ url('/') }}" class="hover:text-teal-300 transition">Dashboard</a></li>
                        <li><a href="{{ url('/aduan') }}" class="hover:text-teal-300 transition">Buat Aduan</a></li>
                        <li><a href="{{ url('/riwayat') }}" class="hover:text-teal-300 transition">Riwayat Saya</a>
                        </li>
                        <li><a href="{{ url('/aduan-publik') }}" class="hover:text-teal-300 transition">Aduan
                                Publik</a></li>
                    </ul>
                </div>

                <!-- Bantuan -->
                <div>
                    <h3 class="font-semibold text-lg mb-4">Bantuan</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('faq') }}" class="hover:text-teal-300 transition">Cara Melapor</a></li>
                        <li><a href="{{ route('faq') }}" class="hover:text-teal-300 transition">FAQ</a></li>
                        <li><a href="{{ route('faq') }}" class="hover:text-teal-300 transition">Syarat & Ketentuan</a>
                        </li>
                        <li><a href="{{ route('faq') }}" class="hover:text-teal-300 transition">Kebijakan Privasi</a>
                        </li>
                    </ul>
                </div>

                <!-- Hubungi Kami -->
                <div>
                    <h3 class="font-semibold text-lg mb-4">Hubungi Kami</h3>
                    <ul class="space-y-2 text-sm">
                        <li class="flex items-start space-x-2">
                            <svg class="w-5 h-5 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>Diskominfo Kab. Sragen</span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <svg class="w-5 h-5 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                            <span>info@sapa.sragenkab.go.id</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-white/20 mt-8 pt-8 text-center text-sm text-gray-200">
                <p>&copy; 2025 Pemerintah Kabupaten Sragen. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>

</html>
