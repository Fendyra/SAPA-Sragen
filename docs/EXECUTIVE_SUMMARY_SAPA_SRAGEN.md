# Executive Summary — SAPA Sragen

Tanggal: 18 Desember 2025  
Produk: SAPA Sragen (Aplikasi Pengaduan Masyarakat)

## 1) Gambaran Singkat

SAPA Sragen adalah aplikasi web untuk menerima, mengelola, dan mempublikasikan pengaduan masyarakat. Warga dapat registrasi dan mengirim aduan (opsional dengan bukti foto), mendapatkan kode tiket untuk pelacakan, serta melihat daftar aduan publik. Admin/OPD memproses aduan melalui Admin Panel.

## 2) Tujuan & Nilai Bisnis

-   Sentralisasi kanal pengaduan warga ke satu sistem.
-   Pelacakan aduan berbasis kode tiket sehingga status terpantau.
-   Transparansi melalui fitur “Aduan Publik” (aduan yang tidak ditolak).
-   Pemisahan peran (Admin vs OPD vs Warga) untuk kontrol akses.

## 3) Pengguna & Hak Akses

Role utama:

-   **Warga**: registrasi, login, membuat aduan, melihat riwayat aduan miliknya, melihat aduan publik.
-   **OPD**: memantau dan mengubah status aduan (umumnya sampai tahap “menunggu validasi”).
-   **Admin**: kontrol penuh (kelola user, kelola kategori, finalisasi status aduan, dapat menghapus aduan/kategori/user).

Ringkas policy:

-   Aduan: Admin & OPD dapat melihat dan update; delete hanya Admin.
-   Kategori: lihat Admin & OPD; create/update/delete hanya Admin.
-   User: hanya Admin.

## 4) Ruang Lingkup Fitur (High-Level)

**Portal Publik**

-   Beranda, Tentang Kami, FAQ/Pusat Bantuan.
-   Halaman Aduan Publik: menampilkan aduan dengan status bukan `ditolak`.

**Portal Warga (Login Required)**

-   Registrasi: NIK 16 digit, email, password, upload foto KTP.
-   Dashboard: ringkasan dan daftar aduan terbaru.
-   Aduan Warga:
    -   Buat aduan (judul, kategori, deskripsi, lokasi, foto opsional).
    -   Daftar aduan dengan filter status dan pencarian.
    -   Detail aduan.

**Admin Panel (Filament)**

-   Path admin: `/admin`.
-   Menu utama: Aduan, Kategori, Users.
-   Widget: statistik aduan dan grafik aduan per bulan.

## 5) Alur Proses (Ringkas)

1. Warga registrasi dan login.
2. Warga membuat aduan → sistem membuat kode tiket otomatis (format `SRG-YYMM-XXXXXX`) dan status awal `pending`.
3. OPD memproses → status dapat diubah ke `proses` lalu `menunggu_validasi`.
4. Admin memverifikasi hasil → status akhir `selesai` atau `ditolak`.

## 6) Data & Status Utama

Entity utama yang digunakan pada modul aduan:

-   **User**: memiliki role `admin|opd|warga`.
-   **Category**: master kategori aduan.
-   **Complaint (Aduan)**: memiliki `ticket_code`, `status`, kategori, dan pemilik (user).

Status aduan (complaints):

-   `pending`, `proses`, `menunggu_validasi`, `selesai`, `ditolak`.

## 7) Teknologi & Arsitektur (Ringkas)

-   Backend: Laravel 12, PHP 8.2.
-   Admin Panel: Filament v3.
-   Frontend assets: Vite + Tailwind CSS.
-   Upload file: Laravel storage (disk `public`).
-   Database default env contoh: SQLite (dapat diganti MySQL/PostgreSQL).

## 8) Operasional (Setup Singkat)

Setup dev yang umum:

-   `composer install`
-   `cp .env.example .env` dan `php artisan key:generate`
-   `php artisan migrate --seed`
-   `php artisan storage:link`
-   `npm install && npm run build`

Admin panel:

-   Akses `/admin` lalu login.

## 9) Risiko / Catatan Teknis yang Perlu Diketahui PM

-   **Duplikasi model/tabel**: aplikasi memiliki dua konsep data (`reports` dan `complaints`). Modul web `/reports` saat ini mengelola `complaints`, sementara dashboard warga mengambil data dari `reports`.
-   **Status tidak konsisten di dashboard**: `DashboardController` menghitung status `resolved` meskipun enum `reports.status` tidak memiliki `resolved`.
-   **Tanggapan aduan**: sudah ada tabel/model `complaint_responses` dan Relation Manager Filament, namun relation tersebut belum diaktifkan pada resource (belum tampil di UI Filament).
-   **Privasi foto KTP**: saat registrasi, file KTP disimpan di disk `public` (perlu dipastikan kebijakan akses/privasi sesuai kebutuhan instansi).

## 10) Rekomendasi Next Step (Untuk Perencanaan)

-   Satukan sumber data dashboard: pilih `complaints` sebagai sumber utama (atau migrasi dari `reports`).
-   Selaraskan enumerasi status (web, admin, dan dashboard) agar laporan dan statistik konsisten.
-   Aktifkan/standarkan modul tanggapan (responses) agar komunikasi admin/OPD terdokumentasi di sistem.
-   Review penyimpanan foto KTP (private storage + kontrol akses) sesuai kebijakan.

---

Dokumen ini merupakan ringkasan eksekutif dan mengacu pada dokumentasi teknis lengkap di `docs/DOKUMENTASI_SAPA_SRAGEN.md`.
