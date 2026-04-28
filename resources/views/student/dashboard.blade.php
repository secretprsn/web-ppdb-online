@extends('layouts.student')

@section('title', 'Dashboard Siswa')

@section('content')
<div style="margin-bottom: 3rem;">
    <h1 style="font-size: 2.25rem; font-weight: 800; color: var(--primary); margin-bottom: 0.5rem; letter-spacing: -0.02em;">Halo, {{ auth()->user()->name }}</h1>
    <p style="color: var(--text-muted); font-size: 1.125rem;">Selamat datang di portal resmi Penerimaan Peserta Didik Baru.</p>
</div>

<div style="display: grid; grid-template-columns: 1.8fr 1fr; gap: 2.5rem;">
    <div>
        {{-- Status Card --}}
        <div class="card" style="margin-bottom: 2.5rem; border-top: 5px solid var(--primary);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--primary);">Status Pendaftaran</h3>
                @if($student && $student->registration)
                    <span class="badge-{{ $student->registration->status_verifikasi }}">{{ $student->registration->status_label }}</span>
                @endif
            </div>
            
            @if($student && $student->registration)
                <div style="background: #F8FAFC; border-radius: 1rem; padding: 2rem; border: 1px solid #F1F5F9;">
                    <div style="grid-template-columns: 1fr 1fr; display: grid; gap: 2rem; margin-bottom: 2rem;">
                        <div>
                            <div style="font-size: 0.8125rem; color: var(--text-muted); font-weight: 600; text-transform: uppercase; margin-bottom: 0.5rem;">Pilihan Jurusan</div>
                            <div style="font-weight: 700; color: var(--primary); font-size: 1.125rem;">{{ $student->registration->major->nama_jurusan }}</div>
                        </div>
                        <div>
                            <div style="font-size: 0.8125rem; color: var(--text-muted); font-weight: 600; text-transform: uppercase; margin-bottom: 0.5rem;">Tanggal Daftar</div>
                            <div style="font-weight: 700; color: var(--primary); font-size: 1.125rem;">{{ $student->registration->tanggal_daftar->format('d M Y') }}</div>
                        </div>
                    </div>

                    @if($student->registration->status_verifikasi === 'diterima')
                        <div style="padding: 1.25rem; background: #ECFDF5; border-left: 4px solid #10B981; color: #065F46; border-radius: 0.5rem; font-size: 0.9375rem; margin-bottom: 2rem;">
                            <strong>Selamat!</strong> Anda dinyatakan <strong>LULUS</strong> seleksi. Silakan unduh kartu bukti pendaftaran di bawah ini.
                        </div>
                    @elseif($student->registration->status_verifikasi === 'ditolak')
                        <div style="padding: 1.25rem; background: #FEF2F2; border-left: 4px solid #EF4444; color: #991B1B; border-radius: 0.5rem; font-size: 0.9375rem; margin-bottom: 2rem;">
                            <strong>Mohon Maaf.</strong> Anda dinyatakan <strong>TIDAK LULUS</strong>. {{ $student->registration->catatan ? 'Catatan: ' . $student->registration->catatan : '' }}
                        </div>
                    @else
                        <div style="padding: 1.25rem; background: #FFFBEB; border-left: 4px solid #F59E0B; color: #92400E; border-radius: 0.5rem; font-size: 0.9375rem; margin-bottom: 2rem;">
                            Data Anda sedang dalam tahap verifikasi. Mohon periksa kembali secara berkala.
                        </div>
                    @endif

                    <div style="display: flex; gap: 1rem;">
                        <a href="{{ route('student.registration.show') }}" class="btn-primary">Lihat Detail</a>
                        @if($student->registration->status_verifikasi === 'diterima')
                            <a href="{{ route('student.print.bukti') }}" class="btn-outline">Cetak Bukti Lulus</a>
                        @endif
                    </div>
                </div>
            @else
                <div style="text-align: center; padding: 4rem 2rem; border: 2px dashed #E2E8F0; border-radius: 1rem;">
                    <p style="color: var(--text-muted); margin-bottom: 2rem; font-size: 1.125rem;">Anda belum mengisi formulir pendaftaran.</p>
                    <a href="{{ route('student.registration.step1') }}" class="btn-primary px-10">Mulai Daftar Sekarang</a>
                </div>
            @endif
        </div>

        {{-- Announcements --}}
        <div class="card">
            <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--primary); margin-bottom: 2rem;">Informasi & Pengumuman</h3>
            <div style="display: flex; flex-direction: column; gap: 2rem;">
                @forelse($announcements as $ann)
                    <div style="border-bottom: 1px solid #F1F5F9; padding-bottom: 2rem;">
                        <div style="color: var(--secondary); font-size: 0.8125rem; font-weight: 700; margin-bottom: 0.5rem;">{{ $ann->tanggal_publish->format('d M Y') }}</div>
                        <h4 style="font-size: 1.125rem; font-weight: 700; color: var(--primary); margin-bottom: 0.75rem;">{{ $ann->judul }}</h4>
                        <div style="color: var(--text-muted); line-height: 1.8; font-size: 0.9375rem;">{!! Str::limit($ann->isi, 180) !!}</div>
                    </div>
                @empty
                    <p style="text-align: center; color: var(--text-muted); padding: 3rem 0;">Belum ada pengumuman terbaru.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div>
        {{-- Jadwal Card --}}
        <div class="card" style="margin-bottom: 2.5rem;">
            <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--primary); margin-bottom: 2rem;">Jadwal Pelaksanaan</h3>
            <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                @foreach($schedules as $schedule)
                    <div style="display: flex; gap: 1.25rem;">
                        <div style="width: 4px; border-radius: 4px; background: {{ $schedule->status === 'berlangsung' ? 'var(--primary)' : '#E2E8F0' }};"></div>
                        <div>
                            <div style="font-weight: 700; color: var(--primary); font-size: 0.9375rem;">{{ $schedule->nama_kegiatan }}</div>
                            <div style="font-size: 0.8125rem; color: var(--text-muted); font-weight: 500; margin-top: 0.25rem;">{{ $schedule->tanggal_mulai->format('d M') }} - {{ $schedule->tanggal_selesai->format('d M Y') }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Help Card --}}
        <div class="card" style="background: var(--primary); color: white; border: none; padding: 2.5rem;">
            <h3 style="color: white; margin-bottom: 1rem;">Butuh Bantuan?</h3>
            <p style="color: rgba(255,255,255,0.8); font-size: 0.9375rem; margin-bottom: 2rem; line-height: 1.7;">Tim panitia PPDB kami siap membantu kendala teknis Anda selama proses pendaftaran.</p>
            <div style="background: rgba(255,255,255,0.1); padding: 1rem; border-radius: 0.75rem; display: flex; align-items: center; gap: 0.75rem;">
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                <span style="font-weight: 700;">0812-3456-7890</span>
            </div>
        </div>
    </div>
</div>
@endsection
