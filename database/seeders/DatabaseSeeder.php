<?php

namespace Database\Seeders;

use App\Models\Major;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin default
        User::create([
            'name'     => 'Administrator',
            'email'    => 'admin@ppdb.id',
            'password' => Hash::make('admin12345'),
            'role'     => 'admin',
        ]);

        // Data jurusan awal
        $majors = [
            [
                'nama_jurusan' => 'Teknik Komputer dan Jaringan',
                'kuota'        => 72,
                'deskripsi'    => 'Mempelajari instalasi, konfigurasi, dan pemeliharaan jaringan komputer serta perangkat keras.',
            ],
            [
                'nama_jurusan' => 'Rekayasa Perangkat Lunak',
                'kuota'        => 72,
                'deskripsi'    => 'Mempelajari perancangan, pengembangan, dan pengujian perangkat lunak berbasis web maupun mobile.',
            ],
            [
                'nama_jurusan' => 'Multimedia',
                'kuota'        => 36,
                'deskripsi'    => 'Mempelajari desain grafis, animasi, fotografi, dan produksi konten digital.',
            ],
            [
                'nama_jurusan' => 'Akuntansi dan Keuangan Lembaga',
                'kuota'        => 72,
                'deskripsi'    => 'Mempelajari pencatatan keuangan, perpajakan, dan pengelolaan lembaga keuangan.',
            ],
            [
                'nama_jurusan' => 'Otomatisasi dan Tata Kelola Perkantoran',
                'kuota'        => 36,
                'deskripsi'    => 'Mempelajari administrasi perkantoran, korespondensi, dan manajemen kearsipan.',
            ],
        ];

        foreach ($majors as $major) {
            Major::create($major);
        }

        // Jadwal PPDB
        $this->call([
            ScheduleSeeder::class,
        ]);
    }
}
