@extends('layouts.app')

@section('title', 'Sampaikan Laporan Anda - SAPA Sragen')

@section('content')

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <strong class="font-bold">Gagal Mengirim!</strong>
                    <span class="block sm:inline">Mohon periksa inputan berikut:</span>
                    <ul class="mt-1 list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

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

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                <h1 class="text-2xl font-bold text-gray-900 mb-2">Sampaikan Laporan Anda</h1>
                <p class="text-gray-600">Isi formulir di bawah ini dengan data yang lengkap dan valid</p>
            </div>

            <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

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

                    <div class="mb-5">
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        @php
                            $categoryInfo = $categories->map(function ($c) {
                                return [
                                    'id' => $c->id,
                                    'name' => $c->name,
                                    'description' => $c->description,
                                    'examples' => $c->examples,
                                    'opd_target' => $c->opd_target,
                                ];
                            })->values();
                        @endphp
                        <select id="category_id" name="category_id"
                            data-category-info='@json($categoryInfo)'
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('category_id') border-red-500 @enderror"
                            required>
                            <option value="">Pilih Kategori Laporan</option>
                            
                            {{-- Mengambil data kategori asli dari database --}}
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                            
                        </select>
                        @error('category_id')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror

                        <!-- Informasi Subkategori (Info saja, bukan input) -->
                        <div id="category-info" class="hidden mt-3 bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <div class="flex items-start space-x-3">
                                <svg class="w-5 h-5 text-blue-600 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div class="text-sm">
                                    <p class="font-semibold text-blue-900 mb-1">Info Subkategori</p>
                                    <p id="category-desc" class="text-blue-800"></p>

                                    <div id="category-examples-wrap" class="mt-2">
                                        <p class="font-semibold text-blue-900">Contoh Subkategori:</p>
                                        <p id="category-examples" class="text-blue-800"></p>
                                    </div>

                                    <div id="category-opd-wrap" class="mt-2">
                                        <p class="font-semibold text-blue-900">OPD Tujuan (Email Mapping):</p>
                                        <p id="category-opd" class="text-blue-800"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

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

                    <div class="mb-5">
                        <p class="text-xs text-gray-500 mb-3">Detail Wilayah</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                            <div>
                                <label for="district" class="block text-sm font-medium text-gray-700 mb-2">
                                    Kecamatan <span class="text-red-500">*</span>
                                </label>
                                <select id="district" name="district"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('district') border-red-500 @enderror"
                                    required>
                                    <option value="">Pilih Kecamatan</option>
                                    <option value="Sragen" {{ old('district') == 'Sragen' ? 'selected' : '' }}>Sragen</option>
                                    <option value="Kedawung" {{ old('district') == 'Kedawung' ? 'selected' : '' }}>Kedawung</option>
                                    <option value="Kalijambe" {{ old('district') == 'Kalijambe' ? 'selected' : '' }}>Kalijambe</option>
                                    <option value="Plupuh" {{ old('district') == 'Plupuh' ? 'selected' : '' }}>Plupuh</option>
                                    <option value="Masaran" {{ old('district') == 'Masaran' ? 'selected' : '' }}>Masaran</option>
                                    <option value="Sidoharjo" {{ old('district') == 'Sidoharjo' ? 'selected' : '' }}>Sidoharjo</option>
                                    <option value="Tanon" {{ old('district') == 'Tanon' ? 'selected' : '' }}>Tanon</option>
                                    <option value="Gemolong" {{ old('district') == 'Gemolong' ? 'selected' : '' }}>Gemolong</option>
                                </select>
                                @error('district')
                                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

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
                </div>

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

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Upload Foto (Wajib ada minimal 1 foto) <span class="text-red-500">*</span>
                        </label>
                        <div id="upload-area" class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-teal-500 transition cursor-pointer bg-gray-50"
                            onclick="document.getElementById('files').click()">
                            <input type="file" id="files" name="files[]" multiple accept="image/*"
                                class="hidden">
                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                </path>
                            </svg>
                            <p class="text-sm font-medium text-gray-900 mb-1">Klik untuk pilih foto</p>
                            <p class="text-xs text-gray-500">Anda dapat memilih lebih dari 1 foto (PNG, JPG, JPEG, max 5MB per foto)</p>
                        </div>
                        @error('files')
                             <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                        @error('files.*')
                             <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Preview Images -->
                    <div id="file-preview" class="hidden mt-4">
                        <div class="flex items-center justify-between mb-3">
                            <p class="text-sm font-medium text-gray-700">Preview Foto (<span id="file-count">0</span> foto terpilih)</p>
                            <button type="button" onclick="clearAllFiles()" class="text-sm text-red-600 hover:text-red-700 font-medium">
                                Hapus Semua
                            </button>
                        </div>
                        <div id="preview-container" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        </div>
                    </div>
                </div>

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
            let CATEGORY_INFO = [];

            let selectedFiles = [];

            // Event listener untuk file input
            document.addEventListener('DOMContentLoaded', function() {
                const fileInput = document.getElementById('files');
                const categorySelect = document.getElementById('category_id');

                if (categorySelect && categorySelect.dataset && categorySelect.dataset.categoryInfo) {
                    try {
                        CATEGORY_INFO = JSON.parse(categorySelect.dataset.categoryInfo);
                    } catch (e) {
                        CATEGORY_INFO = [];
                    }
                }
                
                fileInput.addEventListener('change', function(event) {
                    handleFileSelect(event);
                });

                if (categorySelect) {
                    categorySelect.addEventListener('change', function() {
                        updateCategoryInfo();
                    });
                    updateCategoryInfo();
                }
                
                console.log('Upload script loaded successfully');
            });

            function updateCategoryInfo() {
                const categorySelect = document.getElementById('category_id');
                const infoBox = document.getElementById('category-info');
                const descEl = document.getElementById('category-desc');
                const examplesWrap = document.getElementById('category-examples-wrap');
                const examplesEl = document.getElementById('category-examples');
                const opdWrap = document.getElementById('category-opd-wrap');
                const opdEl = document.getElementById('category-opd');

                if (!categorySelect || !infoBox || !descEl) return;

                const selectedId = categorySelect.value;
                if (!selectedId) {
                    infoBox.classList.add('hidden');
                    return;
                }

                const category = CATEGORY_INFO.find(c => String(c.id) === String(selectedId));
                if (!category) {
                    infoBox.classList.add('hidden');
                    return;
                }

                descEl.textContent = category.description || '';

                const examples = category.examples || '';
                if (examplesWrap && examplesEl) {
                    if (examples.trim().length > 0) {
                        examplesWrap.classList.remove('hidden');
                        examplesEl.textContent = examples;
                    } else {
                        examplesWrap.classList.add('hidden');
                    }
                }

                const opdTarget = category.opd_target || '';
                if (opdWrap && opdEl) {
                    if (opdTarget.trim().length > 0) {
                        opdWrap.classList.remove('hidden');
                        opdEl.textContent = opdTarget;
                    } else {
                        opdWrap.classList.add('hidden');
                    }
                }

                infoBox.classList.remove('hidden');
            }

            function handleFileSelect(event) {
                const files = Array.from(event.target.files);
                
                console.log('Files selected:', files.length);

                files.forEach(file => {
                    if (file.type.startsWith('image/')) {
                        if (file.size <= 5120 * 1024) {
                            selectedFiles.push(file);
                            console.log('Added file:', file.name, 'Size:', (file.size / 1024).toFixed(1) + ' KB');
                        } else {
                            alert(`File ${file.name} terlalu besar (max 5MB)`);
                        }
                    }
                });

                updatePreview();
                updateFileInput();
            }

            function removeFile(index) {
                console.log('Removing file at index:', index);
                selectedFiles.splice(index, 1);
                updatePreview();
                updateFileInput();
            }

            function clearAllFiles() {
                if (confirm('Hapus semua foto yang sudah dipilih?')) {
                    selectedFiles = [];
                    updatePreview();
                    updateFileInput();
                }
            }

            function updatePreview() {
                const previewSection = document.getElementById('file-preview');
                const previewContainer = document.getElementById('preview-container');
                const fileCount = document.getElementById('file-count');
                
                console.log('Updating preview. Total files:', selectedFiles.length);
                
                if (selectedFiles.length > 0) {
                    previewSection.classList.remove('hidden');
                    previewContainer.innerHTML = '';
                    fileCount.textContent = selectedFiles.length;

                    selectedFiles.forEach((file, index) => {
                        const div = document.createElement('div');
                        div.className = 'relative bg-white rounded-lg overflow-hidden border-2 border-gray-200 hover:border-teal-500 transition group shadow-sm';

                        const reader = new FileReader();
                        reader.onload = function(e) {
                            div.innerHTML = `
                                <div class="relative aspect-square">
                                    <img src="${e.target.result}" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-all flex items-center justify-center">
                                        <button type="button" 
                                            onclick="removeFile(${index})" 
                                            class="opacity-0 group-hover:opacity-100 transition-all bg-red-500 hover:bg-red-600 text-white rounded-full p-2 transform hover:scale-110 shadow-lg">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="p-2 bg-gray-50">
                                    <p class="text-xs text-gray-700 truncate font-medium" title="${file.name}">${file.name}</p>
                                    <p class="text-xs text-gray-500">${(file.size / 1024).toFixed(1)} KB</p>
                                </div>
                            `;
                        };
                        
                        reader.onerror = function(error) {
                            console.error('Error reading file:', error);
                        };
                        
                        reader.readAsDataURL(file);

                        previewContainer.appendChild(div);
                    });
                } else {
                    previewSection.classList.add('hidden');
                    console.log('No files to preview');
                }
            }

            function updateFileInput() {
                const input = document.getElementById('files');
                const dataTransfer = new DataTransfer();
                
                selectedFiles.forEach(file => {
                    dataTransfer.items.add(file);
                });
                
                input.files = dataTransfer.files;
                console.log('File input updated. Files count:', input.files.length);
            }
        </script>
    @endpush

@endsection