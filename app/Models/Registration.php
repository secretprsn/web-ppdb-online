<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'major_id',
        'tanggal_daftar',
        'status_verifikasi',
        'catatan',
        'nilai',
    ];

    protected $casts = [
        'tanggal_daftar' => 'date',
        'nilai' => 'decimal:2',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status_verifikasi) {
            'pending'   => 'Menunggu Verifikasi',
            'diterima'  => 'Diterima',
            'ditolak'   => 'Ditolak',
            default     => 'Tidak Diketahui',
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status_verifikasi) {
            'pending'   => 'yellow',
            'diterima'  => 'green',
            'ditolak'   => 'red',
            default     => 'gray',
        };
    }
}
