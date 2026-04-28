@extends('layouts.admin')

@section('title', 'Edit Pengumuman')
@section('page-title', 'Edit Pengumuman')

@section('content')
<div style="max-width: 800px;">
    <div style="margin-bottom: 1.25rem;">
        <a href="{{ route('admin.announcements.index') }}" style="color: #6B7280; font-size: 0.875rem; display: flex; align-items: center; gap: 0.375rem; text-decoration: none;">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Daftar Pengumuman
        </a>
    </div>

    <div class="card" style="padding: 1.5rem;">
        <form method="POST" action="{{ route('admin.announcements.update', $announcement) }}">
            @csrf
            @method('PATCH')
            <div style="margin-bottom: 1.25rem;">
                <label for="judul" class="form-label">Judul Pengumuman</label>
                <input type="text" name="judul" id="judul" class="form-input" value="{{ old('judul', $announcement->judul) }}" placeholder="Judul besar pengumuman" required>
                @error('judul') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div style="margin-bottom: 1.25rem;">
                <label for="tanggal_publish" class="form-label">Tanggal Publish</label>
                <input type="date" name="tanggal_publish" id="tanggal_publish" class="form-input" value="{{ old('tanggal_publish', $announcement->tanggal_publish->toDateString()) }}" required>
                @error('tanggal_publish') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div style="margin-bottom: 1.25rem;">
                <label for="isi" class="form-label">Isi Pengumuman</label>
                <textarea name="isi" id="isi" rows="10" class="form-input" placeholder="Tulis pengumuman di sini..." required>{{ old('isi', $announcement->isi) }}</textarea>
                @error('isi') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div style="margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published', $announcement->is_published) ? 'checked' : '' }}>
                <label for="is_published" class="form-label" style="margin-bottom: 0;">Publish</label>
            </div>

            <div style="display: flex; gap: 0.75rem;">
                <button type="submit" class="btn-primary" style="padding: 0.75rem 2rem;">Simpan Perubahan</button>
                <a href="{{ route('admin.announcements.index') }}" class="btn-outline-sm" style="padding: 0.75rem 1.5rem;">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
