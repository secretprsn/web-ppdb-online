<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::orderBy('tanggal_mulai')->paginate(10);
        return view('admin.schedules.index', compact('schedules'));
    }

    public function create()
    {
        return view('admin.schedules.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan'   => 'required|string|max:200',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'keterangan'      => 'nullable|string|max:500',
        ], [
            'tanggal_selesai.after_or_equal' => 'Tanggal selesai harus sama dengan atau setelah tanggal mulai.',
        ]);

        Schedule::create($request->only(['nama_kegiatan', 'tanggal_mulai', 'tanggal_selesai', 'keterangan']));

        return redirect()->route('admin.schedules.index')
                         ->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit(Schedule $schedule)
    {
        return view('admin.schedules.edit', compact('schedule'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'nama_kegiatan'   => 'required|string|max:200',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'keterangan'      => 'nullable|string|max:500',
        ]);

        $schedule->update($request->only(['nama_kegiatan', 'tanggal_mulai', 'tanggal_selesai', 'keterangan']));

        return redirect()->route('admin.schedules.index')
                         ->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('admin.schedules.index')
                         ->with('success', 'Jadwal berhasil dihapus.');
    }
}
