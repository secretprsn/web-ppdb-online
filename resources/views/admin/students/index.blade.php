@extends('layouts.admin')

@section('title', 'Data Siswa')
@section('page-title', 'Data Siswa')

@section('content')
<div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
    <form method="GET" style="display: flex; gap: 0.75rem; flex-wrap: wrap; align-items: center;">
        <div style="position: relative;">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, NISN..." class="form-input" style="width: 260px; padding-left: 2.5rem;" id="search-input">
            <svg style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #9CA3AF;" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        </div>
        <select name="status" class="form-input" style="width: 160px;" id="status-filter">
            <option value="">Semua Status</option>
            <option value="pending"  {{ request('status') === 'pending'  ? 'selected' : '' }}>Pending</option>
            <option value="diterima" {{ request('status') === 'diterima' ? 'selected' : '' }}>Diterima</option>
            <option value="ditolak"  {{ request('status') === 'ditolak'  ? 'selected' : '' }}>Ditolak</option>
        </select>
        <button type="submit" class="btn-primary" style="padding: 0.625rem 1.5rem;">Cari</button>
        @if(request()->hasAny(['search','status']))
            <a href="{{ route('admin.students.index') }}" class="btn-outline-sm">Reset</a>
        @endif
    </form>
    <a href="{{ route('admin.students.export') }}" class="btn-secondary" id="export-btn" style="background: #059669;">
        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
        Export Excel
    </a>
</div>

<div class="card table-wrap">
    <table class="table-base">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama & NISN</th>
                <th>Jenis Kelamin</th>
                <th>Asal Sekolah</th>
                <th>Jurusan</th>
                <th>Tgl Daftar</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($students as $i => $student)
            <tr>
                <td style="color: #9CA3AF; font-size: 0.8rem;">{{ $students->firstItem() + $i }}</td>
                <td>
                    <div style="font-weight: 500; color: #1E3A5F;">{{ $student->nama_lengkap }}</div>
                    <div style="font-size: 0.75rem; color: #9CA3AF;">{{ $student->nisn ?? 'NISN belum diisi' }}</div>
                </td>
                <td>{{ $student->jenis_kelamin_label }}</td>
                <td style="max-width: 160px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $student->asal_sekolah }}</td>
                <td>{{ $student->registration?->major?->nama_jurusan ?? '-' }}</td>
                <td style="font-size: 0.8rem; white-space: nowrap;">{{ $student->registration?->tanggal_daftar?->format('d/m/Y') ?? '-' }}</td>
                <td>
                    @if($student->registration)
                        <span class="badge-{{ $student->registration->status_verifikasi }}">
                            {{ $student->registration->status_label }}
                        </span>
                    @else
                        <span style="font-size: 0.75rem; color: #9CA3AF;">Belum daftar</span>
                    @endif
                </td>
                <td>
                    <div style="display: flex; gap: 0.375rem;">
                        <a href="{{ route('admin.students.show', $student) }}" class="btn-outline-sm" id="show-student-{{ $student->id }}">Detail</a>
                        <form method="POST" action="{{ route('admin.students.destroy', $student) }}" onsubmit="return confirm('Hapus data siswa ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-danger" id="delete-student-{{ $student->id }}" style="font-size: 0.75rem; padding: 0.35rem 0.75rem;">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align: center; color: #9CA3AF; padding: 2.5rem;">Tidak ada data siswa.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if($students->hasPages())
    <div style="padding: 1rem 1.25rem; border-top: 1px solid #F3F4F6;">
        {{ $students->links() }}
    </div>
    @endif
</div>
@endsection
