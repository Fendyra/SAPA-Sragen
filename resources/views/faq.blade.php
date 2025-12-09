@extends('layouts.app')

@section('title', 'Pusat Bantuan - SAPA Sragen')

@section('content')

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-900 to-blue-700 text-white py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Pusat Bantuan</h1>
            <p class="text-lg text-blue-100 mb-8">
                Temukan jawaban atas pertanyaan Anda seputar layanan Sapa Sragen
            </p>

            <!-- Search Bar -->
            <div class="max-w-2xl mx-auto">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" id="faq-search" placeholder="Ketik kata kunci pencarian Anda..."
                        class="w-full pl-12 pr-4 py-4 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 shadow-lg">
                </div>
            </div>
        </div>
    </div>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Sidebar - Kategori Topik -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 sticky top-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Kategori Topik</h3>
                        <nav class="space-y-2">
                            <a href="#umum"
                                class="category-link block px-4 py-3 rounded-lg text-sm font-medium bg-blue-900 text-white transition">
                                Umum
                            </a>
                            <a href="#akun"
                                class="category-link block px-4 py-3 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 transition">
                                Akun & Registrasi
                            </a>
                            <a href="#proses"
                                class="category-link block px-4 py-3 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 transition">
                                Proses Pengaduan
                            </a>
                        </nav>
                    </div>
                </div>

                <!-- Main Content - FAQ Items -->
                <div class="lg:col-span-3">
                    <!-- Umum Section -->
                    <div id="umum" class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Umum</h2>
                        <div class="space-y-3">
                            <!-- FAQ Item 1 -->
                            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                                <button
                                    class="faq-toggle w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition">
                                    <span class="font-semibold text-gray-900">Apa itu Sapa Sragen?</span>
                                    <svg class="faq-icon w-5 h-5 text-gray-500 transition-transform" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div class="faq-content hidden px-6 pb-4">
                                    <p class="text-gray-600 leading-relaxed">
                                        Sapa Sragen adalah platform pengaduan online masyarakat Kabupaten Sragen yang
                                        memudahkan warga untuk menyampaikan aspirasi, keluhan, dan laporan terkait pelayanan
                                        publik secara transparan dan akuntabel.
                                    </p>
                                </div>
                            </div>

                            <!-- FAQ Item 2 -->
                            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                                <button
                                    class="faq-toggle w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition">
                                    <span class="font-semibold text-gray-900">Apakah layanan ini gratis?</span>
                                    <svg class="faq-icon w-5 h-5 text-gray-500 transition-transform" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div class="faq-content hidden px-6 pb-4">
                                    <p class="text-gray-600 leading-relaxed">
                                        Ya, seluruh layanan Sapa Sragen sepenuhnya gratis untuk semua masyarakat Kabupaten
                                        Sragen. Tidak ada biaya apapun untuk mendaftar, membuat aduan, atau melacak progres
                                        laporan Anda.
                                    </p>
                                </div>
                            </div>

                            <!-- FAQ Item 3 -->
                            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                                <button
                                    class="faq-toggle w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition">
                                    <span class="font-semibold text-gray-900">Jenis aduan apa saja yang bisa
                                        dilaporkan?</span>
                                    <svg class="faq-icon w-5 h-5 text-gray-500 transition-transform" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div class="faq-content hidden px-6 pb-4">
                                    <p class="text-gray-600 leading-relaxed mb-3">
                                        Anda dapat melaporkan berbagai jenis aduan dalam kategori:
                                    </p>
                                    <ul class="list-disc list-inside space-y-2 text-gray-600">
                                        <li>Infrastruktur (jalan rusak, lampu jalan mati, dll)</li>
                                        <li>Kesehatan (fasilitas kesehatan, layanan kesehatan)</li>
                                        <li>Lingkungan (sampah, kebersihan, pencemaran)</li>
                                        <li>Keamanan (gangguan keamanan, penerangan)</li>
                                        <li>Sosial (masalah sosial kemasyarakatan)</li>
                                        <li>Administrasi (pelayanan administrasi publik)</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Akun & Registrasi Section -->
                    <div id="akun" class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Akun & Registrasi</h2>
                        <div class="space-y-3">
                            <!-- FAQ Item 4 -->
                            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                                <button
                                    class="faq-toggle w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition">
                                    <span class="font-semibold text-gray-900">Bagaimana cara mendaftar akun?</span>
                                    <svg class="faq-icon w-5 h-5 text-gray-500 transition-transform" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div class="faq-content hidden px-6 pb-4">
                                    <p class="text-gray-600 leading-relaxed mb-3">
                                        Untuk mendaftar, ikuti langkah berikut:
                                    </p>
                                    <ol class="list-decimal list-inside space-y-2 text-gray-600">
                                        <li>Klik tombol "Daftar" atau "Register" di halaman utama</li>
                                        <li>Isi formulir pendaftaran dengan data yang valid (NIK, nama, email, nomor
                                            telepon)
                                        </li>
                                        <li>Buat password yang kuat</li>
                                        <li>Klik "Daftar" untuk menyelesaikan registrasi</li>
                                        <li>Anda dapat langsung login dan membuat aduan</li>
                                    </ol>
                                </div>
                            </div>

                            <!-- FAQ Item 5 -->
                            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                                <button
                                    class="faq-toggle w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition">
                                    <span class="font-semibold text-gray-900">Apakah harus mendaftar untuk membuat
                                        aduan?</span>
                                    <svg class="faq-icon w-5 h-5 text-gray-500 transition-transform" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div class="faq-content hidden px-6 pb-4">
                                    <p class="text-gray-600 leading-relaxed">
                                        Ya, Anda perlu mendaftar dan login terlebih dahulu untuk membuat aduan. Hal ini
                                        diperlukan agar kami dapat memberikan update progres laporan Anda dan memastikan
                                        akuntabilitas dari setiap aduan yang masuk.
                                    </p>
                                </div>
                            </div>

                            <!-- FAQ Item 6 -->
                            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                                <button
                                    class="faq-toggle w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition">
                                    <span class="font-semibold text-gray-900">Lupa password, bagaimana cara reset?</span>
                                    <svg class="faq-icon w-5 h-5 text-gray-500 transition-transform" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div class="faq-content hidden px-6 pb-4">
                                    <p class="text-gray-600 leading-relaxed">
                                        Jika lupa password, klik link "Lupa Password" di halaman login, masukkan email yang
                                        terdaftar, dan kami akan mengirimkan instruksi reset password ke email Anda. Ikuti
                                        petunjuk dalam email untuk membuat password baru.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Proses Pengaduan Section -->
                    <div id="proses" class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Proses Pengaduan</h2>
                        <div class="space-y-3">
                            <!-- FAQ Item 7 -->
                            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                                <button
                                    class="faq-toggle w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition">
                                    <span class="font-semibold text-gray-900">Bagaimana cara membuat aduan?</span>
                                    <svg class="faq-icon w-5 h-5 text-gray-500 transition-transform" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div class="faq-content hidden px-6 pb-4">
                                    <p class="text-gray-600 leading-relaxed mb-3">
                                        Untuk membuat aduan:
                                    </p>
                                    <ol class="list-decimal list-inside space-y-2 text-gray-600">
                                        <li>Login ke akun Anda</li>
                                        <li>Klik tombol "Buat Aduan Baru" di dashboard</li>
                                        <li>Pilih kategori aduan yang sesuai</li>
                                        <li>Isi form dengan detail lengkap (judul, deskripsi, lokasi)</li>
                                        <li>Upload foto pendukung jika diperlukan (maksimal 5 file)</li>
                                        <li>Pilih apakah aduan bersifat anonim atau publik</li>
                                        <li>Klik "Kirim Aduan"</li>
                                    </ol>
                                </div>
                            </div>

                            <!-- FAQ Item 8 -->
                            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                                <button
                                    class="faq-toggle w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition">
                                    <span class="font-semibold text-gray-900">Berapa lama aduan akan diproses?</span>
                                    <svg class="faq-icon w-5 h-5 text-gray-500 transition-transform" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div class="faq-content hidden px-6 pb-4">
                                    <p class="text-gray-600 leading-relaxed">
                                        Aduan Anda akan diverifikasi oleh admin dalam 1-2 hari kerja. Setelah diverifikasi,
                                        aduan akan diteruskan ke dinas terkait untuk ditindaklanjuti. Waktu penyelesaian
                                        bervariasi tergantung jenis dan kompleksitas masalah, biasanya 7-14 hari kerja. Anda
                                        dapat memantau progres aduan secara real-time di dashboard Anda.
                                    </p>
                                </div>
                            </div>

                            <!-- FAQ Item 9 -->
                            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                                <button
                                    class="faq-toggle w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition">
                                    <span class="font-semibold text-gray-900">Bagaimana cara melacak status aduan
                                        saya?</span>
                                    <svg class="faq-icon w-5 h-5 text-gray-500 transition-transform" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div class="faq-content hidden px-6 pb-4">
                                    <p class="text-gray-600 leading-relaxed mb-3">
                                        Ada dua cara untuk melacak status aduan:
                                    </p>
                                    <ol class="list-decimal list-inside space-y-2 text-gray-600">
                                        <li>Login ke akun Anda dan cek menu "Riwayat Saya" untuk melihat semua aduan yang
                                            pernah Anda buat beserta statusnya</li>
                                        <li>Gunakan fitur "Lacak Aduan" di dashboard dengan memasukkan ID Tiket aduan
                                            (format:
                                            #SR-YYMM-XXX)</li>
                                    </ol>
                                </div>
                            </div>

                            <!-- FAQ Item 10 -->
                            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                                <button
                                    class="faq-toggle w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition">
                                    <span class="font-semibold text-gray-900">Apakah saya bisa membuat aduan anonim?</span>
                                    <svg class="faq-icon w-5 h-5 text-gray-500 transition-transform" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div class="faq-content hidden px-6 pb-4">
                                    <p class="text-gray-600 leading-relaxed">
                                        Ya, saat membuat aduan Anda dapat memilih opsi "Laporan Anonim". Identitas Anda akan
                                        disembunyikan dari publik, namun tetap tercatat di sistem untuk keperluan
                                        administrasi dan follow-up. Laporan anonim akan ditampilkan di halaman publik dengan
                                        nama "Anonim".
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Masih Butuh Bantuan Section -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 text-center">
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Masih butuh bantuan?</h3>
                        <p class="text-gray-600 mb-6">
                            Jika Anda tidak menemukan jawaban di atas, jangan ragu untuk menghubungi tim kami secara
                            langsung.
                        </p>
                        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                            <a href="mailto:info@sapa.sragenkab.go.id"
                                class="inline-flex items-center px-6 py-3 bg-blue-900 hover:bg-blue-800 text-white font-semibold rounded-lg transition">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                                Kirim Email
                            </a>
                            <a href="tel:+622718271234"
                                class="inline-flex items-center px-6 py-3 border-2 border-blue-900 text-blue-900 hover:bg-blue-900 hover:text-white font-semibold rounded-lg transition">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                    </path>
                                </svg>
                                Hubungi Kami
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for FAQ Accordion & Search -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // FAQ Accordion
            const faqToggles = document.querySelectorAll('.faq-toggle');
            faqToggles.forEach(toggle => {
                toggle.addEventListener('click', function() {
                    const content = this.nextElementSibling;
                    const icon = this.querySelector('.faq-icon');

                    // Toggle current FAQ
                    content.classList.toggle('hidden');
                    icon.classList.toggle('rotate-180');
                });
            });

            // Category Links
            const categoryLinks = document.querySelectorAll('.category-link');
            categoryLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    // Remove active class from all
                    categoryLinks.forEach(l => {
                        l.classList.remove('bg-blue-900', 'text-white');
                        l.classList.add('text-gray-700', 'hover:bg-gray-100');
                    });
                    // Add active class to clicked
                    this.classList.add('bg-blue-900', 'text-white');
                    this.classList.remove('text-gray-700', 'hover:bg-gray-100');
                });
            });

            // Search functionality
            const searchInput = document.getElementById('faq-search');
            const faqItems = document.querySelectorAll('.faq-toggle');

            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();

                faqItems.forEach(item => {
                    const question = item.querySelector('span').textContent.toLowerCase();
                    const content = item.nextElementSibling.textContent.toLowerCase();
                    const parent = item.closest('.bg-white');

                    if (question.includes(searchTerm) || content.includes(searchTerm)) {
                        parent.style.display = 'block';
                        // Highlight matching items
                        if (searchTerm.length > 0) {
                            parent.classList.add('ring-2', 'ring-teal-500');
                        } else {
                            parent.classList.remove('ring-2', 'ring-teal-500');
                        }
                    } else {
                        parent.style.display = 'none';
                        parent.classList.remove('ring-2', 'ring-teal-500');
                    }
                });
            });
        });
    </script>

@endsection
