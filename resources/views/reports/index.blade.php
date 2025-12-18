@extends('layouts.app')

@section('title', 'Riwayat Aduan Saya - SAPA Sragen')

@section('content')

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Riwayat Aduan Saya</h1>
                <p class="text-gray-600">Pantau perkembangan laporan yang telah Anda buat</p>
            </div>

            <form action="{{ route('reports.index') }}" method="GET">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                        <div class="md:col-span-5">
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Cari</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <input type="text" id="search" name="search" value="{{ request('search') }}"
                                    placeholder="ID Tiket atau Judul..."
                                    class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                            </div>
                        </div>

                        <div class="md:col-span-3">
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select id="status" name="status"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                                <option value="">Semua Status</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu
                                    Verifikasi</option>
                                <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Sedang Diproses
                                </option>
                                <option value="menunggu_validasi"
                                    {{ request('status') == 'menunggu_validasi' ? 'selected' : '' }}>Menunggu Validasi Admin
                                </option>
                                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai
                                </option>
                                <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak
                                </option>
                            </select>
                        </div>

                        <div class="md:col-span-4 flex items-end">
                            <button type="submit"
                                class="w-full bg-teal-600 hover:bg-teal-700 text-white font-medium px-4 py-2.5 rounded-lg transition">
                                Terapkan Filter
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            <div class="flex items-center justify-between mb-6">
                <div class="text-sm text-gray-600">
                    Menampilkan <span class="font-semibold">{{ $reports->count() }}</span> dari <span
                        class="font-semibold">{{ $reports->total() }}</span> laporan
                </div>
                <a href="{{ route('reports.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-blue-900 font-semibold rounded-lg transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Buat Aduan Baru
                </a>
            </div>

            <div class="space-y-4">
                @forelse($reports as $report)
                    @php
                        // Logika Warna Status Sederhana
                        $borderColor = 'border-gray-300';
                        $badgeColor = 'bg-gray-100 text-gray-800';
                        $statusLabel = 'Menunggu';

                        if ($report->status == 'pending') {
                            $borderColor = 'border-yellow-500';
                            $badgeColor = 'bg-yellow-100 text-yellow-800';
                            $statusLabel = 'Menunggu Verifikasi';
                        } elseif ($report->status == 'proses') {
                            $borderColor = 'border-blue-500';
                            $badgeColor = 'bg-blue-100 text-blue-800';
                            $statusLabel = 'Sedang Diproses';
                        } elseif ($report->status == 'menunggu_validasi') {
                            $borderColor = 'border-orange-500';
                            $badgeColor = 'bg-orange-100 text-orange-800';
                            $statusLabel = 'Menunggu Validasi Admin';
                        } elseif ($report->status == 'selesai') {
                            $borderColor = 'border-green-500';
                            $badgeColor = 'bg-green-100 text-green-800';
                            $statusLabel = 'Selesai';
                        } elseif ($report->status == 'ditolak') {
                            $borderColor = 'border-red-500';
                            $badgeColor = 'bg-red-100 text-red-800';
                            $statusLabel = 'Ditolak';
                        }
                    @endphp

                    <div class="bg-white rounded-lg shadow-sm border-l-4 {{ $borderColor }} hover:shadow-md transition">
                        <div class="p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-3 mb-2">
                                        <span
                                            class="px-3 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full">
                                            {{ optional($report->category)->name ?? 'Umum' }}
                                        </span>

                                        <span
                                            class="px-3 py-1 {{ $badgeColor }} text-xs font-semibold rounded-full uppercase">
                                            {{ $statusLabel }}
                                        </span>
                                    </div>

                                    <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $report->title }}</h3>

                                    <div class="flex items-center space-x-4 text-sm text-gray-500">
                                        <div class="flex items-center space-x-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                                </path>
                                            </svg>
                                            <span>#{{ $report->ticket_code }}</span>
                                        </div>

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
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                </path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            <span class="truncate max-w-xs">{{ $report->location }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-end">
                                <a href="{{ route('reports.show', $report->id) }}"
                                    class="inline-flex items-center text-teal-600 hover:text-teal-700 font-medium text-sm">
                                    <span>Lihat Detail</span>
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-lg shadow-sm p-8 text-center">
                        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Laporan</h3>
                        <p class="text-gray-600 mb-4">Anda belum memiliki laporan aduan.</p>
                        <a href="{{ route('reports.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-blue-900 font-semibold rounded-lg transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                                </path>
                            </svg>
                            Buat Aduan Baru
                        </a>
                    </div>
                @endforelse

                <div class="mt-8 flex items-center justify-center">
                    {{ $reports->links() }}
                </div>
            </div>
        </div>

    @endsection
