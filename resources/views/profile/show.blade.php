@extends('layouts.app')

@section('title', 'Profil Saya - SAPA Sragen')

@section('content')

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="mb-6">
                <h1 class="text-2xl font-semibold text-gray-900">Welcome, {{ $user->name }}</h1>
                <p class="text-sm text-gray-500">{{ now()->locale('id')->translatedFormat('l, d F Y') }}</p>
            </div>

            <!-- Profile Card (match design: top strip + overlap avatar) -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
                <div class="h-16 bg-linear-to-r from-teal-600 to-blue-900"></div>
                <div class="px-6 pb-6">
                    <div class="flex items-start justify-between gap-6">
                        <div class="flex items-start gap-4">
                            <!-- Avatar (overlap) -->
                            <div
                                class="-mt-10 w-16 h-16 rounded-full bg-white p-1 shadow-lg flex items-center justify-center">
                                @if ($user->ktp_photo)
                                    <img src="{{ Storage::url($user->ktp_photo) }}" alt="{{ $user->name }}"
                                        class="w-full h-full rounded-full object-cover">
                                @else
                                    <div class="w-full h-full rounded-full bg-gray-100 flex items-center justify-center">
                                        <span
                                            class="text-lg font-bold text-gray-700">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                    </div>
                                @endif
                            </div>

                            <!-- User Info -->
                            <div class="pt-2">
                                <h2 class="text-lg font-semibold text-gray-900">{{ $user->name }}</h2>
                                <p class="text-sm text-gray-500">{{ $user->email }}</p>
                            </div>
                        </div>

                        <!-- Edit Button -->
                        <a href="{{ route('profile.edit') }}"
                            class="mt-3 inline-flex items-center px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-sm transition">
                            Edit
                        </a>
                    </div>
                </div>
            </div>

            <!-- Success Message -->
            @if (session('success'))
                <div
                    class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Laporan Anda Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Laporan Anda</h3>
                </div>

                <div class="p-6 space-y-4">
                    @forelse($reports as $report)
                        @php
                            // Status badge color
                            $badgeColor = 'bg-gray-100 text-gray-800';
                            $statusLabel = 'Menunggu';
                            $leftBorderColor = 'border-yellow-500';

                            if ($report->status == 'pending') {
                                $badgeColor = 'bg-yellow-100 text-yellow-800';
                                $statusLabel = 'MENUNGGU VERIFIKASI';
                                $leftBorderColor = 'border-yellow-500';
                            } elseif ($report->status == 'proses') {
                                $badgeColor = 'bg-blue-100 text-blue-800';
                                $statusLabel = 'SEDANG DIPROSES';
                                $leftBorderColor = 'border-blue-500';
                            } elseif ($report->status == 'menunggu_validasi') {
                                $badgeColor = 'bg-orange-100 text-orange-800';
                                $statusLabel = 'SELESAI DIKERJAKAN';
                                $leftBorderColor = 'border-orange-500';
                            } elseif ($report->status == 'selesai') {
                                $badgeColor = 'bg-green-100 text-green-800';
                                $statusLabel = 'SELESAI';
                                $leftBorderColor = 'border-green-500';
                            } elseif ($report->status == 'ditolak') {
                                $badgeColor = 'bg-red-100 text-red-800';
                                $statusLabel = 'DITOLAK';
                                $leftBorderColor = 'border-red-500';
                            }
                        @endphp

                        <div class="border border-gray-200 rounded-lg bg-white overflow-hidden">
                            <div class="border-l-4 {{ $leftBorderColor }} px-6 py-4">
                                <div class="flex items-start justify-between gap-6">
                                    <div class="min-w-0">
                                        <div class="flex flex-wrap items-center gap-2 mb-2">
                                            <span
                                                class="text-xs font-semibold text-gray-500">#{{ $report->ticket_code }}</span>
                                            <span
                                                class="px-2.5 py-0.5 rounded-full text-[11px] font-bold {{ $badgeColor }}">
                                                {{ $statusLabel }}
                                            </span>
                                        </div>

                                        <h4 class="text-base font-semibold text-gray-900 mb-2">{{ $report->title }}</h4>

                                        <div class="flex flex-wrap items-center gap-x-5 gap-y-2 text-sm text-gray-600">
                                            <div class="flex items-center space-x-1.5">
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                                <span>{{ $report->created_at->format('d M Y') }}</span>
                                            </div>

                                            <div class="flex items-center space-x-1.5">
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                                    </path>
                                                </svg>
                                                <span>{{ optional($report->category)->name ?? 'Umum' }}</span>
                                            </div>

                                            @if ($report->location)
                                                <div class="flex items-center space-x-1.5">
                                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                        </path>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    </svg>
                                                    <span class="truncate"
                                                        title="{{ $report->location }}">{{ \Illuminate\Support\Str::limit($report->location, 35) }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <a href="{{ route('reports.show', $report->id) }}"
                                        class="inline-flex items-center justify-center px-4 py-2 border border-blue-600 text-blue-600 hover:bg-blue-50 text-sm font-semibold rounded-full transition shrink-0">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-16 bg-gray-50 rounded-lg">
                            <div class="max-w-sm mx-auto">
                                <svg class="w-20 h-20 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum ada laporan</h3>
                                <p class="text-sm text-gray-500 mb-6">Yuk mulai dengan membuat laporan pertama Anda untuk
                                    menyampaikan keluhan atau aspirasi</p>
                                <a href="{{ route('reports.create') }}"
                                    class="inline-flex items-center px-6 py-3 bg-teal-600 hover:bg-teal-700 text-white font-semibold rounded-lg shadow-sm transition">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Buat Laporan Baru
                                </a>
                            </div>
                        </div>
                    @endforelse

                    @if ($reports->total() > 0)
                        <div class="pt-2">
                            <a href="{{ route('reports.create') }}"
                                class="text-sm text-teal-700 hover:text-teal-800 font-medium">
                                +Tambah Laporan
                            </a>
                        </div>
                    @endif

                    <!-- Pagination -->
                    @if ($reports->hasPages())
                        <div class="mt-6 border-t border-gray-200 pt-6">
                            {{ $reports->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
