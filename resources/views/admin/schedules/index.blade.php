@extends('layouts.admin')

@section('title', 'Kelola Jadwal')
@section('page-title', 'Kelola Jadwal')

@section('content')
<div style="display: flex; justify-content: flex-end; margin-bottom: 1.25rem;">
    <a href="{{ route('admin.schedules.create') }}" class="btn-primary" id="add-schedule-btn">
        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Jadwal
    </a>
</div>

<div class="card table-wrap">
    <table class="table-base">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kegiatan</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($schedules as $i => $schedule)
            <tr>
                <td style="color: #9CA3AF; font-size: 0.8rem;">{{ $schedules->firstItem() + $i }}</td>
                <td style="font-weight: 500; color: #1E3A5F;">{{ $schedule->nama_kegiatan }}</td>
                <td>{{ $schedule->tanggal_mulai->isoFormat('D MMM Y') }}</td>
                <td>{{ $schedule->tanggal_selesai->isoFormat('D MMM Y') }}</td>
                <td>
                    @if($schedule->status === 'berlangsung')
                        <span style="background: #DBEAFE; color: #1E40AF; padding: 0.2rem 0.625rem; border-radius: 9999px; font-size: 0.7rem; font-weight: 600;">Berlangsung</span>
                    @elseif($schedule->status === 'selesai')
                        <span style="background: #D1FAE5; color: #065F46; padding: 0.2rem 0.625rem; border-radius: 9999px; font-size: 0.7rem; font-weight: 600;">Selesai</span>
                    @else
                        <span style="background: #F3F4F6; color: #6B7280; padding: 0.2rem 0.625rem; border-radius: 9999px; font-size: 0.7rem; font-weight: 600;">Mendatang</span>
                    @endif
                </td>
                <td>
                    <div style="display: flex; gap: 0.375rem;">
                        <a href="{{ route('admin.schedules.edit', $schedule) }}" class="btn-outline-sm" id="edit-schedule-{{ $schedule->id }}">Edit</a>
                        <form method="POST" action="{{ route('admin.schedules.destroy', $schedule) }}" onsubmit="return confirm('Hapus jadwal ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-danger" id="delete-schedule-{{ $schedule->id }}" style="font-size: 0.75rem; padding: 0.35rem 0.75rem;">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; color: #9CA3AF; padding: 2rem;">Belum ada jadwal.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if($schedules->hasPages())
    <div style="padding: 1rem 1.25rem; border-top: 1px solid #F3F4F6;">{{ $schedules->links() }}</div>
    @endif
</div>
@endsection
