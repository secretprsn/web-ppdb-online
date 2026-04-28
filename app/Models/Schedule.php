<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kegiatan',
        'tanggal_mulai',
        'tanggal_selesai',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_mulai'   => 'date',
        'tanggal_selesai' => 'date',
    ];

    public function getStatusAttribute(): string
    {
        $today = now()->toDateString();
        if ($this->tanggal_mulai->toDateString() > $today) {
            return 'upcoming';
        } elseif ($this->tanggal_selesai->toDateString() < $today) {
            return 'selesai';
        }
        return 'berlangsung';
    }
}
