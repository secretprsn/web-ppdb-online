@extends('layouts.admin')

@section('title', 'Kelola Pengumuman')
@section('page-title', 'Kelola Pengumuman')

@section('content')
<div style="display: flex; justify-content: flex-end; margin-bottom: 1.25rem;">
    <a href="{{ route('admin.announcements.create') }}" class="btn-primary" id="add-announcement-btn">
        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Buat Pengumuman
    </a>
</div>

<div class="card table-wrap">
    <table class="table-base">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Pengumuman</th>
                <th>Tanggal Publish</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($announcements as $i => $announcement)
            <tr>
                <td style="color: #9CA3AF; font-size: 0.8rem;">{{ $announcements->firstItem() + $i }}</td>
                <td style="font-weight: 500; color: #1E3A5F;">{{ Str::limit($announcement->judul, 60) }}</td>
                <td style="font-size: 0.8rem; color: #6B7280;">{{ $announcement->tanggal_publish->isoFormat('D MMMM Y') }}</td>
                <td>
                    @if($announcement->is_published)
                        <span style="background: #D1FAE5; color: #065F46; padding: 0.2rem 0.625rem; border-radius: 9999px; font-size: 0.7rem; font-weight: 600;">Publish</span>
                    @else
                        <span style="background: #F3F4F6; color: #6B7280; padding: 0.2rem 0.625rem; border-radius: 9999px; font-size: 0.7rem; font-weight: 600;">Draft</span>
                    @endif
                </td>
                <td>
                    <div style="display: flex; gap: 0.375rem;">
                        <a href="{{ route('admin.announcements.edit', $announcement) }}" class="btn-outline-sm" id="edit-announcement-{{ $announcement->id }}">Edit</a>
                        <form method="POST" action="{{ route('admin.announcements.destroy', $announcement) }}" onsubmit="return confirm('Hapus pengumuman ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-danger" id="delete-announcement-{{ $announcement->id }}" style="font-size: 0.75rem; padding: 0.35rem 0.75rem;">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; color: #9CA3AF; padding: 2rem;">Belum ada pengumuman.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if($announcements->hasPages())
    <div style="padding: 1rem 1.25rem; border-top: 1px solid #F3F4F6;">{{ $announcements->links() }}</div>
    @endif
</div>
@endsection
