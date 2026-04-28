<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StudentsExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    public function collection()
    {
        return Student::with(['user', 'registration.major'])->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'NISN',
            'Nama Lengkap',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Alamat',
            'Asal Sekolah',
            'No HP',
            'Jurusan Pilihan',
            'Tanggal Daftar',
            'Status Verifikasi',
        ];
    }

    public function map($student): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $student->nisn,
            $student->nama_lengkap,
            $student->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan',
            $student->tempat_lahir,
            $student->tanggal_lahir->format('d/m/Y'),
            $student->alamat,
            $student->asal_sekolah,
            $student->no_hp,
            $student->registration?->major?->nama_jurusan ?? '-',
            $student->registration?->tanggal_daftar?->format('d/m/Y') ?? '-',
            $student->registration?->status_label ?? '-',
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font'      => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill'      => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E3A5F']],
                'alignment' => ['horizontal' => 'center'],
            ],
        ];
    }
}
