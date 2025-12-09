@extends('layouts.app')

@section('title', 'Suara Anda, Kemajuan Sragen - SAPA Sragen')

@section('content')

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-900 to-teal-700 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                <!-- Text Content -->
                <div>
                    <h1 class="text-4xl md:text-5xl font-bold mb-6">
                        Suara Anda, Kemajuan Sragen
                    </h1>
                    <p class="text-lg mb-8 text-gray-100 leading-relaxed">
                        Layanan aspirasi dan pengaduan online terintegrasi. Sampaikan masalah di sekitar Anda, pantau
                        prosesnya secara transparan.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        @auth
                            <a href="{{ route('dashboard') }}"
                                class="bg-yellow-500 hover:bg-yellow-600 text-blue-900 font-semibold px-8 py-3 rounded-lg transition flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                                    </path>
                                </svg>
                                <span>Pelajari Alur</span>
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="bg-yellow-500 hover:bg-yellow-600 text-blue-900 font-semibold px-8 py-3 rounded-lg transition flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                                    </path>
                                </svg>
                                <span>Pelajari Alur</span>
                            </a>
                        @endauth
                        <a href="#aduan-publik"
                            class="bg-transparent border-2 border-white hover:bg-white hover:text-blue-900 font-semibold px-8 py-3 rounded-lg transition flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                </path>
                            </svg>
                            <span>Pelajari Alur</span>
                        </a>
                    </div>
                </div>

                <!-- Image -->
                <div class="hidden lg:block">
                    <img src="{{ asset('assets/images/hero-image.jpg') }}" alt="Community" class="rounded-lg shadow-2xl"
                        onerror="this.src='https://images.unsplash.com/photo-1531206715517-5c0ba140b2b8?w=600&h=400&fit=crop'">
                </div>
            </div>
        </div>
    </section>

    <!-- Search Section -->
    <section class="bg-white py-8 shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto">
                <div class="bg-gray-50 rounded-lg p-6 flex flex-col md:flex-row gap-4">
                    <div class="flex-1 flex items-center border border-gray-300 rounded-md bg-white px-4 py-2">
                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <input type="text" placeholder="Cari status laporan Anda dengan login..."
                            class="flex-1 bg-transparent border-none focus:outline-none text-gray-700">
                    </div>
                    <div class="flex-1 md:flex-initial">
                        <input type="text" placeholder="Masukkan ID Tiket Aduan (Contoh: #SR-20251210-123)"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                    </div>
                    <button
                        class="bg-teal-600 hover:bg-teal-700 text-white font-medium px-6 py-2 rounded-md transition flex items-center justify-center space-x-2">
                        <span>Lacak</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Kategori Layanan Section -->
    <section class="py-16 bg-gray-50" id="layanan">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Kategori Layanan</h2>
                <p class="text-gray-600">Pilih kategori yang sesuai dengan laporan Anda untuk diteruskan ke instansi
                    terkait.</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                <!-- Infrastruktur -->
                <div
                    class="bg-white rounded-lg p-6 text-center hover:shadow-lg transition cursor-pointer border border-gray-200">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-1">Infrastruktur</h3>
                </div>

                <!-- Kesehatan -->
                <div
                    class="bg-white rounded-lg p-6 text-center hover:shadow-lg transition cursor-pointer border border-gray-200">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-1">Kesehatan</h3>
                </div>

                <!-- Lingkungan -->
                <div
                    class="bg-white rounded-lg p-6 text-center hover:shadow-lg transition cursor-pointer border border-gray-200">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-1">Lingkungan</h3>
                </div>

                <!-- Keamanan -->
                <div
                    class="bg-white rounded-lg p-6 text-center hover:shadow-lg transition cursor-pointer border border-gray-200">
                    <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-1">Keamanan</h3>
                </div>

                <!-- Sosial -->
                <div
                    class="bg-white rounded-lg p-6 text-center hover:shadow-lg transition cursor-pointer border border-gray-200">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-1">Sosial</h3>
                </div>

                <!-- Administrasi -->
                <div
                    class="bg-white rounded-lg p-6 text-center hover:shadow-lg transition cursor-pointer border border-gray-200">
                    <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-1">Administrasi</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- Aduan Publik Terkini Section -->
    <section class="py-16 bg-white" id="aduan-publik">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Aduan Publik Terkini</h2>
                    <p class="text-gray-600">Transparansi tindak lanjutan masyarakat.</p>
                </div>
                <a href="#" class="text-teal-600 hover:text-teal-700 font-medium flex items-center space-x-2">
                    <span>Lihat Semua</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Aduan Card 1 -->
                <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-lg transition">
                    <div class="flex items-start justify-between mb-4">
                        <span
                            class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full">Diproses</span>
                        <span class="text-xs text-gray-500">10 Nov 2025</span>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2 line-clamp-2">Jalan Berlubang di Kec. Masaran</h3>
                    <p class="text-sm text-gray-600 mb-4 line-clamp-3">
                        Mohon segera diperbaiki jalan utama di kecamatan karena sangat membahayakan pengendara motor
                        terutama saat malam hari...
                    </p>
                    <div class="flex items-center text-sm text-gray-500 space-x-4">
                        <div class="flex items-center space-x-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                </path>
                            </svg>
                            <span>Infrastruktur</span>
                        </div>
                        <div class="flex items-center space-x-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span>Masaran, Sragen</span>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <a href="#" class="text-teal-600 hover:text-teal-700 text-sm font-medium flex items-center">
                            <span>Detail</span>
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Aduan Card 2 -->
                <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-lg transition">
                    <div class="flex items-start justify-between mb-4">
                        <span
                            class="px-3 py-1 bg-orange-100 text-orange-800 text-xs font-semibold rounded-full">Ditinjau</span>
                        <span class="text-xs text-gray-500">08 Nov 2025</span>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2 line-clamp-2">Antrean Lama di Disdukcapil</h3>
                    <p class="text-sm text-gray-600 mb-4 line-clamp-3">
                        Pelayanan yang lambat dan sistem antrean yang tidak teratur membuat warga menunggu berjam-jam untuk
                        pembuatan KTP...
                    </p>
                    <div class="flex items-center text-sm text-gray-500 space-x-4">
                        <div class="flex items-center space-x-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                </path>
                            </svg>
                            <span>Administrasi</span>
                        </div>
                        <div class="flex items-center space-x-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span>Sragen Kota</span>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <a href="#" class="text-teal-600 hover:text-teal-700 text-sm font-medium flex items-center">
                            <span>Detail</span>
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Aduan Card 3 -->
                <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-lg transition">
                    <div class="flex items-start justify-between mb-4">
                        <span
                            class="px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Selesai</span>
                        <span class="text-xs text-gray-500">Hari ini</span>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2 line-clamp-2">Lampu PJU Mati Total</h3>
                    <p class="text-sm text-gray-600 mb-4 line-clamp-3">
                        Sejumlah jalan utama sudah 2 hari tanpa penerangan jalan umum. Sudah melapor ke RT namun belum ada
                        tindakan...
                    </p>
                    <div class="flex items-center text-sm text-gray-500 space-x-4">
                        <div class="flex items-center space-x-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                </path>
                            </svg>
                            <span>Infrastruktur</span>
                        </div>
                        <div class="flex items-center space-x-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span>Sragen Wetan</span>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <a href="#" class="text-teal-600 hover:text-teal-700 text-sm font-medium flex items-center">
                            <span>Detail</span>
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Alur Pengaduan Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Alur Pengaduan</h2>
                <p class="text-gray-600">Mudah, cepat, dan terpantau.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Step 1 -->
                <div class="text-center">
                    <div
                        class="w-20 h-20 bg-teal-600 text-white rounded-full flex items-center justify-center text-3xl font-bold mx-auto mb-4">
                        1</div>
                    <h3 class="font-bold text-gray-900 mb-2">Tulis Laporan</h3>
                    <p class="text-sm text-gray-600">Lengkapi & Jelaskan</p>
                </div>

                <!-- Step 2 -->
                <div class="text-center">
                    <div
                        class="w-20 h-20 bg-teal-600 text-white rounded-full flex items-center justify-center text-3xl font-bold mx-auto mb-4">
                        2</div>
                    <h3 class="font-bold text-gray-900 mb-2">Verifikasi</h3>
                    <p class="text-sm text-gray-600">Oleh Admin</p>
                </div>

                <!-- Step 3 -->
                <div class="text-center">
                    <div
                        class="w-20 h-20 bg-teal-600 text-white rounded-full flex items-center justify-center text-3xl font-bold mx-auto mb-4">
                        3</div>
                    <h3 class="font-bold text-gray-900 mb-2">Tindak Lanjut</h3>
                    <p class="text-sm text-gray-600">Oleh Dinas Terkait</p>
                </div>

                <!-- Step 4 -->
                <div class="text-center">
                    <div
                        class="w-20 h-20 bg-teal-600 text-white rounded-full flex items-center justify-center text-3xl font-bold mx-auto mb-4">
                        4</div>
                    <h3 class="font-bold text-gray-900 mb-2">Selesai</h3>
                    <p class="text-sm text-gray-600">Laporan Ditutup</p>
                </div>
            </div>
        </div>
    </section>

@endsection
