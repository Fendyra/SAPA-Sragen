@extends('layouts.app')

@section('title', 'Detail Aduan - SAPA Sragen')

@section('content')

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('reports.index') }}"
                    class="inline-flex items-center text-gray-600 hover:text-gray-900 font-medium">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Daftar
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-gradient-to-r from-blue-900 to-blue-700 rounded-lg shadow-sm p-6 text-white">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <div class="flex items-center space-x-2 mb-3">
                                    <span class="px-3 py-1 bg-white/20 backdrop-blur-sm text-white text-xs font-semibold rounded-full">
                                        {{ optional($report->category)->name ?? 'Umum' }}
                                    </span>

                                    @php
                                        $statusClass = 'bg-gray-500';
                                        $statusLabel = 'Menunggu';
                                        
                                        if($report->status == 'proses') {
                                            $statusClass = 'bg-blue-500';
                                            $statusLabel = 'Diproses';
                                        } elseif($report->status == 'selesai') {
                                            $statusClass = 'bg-green-500';
                                            $statusLabel = 'Selesai';
                                        } elseif($report->status == 'ditolak') {
                                            $statusClass = 'bg-red-500';
                                            $statusLabel = 'Ditolak';
                                        }
                                    @endphp
                                    <span class="px-3 py-1 {{ $statusClass }} text-xs font-semibold rounded-full">
                                        {{ $statusLabel }}
                                    </span>
                                </div>

                                <h1 class="text-2xl font-bold mb-2">{{ $report->title }}</h1>
                                
                                <div class="flex items-center space-x-4 text-sm text-blue-100">
                                    <div class="flex items-center space-x-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <span>{{ $report->created_at->format('d M Y') }}</span>
                                    </div>
                                    <div class="flex items-center space-x-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                        </svg>
                                        <span>#{{ $report->ticket_code }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <h2 class="text-lg font-bold text-gray-900 mb-4">Deskripsi Laporan</h2>
                        <p class="text-gray-700 leading-relaxed whitespace-pre-line">
                            {{ $report->description }}
                        </p>
                    </div>

                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <h2 class="text-lg font-bold text-gray-900 mb-4">Lokasi Kejadian</h2>
                        <div class="mb-4">
                            <div class="flex items-start space-x-2 text-gray-700">
                                <svg class="w-5 h-5 text-teal-600 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <div>
                                    <p class="font-medium">{{ $report->location }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($report->image)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <h2 class="text-lg font-bold text-gray-900 mb-4">Bukti Lampiran</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="relative group">
                                <img src="{{ asset('storage/' . $report->image) }}"
                                    alt="Foto Bukti" class="w-full h-64 object-cover rounded-lg border border-gray-200 cursor-pointer hover:opacity-90 transition"
                                    onclick="window.open(this.src)">
                                
                                <div class="absolute bottom-2 left-2 bg-black bg-opacity-70 text-white px-2 py-1 rounded text-xs">
                                    Klik untuk memperbesar
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="space-y-6">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-bold text-gray-900">Status Laporan</h3>
                        </div>

                        <div class="space-y-6">
                            <div class="flex items-start space-x-3">
                                <div class="relative">
                                    <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    </div>
                                    <div class="absolute top-10 left-1/2 transform -translate-x-1/2 w-0.5 h-8 {{ $report->status != 'pending' ? 'bg-green-500' : 'bg-gray-300' }}"></div>
                                </div>
                                <div class="flex-1 pt-1">
                                    <p class="font-semibold text-gray-900">Laporan Diterima</p>
                                    <p class="text-xs text-gray-500 mt-1">{{ $report->created_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-3">
                                <div class="relative">
                                    <div class="w-10 h-10 {{ in_array($report->status, ['proses', 'selesai']) ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-400' }} rounded-full flex items-center justify-center">
                                        @if(in_array($report->status, ['proses', 'selesai']))
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        @else
                                            <span class="font-bold">2</span>
                                        @endif
                                    </div>
                                    <div class="absolute top-10 left-1/2 transform -translate-x-1/2 w-0.5 h-8 {{ $report->status == 'selesai' ? 'bg-green-500' : 'bg-gray-300' }}"></div>
                                </div>
                                <div class="flex-1 pt-1">
                                    <p class="font-semibold {{ in_array($report->status, ['proses', 'selesai']) ? 'text-gray-900' : 'text-gray-400' }}">Sedang Diproses</p>
                                    <p class="text-xs text-gray-500 mt-1">Laporan sedang ditindaklanjuti oleh petugas.</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-3">
                                <div class="relative">
                                    <div class="w-10 h-10 {{ $report->status == 'selesai' ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-400' }} rounded-full flex items-center justify-center">
                                        @if($report->status == 'selesai')
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        @else
                                            <span class="font-bold">3</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex-1 pt-1">
                                    <p class="font-semibold {{ $report->status == 'selesai' ? 'text-gray-900' : 'text-gray-400' }}">Selesai</p>
                                    <p class="text-xs text-gray-500 mt-1">Laporan telah ditangani.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-blue-600 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="text-sm">
                                <p class="font-semibold text-blue-900 mb-1">Kode Tiket Anda</p>
                                <p class="text-blue-700 font-mono text-lg">{{ $report->ticket_code }}</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection