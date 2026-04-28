@extends('layouts.student')

@section('title', 'Pendaftaran - Langkah 1')

@section('content')
<div class="step-bar" style="max-width: 600px; margin: 0 auto 3rem;">
    <div class="step-item">
        <div class="step-circle active">1</div>
        <div class="step-label active">Data Diri</div>
    </div>
    <div class="step-line active"></div>
    <div class="step-item">
        <div class="step-circle inactive">2</div>
        <div class="step-label inactive">Jurusan</div>
    </div>
    <div class="step-line"></div>
    <div class="step-item">
        <div class="step-circle inactive">3</div>
        <div class="step-label inactive">Dokumen</div>
    </div>
</div>

<div class="card" style="max-width: 800px; margin: 0 auto; padding: 3rem;">
    <div style="margin-bottom: 2.5rem;">
        <h2 style="font-size: 1.5rem; font-weight: 800; color: var(--primary); margin-bottom: 0.5rem;">Data Pribadi</h2>
        <p style="color: var(--text-muted); font-size: 0.9375rem;">Pastikan data yang Anda masukkan sudah sesuai dengan dokumen kependudukan resmi.</p>
    </div>

    <form method="POST" action="{{ route('student.registration.step1.store') }}">
        @csrf
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
            <div>
                <label for="nisn" class="form-label">NISN</label>
                <input type="text" name="nisn" id="nisn" class="form-input" value="{{ old('nisn', $student?->nisn ?? '') }}" required placeholder="Masukkan 10 digit NISN">
                @error('nisn') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div>
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-input" value="{{ old('nama_lengkap', $student?->nama_lengkap ?? auth()->user()->name) }}" required>
                @error('nama_lengkap') <div class="form-error">{{ $message }}</div> @enderror
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
            <div>
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="form-input" required>
                    <option value="">Pilih</option>
                    <option value="L" {{ old('jenis_kelamin', $student?->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ old('jenis_kelamin', $student?->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('jenis_kelamin') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div>
                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-input" value="{{ old('tempat_lahir', $student?->tempat_lahir ?? '') }}" required>
                @error('tempat_lahir') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div>
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-input" value="{{ old('tanggal_lahir', $student?->tanggal_lahir?->toDateString() ?? '') }}" required>
                @error('tanggal_lahir') <div class="form-error">{{ $message }}</div> @enderror
            </div>
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label for="alamat" class="form-label">Alamat Domisili</label>
            <textarea name="alamat" id="alamat" rows="3" class="form-input" required placeholder="Tuliskan alamat lengkap sesuai KTP/KK">{{ old('alamat', $student->alamat ?? '') }}</textarea>
            @error('alamat') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2.5rem;">
            <div>
                <label for="asal_sekolah" class="form-label">Sekolah Asal</label>
                <input type="text" name="asal_sekolah" id="asal_sekolah" class="form-input" value="{{ old('asal_sekolah', $student->asal_sekolah ?? '') }}" required placeholder="Contoh: SMP Negeri 1 Bandung">
                @error('asal_sekolah') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div>
                <label for="no_hp" class="form-label">Nomor WhatsApp Aktif</label>
                <input type="text" name="no_hp" id="no_hp" class="form-input" value="{{ old('no_hp', $student->no_hp ?? '') }}" required placeholder="Contoh: 081234567890">
                @error('no_hp') <div class="form-error">{{ $message }}</div> @enderror
            </div>
        </div>

        <div style="display: flex; justify-content: flex-end;">
            <button type="submit" class="btn-primary" style="padding-left: 3rem; padding-right: 3rem;">Lanjutkan &rarr;</button>
        </div>
    </form>
</div>
@endsection
