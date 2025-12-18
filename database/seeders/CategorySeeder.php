<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Delete existing categories safely
        Category::query()->delete();

        $categories = [
            [
                'name' => 'Infrastruktur & Fasilitas Umum',
                'slug' => 'infrastruktur-fasilitas-umum',
                'description' => 'Keluhan terkait kondisi sarana prasarana publik seperti jalan rusak, lampu jalan mati, saluran air tersumbat, jembatan rusak',
                'examples' => 'Jalan rusak, lampu jalan mati, saluran air tersumbat, jembatan rusak.',
                'opd_target' => 'Dinas Pekerjaan Umum & Penataan Ruang (DPUPR)',
                'is_active' => true,
            ],
            [
                'name' => 'Kebersihan & Lingkungan',
                'slug' => 'kebersihan-lingkungan',
                'description' => 'Masalah kebersihan dan lingkungan sekitar seperti sampah menumpuk, pencemaran, drainase, penghijauan',
                'examples' => 'Sampah menumpuk, pencemaran, drainase, penghijauan.',
                'opd_target' => 'Dinas Lingkungan Hidup (DLH)',
                'is_active' => true,
            ],
            [
                'name' => 'Pelayanan Publik & Administrasi',
                'slug' => 'pelayanan-publik-administrasi',
                'description' => 'Layanan publik di kantor pemerintahan seperti KTP, KK, surat pindah, pelayanan lambat, antrean, pungli',
                'examples' => 'KTP, KK, surat pindah, pelayanan lambat, antrean, pungli.',
                'opd_target' => 'Dinas Kependudukan & Catatan Sipil (Disdukcapil)',
                'is_active' => true,
            ],
            [
                'name' => 'Keamanan & Ketertiban Umum',
                'slug' => 'keamanan-ketertiban-umum',
                'description' => 'Aduan yang berkaitan dengan gangguan keamanan atau keselamatan umum seperti kebisingan, parkir liar, pelanggaran perda, keamanan lingkungan',
                'examples' => 'Kebisingan, parkir liar, pelanggaran perda, keamanan lingkungan.',
                'opd_target' => 'Satpol PP / Dinas Perhubungan',
                'is_active' => true,
            ],
            [
                'name' => 'Sosial & Kesejahteraan Masyarakat',
                'slug' => 'sosial-kesejahteraan-masyarakat',
                'description' => 'Masalah sosial masyarakat atau bantuan sosial seperti bantuan tidak tepat sasaran, anak terlantar, lansia masyarakat miskin',
                'examples' => 'Bantuan tidak tepat sasaran, anak terlantar, lansia, masyarakat miskin.',
                'opd_target' => 'Dinas Sosial',
                'is_active' => true,
            ],
            [
                'name' => 'Kesehatan & Lingkungan Medis',
                'slug' => 'kesehatan-lingkungan-medis',
                'description' => 'Pelayanan kesehatan di puskesmas/RS dan kebersihan medis seperti obat kosong, pelayanan lambat, fasilitas rusak, sampah medis',
                'examples' => 'Obat kosong, pelayanan lambat, fasilitas rusak, sampah medis.',
                'opd_target' => 'Dinas Kesehatan',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
