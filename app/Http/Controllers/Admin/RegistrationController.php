<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index(Request $request)
    {
        $query = Registration::with(['student', 'major']);

        if ($request->filled('status')) {
            $query->where('status_verifikasi', $request->status);
        }

        if ($request->filled('major')) {
            $query->where('major_id', $request->major);
        }

        $registrations = $query->latest()->paginate(15)->withQueryString();

        return view('admin.registrations.index', compact('registrations'));
    }

    public function show(Registration $registration)
    {
        $registration->load(['student.documents', 'major']);
        return view('admin.registrations.show', compact('registration'));
    }

    public function verify(Request $request, Registration $registration)
    {
        $request->validate([
            'status_verifikasi' => 'required|in:diterima,ditolak,pending',
            'catatan'           => 'nullable|string|max:500',
            'nilai'             => 'nullable|numeric|min:0|max:100',
        ]);

        $registration->update([
            'status_verifikasi' => $request->status_verifikasi,
            'catatan'           => $request->catatan,
            'nilai'             => $request->nilai,
        ]);

        return redirect()->route('admin.registrations.show', $registration)
                         ->with('success', 'Status verifikasi berhasil diperbarui.');
    }
}
