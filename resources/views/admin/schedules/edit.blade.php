@extends('layouts.admin')

@section('title', 'Edit Jadwal')
@section('page-title', 'Edit Jadwal')

@section('content')
<div style="max-width: 600px;">
    <div style="margin-bottom: 1.25rem;">
        <a href="{{ route('admin.schedules.index') }}" style="color: #6B7280; font-size: 0.875rem; display: flex; align-items: center; gap: 0.375rem; text-decoration: none;">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Daftar Jadwal
        </a>
    </div>

    <div class="card" style="padding: 1.5rem;">
        <form method="POST" action="{{ route('admin.schedules.update', $schedule) }}">
            @csrf
            @method('PATCH')
            <div style="margin-bottom: 1.25rem;">
                <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
                <input type="text" name="nama_kegiatan" id="nama_kegiatan" class="form-input" value="{{ old('nama_kegiatan', $schedule->nama_kegiatan) }}" placeholder="Contoh: Pendaftaran Online" required>
                @error('nama_kegiatan') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.25rem;">
                <div>
                    <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-input" value="{{ old('tanggal_mulai', $schedule->tanggal_mulai->toDateString()) }}" required>
                    @error('tanggal_mulai') <div class="form-error">{{ $message }}</div> @enderror
                </div>
                <div>
                    <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-input" value="{{ old('tanggal_selesai', $schedule->tanggal_selesai->toDateString()) }}" required>
                    @error('tanggal_selesai') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label for="keterangan" class="form-label">Keterangan (Opsional)</label>
                <textarea name="keterangan" id="keterangan" rows="3" class="form-input" placeholder="Deskripsi singkat kegiatan...">{{ old('keterangan', $schedule->keterangan) }}</textarea>
                @error('keterangan') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div style="display: flex; gap: 0.75rem;">
                <button type="submit" class="btn-primary" style="padding: 0.75rem 2rem;">Simpan Perubahan</button>
                <a href="{{ route('admin.schedules.index') }}" class="btn-outline-sm" style="padding: 0.75rem 1.5rem;">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
