<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Major;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    public function index()
    {
        $majors = Major::withCount('registrations')->latest()->paginate(10);
        return view('admin.majors.index', compact('majors'));
    }

    public function create()
    {
        return view('admin.majors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jurusan' => 'required|string|max:100|unique:majors',
            'kuota'        => 'required|integer|min:1|max:500',
            'deskripsi'    => 'nullable|string|max:500',
        ], [
            'nama_jurusan.required' => 'Nama jurusan wajib diisi.',
            'nama_jurusan.unique'   => 'Nama jurusan sudah terdaftar.',
            'kuota.required'        => 'Kuota wajib diisi.',
            'kuota.min'             => 'Kuota minimal 1.',
        ]);

        Major::create($request->only(['nama_jurusan', 'kuota', 'deskripsi']));

        return redirect()->route('admin.majors.index')
                         ->with('success', 'Jurusan berhasil ditambahkan.');
    }

    public function edit(Major $major)
    {
        return view('admin.majors.edit', compact('major'));
    }

    public function update(Request $request, Major $major)
    {
        $request->validate([
            'nama_jurusan' => "required|string|max:100|unique:majors,nama_jurusan,{$major->id}",
            'kuota'        => 'required|integer|min:1|max:500',
            'deskripsi'    => 'nullable|string|max:500',
        ]);

        $major->update($request->only(['nama_jurusan', 'kuota', 'deskripsi']));

        return redirect()->route('admin.majors.index')
                         ->with('success', 'Jurusan berhasil diperbarui.');
    }

    public function destroy(Major $major)
    {
        if ($major->registrations()->exists()) {
            return back()->with('error', 'Jurusan tidak dapat dihapus karena sudah memiliki pendaftar.');
        }

        $major->delete();
        return redirect()->route('admin.majors.index')
                         ->with('success', 'Jurusan berhasil dihapus.');
    }
}
