<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'jenis_dokumen',
        'file_path',
        'nama_file',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function getJenisLabelAttribute(): string
    {
        return match ($this->jenis_dokumen) {
            'kartu_keluarga' => 'Kartu Keluarga',
            'akta_kelahiran' => 'Akta Kelahiran',
            'ijazah'         => 'Ijazah',
            'skhun'          => 'SKHUN',
            'foto'           => 'Foto 3x4',
            'raport'         => 'Raport',
            default          => ucfirst($this->jenis_dokumen),
        };
    }
}
