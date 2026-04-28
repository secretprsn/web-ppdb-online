@extends('layouts.admin')

@section('title', 'Detail Siswa - ' . $student->nama_lengkap)
@section('page-title', 'Detail Siswa')

@section('content')
<div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.25rem;">
    <a href="{{ route('admin.students.index') }}" style="color: #6B7280; font-size: 0.875rem; display: flex; align-items: center; gap: 0.375rem; text-decoration: none;">
        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali ke Daftar Siswa
    </a>
</div>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;">
    {{-- Data Pribadi --}}
    <div class="card" style="padding: 1.5rem;">
        <h3 style="font-family: 'Poppins', sans-serif; font-size: 0.9375rem; font-weight: 600; color: #1E3A5F; margin: 0 0 1.25rem; padding-bottom: 0.875rem; border-bottom: 1px solid #F3F4F6;">Data Pribadi</h3>
        <div style="display: flex; flex-direction: column; gap: 0.875rem;">
            @foreach([
                'Nama Lengkap' => $student->nama_lengkap,
                'NISN' => $student->nisn ?? '-',
                'Jenis Kelamin' => $student->jenis_kelamin_label,
                'Tempat, Tanggal Lahir' => $student->tempat_lahir . ', ' . $student->tanggal_lahir->isoFormat('D MMMM Y'),
                'Alamat' => $student->alamat,
                'Asal Sekolah' => $student->asal_sekolah,
                'No. HP' => $student->no_hp,
            ] as $label => $value)
            <div style="display: grid; grid-template-columns: 160px 1fr; gap: 0.5rem; align-items: start;">
                <span style="font-size: 0.8rem; color: #6B7280; font-weight: 500;">{{ $label }}</span>
                <span style="font-size: 0.875rem; color: #1E3A5F; font-weight: 500;">{{ $value }}</span>
            </div>
            @endforeach
        </div>
    </div>

    <div style="display: flex; flex-direction: column; gap: 1.25rem;">
        {{-- Status Pendaftaran --}}
        @if($student->registration)
        <div class="card" style="padding: 1.5rem;">
            <h3 style="font-family: 'Poppins', sans-serif; font-size: 0.9375rem; font-weight: 600; color: #1E3A5F; margin: 0 0 1.25rem; padding-bottom: 0.875rem; border-bottom: 1px solid #F3F4F6;">Status Pendaftaran</h3>
            <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-size: 0.8rem; color: #6B7280;">Jurusan</span>
                    <span style="font-size: 0.875rem; font-weight: 600; color: #1E3A5F;">{{ $student->registration->major->nama_jurusan }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-size: 0.8rem; color: #6B7280;">Tanggal Daftar</span>
                    <span style="font-size: 0.875rem; color: #374151;">{{ $student->registration->tanggal_daftar->isoFormat('D MMMM Y') }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-size: 0.8rem; color: #6B7280;">Nilai</span>
                    <span style="font-size: 0.875rem; color: #374151;">{{ $student->registration->nilai ?? '-' }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-size: 0.8rem; color: #6B7280;">Status</span>
                    <span class="badge-{{ $student->registration->status_verifikasi }}">{{ $student->registration->status_label }}</span>
                </div>
                @if($student->registration->catatan)
                <div style="background: #F9FAFB; border-radius: 0.5rem; padding: 0.75rem; margin-top: 0.25rem;">
                    <div style="font-size: 0.75rem; color: #6B7280; font-weight: 500; margin-bottom: 0.25rem;">Catatan Admin:</div>
                    <div style="font-size: 0.8125rem; color: #374151;">{{ $student->registration->catatan }}</div>
                </div>
                @endif
            </div>

            {{-- Form Verifikasi --}}
            <form method="POST" action="{{ route('admin.registrations.verify', $student->registration) }}" style="margin-top: 1.25rem; padding-top: 1rem; border-top: 1px solid #F3F4F6;">
                @csrf @method('PATCH')
                <div style="margin-bottom: 0.75rem;">
                    <label class="form-label" for="status_verifikasi">Ubah Status</label>
                    <select name="status_verifikasi" id="status_verifikasi" class="form-input">
                        <option value="pending"  {{ $student->registration->status_verifikasi === 'pending'  ? 'selected' : '' }}>Pending</option>
                        <option value="diterima" {{ $student->registration->status_verifikasi === 'diterima' ? 'selected' : '' }}>Diterima</option>
                        <option value="ditolak"  {{ $student->registration->status_verifikasi === 'ditolak'  ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
                <div style="margin-bottom: 0.75rem;">
                    <label class="form-label" for="nilai">Nilai (Opsional)</label>
                    <input type="number" name="nilai" id="nilai" value="{{ $student->registration->nilai }}" min="0" max="100" step="0.01" class="form-input" placeholder="0 - 100">
                </div>
                <div style="margin-bottom: 0.875rem;">
                    <label class="form-label" for="catatan">Catatan</label>
                    <textarea name="catatan" id="catatan" rows="2" class="form-input" placeholder="Catatan opsional untuk siswa...">{{ $student->registration->catatan }}</textarea>
                </div>
                <button type="submit" class="btn-primary" id="verify-btn" style="width: 100%; justify-content: center;">Simpan Verifikasi</button>
            </form>
        </div>
        @endif

        {{-- Dokumen --}}
        <div class="card" style="padding: 1.5rem;">
            <h3 style="font-family: 'Poppins', sans-serif; font-size: 0.9375rem; font-weight: 600; color: #1E3A5F; margin: 0 0 1rem; padding-bottom: 0.875rem; border-bottom: 1px solid #F3F4F6;">Dokumen yang Diunggah</h3>
            @forelse($student->documents as $doc)
            <div style="display: flex; align-items: center; justify-content: space-between; padding: 0.625rem 0; border-bottom: 1px solid #F9FAFB;">
                <div style="display: flex; align-items: center; gap: 0.625rem;">
                    <div style="width: 32px; height: 32px; background: #EFF6FF; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                        <svg width="14" height="14" fill="none" stroke="#1E3A5F" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <div>
                        <div style="font-size: 0.8125rem; font-weight: 500; color: #1E3A5F;">{{ $doc->jenis_label }}</div>
                        <div style="font-size: 0.7rem; color: #9CA3AF;">{{ $doc->nama_file }}</div>
                    </div>
                </div>
                <a href="{{ Storage::url($doc->file_path) }}" target="_blank" style="font-size: 0.75rem; color: #3A7CA5; font-weight: 500; text-decoration: none;">Lihat</a>
            </div>
            @empty
            <p style="font-size: 0.8125rem; color: #9CA3AF; text-align: center; padding: 0.75rem 0;">Belum ada dokumen diunggah.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
