<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $schedules = [
            [
                'nama_kegiatan'  => 'Pendaftaran Online',
                'tanggal_mulai'  => '2026-05-01',
                'tanggal_selesai' => '2026-06-15',
                'keterangan'     => 'Pendaftaran calon peserta didik baru melalui portal online.',
            ],
            [
                'nama_kegiatan'  => 'Verifikasi Berkas',
                'tanggal_mulai'  => '2026-06-16',
                'tanggal_selesai' => '2026-06-25',
                'keterangan'     => 'Verifikasi dokumen dan berkas persyaratan oleh panitia PPDB.',
            ],
            [
                'nama_kegiatan'  => 'Seleksi dan Penilaian',
                'tanggal_mulai'  => '2026-06-26',
                'tanggal_selesai' => '2026-06-30',
                'keterangan'     => 'Proses seleksi berdasarkan nilai rapor dan hasil tes.',
            ],
            [
                'nama_kegiatan'  => 'Pengumuman Hasil Seleksi',
                'tanggal_mulai'  => '2026-07-02',
                'tanggal_selesai' => '2026-07-02',
                'keterangan'     => 'Pengumuman calon siswa yang diterima melalui portal PPDB.',
            ],
            [
                'nama_kegiatan'  => 'Daftar Ulang',
                'tanggal_mulai'  => '2026-07-03',
                'tanggal_selesai' => '2026-07-10',
                'keterangan'     => 'Daftar ulang bagi calon siswa yang dinyatakan diterima.',
            ],
        ];

        foreach ($schedules as $schedule) {
            Schedule::create($schedule);
        }
    }
}
