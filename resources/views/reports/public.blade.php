@extends('layouts.app')

@section('title', 'Aduan Publik - SAPA Sragen')

@section('content')

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Aduan Publik</h1>
                <p class="text-gray-600">Pantau aspirasi dan laporan dari seluruh masyarakat Kabupaten Sragen secara
                    transparan.</p>
            </div>

            <!-- Search & Filter Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                <form method="GET" action="{{ route('reports.public') }}" class="grid grid-cols-1 md:grid-cols-12 gap-4">
                    <!-- Search -->
                    <div class="md:col-span-4">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Cari Aduan</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" id="search" name="search" value="{{ request('search') }}"
                                placeholder="Kata kunci judul atau lokasi..."
                                class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                        </div>
                    </div>

                    <!-- Wilayah/Kecamatan Filter -->
                    <div class="md:col-span-3">
                        <label for="district" class="block text-sm font-medium text-gray-700 mb-2">Wilayah
                            Kecamatan</label>
                        <select id="district" name="district"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                            <option value="">Semua Kecamatan</option>
                            <option value="Masaran" {{ request('district') == 'Masaran' ? 'selected' : '' }}>Masaran
                            </option>
                            <option value="Sragen Kota" {{ request('district') == 'Sragen Kota' ? 'selected' : '' }}>Sragen
                                Kota</option>
                            <option value="Gondang" {{ request('district') == 'Gondang' ? 'selected' : '' }}>Gondang
                            </option>
                            <option value="Sambungmacan" {{ request('district') == 'Sambungmacan' ? 'selected' : '' }}>
                                Sambungmacan</option>
                            <option value="Kalijambe" {{ request('district') == 'Kalijambe' ? 'selected' : '' }}>Kalijambe
                            </option>
                            <option value="Plupuh" {{ request('district') == 'Plupuh' ? 'selected' : '' }}>Plupuh</option>
                            <option value="Sidoharjo" {{ request('district') == 'Sidoharjo' ? 'selected' : '' }}>Sidoharjo
                            </option>
                            <option value="Tanon" {{ request('district') == 'Tanon' ? 'selected' : '' }}>Tanon</option>
                            <option value="Gemolong" {{ request('district') == 'Gemolong' ? 'selected' : '' }}>Gemolong
                            </option>
                            <option value="Miri" {{ request('district') == 'Miri' ? 'selected' : '' }}>Miri</option>
                        </select>
                    </div>

                    <!-- Kategori Filter -->
                    <div class="md:col-span-3">
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <select id="category" name="category"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                            <option value="">Semua</option>
                            <option value="infrastruktur" {{ request('category') == 'infrastruktur' ? 'selected' : '' }}>
                                Infrastruktur</option>
                            <option value="kesehatan" {{ request('category') == 'kesehatan' ? 'selected' : '' }}>Kesehatan
                            </option>
                            <option value="lingkungan" {{ request('category') == 'lingkungan' ? 'selected' : '' }}>
                                Lingkungan</option>
                            <option value="keamanan" {{ request('category') == 'keamanan' ? 'selected' : '' }}>Keamanan
                            </option>
                            <option value="sosial" {{ request('category') == 'sosial' ? 'selected' : '' }}>Sosial</option>
                            <option value="administrasi" {{ request('category') == 'administrasi' ? 'selected' : '' }}>
                                Administrasi</option>
                        </select>
                    </div>

                    <!-- Filter Button -->
                    <div class="md:col-span-2 flex items-end">
                        <button type="submit"
                            class="w-full bg-blue-900 hover:bg-blue-800 text-white font-medium px-4 py-2.5 rounded-lg transition flex items-center justify-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                                </path>
                            </svg>
                            <span>Filter</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Reports Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                @forelse($reports as $report)
                    <div
                        class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg transition">
                        <!-- Image -->
                        <div class="relative h-48 bg-gray-200">
                            @if ($report->attachments && is_array($report->attachments) && count($report->attachments) > 0)
                                <img src="{{ Storage::url($report->attachments[0]['path']) }}" alt="{{ $report->title }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div
                                    class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                            @endif
                            <!-- Status Badge -->
                            <div class="absolute top-3 right-3">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $report->status_color }}">
                                    {{ $report->status_label }}
                                </span>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-5">
                            <!-- Category & Location -->
                            <div class="flex items-center space-x-2 mb-3">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                        </path>
                                    </svg>
                                    {{ ucfirst($report->category) }}
                                </span>
                                <span class="text-xs text-gray-500 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    {{ $report->district }}
                                </span>
                            </div>

                            <!-- Title -->
                            <h3 class="text-base font-bold text-gray-900 mb-2 line-clamp-2">{{ $report->title }}</h3>

                            <!-- Description -->
                            <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ $report->description }}</p>

                            <!-- Footer -->
                            <div class="flex items-center justify-between pt-3 border-t border-gray-200">
                                <div class="flex items-center space-x-2">
                                    <!-- Reporter -->
                                    <div class="flex items-center text-xs text-gray-600">
                                        <svg class="w-4 h-4 mr-1 text-teal-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                            </path>
                                        </svg>
                                        <span class="font-medium text-teal-700">
                                            {{ $report->is_anonymous ? 'Anonim' : ($report->user ? Str::limit($report->user->name, 15) : 'Pengguna') }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Date -->
                                <div class="flex items-center text-xs text-gray-500">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span>{{ $report->created_at->format('d M Y') }}</span>
                                </div>
                            </div>

                            <!-- View Detail Button -->
                            <a href="{{ route('reports.show', $report->id) }}"
                                class="mt-4 block w-full text-center bg-gray-50 hover:bg-teal-50 text-teal-700 font-medium py-2 rounded-lg transition border border-gray-200 hover:border-teal-500">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3">
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-12 text-center">
                            <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                </path>
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Tidak Ada Laporan</h3>
                            <p class="text-gray-600">Belum ada laporan publik yang sesuai dengan filter Anda.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($reports->hasPages())
                <div class="flex justify-center">
                    {{ $reports->links() }}
                </div>
            @endif
        </div>
    </div>

@endsection
