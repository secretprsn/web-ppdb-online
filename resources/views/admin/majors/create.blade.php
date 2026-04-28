@extends('layouts.admin')

@section('title', 'Tambah Jurusan')
@section('page-title', 'Tambah Jurusan')

@section('content')
<div style="max-width: 600px;">
    <div style="margin-bottom: 1.25rem;">
        <a href="{{ route('admin.majors.index') }}" style="color: #6B7280; font-size: 0.875rem; display: flex; align-items: center; gap: 0.375rem; text-decoration: none;">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Daftar Jurusan
        </a>
    </div>

    <div class="card" style="padding: 1.5rem;">
        <form method="POST" action="{{ route('admin.majors.store') }}">
            @csrf
            <div style="margin-bottom: 1.25rem;">
                <label for="nama_jurusan" class="form-label">Nama Jurusan</label>
                <input type="text" name="nama_jurusan" id="nama_jurusan" class="form-input" value="{{ old('nama_jurusan') }}" placeholder="Contoh: Rekayasa Perangkat Lunak" required>
                @error('nama_jurusan') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div style="margin-bottom: 1.25rem;">
                <label for="kuota" class="form-label">Kuota Peserta</label>
                <input type="number" name="kuota" id="kuota" class="form-input" value="{{ old('kuota') }}" placeholder="Jumlah kuota siswa baru" required min="1">
                @error('kuota') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label for="deskripsi" class="form-label">Deskripsi Jurusan (Opsional)</label>
                <textarea name="deskripsi" id="deskripsi" rows="4" class="form-input" placeholder="Jelaskan secara singkat tentang jurusan ini...">{{ old('deskripsi') }}</textarea>
                @error('deskripsi') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div style="display: flex; gap: 0.75rem;">
                <button type="submit" class="btn-primary" style="padding: 0.75rem 2rem;">Simpan Jurusan</button>
                <a href="{{ route('admin.majors.index') }}" class="btn-outline-sm" style="padding: 0.75rem 1.5rem;">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
