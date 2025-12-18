@extends('layouts.app')

@section('title', 'Detail Aduan - SAPA Sragen')

@section('content')

    <div class="py-8 bg-gradient-to-br from-gray-50 to-blue-50 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('reports.index') }}"
                    class="inline-flex items-center text-gray-600 hover:text-blue-700 font-medium transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-5">
                    <!-- Header Card -->
                    <div class="bg-gradient-to-br from-blue-900 via-blue-800 to-blue-950 rounded-2xl shadow-lg overflow-hidden">
                        <div class="p-6 md:p-8">
                            <div class="flex flex-wrap items-center gap-2 mb-4">
                                <span class="px-4 py-1.5 bg-white/20 backdrop-blur-sm text-white text-xs font-semibold rounded-full border border-white/30">
                                    {{ optional($report->category)->name ?? 'Umum' }}
                                </span>

                                @php
                                    $statusConfig = [
                                        'pending' => ['class' => 'bg-yellow-400 text-yellow-900', 'label' => 'Menunggu'],
                                        'proses' => ['class' => 'bg-blue-400 text-blue-900', 'label' => 'Sedang Diproses'],
                                        'selesai' => ['class' => 'bg-green-400 text-green-900', 'label' => 'Selesai'],
                                        'ditolak' => ['class' => 'bg-red-400 text-red-900', 'label' => 'Ditolak'],
                                    ];
                                    $status = $statusConfig[$report->status] ?? $statusConfig['pending'];
                                @endphp
                                <span class="px-4 py-1.5 {{ $status['class'] }} text-xs font-bold rounded-full">
                                    {{ $status['label'] }}
                                </span>
                            </div>

                            <h1 class="text-2xl md:text-3xl font-bold text-white mb-4 leading-tight">
                                {{ $report->title }}
                            </h1>
                            
                            <div class="flex flex-wrap items-center gap-4 text-sm text-blue-100">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span>{{ $report->created_at->format('d M Y') }}</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span>{{ optional($report->category)->name ?? 'Lingkungan' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi Laporan -->
                    <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
                        <div class="p-6">
                            <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                                <span class="w-1 h-6 bg-blue-600 rounded-full mr-3"></span>
                                Deskripsi Laporan
                            </h2>
                            <p class="text-gray-700 leading-relaxed whitespace-pre-line">
                                {{ $report->description }}
                            </p>
                        </div>
                    </div>

                    <!-- Lokasi Kejadian -->
                    <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
                        <div class="p-6">
                            <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                                <span class="w-1 h-6 bg-blue-600 rounded-full mr-3"></span>
                                Lokasi Kejadian
                            </h2>
                            <div class="flex items-start space-x-3 bg-gray-50 p-4 rounded-lg border border-gray-200">
                                <svg class="w-5 h-5 text-blue-600 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <div>
                                    <p class="font-medium text-gray-900">{{ $report->location }}</p>
                                    <p class="text-sm text-gray-500 mt-1">Kec. Sragen Kulon, Kab. Sragen</p>
                                </div>
                            </div>
                            
                            <!-- Map Placeholder (jika ada) -->
                            <div class="mt-4 bg-gray-200 rounded-lg overflow-hidden h-48 flex items-center justify-center">
                                <div class="text-center text-gray-500">
                                    <svg class="w-12 h-12 mx-auto mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                                    </svg>
                                    <p class="text-sm">Peta lokasi</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bukti Lampiran -->
                    @if($report->image)
                    <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
                        <div class="p-6">
                            <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                                <span class="w-1 h-6 bg-blue-600 rounded-full mr-3"></span>
                                Bukti Lampiran
                            </h2>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="relative group">
                                    <img src="{{ asset('storage/' . $report->image) }}"
                                        alt="Foto Bukti 1" 
                                        class="w-full h-48 object-cover rounded-lg border border-gray-200 cursor-pointer hover:shadow-lg transition"
                                        onclick="window.open(this.src)">
                                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition rounded-lg flex items-center justify-center">
                                        <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="relative bg-gray-100 rounded-lg border border-gray-200 h-48 flex items-center justify-center">
                                    <div class="text-center text-gray-400">
                                        <svg class="w-10 h-10 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <p class="text-xs">Foto Bukti 2</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="space-y-5">
                    <!-- Status Laporan -->
                    <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
                        <div class="bg-gradient-to-r from-blue-600 to-blue-700 p-4">
                            <h3 class="text-lg font-bold text-white flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Status Laporan
                            </h3>
                        </div>
                        <div class="p-5">
                            <div class="space-y-5">
                                <!-- Step 1 -->
                                <div class="flex items-start space-x-3">
                                    <div class="relative">
                                        <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white shadow-lg">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        @if($report->status != 'pending')
                                        <div class="absolute top-10 left-1/2 transform -translate-x-1/2 w-0.5 h-10 bg-green-500"></div>
                                        @else
                                        <div class="absolute top-10 left-1/2 transform -translate-x-1/2 w-0.5 h-10 bg-gray-300"></div>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-bold text-gray-900">Laporan Diterima</p>
                                        <p class="text-xs text-gray-500 mt-1">{{ $report->created_at->format('d M Y, H:i') }} WIB</p>
                                    </div>
                                </div>

                                <!-- Step 2 -->
                                <div class="flex items-start space-x-3">
                                    <div class="relative">
                                        @if(in_array($report->status, ['proses', 'selesai']))
                                        <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white shadow-lg">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        @else
                                        <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-gray-600">
                                            <span class="font-bold text-sm">2</span>
                                        </div>
                                        @endif
                                        @if($report->status == 'selesai')
                                        <div class="absolute top-10 left-1/2 transform -translate-x-1/2 w-0.5 h-10 bg-green-500"></div>
                                        @else
                                        <div class="absolute top-10 left-1/2 transform -translate-x-1/2 w-0.5 h-10 bg-gray-300"></div>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-bold {{ in_array($report->status, ['proses', 'selesai']) ? 'text-gray-900' : 'text-gray-400' }}">
                                            @if($report->status == 'proses')
                                                Diverifikasi Admin
                                            @else
                                                Sedang Diproses
                                            @endif
                                        </p>
                                        <p class="text-xs text-gray-500 mt-1">
                                            @if(in_array($report->status, ['proses', 'selesai']))
                                                Laporan valid dan diteruskan ke sistem.
                                            @else
                                                Menunggu verifikasi petugas.
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <!-- Step 3 -->
                                <div class="flex items-start space-x-3">
                                    <div class="relative">
                                        @if($report->status == 'selesai')
                                        <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white shadow-lg">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        @else
                                        <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-gray-600">
                                            <span class="font-bold text-sm">3</span>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-bold {{ $report->status == 'selesai' ? 'text-gray-900' : 'text-gray-400' }}">Selesai</p>
                                        <p class="text-xs text-gray-500 mt-1">Laporan telah ditangani.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kode Tiket -->
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 border-2 border-blue-200 rounded-xl p-5 shadow-md">
                        <div class="flex items-start space-x-3">
                            <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="font-bold text-blue-900 text-sm mb-1">Kode Tiket Anda</p>
                                <p class="text-blue-700 font-mono text-xl font-bold tracking-wider">{{ $report->ticket_code }}</p>
                                <p class="text-xs text-blue-600 mt-2">Simpan kode ini untuk tracking laporan</p>
                            </div>
                        </div>
                    </div>

                    <!-- Cetak Bukti Button -->
                    <button class="w-full bg-white hover:bg-gray-50 border-2 border-gray-200 text-gray-700 font-semibold py-3 px-4 rounded-xl transition flex items-center justify-center shadow-md">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                        Cetak Bukti
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection