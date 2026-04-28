@extends('layouts.admin')

@section('title', 'Detail Pendaftaran')
@section('page-title', 'Detail Pendaftaran')

@section('content')
<div style="margin-bottom: 1.25rem;">
    <a href="{{ route('admin.registrations.index') }}" style="color: #6B7280; font-size: 0.875rem; display: flex; align-items: center; gap: 0.375rem; text-decoration: none;">
        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali ke Daftar Pendaftaran
    </a>
</div>

<div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 1.5rem;">
    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
        {{-- Data Siswa --}}
        <div class="card" style="padding: 1.5rem;">
            <h3 style="font-family: 'Poppins', sans-serif; font-size: 1rem; font-weight: 600; color: #1E3A5F; margin-bottom: 1.25rem;">Informasi Pendaftar</h3>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div>
                    <label class="form-label" style="color: #6B7280;">Nama Lengkap</label>
                    <div style="font-weight: 600; color: #1E3A5F;">{{ $registration->student->nama_lengkap }}</div>
                </div>
                <div>
                    <label class="form-label" style="color: #6B7280;">NISN</label>
                    <div style="font-weight: 600; color: #1E3A5F;">{{ $registration->student->nisn ?? '-' }}</div>
                </div>
                <div>
                    <label class="form-label" style="color: #6B7280;">Asal Sekolah</label>
                    <div style="color: #374151;">{{ $registration->student->asal_sekolah }}</div>
                </div>
                <div>
                    <label class="form-label" style="color: #6B7280;">No. HP</label>
                    <div style="color: #374151;">{{ $registration->student->no_hp }}</div>
                </div>
            </div>
        </div>

        {{-- Dokumen --}}
        <div class="card" style="padding: 1.5rem;">
            <h3 style="font-family: 'Poppins', sans-serif; font-size: 1rem; font-weight: 600; color: #1E3A5F; margin-bottom: 1rem;">Dokumen Persyaratan</h3>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem;">
                @foreach($registration->student->documents as $doc)
                <div style="display: flex; align-items: center; justify-content: space-between; padding: 0.75rem; background: #F9FAFB; border-radius: 0.5rem; border: 1px solid #F3F4F6;">
                    <div style="font-size: 0.8125rem; font-weight: 500;">{{ $doc->jenis_label }}</div>
                    <a href="{{ Storage::url($doc->file_path) }}" target="_blank" class="btn-outline-sm" style="font-size: 0.7rem;">Lihat</a>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div>
        {{-- Verifikasi --}}
        <div class="card" style="padding: 1.5rem; position: sticky; top: 80px;">
            <h3 style="font-family: 'Poppins', sans-serif; font-size: 1rem; font-weight: 600; color: #1E3A5F; margin-bottom: 1.25rem;">Verifikasi Pendaftaran</h3>
            
            <div style="margin-bottom: 1rem; padding: 1rem; background: #F0F9FF; border-radius: 0.75rem;">
                <label class="form-label" style="color: #3A7CA5;">Jurusan Pilihan</label>
                <div style="font-weight: 700; color: #1E3A5F; font-size: 1.125rem;">{{ $registration->major->nama_jurusan }}</div>
            </div>

            <form method="POST" action="{{ route('admin.registrations.verify', $registration) }}">
                @csrf @method('PATCH')
                
                <div style="margin-bottom: 1rem;">
                    <label for="status_verifikasi" class="form-label">Status Verifikasi</label>
                    <select name="status_verifikasi" id="status_verifikasi" class="form-input" required>
                        <option value="pending" {{ $registration->status_verifikasi == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="diterima" {{ $registration->status_verifikasi == 'diterima' ? 'selected' : '' }}>Diterima</option>
                        <option value="ditolak" {{ $registration->status_verifikasi == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>

                <div style="margin-bottom: 1rem;">
                    <label for="nilai" class="form-label">Nilai Seleksi / Rata-rata Raport</label>
                    <input type="number" name="nilai" id="nilai" class="form-input" value="{{ old('nilai', $registration->nilai) }}" step="0.01" min="0" max="100">
                </div>

                <div style="margin-bottom: 1.25rem;">
                    <label for="catatan" class="form-label">Catatan Admin</label>
                    <textarea name="catatan" id="catatan" rows="3" class="form-input" placeholder="Alasan ditolak atau instruksi jika diterima...">{{ old('catatan', $registration->catatan) }}</textarea>
                </div>

                <button type="submit" class="btn-primary" style="width: 100%; justify-content: center;">Simpan Hasil Verifikasi</button>
            </form>
        </div>
    </div>
</div>
@endsection
