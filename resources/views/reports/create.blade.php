@extends('layouts.app')

@section('title', 'Sampaikan Laporan Anda - SAPA Sragen')

@section('content')

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center text-gray-600 hover:text-gray-900 font-medium">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Dashboard
                </a>
            </div>

            <!-- Header -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                <h1 class="text-2xl font-bold text-gray-900 mb-2">Sampaikan Laporan Anda</h1>
                <p class="text-gray-600">Isi formulir di bawah ini dengan data yang lengkap dan valid</p>
            </div>

            <!-- Form -->
            <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Informasi Aduan Section -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 bg-teal-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        <h2 class="text-lg font-bold text-gray-900">Informasi Aduan</h2>
                    </div>

                    <!-- Judul Laporan -->
                    <div class="mb-5">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            Judul Laporan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="title" name="title"
                            placeholder="Contoh: Jalan Berlubang di Kec. Masaran"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('title') border-red-500 @enderror"
                            value="{{ old('title') }}" required>
                        <p class="text-xs text-gray-500 mt-1">Singkat, jelas dan menggambarkan inti masalah</p>
                        @error('title')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div class="mb-5">
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <select id="category" name="category"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('category') border-red-500 @enderror"
                            required>
                            <option value="">Pilih Kategori Laporan</option>
                            <option value="infrastruktur" {{ old('category') == 'infrastruktur' ? 'selected' : '' }}>
                                Infrastruktur</option>
                            <option value="kesehatan" {{ old('category') == 'kesehatan' ? 'selected' : '' }}>Kesehatan
                            </option>
                            <option value="lingkungan" {{ old('category') == 'lingkungan' ? 'selected' : '' }}>Lingkungan
                            </option>
                            <option value="keamanan" {{ old('category') == 'keamanan' ? 'selected' : '' }}>Keamanan</option>
                            <option value="sosial" {{ old('category') == 'sosial' ? 'selected' : '' }}>Sosial</option>
                            <option value="administrasi" {{ old('category') == 'administrasi' ? 'selected' : '' }}>
                                Administrasi</option>
                        </select>
                        @error('category')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi Lengkap -->
                    <div class="mb-5">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Deskripsi Lengkap <span class="text-red-500">*</span>
                        </label>
                        <textarea id="description" name="description" rows="6"
                            placeholder="Jelaskan kronologi, penyebab (jika tahu), dan dampak yang terjadi..."
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('description') border-red-500 @enderror"
                            required>{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Lokasi Kejadian Section -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <h2 class="text-lg font-bold text-gray-900">Lokasi Kejadian</h2>
                    </div>

                    <!-- Titik Lokasi di Peta -->
                    <div class="mb-5">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Titik Lokasi di Peta <span class="text-red-500">*</span>
                        </label>
                        <p class="text-xs text-gray-500 mb-3">Geser peta atau klik di mencari lokasi yang tepat</p>

                        <!-- Map Container -->
                        <div class="border-2 border-dashed border-gray-300 rounded-lg overflow-hidden bg-gray-50"
                            style="height: 300px;">
                            <div id="map" class="w-full h-full relative">
                                <!-- Placeholder for map -->
                                <img src="https://api.mapbox.com/styles/v1/mapbox/streets-v11/static/110.8456,-7.4461,13,0/600x300@2x?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw"
                                    alt="Map" class="w-full h-full object-cover">
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <div class="bg-white rounded-lg shadow-lg p-4 text-center">
                                        <svg class="w-8 h-8 text-teal-600 mx-auto mb-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        <p class="text-sm text-gray-700">Klik untuk menandai lokasi</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="latitude" name="latitude" value="{{ old('latitude') }}">
                        <input type="hidden" id="longitude" name="longitude" value="{{ old('longitude') }}">
                    </div>

                    <!-- Grid for Kecamatan, Kelurahan, Detail Alamat -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                        <!-- Kecamatan -->
                        <div>
                            <label for="district" class="block text-sm font-medium text-gray-700 mb-2">
                                Kecamatan <span class="text-red-500">*</span>
                            </label>
                            <select id="district" name="district"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('district') border-red-500 @enderror"
                                required>
                                <option value="">Pilih Kecamatan</option>
                                <option value="sragen" {{ old('district') == 'sragen' ? 'selected' : '' }}>Sragen</option>
                                <option value="kedawung" {{ old('district') == 'kedawung' ? 'selected' : '' }}>Kedawung
                                </option>
                                <option value="kalijambe" {{ old('district') == 'kalijambe' ? 'selected' : '' }}>Kalijambe
                                </option>
                                <option value="plupuh" {{ old('district') == 'plupuh' ? 'selected' : '' }}>Plupuh</option>
                                <option value="masaran" {{ old('district') == 'masaran' ? 'selected' : '' }}>Masaran
                                </option>
                                <option value="sidoharjo" {{ old('district') == 'sidoharjo' ? 'selected' : '' }}>Sidoharjo
                                </option>
                                <option value="tanon" {{ old('district') == 'tanon' ? 'selected' : '' }}>Tanon</option>
                                <option value="gemolong" {{ old('district') == 'gemolong' ? 'selected' : '' }}>Gemolong
                                </option>
                            </select>
                            @error('district')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kelurahan/Desa -->
                        <div>
                            <label for="village" class="block text-sm font-medium text-gray-700 mb-2">
                                Kelurahan/Desa <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="village" name="village" placeholder="Nama Desa/Kelurahan"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('village') border-red-500 @enderror"
                                value="{{ old('village') }}" required>
                            @error('village')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Detail Alamat -->
                    <div class="mb-5">
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                            Detail Alamat <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="address" name="address"
                            placeholder="Contoh: Jl. Sukawati No. 13, dekat Indomaret ABC"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('address') border-red-500 @enderror"
                            value="{{ old('address') }}" required>
                        @error('address')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Bukti Pendukung Section -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <h2 class="text-lg font-bold text-gray-900">Bukti Pendukung</h2>
                    </div>

                    <!-- Upload Area -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Upload Foto/File
                        </label>
                        <div
                            class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-teal-500 transition cursor-pointer bg-gray-50">
                            <input type="file" id="files" name="files[]" multiple accept="image/*,.pdf"
                                class="hidden" onchange="handleFileSelect(event)">
                            <label for="files" class="cursor-pointer">
                                <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                    </path>
                                </svg>
                                <p class="text-sm font-medium text-gray-900 mb-1">Tarik & Lepas File di sini</p>
                                <p class="text-xs text-gray-500 mb-1">atau klik untuk memilih file dari perangkat Anda</p>
                            </label>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">Format yang diizinkan: JPG, PNG, PDF. Max. 5MB per file</p>
                    </div>

                    <!-- File Preview Area -->
                    <div id="file-preview" class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4 hidden">
                        <!-- Files will be displayed here -->
                    </div>
                </div>

                <!-- Lapor sebagai Anonim -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                    <div class="flex items-start">
                        <input type="checkbox" id="is_anonymous" name="is_anonymous" value="1"
                            class="mt-1 w-4 h-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500"
                            {{ old('is_anonymous') ? 'checked' : '' }}>
                        <label for="is_anonymous" class="ml-3">
                            <span class="block text-sm font-medium text-gray-900">Lapor sebagai Anonim</span>
                            <span class="block text-xs text-gray-500 mt-1">Nama Anda akan muncul pada detail laporan, namun
                                hanya bisa dilihat admin</span>
                        </label>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end space-x-4">
                    <a href="{{ route('dashboard') }}"
                        class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-8 py-2.5 bg-yellow-500 hover:bg-yellow-600 text-blue-900 font-semibold rounded-lg transition flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        <span>Kirim Laporan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            function handleFileSelect(event) {
                const files = event.target.files;
                const preview = document.getElementById('file-preview');

                if (files.length > 0) {
                    preview.classList.remove('hidden');
                    preview.innerHTML = '';

                    Array.from(files).forEach((file, index) => {
                        const div = document.createElement('div');
                        div.className = 'relative bg-gray-100 rounded-lg p-4 border border-gray-200';

                        if (file.type.startsWith('image/')) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                div.innerHTML = `
                        <img src="${e.target.result}" class="w-full h-24 object-cover rounded mb-2">
                        <p class="text-xs text-gray-600 truncate">${file.name}</p>
                        <button type="button" onclick="removeFile(${index})" class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    `;
                            };
                            reader.readAsDataURL(file);
                        } else {
                            div.innerHTML = `
                    <div class="flex items-center justify-center h-24 mb-2">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <p class="text-xs text-gray-600 truncate">${file.name}</p>
                    <button type="button" onclick="removeFile(${index})" class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                `;
                        }

                        preview.appendChild(div);
                    });
                }
            }

            function removeFile(index) {
                // Implementation for removing specific file
                const input = document.getElementById('files');
                const dt = new DataTransfer();
                const files = input.files;

                for (let i = 0; i < files.length; i++) {
                    if (i !== index) {
                        dt.items.add(files[i]);
                    }
                }

                input.files = dt.files;
                handleFileSelect({
                    target: input
                });
            }
        </script>
    @endpush

@endsection
