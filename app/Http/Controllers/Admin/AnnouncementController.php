<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::latest('tanggal_publish')->paginate(10);
        return view('admin.announcements.index', compact('announcements'));
    }

    public function create()
    {
        return view('admin.announcements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'           => 'required|string|max:200',
            'isi'             => 'required|string',
            'tanggal_publish' => 'required|date',
            'is_published'    => 'boolean',
        ]);

        Announcement::create([
            'judul'           => $request->judul,
            'isi'             => $request->isi,
            'tanggal_publish' => $request->tanggal_publish,
            'is_published'    => $request->boolean('is_published', true),
        ]);

        return redirect()->route('admin.announcements.index')
                         ->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function edit(Announcement $announcement)
    {
        return view('admin.announcements.edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $request->validate([
            'judul'           => 'required|string|max:200',
            'isi'             => 'required|string',
            'tanggal_publish' => 'required|date',
            'is_published'    => 'boolean',
        ]);

        $announcement->update([
            'judul'           => $request->judul,
            'isi'             => $request->isi,
            'tanggal_publish' => $request->tanggal_publish,
            'is_published'    => $request->boolean('is_published', true),
        ]);

        return redirect()->route('admin.announcements.index')
                         ->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        return redirect()->route('admin.announcements.index')
                         ->with('success', 'Pengumuman berhasil dihapus.');
    }
}
