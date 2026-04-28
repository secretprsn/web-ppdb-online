@extends('layouts.admin')

@section('title', 'Kelola Jurusan')
@section('page-title', 'Kelola Jurusan')

@section('content')
<div style="display: flex; justify-content: flex-end; margin-bottom: 1.25rem;">
    <a href="{{ route('admin.majors.create') }}" class="btn-primary" id="add-major-btn">
        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Jurusan
    </a>
</div>

<div class="card table-wrap">
    <table class="table-base">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Jurusan</th>
                <th>Deskripsi</th>
                <th>Kuota</th>
                <th>Pendaftar</th>
                <th>Sisa Kuota</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($majors as $i => $major)
            <tr>
                <td style="color: #9CA3AF; font-size: 0.8rem;">{{ $majors->firstItem() + $i }}</td>
                <td style="font-weight: 600; color: #1E3A5F;">{{ $major->nama_jurusan }}</td>
                <td style="max-width: 220px; font-size: 0.8125rem; color: #6B7280;">{{ Str::limit($major->deskripsi, 70) ?? '-' }}</td>
                <td style="text-align: center;">{{ $major->kuota }}</td>
                <td style="text-align: center;">
                    <span style="font-weight: 600; color: #3A7CA5;">{{ $major->registrations_count }}</span>
                </td>
                <td style="text-align: center;">
                    @php $sisa = $major->kuota - $major->registrations_count; @endphp
                    <span style="font-weight: 600; color: {{ $sisa <= 5 ? '#DC2626' : ($sisa <= 15 ? '#D97706' : '#059669') }};">{{ max(0, $sisa) }}</span>
                </td>
                <td>
                    <div style="display: flex; gap: 0.375rem;">
                        <a href="{{ route('admin.majors.edit', $major) }}" class="btn-outline-sm" id="edit-major-{{ $major->id }}">Edit</a>
                        <form method="POST" action="{{ route('admin.majors.destroy', $major) }}" onsubmit="return confirm('Hapus jurusan ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-danger" id="delete-major-{{ $major->id }}" style="font-size: 0.75rem; padding: 0.35rem 0.75rem;">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center; color: #9CA3AF; padding: 2rem;">Belum ada jurusan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if($majors->hasPages())
    <div style="padding: 1rem 1.25rem; border-top: 1px solid #F3F4F6;">{{ $majors->links() }}</div>
    @endif
</div>
@endsection
