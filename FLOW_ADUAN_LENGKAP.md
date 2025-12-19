# 📊 Flow Aduan & Bukti Pengerjaan - Updated

## 🔄 Timeline Lengkap

```
FASE 1: PENDAFTARAN & PENGAJUAN ADUAN (Warga)
├─ Warga register akun
├─ Warga login
├─ Warga buat laporan aduan baru
└─ Status: PENDING ⏳

         ↓

FASE 2: ROUTING KE OPD (Admin)
├─ Admin login ke /admin
├─ Admin review laporan warga
├─ Admin tentukan kategori ke OPD mana
├─ Status berubah: PROSES 🔄
└─ OPD notif (if implemented)

         ↓

FASE 3: PENANGANAN OLEH OPD
├─ OPD login ke /admin
├─ OPD lihat laporan yang ditugaskan
├─ OPD kerjakan pekerjaan
├─ OPD siap kasih laporan
└─ Status tetap: PROSES 🔄

         ↓

FASE 4: UPLOAD BUKTI PENGERJAAN (OPD) ⭐ NEW FLOW
├─ OPD buka complaint di Filament admin panel
├─ OPD klik tab "Progres Penanganan"
├─ OPD klik "Create" untuk tambah response
├─ OPD isi:
│  ├─ Update Progres (text/komentar)
│  └─ Upload Foto Bukti (max 5 foto)
├─ OPD klik Save
├─ Response dibuat dengan: is_public = FALSE ❌
├─ Status complaint berubah: MENUNGGU_VALIDASI ⏹️
└─ Bukti TIDAK tampil ke warga (KUNCI!)

         ↓

FASE 5: VALIDASI BUKTI OLEH ADMIN ⭐ CRITICAL
├─ Admin login ke /admin
├─ Admin buka laporan dengan status MENUNGGU_VALIDASI
├─ Admin lihat tab "Progres Penanganan"
├─ Admin review response dari OPD:
│  ├─ Baca komentar/deskripsi pekerjaan
│  ├─ Lihat foto bukti pengerjaan
│  └─ Putus: Approve atau Reject?
├─ Admin pilih (Option A atau B):
│  │
│  ├─ OPTION A: APPROVE ✅
│  │  ├─ Klik button hijau "Validasi Bukti"
│  │  │  (atau toggle di form edit)
│  │  ├─ Confirm action
│  │  ├─ is_public = TRUE
│  │  ├─ Status complaint: SELESAI ✅
│  │  └─ Bukti SEKARANG TAMPIL ke warga
│  │
│  └─ OPTION B: REJECT ❌
│     ├─ Klik button merah "Tolak Bukti"
│     ├─ Confirm action
│     ├─ is_public = FALSE
│     ├─ Admin kasih komentar alasan tolak
│     └─ OPD diminta re-upload bukti

         ↓

FASE 6: WARGA LIHAT HASIL (FINAL)
├─ Warga login ke web
├─ Warga buka laporan mereka
├─ Warga scroll ke "Progres Penanganan"
├─ ✅ Warga lihat bukti dari OPD (jika di-approve)
├─ Warga lihat komentar/penjelasan OPD
├─ Warga puas atau kasih feedback
└─ Laporan selesai ✨

```

---

## 📋 State Diagram

```
                        ┌─────────────────────┐
                        │  PENDING (Baru)     │
                        │  Warga buat aduan   │
                        └──────────┬──────────┘
                                   │ Admin ubah status
                                   ↓
                        ┌─────────────────────┐
                        │  PROSES (Sedang)    │
                        │  OPD mulai kerjain  │
                        └──────────┬──────────┘
                                   │ OPD upload bukti
                                   ↓
                    ┌──────────────────────────────┐
                    │ MENUNGGU_VALIDASI (Cek)      │
                    │ Admin review bukti OPD       │
                    │ is_public = FALSE ❌         │
                    └──────────┬──────────┬────────┘
                               │          │
                        ✅ Approve    ❌ Reject
                               │          │
                               ↓          ↓
                    ┌──────────────┐  ┌──────────────┐
                    │ SELESAI ✅   │  │ PROSES (Lagi)│
                    │ is_public=  │  │ OPD re-upload│
                    │ TRUE         │  └──────────────┘
                    │ Warga lihat  │        │
                    │ bukti ✅     │        └─→ (kembali ke MENUNGGU_VALIDASI)
                    └──────────────┘
```

---

## 🔐 Permission Matrix

| Role | Create Response | Edit Response | Approve is_public | Reject is_public | Delete Response |
|------|-----------------|---------------|-------------------|------------------|-----------------|
| **Warga** | ❌ | ❌ | ❌ | ❌ | ❌ |
| **OPD** | ✅ | ✅ | ❌ | ❌ | ❌ |
| **Admin** | ✅ | ✅ | ✅ | ✅ | ✅ |

---

## 📊 Data: ComplaintResponse

```javascript
{
  id: 1,
  complaint_id: 5,
  user_id: 2,           // OPD user
  response: "Sudah selesai...",
  images: [
    "complaint-response-images/abc123.jpg",
    "complaint-response-images/def456.jpg"
  ],
  is_public: false,     // ⭐ KUNCI: false = tidak tampil ke warga
  created_at: "2025-12-19T10:30:00",
  updated_at: "2025-12-19T10:30:00"
}
```

---

## 🎯 Perubahan vs Original

### ❌ SEBELUMNYA (SALAH)
```
OPD upload bukti
    ↓
is_public = TRUE (langsung public)
    ↓
Warga langsung lihat
    ↓
Admin tidak bisa kontrol 💥
```

### ✅ SEKARANG (BENAR)
```
OPD upload bukti
    ↓
is_public = FALSE (default hidden)
    ↓
Warga tidak lihat dulu
    ↓
Admin review & approve
    ↓
is_public = TRUE (approved)
    ↓
Warga baru lihat bukti ✅
```

---

## 🔍 Code Points

### 1. Controller (Filter di Warga)
**File:** `app/Http/Controllers/ReportController.php` (line ~147)
```php
$report = Complaint::with([
    'responses' => function ($query) {
        $query->where('is_public', true)->with('user'); // ⭐ Filter di sini
    },
])->findOrFail($id);
```
✅ **Sudah ada filter, tidak perlu ubah**

### 2. Model (Relasi)
**File:** `app/Models/Complaint.php`
```php
public function responses(): HasMany
{
    return $this->hasMany(ComplaintResponse::class);
}
```
✅ **Relasi sudah ada**

### 3. Filament Response Manager (DIUBAH)
**File:** `app/Filament/Resources/ComplaintResource/RelationManagers/ResponsesRelationManager.php`
- Default: `is_public = false` ✅ DIUBAH
- Toggle field untuk admin ✅ DITAMBAH
- Action approve/reject ✅ DITAMBAH

### 4. View (Sudah Filter)
**File:** `resources/views/reports/show.blade.php` (line ~182)
```php
@forelse($report->responses->sortBy('created_at') as $response)
    <!-- Hanya responses dengan is_public=true akan ada di sini -->
    <!-- Karena controller sudah filter -->
@endforelse
```
✅ **Sudah bekerja karena controller filter**

---

## 🚀 Deployment Checklist

- [ ] Clear cache: `php artisan cache:clear`
- [ ] Check database: Kolom `is_public` ada di `complaint_responses`
- [ ] Test OPD upload (should have is_public = false)
- [ ] Test Admin approve (toggle or button)
- [ ] Test Warga view (should see bukti after approved)
- [ ] Check logs: `storage/logs/laravel.log`

---

## 📚 Referensi Files

- **Logic Flow:** `app/Filament/Resources/ComplaintResource/RelationManagers/ResponsesRelationManager.php`
- **Data Retrieval:** `app/Http/Controllers/ReportController.php` (show method)
- **Display:** `resources/views/reports/show.blade.php`
- **Database:** `complaint_responses` table (kolom `is_public`)

---

## 💬 Notes

- Semua response default `is_public = false` sekarang
- Hanya admin yang bisa toggle/approve
- OPD tidak bisa set public sendiri
- Warga hanya lihat response yang `is_public = true`
- Admin bisa reject & minta OPD re-upload

---

**Last Updated:** December 19, 2025
**Status:** ✅ Implementation Complete
