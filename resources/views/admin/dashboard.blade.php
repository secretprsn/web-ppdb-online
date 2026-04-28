@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')

@section('content')

{{-- Stats Grid --}}
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
    <div class="stat-card">
        <div class="stat-icon">
            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
        </div>
        <div>
            <div class="stat-value">{{ $stats['total_siswa'] }}</div>
            <div class="stat-label">Siswa Terdaftar</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">
            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
        </div>
        <div>
            <div class="stat-value">{{ $stats['total_pendaftar'] }}</div>
            <div class="stat-label">Total Pendaftar</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="color: #059669; background: #ECFDF5 !important;">
            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div>
            <div class="stat-value" style="color: #059669;">{{ $stats['diterima'] }}</div>
            <div class="stat-label">Diterima</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="color: #6B7280; background: #F3F4F6 !important;">
            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
        </div>
        <div>
            <div class="stat-value" style="color: #6B7280;">{{ $stats['total_jurusan'] }}</div>
            <div class="stat-label">Total Jurusan</div>
        </div>
    </div>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 2rem;">
    {{-- Kuota per Jurusan --}}
    <div class="card">
        <h3 style="font-size: 1.125rem; font-weight: 700; color: var(--primary); margin-bottom: 2rem;">Kapasitas Jurusan</h3>
        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
            @foreach($registrasiPerJurusan as $major)
            <div>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.625rem;">
                    <span style="font-size: 0.9375rem; font-weight: 600; color: var(--text);">{{ $major->nama_jurusan }}</span>
                    <span style="font-size: 0.8125rem; font-weight: 700; color: var(--text-muted);">{{ $major->registrations_count }} / {{ $major->kuota }}</span>
                </div>
                @php $pct = $major->kuota > 0 ? min(100, round($major->registrations_count/$major->kuota*100)) : 0; @endphp
                <div style="background: #F1F5F9; border-radius: 9999px; height: 8px; overflow: hidden;">
                    <div style="width: {{ $pct }}%; background: var(--primary); height: 100%; border-radius: 9999px;"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Pendaftaran Terbaru --}}
    <div class="card">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 2rem;">
            <h3 style="font-size: 1.125rem; font-weight: 700; color: var(--primary); margin: 0;">Pendaftaran Terbaru</h3>
            <a href="{{ route('admin.registrations.index') }}" style="font-size: 0.875rem; color: var(--secondary); font-weight: 700; text-decoration: none;">Semua &rarr;</a>
        </div>
        <div style="display: flex; flex-direction: column; gap: 1rem;">
            @forelse($recentRegistrations as $reg)
            <div style="display: flex; align-items: center; justify-content: space-between; padding: 1.25rem; background: #F8FAFC; border-radius: 0.75rem; border: 1px solid #F1F5F9;">
                <div>
                    <div style="font-size: 0.9375rem; font-weight: 700; color: var(--primary);">{{ $reg->student->nama_lengkap }}</div>
                    <div style="font-size: 0.8125rem; color: var(--text-muted); font-weight: 500; margin-top: 0.25rem;">{{ $reg->major->nama_jurusan }}</div>
                </div>
                <span class="badge-{{ $reg->status_verifikasi }}">{{ $reg->status_label }}</span>
            </div>
            @empty
            <p style="font-size: 0.875rem; color: var(--text-muted); text-align: center; padding: 3rem 0;">Belum ada data pendaftaran.</p>
            @endforelse
        </div>
    </div>
</div>

@endsection
