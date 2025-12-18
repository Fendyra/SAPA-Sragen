<?php

namespace Database\Seeders;

use App\Models\Report;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing reports to avoid duplicate key errors
        Report::truncate();

        // Get the first user or create one
        $user = User::first() ?? User::create([
            'nik' => '3314010101010001',
            'name' => 'John Doe',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'phone_number' => '081234567890',
            'role' => 'warga',
        ]);

        $reports = [
            [
                'user_id' => $user->id,
                'ticket_number' => 'SR-2512-001',
                'title' => 'Jalan Berlubang di Jalan Raya Sukowati',
                'category' => 'Infrastruktur',
                'description' => 'Terdapat lubang besar di jalan raya Sukowati yang sangat mengganggu pengguna jalan. Lubang berukuran sekitar 50cm x 50cm dengan kedalaman 20cm.',
                'district' => 'Sragen',
                'village' => 'Sukowati',
                'address' => 'Jl. Raya Sukowati No. 123, Sragen',
                'latitude' => -7.4254,
                'longitude' => 111.0108,
                'status' => 'processing',
                'is_anonymous' => false,
                'is_public' => true,
                'attachments' => json_encode([]),
            ],
            [
                'user_id' => $user->id,
                'ticket_number' => 'SR-2512-002',
                'title' => 'Lampu Jalan Mati di Perempatan Pasar',
                'category' => 'Infrastruktur',
                'description' => 'Lampu penerangan jalan di perempatan pasar tidak menyala sejak 3 hari yang lalu, menyebabkan area tersebut gelap di malam hari.',
                'district' => 'Sragen',
                'village' => 'Nglorog',
                'address' => 'Perempatan Pasar Nglorog, Sragen',
                'latitude' => -7.4265,
                'longitude' => 111.0125,
                'status' => 'verified',
                'is_anonymous' => false,
                'is_public' => true,
                'attachments' => json_encode([]),
            ],
            [
                'user_id' => $user->id,
                'ticket_number' => 'SR-2512-003',
                'title' => 'Sampah Menumpuk di TPS Kecamatan',
                'category' => 'Kebersihan',
                'description' => 'Sampah di TPS kecamatan sudah menumpuk tinggi dan tidak diangkut selama beberapa hari, menimbulkan bau tidak sedap.',
                'district' => 'Sragen',
                'village' => 'Sragen Kulon',
                'address' => 'TPS Kecamatan Sragen Kulon',
                'latitude' => -7.4245,
                'longitude' => 111.0090,
                'status' => 'completed',
                'is_anonymous' => true,
                'is_public' => true,
                'attachments' => json_encode([]),
            ],
            [
                'user_id' => $user->id,
                'ticket_number' => 'SR-2512-004',
                'title' => 'Pohon Tumbang Menghalangi Jalan',
                'category' => 'Lingkungan',
                'description' => 'Pohon besar tumbang akibat angin kencang dan menghalangi sebagian badan jalan, mengganggu lalu lintas.',
                'district' => 'Sragen',
                'village' => 'Tangkil',
                'address' => 'Jl. Tangkil - Sragen KM 5',
                'latitude' => -7.4280,
                'longitude' => 111.0150,
                'status' => 'pending',
                'is_anonymous' => false,
                'is_public' => true,
                'attachments' => json_encode([]),
            ],
        ];

        foreach ($reports as $report) {
            Report::create($report);
        }
    }
}
