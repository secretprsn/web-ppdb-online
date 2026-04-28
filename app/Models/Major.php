<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_jurusan',
        'kuota',
        'deskripsi',
    ];

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function getDiterimaCountAttribute(): int
    {
        return $this->registrations()->where('status_verifikasi', 'diterima')->count();
    }

    public function getSisaKuotaAttribute(): int
    {
        return max(0, $this->kuota - $this->diterimaCount);
    }

    public function getIsFullAttribute(): bool
    {
        return $this->registrations()->count() >= $this->kuota;
    }
}
