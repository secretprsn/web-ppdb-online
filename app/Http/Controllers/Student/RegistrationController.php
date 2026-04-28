<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Major;
use App\Models\Registration;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{
    public function step1(Request $request)
    {
        $user    = auth()->user();
        $student = $user->student;

        // Jika sudah daftar dan sudah diverifikasi (diterima/ditolak), tidak bisa edit
        if ($student && $student->registration &&
            in_array($student->registration->status_verifikasi, ['diterima', 'ditolak'])) {
            return redirect()->route('student.registration.show')
                             ->with('info', 'Pendaftaran Anda sudah diverifikasi dan tidak dapat diubah.');
        }

        return view('student.registration.step1', compact('student'));
    }

    public function storeStep1(Request $request)
    {
        $request->validate([
            'nisn'          => 'required|string|max:20|unique:students,nisn,' . (auth()->user()->student?->id ?? 'NULL'),
            'nama_lengkap'  => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir'  => 'required|string|max:100',
            'tanggal_lahir' => 'required|date|before:today',
            'alamat'        => 'required|string|max:500',
            'asal_sekolah'  => 'required|string|max:100',
            'no_hp'         => 'required|string|max:20|regex:/^[0-9+\-\s]+$/',
        ], [
            'nisn.unique'        => 'NISN sudah terdaftar.',
            'tanggal_lahir.before' => 'Tanggal lahir tidak valid.',
            'no_hp.regex'        => 'Format nomor HP tidak valid.',
        ]);

        $user    = auth()->user();
        $student = $user->student;

        $data = $request->only([
            'nisn', 'nama_lengkap', 'jenis_kelamin', 'tempat_lahir',
            'tanggal_lahir', 'alamat', 'asal_sekolah', 'no_hp',
        ]);

        if ($student) {
            $student->update($data);
        } else {
            $student = Student::create(array_merge($data, ['user_id' => $user->id]));
        }

        // Jika sudah ada registrasi, kembali ke halaman detail
        if (auth()->user()->fresh()->student->registration) {
            return redirect()->route('student.registration.show')
                             ->with('success', 'Data pribadi berhasil diperbarui.');
        }

        return redirect()->route('student.registration.step2');
    }

    public function step2(Request $request)
    {
        $student = auth()->user()->student;

        if (!$student) {
            return redirect()->route('student.registration.step1')
                             ->with('error', 'Lengkapi data diri terlebih dahulu.');
        }

        $majors = Major::all();

        return view('student.registration.step2', compact('student', 'majors'));
    }

    public function storeStep2(Request $request)
    {
        $request->validate([
            'major_id' => 'required|exists:majors,id',
        ], [
            'major_id.required' => 'Pilih jurusan yang diminati.',
        ]);

        $student = auth()->user()->student;

        if (!$student) {
            return redirect()->route('student.registration.step1')->with('error', 'Lengkapi data diri terlebih dahulu.');
        }

        // Jika sudah ada registrasi, jangan buat baru
        if ($student->registration) {
            return redirect()->route('student.registration.show')
                             ->with('info', 'Anda sudah melakukan pendaftaran.');
        }

        $major = Major::findOrFail($request->major_id);
        
        // Pengecekan Kuota
        if ($major->registrations_count >= $major->kuota) {
            return back()->with('error', 'Maaf, kuota untuk jurusan ' . $major->nama_jurusan . ' sudah penuh.');
        }

        $registration = Registration::create([
            'student_id'        => $student->id,
            'major_id'          => $request->major_id,
            'tanggal_daftar'    => now()->toDateString(),
            'status_verifikasi' => 'pending',
        ]);

        // Opsional: Kirim notifikasi jika class sudah tersedia
        try {
            if (class_exists('\App\Notifications\RegistrationSuccessful')) {
                auth()->user()->notify(new \App\Notifications\RegistrationSuccessful($registration));
            }
        } catch (\Exception $e) {
            // Silently fail notification
        }

        return redirect()->route('student.registration.step3');
    }

    public function show()
    {
        $student = auth()->user()->student;

        if (!$student || !$student->registration) {
            return redirect()->route('student.registration.step1');
        }

        $dokumenTypes = [
            'kartu_keluarga' => 'Kartu Keluarga',
            'akta_kelahiran' => 'Akta Kelahiran',
            'ijazah'         => 'Ijazah',
            'skhun'          => 'SKHUN',
            'foto'           => 'Foto 3x4',
            'raport'         => 'Raport',
        ];

        $uploadedDocs = $student->documents->keyBy('jenis_dokumen');
        $majors       = \App\Models\Major::all();

        return view('student.registration.show', compact('student', 'dokumenTypes', 'uploadedDocs', 'majors'));
    }

    public function updateMajor(Request $request)
    {
        $request->validate([
            'major_id' => 'required|exists:majors,id',
        ], [
            'major_id.required' => 'Pilih jurusan terlebih dahulu.',
        ]);

        $student = auth()->user()->student;

        if (!$student || !$student->registration) {
            return redirect()->route('student.registration.step1');
        }

        $registration = $student->registration;

        // Hanya bisa diubah jika masih pending
        if ($registration->status_verifikasi !== 'pending') {
            return redirect()->route('student.registration.show')
                             ->with('error', 'Jurusan tidak dapat diubah karena pendaftaran sudah diverifikasi.');
        }

        $registration->update(['major_id' => $request->major_id]);

        return redirect()->route('student.registration.show')
                         ->with('success', 'Jurusan berhasil diperbarui.');
    }

    public function step3()
    {
        $student = auth()->user()->student;

        if (!$student || !$student->registration) {
            return redirect()->route('student.registration.step1');
        }

        $dokumenTypes = [
            'kartu_keluarga' => 'Kartu Keluarga',
            'akta_kelahiran' => 'Akta Kelahiran',
            'ijazah'         => 'Ijazah',
            'skhun'          => 'SKHUN',
            'foto'           => 'Foto 3x4',
            'raport'         => 'Raport',
        ];

        $uploadedDocs = $student->documents->pluck('jenis_dokumen')->toArray();

        return view('student.registration.step3', compact('student', 'dokumenTypes', 'uploadedDocs'));
    }

    public function uploadDocument(Request $request)
    {
        $request->validate([
            'jenis_dokumen' => 'required|in:kartu_keluarga,akta_kelahiran,ijazah,skhun,foto,raport',
            'file'          => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ], [
            'file.mimes' => 'File harus berformat PDF, JPG, atau PNG.',
            'file.max'   => 'Ukuran file maksimal 2MB.',
        ]);

        $student = auth()->user()->student;

        if (!$student) {
            return back()->with('error', 'Data siswa tidak ditemukan.');
        }

        $file     = $request->file('file');
        $fileName = time() . '_' . $request->jenis_dokumen . '.' . $file->getClientOriginalExtension();
        $path     = $file->storeAs("documents/{$student->id}", $fileName, 'public');

        // Hapus dokumen lama jika ada
        $existing = $student->documents()->where('jenis_dokumen', $request->jenis_dokumen)->first();
        if ($existing) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($existing->file_path);
            $existing->delete();
        }

        $student->documents()->create([
            'jenis_dokumen' => $request->jenis_dokumen,
            'file_path'     => $path,
            'nama_file'     => $file->getClientOriginalName(),
        ]);

        return back()->with('success', 'Dokumen berhasil diunggah.');
    }

    public function complete()
    {
        $student = auth()->user()->student;

        if (!$student || !$student->registration) {
            return redirect()->route('student.registration.step1');
        }

        return view('student.registration.complete', compact('student'));
    }
}
