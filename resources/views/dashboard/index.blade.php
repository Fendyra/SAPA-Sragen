@extends('layouts.app')

@section('title', 'Dashboard - SAPA Sragen')

@section('content')

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="mb-8">
                <div class="bg-gradient-to-r from-blue-900 to-blue-700 rounded-xl p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm opacity-90">Selamat Datang,</p>
                            <h1 class="text-2xl md:text-3xl font-bold">{{ auth()->user()->name }}</h1>
                            <p class="text-blue-100 mt-2">Ada masalah di sekitar Anda hari ini? Sampaikan kepada kami agar
                                segera ditindaklanjuti.</p>
                        </div>
                        <a href="{{ route('reports.create') }}"
                            class="inline-flex items-center px-5 py-2.5 bg-yellow-500 hover:bg-yellow-600 text-blue-900 font-semibold rounded-lg shadow transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                                </path>
                            </svg>
                            Buat Aduan Baru
                        </a>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Total Aduan -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Total Aduan Saya</p>
                            <h3 class="text-3xl font-bold text-gray-900">{{ $totalReports }}</h3>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Sedang Diproses -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Sedang Diproses</p>
                            <h3 class="text-3xl font-bold text-yellow-600">{{ $processingReports }}</h3>
                        </div>
                        <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Aduan Selesai -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Aduan Selesai</p>
                            <h3 class="text-3xl font-bold text-green-600">{{ $completedReports }}</h3>
                        </div>
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Aduan Terkini Saya Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-8">
                <div class="p-6 border-b border-gray-200 flex items-center justify-between">
                    <h2 class="text-xl font-bold text-gray-900">Aduan Terkini Saya</h2>
                    <a href="{{ route('reports.index') }}"
                        class="text-sm text-teal-600 hover:text-teal-700 font-medium flex items-center space-x-1">
                        <span>Lihat Semua Riwayat</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    ID Tiket</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Judul Aduan</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Tanggal</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Kategori</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Status</th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($recentReports as $report)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        #{{ $report->ticket_number }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $report->title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        <div class="flex items-center space-x-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            <span>{{ $report->created_at->format('d M Y') }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                                </path>
                                            </svg>
                                            {{ ucfirst($report->category) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span
                                            class="px-2.5 py-0.5 rounded text-xs font-semibold {{ $report->status_color }}">
                                            {{ $report->status_label }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                        <a href="{{ route('reports.show', $report->id) }}"
                                            class="text-teal-600 hover:text-teal-900 font-medium">Detail</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center text-sm text-gray-500">
                                        Belum ada aduan. Yuk mulai dengan membuat aduan pertama Anda.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Lacak Aduan Lain -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
                <h3 class="text-lg font-bold text-gray-900 mb-2">Lacak Aduan Lain</h3>
                <p class="text-sm text-gray-600 mb-4">Masukkan tiket aduan untuk melihat progres tanpa perlu masuk.</p>
                <form action="{{ route('reports.index') }}" method="GET" class="flex gap-3">
                    <div class="flex-1">
                        <input type="text" name="search" placeholder="Masukkan ID Tiket Aduan"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                    </div>
                    <button type="submit"
                        class="px-6 py-2.5 bg-teal-600 hover:bg-teal-700 text-white font-medium rounded-lg transition flex items-center space-x-2">
                        <span>Lacak</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </form>
            </div>

            <!-- Buat Aduan Baru Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 mb-8">
                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-blue-900 mb-2">Buat Aduan Baru</h2>
                    <p class="text-gray-600">Pilih kategori yang sesuai untuk memulai laporan Anda.</p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 max-w-5xl mx-auto">
                    <a href="{{ route('reports.create') }}?category=infrastruktur"
                        class="group flex flex-col items-center p-4 rounded-lg border-2 border-gray-200 hover:border-teal-500 hover:bg-teal-50 transition">
                        <div
                            class="w-16 h-16 bg-blue-100 group-hover:bg-teal-100 rounded-full flex items-center justify-center mb-3 transition">
                            <svg class="w-8 h-8 text-blue-600 group-hover:text-teal-600 transition" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <span class="text-sm font-semibold text-gray-900 text-center">Infrastruktur</span>
                    </a>

                    <a href="{{ route('reports.create') }}?category=kesehatan"
                        class="group flex flex-col items-center p-4 rounded-lg border-2 border-gray-200 hover:border-teal-500 hover:bg-teal-50 transition">
                        <div
                            class="w-16 h-16 bg-blue-100 group-hover:bg-teal-100 rounded-full flex items-center justify-center mb-3 transition">
                            <svg class="w-8 h-8 text-blue-600 group-hover:text-teal-600 transition" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                        <span class="text-sm font-semibold text-gray-900 text-center">Kesehatan</span>
                    </a>

                    <a href="{{ route('reports.create') }}?category=lingkungan"
                        class="group flex flex-col items-center p-4 rounded-lg border-2 border-gray-200 hover:border-teal-500 hover:bg-teal-50 transition">
                        <div
                            class="w-16 h-16 bg-blue-100 group-hover:bg-teal-100 rounded-full flex items-center justify-center mb-3 transition">
                            <svg class="w-8 h-8 text-blue-600 group-hover:text-teal-600 transition" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="text-sm font-semibold text-gray-900 text-center">Lingkungan</span>
                    </a>

                    <a href="{{ route('reports.create') }}?category=keamanan"
                        class="group flex flex-col items-center p-4 rounded-lg border-2 border-gray-200 hover:border-teal-500 hover:bg-teal-50 transition">
                        <div
                            class="w-16 h-16 bg-blue-100 group-hover:bg-teal-100 rounded-full flex items-center justify-center mb-3 transition">
                            <svg class="w-8 h-8 text-blue-600 group-hover:text-teal-600 transition" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <span class="text-sm font-semibold text-gray-900 text-center">Keamanan</span>
                    </a>

                    <a href="{{ route('reports.create') }}?category=sosial"
                        class="group flex flex-col items-center p-4 rounded-lg border-2 border-gray-200 hover:border-teal-500 hover:bg-teal-50 transition">
                        <div
                            class="w-16 h-16 bg-blue-100 group-hover:bg-teal-100 rounded-full flex items-center justify-center mb-3 transition">
                            <svg class="w-8 h-8 text-blue-600 group-hover:text-teal-600 transition" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 009.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <span class="text-sm font-semibold text-gray-900 text-center">Sosial</span>
                    </a>

                    <a href="{{ route('reports.create') }}?category=administrasi"
                        class="group flex flex-col items-center p-4 rounded-lg border-2 border-gray-200 hover:border-teal-500 hover:bg-teal-50 transition">
                        <div
                            class="w-16 h-16 bg-blue-100 group-hover:bg-teal-100 rounded-full flex items-center justify-center mb-3 transition">
                            <svg class="w-8 h-8 text-blue-600 group-hover:text-teal-600 transition" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <span class="text-sm font-semibold text-gray-900 text-center">Administrasi</span>
                    </a>
                </div>
            </div>

            <!-- Aduan Publik Terkini -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-gray-900">Aduan Publik Terkini</h3>
                    <a href="{{ route('home') }}" class="text-sm text-teal-600 hover:text-teal-700 font-medium">Lihat
                        Semua</a>
                </div>
                <p class="text-sm text-gray-600 mb-6">Pantau apa yang sedang terjadi di Sragen</p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @forelse($publicReports as $publicReport)
                        <a href="{{ route('reports.show', $publicReport->id) }}"
                            class="block p-4 border border-gray-200 rounded-lg hover:shadow-lg transition">
                            <div class="flex items-start space-x-3 mb-3">
                                <span
                                    class="px-2.5 py-0.5 rounded text-xs font-semibold {{ $publicReport->status == 'completed' ? 'bg-green-100 text-green-800' : ($publicReport->status == 'processing' ? 'bg-yellow-100 text-yellow-800' : 'bg-blue-100 text-blue-800') }}">
                                    {{ $publicReport->status_label }}
                                </span>
                            </div>
                            <h4 class="text-sm font-bold text-gray-900 mb-2 line-clamp-2">{{ $publicReport->title }}</h4>
                            <p class="text-xs text-gray-500 mb-2">{{ $publicReport->description }}</p>
                            <div class="flex items-center justify-between text-xs text-gray-500">
                                <div class="flex items-center space-x-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span>{{ $publicReport->district }}</span>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span>{{ $publicReport->created_at->format('d M Y') }}</span>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="col-span-3 text-center py-8">
                            <p class="text-sm text-gray-500">Belum ada laporan publik</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

@endsection
