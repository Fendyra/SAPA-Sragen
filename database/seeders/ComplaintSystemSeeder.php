<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Complaint;
use App\Models\User;
use Illuminate\Database\Seeder;

class ComplaintSystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Categories
        $categories = [
            [
                'name' => 'Infrastruktur',
                'slug' => 'infrastruktur',
                'description' => 'Pengaduan terkait jalan, jembatan, saluran air, dan infrastruktur publik lainnya',
                'is_active' => true,
            ],
            [
                'name' => 'Pelayanan Publik',
                'slug' => 'pelayanan-publik',
                'description' => 'Pengaduan terkait pelayanan administrasi dan layanan pemerintah',
                'is_active' => true,
            ],
            [
                'name' => 'Kebersihan',
                'slug' => 'kebersihan',
                'description' => 'Pengaduan terkait sampah, kebersihan lingkungan, dan sanitasi',
                'is_active' => true,
            ],
            [
                'name' => 'Keamanan',
                'slug' => 'keamanan',
                'description' => 'Pengaduan terkait keamanan dan ketertiban masyarakat',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create sample user (warga)
        $user = User::create([
            'nik' => '3314010101010002',
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'phone_number' => '081234567891',
            'password' => bcrypt('password'),
            'role' => 'warga',
        ]);

        // Create sample complaints
        $complaints = [
            [
                'user_id' => $user->id,
                'category_id' => 1,
                'title' => 'Jalan Berlubang di Jalan Raya Sukowati',
                'description' => 'Terdapat lubang besar di jalan raya Sukowati yang sangat mengganggu pengguna jalan. Lubang berukuran sekitar 50cm x 50cm dengan kedalaman 20cm. Sudah beberapa minggu dan belum diperbaiki.',
                'location' => 'Jl. Raya Sukowati, Sragen',
                'status' => 'pending',
            ],
            [
                'user_id' => $user->id,
                'category_id' => 3,
                'title' => 'Sampah Menumpuk di Pasar Sragen',
                'description' => 'Sampah di area pasar Sragen menumpuk dan tidak diangkut selama 3 hari. Menimbulkan bau tidak sedap dan mengganggu aktivitas pedagang.',
                'location' => 'Pasar Sragen, Jl. Veteran',
                'status' => 'proses',
            ],
            [
                'user_id' => $user->id,
                'category_id' => 2,
                'title' => 'Pelayanan KTP Lambat',
                'description' => 'Proses pembuatan KTP di Disdukcapil memakan waktu lebih dari 2 minggu, padahal dijanjikan 3 hari kerja.',
                'location' => 'Disdukcapil Sragen',
                'status' => 'selesai',
            ],
        ];

        foreach ($complaints as $complaint) {
            Complaint::create($complaint);
        }
    }
}
