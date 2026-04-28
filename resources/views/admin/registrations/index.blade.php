@extends('layouts.admin')

@section('title', 'Daftar Pendaftaran')
@section('page-title', 'Daftar Pendaftaran')

@section('content')
<div style="margin-bottom: 1.25rem;">
    <form method="GET" style="display: flex; gap: 0.625rem; flex-wrap: wrap; align-items: center;">
        <select name="status" class="form-input" style="width: 180px;">
            <option value="">Semua Status</option>
            <option value="pending"  {{ request('status') === 'pending'  ? 'selected' : '' }}>Pending</option>
            <option value="diterima" {{ request('status') === 'diterima' ? 'selected' : '' }}>Diterima</option>
            <option value="ditolak"  {{ request('status') === 'ditolak'  ? 'selected' : '' }}>Ditolak</option>
        </select>
        <button type="submit" class="btn-secondary" style="padding: 0.575rem 1rem;">Filter</button>
        @if(request()->has('status'))
            <a href="{{ route('admin.registrations.index') }}" class="btn-outline-sm">Reset</a>
        @endif
    </form>
</div>

<div class="card table-wrap">
    <table class="table-base">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Jurusan</th>
                <th>Tanggal Daftar</th>
                <th>Nilai</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($registrations as $i => $reg)
            <tr>
                <td style="color: #9CA3AF; font-size: 0.8rem;">{{ $registrations->firstItem() + $i }}</td>
                <td style="font-weight: 500; color: #1E3A5F;">{{ $reg->student->nama_lengkap }}</td>
                <td>{{ $reg->major->nama_jurusan }}</td>
                <td>{{ $reg->tanggal_daftar->format('d/m/Y') }}</td>
                <td>{{ $reg->nilai ?? '-' }}</td>
                <td><span class="badge-{{ $reg->status_verifikasi }}">{{ $reg->status_label }}</span></td>
                <td>
                    <a href="{{ route('admin.registrations.show', $reg) }}" class="btn-outline-sm" id="view-reg-{{ $reg->id }}">Lihat & Verifikasi</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center; color: #9CA3AF; padding: 2rem;">Tidak ada data pendaftaran.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if($registrations->hasPages())
    <div style="padding: 1rem 1.25rem; border-top: 1px solid #F3F4F6;">{{ $registrations->links() }}</div>
    @endif
</div>
@endsection
