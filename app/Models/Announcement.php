<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'isi',
        'tanggal_publish',
        'is_published',
    ];

    protected $casts = [
        'tanggal_publish' => 'date',
        'is_published'    => 'boolean',
    ];

    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                     ->where('tanggal_publish', '<=', now()->toDateString())
                     ->orderByDesc('tanggal_publish');
    }
}
