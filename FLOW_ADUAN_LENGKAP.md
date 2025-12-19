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

## 💬 Notes

- Semua response default `is_public = false` sekarang
- Hanya admin yang bisa toggle/approve
- OPD tidak bisa set public sendiri
- Warga hanya lihat response yang `is_public = true`
- Admin bisa reject & minta OPD re-upload

---

**Last Updated:** December 19, 2025
**Status:** ✅ Implementation Complete
