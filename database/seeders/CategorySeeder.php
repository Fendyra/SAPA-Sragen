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
                'is_active' => true,
            ],
            [
                'name' => 'Kebersihan & Lingkungan',
                'slug' => 'kebersihan-lingkungan',
                'description' => 'Masalah kebersihan dan lingkungan sekitar seperti sampah menumpuk, pencemaran, drainase, penghijauan',
                'is_active' => true,
            ],
            [
                'name' => 'Pelayanan Publik & Administrasi',
                'slug' => 'pelayanan-publik-administrasi',
                'description' => 'Layanan publik di kantor pemerintahan seperti KTP, KK, surat pindah, pelayanan lambat, antrean, pungli',
                'is_active' => true,
            ],
            [
                'name' => 'Keamanan & Ketertiban Umum',
                'slug' => 'keamanan-ketertiban-umum',
                'description' => 'Aduan yang berkaitan dengan gangguan keamanan atau keselamatan umum seperti kebisingan, parkir liar, pelanggaran perda, keamanan lingkungan',
                'is_active' => true,
            ],
            [
                'name' => 'Sosial & Kesejahteraan Masyarakat',
                'slug' => 'sosial-kesejahteraan-masyarakat',
                'description' => 'Masalah sosial masyarakat atau bantuan sosial seperti bantuan tidak tepat sasaran, anak terlantar, lansia masyarakat miskin',
                'is_active' => true,
            ],
            [
                'name' => 'Kesehatan & Lingkungan Medis',
                'slug' => 'kesehatan-lingkungan-medis',
                'description' => 'Pelayanan kesehatan di puskesmas/RS dan kebersihan medis seperti obat kosong, pelayanan lambat, fasilitas rusak, sampah medis',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
