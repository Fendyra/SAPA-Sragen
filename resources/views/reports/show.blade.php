@extends('layouts.app')

@section('title', 'Detail Aduan - SAPA Sragen')

@section('content')

    @php
        $statusMeta = match ($report->status) {
            'pending' => ['label' => 'Menunggu Verifikasi Admin', 'pill' => 'bg-yellow-500 text-blue-900'],
            'proses' => ['label' => 'Sedang Diproses', 'pill' => 'bg-blue-500 text-white'],
            'menunggu_validasi' => ['label' => 'Menunggu Validasi Admin', 'pill' => 'bg-orange-500 text-white'],
            'selesai' => ['label' => 'Selesai', 'pill' => 'bg-green-500 text-white'],
            'ditolak' => ['label' => 'Ditolak', 'pill' => 'bg-red-500 text-white'],
            default => ['label' => ucfirst((string) $report->status), 'pill' => 'bg-gray-500 text-white'],
        };

        $timelineStep = match ($report->status) {
            'pending' => 1,
            'proses' => 3,
            'menunggu_validasi' => 4,
            'selesai' => 5,
            'ditolak' => 2,
            default => 1,
        };

        $timeline = [
            [
                'title' => 'Laporan Dikirim',
                'desc' => 'Laporan berhasil masuk ke sistem.',
                'time' => optional($report->created_at)?->format('d M Y, H:i'),
            ],
            [
                'title' => 'Diverifikasi Admin',
                'desc' => 'Laporan valid dan diteruskan ke instansi terkait.',
                'time' => $timelineStep >= 2 ? optional($report->updated_at)?->format('d M Y, H:i') : null,
            ],
            [
                'title' => 'Sedang Tindak Lanjut',
                'desc' => 'Petugas melakukan tindak lanjut sesuai laporan.',
                'time' => $timelineStep >= 3 ? optional($report->updated_at)?->format('d M Y, H:i') : null,
            ],
            [
                'title' => 'Menunggu Validasi Admin',
                'desc' => 'Tindak lanjut selesai, menunggu validasi dari admin.',
                'time' => $timelineStep >= 4 ? optional($report->updated_at)?->format('d M Y, H:i') : null,
            ],
            [
                'title' => 'Selesai',
                'desc' => 'Laporan telah divalidasi dan ditutup.',
                'time' => $timelineStep >= 5 ? optional($report->updated_at)?->format('d M Y, H:i') : null,
            ],
        ];
    @endphp

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-6">
                <a href="{{ route('reports.index') }}"
                    class="inline-flex items-center text-gray-600 hover:text-gray-900 font-medium">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>

                <button type="button" onclick="window.print()"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition text-sm font-medium">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 9V2h12v7M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2M6 14h12v8H6v-8z">
                        </path>
                    </svg>
                    Cetak Bukti
                </button>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-blue-900 p-6 text-white">
                            <p class="text-xs font-semibold text-blue-100">#{{ $report->ticket_code }}</p>
                            <h1 class="text-2xl font-bold mt-1">{{ $report->title }}</h1>

                            <div class="flex items-center flex-wrap gap-2 mt-3">
                                <span class="px-3 py-1 bg-white/10 text-white text-xs font-semibold rounded-full">
                                    {{ optional($report->category)->name ?? 'Umum' }}
                                </span>
                                <span class="px-3 py-1 {{ $statusMeta['pill'] }} text-xs font-semibold rounded-full">
                                    {{ $statusMeta['label'] }}
                                </span>
                            </div>

                            <div class="flex items-center gap-4 text-sm text-blue-100 mt-4">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span>{{ $report->created_at->format('d M Y') }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 space-y-8">
                            <div>
                                <h2 class="text-base font-bold text-gray-900 mb-3">Deskripsi Laporan</h2>
                                <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $report->description }}</p>
                            </div>

                            <div>
                                <h2 class="text-base font-bold text-gray-900 mb-3 mt-4">Lokasi Kejadian</h2>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="text-gray-700">
                                        <div class="flex items-start gap-2">
                                            <svg class="w-5 h-5 text-teal-600 mt-0.5 shrink-0" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                </path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            <div>
                                                <p class="font-medium">{{ $report->location }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="rounded-lg border border-gray-200 overflow-hidden bg-gray-50">
                                        <iframe title="Peta lokasi" class="w-full h-48" loading="lazy"
                                            referrerpolicy="no-referrer-when-downgrade"
                                            src="https://www.google.com/maps?q={{ urlencode($report->location) }}&output=embed"></iframe>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h2 class="text-base font-bold text-gray-900 mb-3 mt-4">Bukti Lampiran</h2>

                                @php
                                    $evidence = [];
                                    if (!empty($report->images) && is_array($report->images)) {
                                        $evidence = $report->images;
                                    } elseif (!empty($report->image)) {
                                        $evidence = [$report->image];
                                    }
                                @endphp

                                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                    @forelse($evidence as $index => $image)
                                        <a href="{{ asset('storage/' . $image) }}" target="_blank" rel="noopener"
                                            class="block rounded-lg border border-gray-200 overflow-hidden bg-white hover:opacity-95 transition">
                                            <div class="aspect-square bg-gray-100">
                                                <img src="{{ asset('storage/' . $image) }}"
                                                    alt="Foto Bukti {{ $index + 1 }}"
                                                    class="w-full h-full object-cover">
                                            </div>
                                            <div class="p-2 text-center">
                                                <p class="text-xs font-medium text-gray-600">Foto Bukti {{ $index + 1 }}
                                                </p>
                                            </div>
                                        </a>
                                    @empty
                                        @for ($i = 1; $i <= 2; $i++)
                                            <div class="rounded-lg border border-gray-200 bg-gray-100 overflow-hidden">
                                                <div class="aspect-square flex items-center justify-center">
                                                    <p class="text-xs font-medium text-gray-400">Foto Bukti
                                                        {{ $i }}</p>
                                                </div>
                                            </div>
                                        @endfor
                                    @endforelse
                                </div>
                            </div>

                            <div>
                                <h2 class="text-base font-bold text-gray-900 mb-3 mt-4">Progres Penanganan</h2>

                                <div class="space-y-4">
                                    @forelse($report->responses->sortBy('created_at') as $response)
                                        @php
                                            $progressEvidence = [];
                                            if (!empty($response->images) && is_array($response->images)) {
                                                $progressEvidence = $response->images;
                                            }
                                        @endphp

                                        <div class="rounded-lg border border-gray-200 bg-white p-4">
                                            <div class="flex items-start justify-between gap-4">
                                                <div>
                                                    <p class="text-sm font-semibold text-gray-900">
                                                        {{ optional($response->user)->name ?? 'Petugas' }}
                                                        @if (!empty(optional($response->user)->role))
                                                            <span
                                                                class="text-xs font-medium text-gray-500">({{ optional($response->user)->role }})</span>
                                                        @endif
                                                    </p>
                                                    <p class="text-xs text-gray-500 mt-1">
                                                        {{ optional($response->created_at)?->format('d M Y, H:i') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <p class="text-sm text-gray-700 mt-3 whitespace-pre-line">
                                                {{ $response->response }}</p>

                                            @if (!empty($progressEvidence))
                                                <div class="grid grid-cols-2 md:grid-cols-3 gap-3 mt-4">
                                                    @foreach ($progressEvidence as $idx => $img)
                                                        <a href="{{ asset('storage/' . $img) }}" target="_blank"
                                                            rel="noopener"
                                                            class="block rounded-lg border border-gray-200 overflow-hidden bg-white hover:opacity-95 transition">
                                                            <div class="aspect-square bg-gray-100">
                                                                <img src="{{ asset('storage/' . $img) }}"
                                                                    alt="Bukti Progres {{ $idx + 1 }}"
                                                                    class="w-full h-full object-cover">
                                                            </div>
                                                        </a>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    @empty
                                        <div class="rounded-lg border border-gray-200 bg-gray-50 p-4">
                                            <p class="text-sm text-gray-600">Belum ada update progres dari petugas.</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-bold text-gray-900">Status Laporan</h3>
                        </div>

                        <div class="space-y-6">
                            @foreach ($timeline as $idx => $step)
                                @php
                                    $number = $idx + 1;
                                    $isCompleted = $number < $timelineStep;
                                    $isCurrent = $number === $timelineStep;
                                    $isUpcoming = $number > $timelineStep;

                                    $circleClass = 'bg-gray-200 text-gray-400';
                                    if ($report->status === 'ditolak' && $number === 2) {
                                        $circleClass = 'bg-red-500 text-white';
                                    } elseif ($isCompleted) {
                                        $circleClass = 'bg-blue-600 text-white';
                                    } elseif ($isCurrent) {
                                        $circleClass = 'bg-teal-600 text-white';
                                    }

                                    $lineClass = $isCompleted ? 'bg-blue-600' : 'bg-gray-300';
                                @endphp

                                <div class="flex items-start space-x-3">
                                    <div class="relative">
                                        <div
                                            class="w-10 h-10 {{ $circleClass }} rounded-full flex items-center justify-center">
                                            @if ($report->status === 'ditolak' && $number === 2)
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            @elseif($isCompleted)
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            @elseif($isCurrent)
                                                <span class="font-bold">{{ $number }}</span>
                                            @else
                                                <span class="font-bold">{{ $number }}</span>
                                            @endif
                                        </div>

                                        @if ($number < count($timeline))
                                            <div
                                                class="absolute top-10 left-1/2 transform -translate-x-1/2 w-0.5 h-8 {{ $lineClass }}">
                                            </div>
                                        @endif
                                    </div>

                                    <div class="flex-1 pt-1">
                                        <p class="font-semibold {{ $isUpcoming ? 'text-gray-400' : 'text-gray-900' }}">
                                            {{ $step['title'] }}</p>
                                        <p class="text-xs text-gray-500 mt-1">{{ $step['desc'] }}</p>
                                        @if (!empty($step['time']) && !$isUpcoming)
                                            <p class="text-xs text-gray-500 mt-1">{{ $step['time'] }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
