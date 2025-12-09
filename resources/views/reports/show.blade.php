@extends('layouts.app')

@section('title', 'Detail Aduan - SAPA Sragen')

@section('content')

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('reports.index') }}"
                    class="inline-flex items-center text-gray-600 hover:text-gray-900 font-medium">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Header Card -->
                    <div class="bg-gradient-to-r from-blue-900 to-blue-700 rounded-lg shadow-sm p-6 text-white">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <div class="flex items-center space-x-2 mb-3">
                                    <span
                                        class="px-3 py-1 bg-white/20 backdrop-blur-sm text-white text-xs font-semibold rounded-full">{{ $report->category }}</span>
                                    <span
                                        class="px-3 py-1 {{ str_replace(['text-', 'bg-'], ['text-white bg-', 'bg-'], explode(' ', $report->status_color)[1] ?? 'bg-gray-500') }} text-xs font-semibold rounded-full">{{ $report->status_label }}</span>
                                </div>
                                <h1 class="text-2xl font-bold mb-2">{{ $report->title }}</h1>
                                <div class="flex items-center space-x-4 text-sm text-blue-100">
                                    <div class="flex items-center space-x-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        <span>{{ $report->created_at->format('d M Y') }}</span>
                                    </div>
                                    <div class="flex items-center space-x-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                            </path>
                                        </svg>
                                        <span>#{{ $report->ticket_number }}</span>
                                    </div>
                                </div>
                            </div>
                            <button class="text-white hover:text-blue-100">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Deskripsi Laporan -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <h2 class="text-lg font-bold text-gray-900 mb-4">Deskripsi Laporan</h2>
                        <p class="text-gray-700 leading-relaxed">
                            {{ $report->description }}
                        </p>
                    </div>

                    <!-- Lokasi Kejadian -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <h2 class="text-lg font-bold text-gray-900 mb-4">Lokasi Kejadian</h2>

                        <div class="mb-4">
                            <div class="flex items-start space-x-2 text-gray-700">
                                <svg class="w-5 h-5 text-teal-600 mt-0.5 shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <div>
                                    <p class="font-medium">{{ $report->address }}</p>
                                    <p class="text-sm text-gray-500">Kel. {{ $report->village }}, Kec.
                                        {{ $report->district }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Map -->
                        <div class="rounded-lg overflow-hidden border border-gray-200" style="height: 300px;">
                            <img src="https://api.mapbox.com/styles/v1/mapbox/streets-v11/static/pin-s+ff6b35(110.8456,-7.4461)/110.8456,-7.4461,14,0/600x300@2x?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw"
                                alt="Map Location" class="w-full h-full object-cover">
                        </div>
                    </div>

                    <!-- Bukti Lampiran -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <h2 class="text-lg font-bold text-gray-900 mb-4">Bukti Lampiran</h2>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Photo 1 -->
                            <div class="relative group">
                                <img src="https://images.unsplash.com/photo-1530587191325-3db32d826c18?w=400&h=300&fit=crop"
                                    alt="Foto Bukti 1" class="w-full h-48 object-cover rounded-lg border border-gray-200">
                                <div
                                    class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 rounded-lg transition flex items-center justify-center">
                                    <button
                                        class="opacity-0 group-hover:opacity-100 bg-white text-gray-900 px-4 py-2 rounded-lg font-medium transition">
                                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                        Lihat
                                    </button>
                                </div>
                                <div
                                    class="absolute bottom-2 left-2 bg-black bg-opacity-70 text-white px-2 py-1 rounded text-xs">
                                    Foto Bukti 1
                                </div>
                            </div>

                            <!-- Photo 2 -->
                            <div class="relative group">
                                <img src="https://images.unsplash.com/photo-1604187351574-c75ca79f5807?w=400&h=300&fit=crop"
                                    alt="Foto Bukti 2" class="w-full h-48 object-cover rounded-lg border border-gray-200">
                                <div
                                    class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 rounded-lg transition flex items-center justify-center">
                                    <button
                                        class="opacity-0 group-hover:opacity-100 bg-white text-gray-900 px-4 py-2 rounded-lg font-medium transition">
                                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                        Lihat
                                    </button>
                                </div>
                                <div
                                    class="absolute bottom-2 left-2 bg-black bg-opacity-70 text-white px-2 py-1 rounded text-xs">
                                    Foto Bukti 2
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Status Timeline -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-bold text-gray-900">Status Laporan</h3>
                            <button class="text-gray-400 hover:text-gray-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        <!-- Timeline -->
                        <div class="space-y-6">
                            <!-- Step 1 - Completed -->
                            <div class="flex items-start space-x-3">
                                <div class="relative">
                                    <div
                                        class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <div
                                        class="absolute top-10 left-1/2 transform -translate-x-1/2 w-0.5 h-8 bg-green-500">
                                    </div>
                                </div>
                                <div class="flex-1 pt-1">
                                    <p class="font-semibold text-gray-900">Laporan Diterima</p>
                                    <p class="text-xs text-gray-500 mt-1">Laporan berhasil masuk ke sistem.</p>
                                    <p class="text-xs text-gray-400 mt-1">05 Nov 2025, 09:12 WIB</p>
                                </div>
                            </div>

                            <!-- Step 2 - Completed -->
                            <div class="flex items-start space-x-3">
                                <div class="relative">
                                    <div
                                        class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <div
                                        class="absolute top-10 left-1/2 transform -translate-x-1/2 w-0.5 h-8 bg-green-500">
                                    </div>
                                </div>
                                <div class="flex-1 pt-1">
                                    <p class="font-semibold text-gray-900">Diverifikasi Admin</p>
                                    <p class="text-xs text-gray-500 mt-1">Laporan valid dan diteruskan ke Dinas Lingkungan
                                        Hidup (DLH).</p>
                                    <p class="text-xs text-gray-400 mt-1">05 Nov 2025, 14:33 WIB</p>
                                </div>
                            </div>

                            <!-- Step 3 - Current -->
                            <div class="flex items-start space-x-3">
                                <div class="relative">
                                    <div
                                        class="w-10 h-10 bg-orange-500 rounded-full flex items-center justify-center text-white animate-pulse">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="absolute top-10 left-1/2 transform -translate-x-1/2 w-0.5 h-8 bg-gray-300">
                                    </div>
                                </div>
                                <div class="flex-1 pt-1">
                                    <p class="font-semibold text-gray-900">Sedang Tindak Lanjut</p>
                                    <p class="text-xs text-gray-500 mt-1">Petugas DLH sedang melakukan survei dan
                                        perencanaan pengangkutan.</p>
                                    <p class="text-xs text-gray-400 mt-1">07 Nov 2025, 09:00 WIB</p>
                                </div>
                            </div>

                            <!-- Step 4 - Pending -->
                            <div class="flex items-start space-x-3">
                                <div class="relative">
                                    <div
                                        class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-white">
                                        <span class="text-sm font-bold">4</span>
                                    </div>
                                </div>
                                <div class="flex-1 pt-1">
                                    <p class="font-semibold text-gray-400">Selesai</p>
                                    <p class="text-xs text-gray-400 mt-1">Laporan Ditutup</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Info Card -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-blue-600 mt-0.5 shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="text-sm">
                                <p class="font-semibold text-blue-900 mb-1">ID Tiket Laporan</p>
                                <p class="text-blue-700 font-mono">#SR-2511-012</p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <h3 class="text-sm font-bold text-gray-900 mb-4">Aksi</h3>
                        <div class="space-y-3">
                            <button
                                class="w-full flex items-center justify-center space-x-2 px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                                    </path>
                                </svg>
                                <span>Cetak Bukti</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
