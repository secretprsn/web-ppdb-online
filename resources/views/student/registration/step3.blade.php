@extends('layouts.student')

@section('title', 'Pendaftaran - Langkah 3')

@section('content')
<div class="step-bar">
    <div class="step-item">
        <div class="step-circle done">
            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
        </div>
        <div class="step-label done">Data Diri</div>
    </div>
    <div class="step-line done"></div>
    <div class="step-item">
        <div class="step-circle done">
            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
        </div>
        <div class="step-label done">Pilih Jurusan</div>
    </div>
    <div class="step-line done"></div>
    <div class="step-item">
        <div class="step-circle active">3</div>
        <div class="step-label active">Unggah Dokumen</div>
    </div>
</div>

<div class="card" style="padding: 2rem;">
    <h2 style="font-size: 1.25rem; font-weight: 700; color: #1E3A5F; margin-bottom: 0.5rem;">Unggah Dokumen Persyaratan</h2>
    <p style="color: #6B7280; font-size: 0.875rem; margin-bottom: 2rem;">Silakan unggah pindaian (scan) dokumen asli dalam format PDF atau Gambar (JPG/PNG).</p>

    <div style="display: grid; grid-template-columns: 1fr; gap: 1rem; margin-bottom: 2rem;">
        @foreach($dokumenTypes as $key => $label)
        @php $isUploaded = in_array($key, $uploadedDocs); @endphp
        <div style="padding: 1.25rem; border: 1px solid #E5E7EB; border-radius: 1rem; display: flex; align-items: center; justify-content: space-between; gap: 1rem; flex-wrap: wrap;">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="width: 40px; height: 40px; border-radius: 0.75rem; background: {{ $isUploaded ? '#D1FAE5' : '#F3F4F6' }}; display: flex; align-items: center; justify-content: center;">
                    @if($isUploaded)
                        <svg width="20" height="20" fill="none" stroke="#059669" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    @else
                        <svg width="20" height="20" fill="none" stroke="#9CA3AF" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    @endif
                </div>
                <div>
                    <div style="font-size: 0.875rem; font-weight: 600; color: #1E3A5F;">{{ $label }}</div>
                    <div style="font-size: 0.75rem; color: #9CA3AF;">{{ $isUploaded ? 'Dokumen sudah diunggah' : 'Belum diunggah (Wajib)' }}</div>
                </div>
            </div>

            <form action="{{ route('student.registration.upload') }}" method="POST" enctype="multipart/form-data" style="display: flex; align-items: center; gap: 0.75rem;">
                @csrf
                <input type="hidden" name="jenis_dokumen" value="{{ $key }}">
                <label class="btn-outline-sm" style="margin: 0; cursor: pointer; padding: 0.5rem 1rem;">
                    {{ $isUploaded ? 'Ganti File' : 'Pilih File' }}
                    <input type="file" name="file" style="display: none;" onchange="this.form.submit()">
                </label>
                @if($isUploaded)
                    <span style="font-size: 0.75rem; color: #059669; font-weight: 600;">Berhasil</span>
                @endif
            </form>
        </div>
        @endforeach
    </div>

    <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 1.5rem; border-top: 1px solid #F3F4F6;">
        <p style="font-size: 0.8125rem; color: #6B7280;">Pastikan semua dokumen sudah tercentang hijau sebelum lanjut.</p>
        <a href="{{ route('student.registration.complete') }}" class="btn-primary" style="background: #059669;">Selesaikan Pendaftaran</a>
    </div>
</div>
@endsection
