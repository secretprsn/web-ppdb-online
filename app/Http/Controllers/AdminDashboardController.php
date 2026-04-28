<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Major;
use App\Models\Registration;
use App\Models\Schedule;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_siswa'        => Student::count(),
            'total_pendaftar'    => Registration::count(),
            'diterima'           => Registration::where('status_verifikasi', 'diterima')->count(),
            'ditolak'            => Registration::where('status_verifikasi', 'ditolak')->count(),
            'pending'            => Registration::where('status_verifikasi', 'pending')->count(),
            'total_jurusan'      => Major::count(),
        ];

        $registrasiPerJurusan = Major::withCount([
            'registrations',
            'registrations as diterima_count' => fn($q) => $q->where('status_verifikasi', 'diterima'),
        ])->get();

        $recentRegistrations = Registration::with(['student', 'major'])
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'registrasiPerJurusan', 'recentRegistrations'));
    }
}
