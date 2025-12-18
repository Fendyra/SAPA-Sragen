# Dokumentasi Aplikasi SAPA Sragen

Tanggal: 18 Desember 2025  
Repo/Project: SAPA-Sragen (Laravel)

## 1. Ringkasan

SAPA Sragen adalah aplikasi layanan pengaduan/aduan masyarakat berbasis web.

Fokus utama:

-   Warga dapat registrasi dan mengirim aduan beserta bukti foto.
-   Aduan memiliki kode tiket otomatis untuk pelacakan.
-   Aduan tertentu dapat ditampilkan sebagai aduan publik.
-   Admin/OPD mengelola aduan melalui Admin Panel (Filament) termasuk pembaruan status.

## 2. Ruang Lingkup Fitur

### 2.1 Halaman Publik

Rute publik yang dapat diakses tanpa login:

-   Beranda: `/`
-   Tentang Kami: `/tentang-kami`
-   Pusat Bantuan/FAQ: `/pusat-bantuan`
-   Aduan Publik: `/aduan-publik`

Referensi implementasi routing: [routes/web.php](../routes/web.php)

### 2.2 Autentikasi (Warga)

Fitur autentikasi untuk warga:

-   Registrasi warga: `/register`
    -   Field: NIK (16 digit), nama, email, no HP (opsional), foto KTP, password + konfirmasi.
    -   Upload foto KTP tersimpan di storage disk `public` (folder `ktp_photos`).
    -   Role default: `warga`.
-   Login: `/login`
-   Logout (POST): `/logout`

Referensi: [app/Http/Controllers/AuthController.php](../app/Http/Controllers/AuthController.php)

### 2.3 Dashboard Warga

Setelah login, warga menuju:

-   Dashboard: `/dashboard`

Dashboard menampilkan ringkasan dan daftar aduan terbaru.
Catatan: saat ini `DashboardController` mengambil data dari model `Report` (tabel `reports`), sedangkan modul aduan utama di sisi web menggunakan model `Complaint` (tabel `complaints`). Lihat bagian “Catatan Teknis / Known Issues”.

Referensi: [app/Http/Controllers/DashboardController.php](../app/Http/Controllers/DashboardController.php)

### 2.4 Modul Aduan (Frontend Warga)

Pada rute terautentikasi (`auth`), tersedia resource `reports` (sebenarnya menangani `Complaint`).

Rute utama (resource):

-   List aduan warga: `GET /reports`
-   Form buat aduan: `GET /reports/create`
-   Simpan aduan: `POST /reports`
-   Detail aduan: `GET /reports/{id}`

Fitur di list aduan:

-   Filter berdasarkan `status` (query string `?status=...`).
-   Pencarian berdasarkan `title` atau `ticket_code` (query string `?search=...`).

Fitur pembuatan aduan:

-   Field: judul, kategori, deskripsi, kecamatan (`district`), desa (`village`), alamat (`address`), foto (opsional).
-   Lokasi disusun sebagai string gabungan: `{address}, Desa {village}, Kec. {district}`.
-   Foto aduan disimpan di storage disk `public` (folder `aduan-images`).
-   Status awal: `pending`.
-   Kode tiket otomatis: format `SRG-YYMM-XXXXXX` (unik).

Aduan publik:

-   `GET /aduan-publik` menampilkan aduan yang statusnya **bukan** `ditolak`.

Referensi: [app/Http/Controllers/ReportController.php](../app/Http/Controllers/ReportController.php), [app/Models/Complaint.php](../app/Models/Complaint.php)

## 3. Admin Panel (Filament)

Admin Panel berjalan di path:

-   `/admin`

Admin panel menggunakan Filament v3.
Menu/Resource yang tersedia:

-   `Aduan` (ComplaintResource): list & edit aduan.
-   `Kategori` (CategoryResource): kelola master kategori.
-   `Users` (UserResource): kelola akun pengguna.

Widget dashboard admin:

-   Statistik aduan (total/pending/selesai)
-   Grafik aduan per bulan

Referensi:

-   Panel provider: [app/Providers/Filament/AdminPanelProvider.php](../app/Providers/Filament/AdminPanelProvider.php)
-   Resources: [app/Filament/Resources](../app/Filament/Resources)
-   Widgets: [app/Filament/Widgets](../app/Filament/Widgets)

### 3.1 Aturan Edit Aduan di Admin Panel

Pada Form Filament untuk aduan:

-   Field `title`, `description`, `category_id` dan `location` dibuat tidak bisa diubah saat edit (`disabledOn('edit')`).
-   Admin panel berfokus pada pembaruan `status` (dan upload foto bila diperlukan).

Pilihan status di admin panel:

-   Jika role `admin`: `pending`, `proses`, `selesai`, `ditolak`.
-   Jika role non-admin (mis. `opd`): `pending`, `proses`, `menunggu_validasi`.

Referensi: [app/Filament/Resources/ComplaintResource.php](../app/Filament/Resources/ComplaintResource.php)

### 3.2 Respon/Tanggapan Aduan

Secara data, sistem memiliki tabel `complaint_responses` dan model `ComplaintResponse`.
Di Filament terdapat `ResponsesRelationManager` untuk mengelola tanggapan.

Catatan penting: saat ini `ComplaintResource::getRelations()` mengembalikan array kosong, sehingga Relation Manager `responses` belum tampil/terhubung di UI Filament (butuh aktivasi/registrasi relation manager).

Referensi:

-   Model: [app/Models/ComplaintResponse.php](../app/Models/ComplaintResponse.php)
-   Relation Manager: [app/Filament/Resources/ComplaintResource/RelationManagers/ResponsesRelationManager.php](../app/Filament/Resources/ComplaintResource/RelationManagers/ResponsesRelationManager.php)

## 4. Role & Hak Akses

Role yang digunakan:

-   `warga` (default saat registrasi)
-   `opd`
-   `admin`

Hak akses utama (berdasarkan policy):

-   Aduan (ComplaintPolicy)
    -   `admin` dan `opd` dapat melihat dan memperbarui aduan.
    -   hanya `admin` yang boleh menghapus aduan.
-   Kategori (CategoryPolicy)
    -   `admin` dan `opd` dapat melihat kategori.
    -   hanya `admin` dapat membuat/mengubah/menghapus kategori.
-   User (UserPolicy)
    -   hanya `admin` dapat melihat/mengelola user.

Referensi policies:

-   [app/Policies/ComplaintPolicy.php](../app/Policies/ComplaintPolicy.php)
-   [app/Policies/CategoryPolicy.php](../app/Policies/CategoryPolicy.php)
-   [app/Policies/UserPolicy.php](../app/Policies/UserPolicy.php)

## 5. Alur Bisnis (End-to-End)

### 5.1 Alur Warga

1. Warga registrasi (`/register`) dengan NIK, data identitas, dan upload foto KTP.
2. Warga login (`/login`).
3. Warga membuat aduan baru (`/reports/create`).
4. Sistem menyimpan aduan dengan kode tiket otomatis dan status `pending`.
5. Warga dapat memantau daftar aduan (`/reports`) dan membuka detail aduan (`/reports/{id}`).

### 5.2 Alur Admin/OPD

1. Admin/OPD login ke admin panel (`/admin`).
2. Admin/OPD melihat daftar aduan.
3. OPD mengubah status aduan ke `proses` saat mulai ditangani.
4. Setelah selesai ditangani oleh OPD, status dapat menjadi `menunggu_validasi`.
5. Admin memverifikasi hasil dan mengubah status akhir menjadi `selesai` atau `ditolak`.

## 6. Struktur Data (Database)

### 6.1 Tabel `users`

Kolom penting:

-   `nik` (unique, 16 digit)
-   `name`, `email` (unique)
-   `phone_number` (nullable)
-   `ktp_photo` (path file, nullable)
-   `password`
-   `role` enum: `admin|warga|opd`

Referensi: [database/migrations/2025_12_08_165357_create_users_table.php](../database/migrations/2025_12_08_165357_create_users_table.php)

### 6.2 Tabel `categories`

Kolom penting:

-   `name`
-   `slug` (unique)
-   `description` (nullable)
-   `is_active` (boolean)

Referensi: [database/migrations/2025_12_10_000001_create_categories_table.php](../database/migrations/2025_12_10_000001_create_categories_table.php)

### 6.3 Tabel `complaints`

Kolom penting:

-   `user_id` (FK -> users)
-   `category_id` (FK -> categories)
-   `ticket_code` (unique)
-   `title`, `description`
-   `location` (nullable)
-   `image` (nullable)
-   `status` enum: `pending|proses|menunggu_validasi|selesai|ditolak`

Relasi:

-   User (1) -> (N) Complaint
-   Category (1) -> (N) Complaint

Referensi: [database/migrations/2025_12_10_000002_create_complaints_table.php](../database/migrations/2025_12_10_000002_create_complaints_table.php)

### 6.4 Tabel `complaint_responses`

Kolom penting:

-   `complaint_id` (FK -> complaints)
-   `user_id` (FK -> users)
-   `response` (text)

Relasi:

-   Complaint (1) -> (N) ComplaintResponse
-   User (1) -> (N) ComplaintResponse

Referensi: [database/migrations/2025_12_10_000003_create_complaint_responses_table.php](../database/migrations/2025_12_10_000003_create_complaint_responses_table.php)

### 6.5 Tabel `reports` (Legacy/Alternatif)

Tabel `reports` dan model `Report` masih ada dan dipakai oleh `DashboardController`.
Namun rute web `/reports` saat ini mengelola data di tabel `complaints`.

Referensi:

-   Migration: [database/migrations/2025_12_09_124858_create_reports_table.php](../database/migrations/2025_12_09_124858_create_reports_table.php)
-   Model: [app/Models/Report.php](../app/Models/Report.php)

## 7. Data Awal (Seeder)

Seeder yang dipanggil oleh default `DatabaseSeeder`:

-   `CategorySeeder`: membuat 6 kategori standar.
-   `AdminUserSeeder`: membuat 1 akun admin.
-   `ReportSeeder`: membuat contoh data pada tabel `reports`.

Kredensial admin default (development):

-   Email: `admin@admin.com`
-   Password: `adm123`

Referensi:

-   [database/seeders/DatabaseSeeder.php](../database/seeders/DatabaseSeeder.php)
-   [database/seeders/AdminUserSeeder.php](../database/seeders/AdminUserSeeder.php)
-   [database/seeders/CategorySeeder.php](../database/seeders/CategorySeeder.php)
-   [database/seeders/ReportSeeder.php](../database/seeders/ReportSeeder.php)

Catatan: ada `ComplaintSystemSeeder` yang membuat sample kategori/user/aduan untuk tabel `complaints`, tetapi belum dipanggil oleh `DatabaseSeeder`.
Referensi: [database/seeders/ComplaintSystemSeeder.php](../database/seeders/ComplaintSystemSeeder.php)

## 8. Setup Lokal (Development)

### 8.1 Prasyarat

-   PHP >= 8.2
-   Composer
-   Node.js + npm

### 8.2 Langkah Setup Cepat

Dari root project:

1. Install dependency PHP:
    - `composer install`
2. Buat file env:
    - `cp .env.example .env`
3. Generate app key:
    - `php artisan key:generate`
4. Jalankan migrasi dan seeder:
    - `php artisan migrate --seed`
5. Buat symlink storage agar file upload bisa diakses:
    - `php artisan storage:link`
6. Install dependency frontend:
    - `npm install`
7. Build asset:
    - `npm run build`

Alternatif (menggunakan composer script):

-   `composer run setup`

Referensi script: [composer.json](../composer.json)

### 8.3 Menjalankan Mode Dev

Opsi sederhana:

-   Backend: `php artisan serve`
-   Frontend: `npm run dev`

Opsi terpadu (server + queue + logs + vite) via script:

-   `composer run dev`

## 9. Deployment (Ringkas)

Rekomendasi langkah deployment umum (production):

-   Set `APP_ENV=production`, `APP_DEBUG=false`, dan `APP_URL` sesuai domain.
-   Gunakan database production (mis. MySQL/PostgreSQL) dan set env DB.
-   Jalankan:
    -   `composer install --no-dev --optimize-autoloader`
    -   `php artisan migrate --force`
    -   `php artisan storage:link`
    -   `npm ci && npm run build`
-   Jika memakai queue (`QUEUE_CONNECTION=database`), jalankan worker:
    -   `php artisan queue:work`

## 10. Catatan Teknis / Known Issues

1. **Duplikasi konsep “Report” vs “Complaint”**

    - Frontend `/reports` memakai model `Complaint`.
    - Dashboard memakai model `Report`.
    - Ini berpotensi membingungkan untuk analitik/dashboard dan maintenance.

2. **Status `resolved` di dashboard**

    - `DashboardController` menghitung status `resolved` padahal enum `reports.status` tidak memiliki `resolved` (yang ada: `pending|verified|processing|completed|rejected`).
    - Perlu penyesuaian jika dashboard ingin akurat.

3. **Relation Manager tanggapan belum tampil**

    - `ResponsesRelationManager` sudah ada, namun belum diregistrasikan di `ComplaintResource::getRelations()`.

4. **Privasi data KTP**
    - Foto KTP disimpan di disk `public` saat registrasi.
    - Untuk kebutuhan layanan publik, pertimbangkan pemisahan penyimpanan private/akses terbatas (kebijakan akses dan audit).

---

Dokumen ini ditulis berdasarkan struktur dan kode pada repo per 18 Desember 2025.
