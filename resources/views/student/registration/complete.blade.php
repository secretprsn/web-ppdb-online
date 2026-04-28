@extends('layouts.student')

@section('title', 'Pendaftaran Selesai')

@section('content')
<div class="card" style="padding: 3rem 2rem; text-align: center;">
    <div style="width: 80px; height: 80px; background: #D1FAE5; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
        <svg width="40" height="40" fill="none" stroke="#059669" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
    </div>
    
    <h1 style="font-size: 1.75rem; font-weight: 700; color: #1E3A5F; margin-bottom: 1rem;">Pendaftaran Berhasil Terkirim!</h1>
    <p style="color: #6B7280; font-size: 1rem; line-height: 1.6; max-width: 500px; margin: 0 auto 2.5rem;">
        Terima kasih, {{ auth()->user()->name }}. Data pendaftaran kamu telah kami terima dan akan segera diproses oleh panitia seleksi.
    </p>

    <div style="background: #F9FAFB; border-radius: 1rem; padding: 1.5rem; max-width: 440px; margin: 0 auto 2.5rem; text-align: left; border: 1px solid #F3F4F6;">
        <div style="font-size: 0.8125rem; color: #9CA3AF; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em; margin-bottom: 1rem;">Ringkasan Pendaftaran</div>
        <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">
            <span style="font-size: 0.875rem; color: #6B7280;">Nama</span>
            <span style="font-size: 0.875rem; font-weight: 600; color: #1E3A5F;">{{ $student->nama_lengkap }}</span>
        </div>
        <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">
            <span style="font-size: 0.875rem; color: #6B7280;">NISN</span>
            <span style="font-size: 0.875rem; font-weight: 600; color: #1E3A5F;">{{ $student->nisn }}</span>
        </div>
        <div style="display: flex; justify-content: space-between;">
            <span style="font-size: 0.875rem; color: #6B7280;">Pilihan Jurusan</span>
            <span style="font-size: 0.875rem; font-weight: 600; color: #1E3A5F;">{{ $student->registration->major->nama_jurusan }}</span>
        </div>
    </div>

    <div style="display: flex; justify-content: center; gap: 1rem;">
        <a href="{{ route('student.dashboard') }}" class="btn-secondary">Ke Dashboard</a>
        <a href="{{ route('student.print.bukti') }}" class="btn-primary">Cetak Bukti Pendaftaran</a>
    </div>
</div>
@endsection
