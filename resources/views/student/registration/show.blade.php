@extends('layouts.student')

@section('title', 'Detail Pendaftaran')

@section('content')
{{-- Header --}}
<div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.75rem; flex-wrap: wrap; gap: 1rem;">
    <div>
        <a href="{{ route('student.dashboard') }}" style="display: inline-flex; align-items: center; gap: 0.375rem; color: #6B7280; font-size: 0.8125rem; text-decoration: none; margin-bottom: 0.5rem; transition: color 0.15s;"
           onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='#6B7280'">
            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Dashboard
        </a>
        <h1 style="font-size: 1.375rem; font-weight: 700; color: var(--primary); margin: 0;">Detail Pendaftaran</h1>
        <p style="color: #6B7280; font-size: 0.875rem; margin-top: 0.25rem;">
            Terdaftar pada {{ $student->registration->tanggal_daftar->format('d F Y') }}
        </p>
    </div>
    <div style="display: flex; align-items: center; gap: 0.75rem; flex-wrap: wrap;">
        <span class="badge-{{ $student->registration->status_verifikasi }}" style="padding: 0.375rem 1rem; font-size: 0.8125rem;">
            {{ $student->registration->status_label }}
        </span>
        @if($student->registration->status_verifikasi === 'diterima')
            <a href="{{ route('student.print.bukti') }}" class="btn-primary" style="padding: 0.5rem 1rem; font-size: 0.8125rem;">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Cetak Bukti
            </a>
        @endif
    </div>
</div>

{{-- Status Banner --}}
@if($student->registration->status_verifikasi === 'diterima')
    <div style="background: linear-gradient(135deg, #065F46, #047857); color: white; border-radius: 1rem; padding: 1.25rem 1.5rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 1rem;">
        <div style="width: 42px; height: 42px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
            <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
            </svg>
        </div>
        <div>
            <div style="font-weight: 700; font-size: 1rem; margin-bottom: 0.2rem;">Selamat! Anda Diterima 🎉</div>
            <div style="font-size: 0.8125rem; opacity: 0.9;">Silakan unduh bukti pendaftaran dan lakukan daftar ulang sesuai jadwal yang ditentukan.</div>
        </div>
    </div>
@elseif($student->registration->status_verifikasi === 'ditolak')
    <div style="background: linear-gradient(135deg, #DC2626, #B91C1C); color: white; border-radius: 1rem; padding: 1.25rem 1.5rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 1rem;">
        <div style="width: 42px; height: 42px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
            <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </div>
        <div>
            <div style="font-weight: 700; font-size: 1rem; margin-bottom: 0.2rem;">Pendaftaran Belum Berhasil</div>
            @if($student->registration->catatan)
                <div style="font-size: 0.8125rem; opacity: 0.9;">Keterangan: {{ $student->registration->catatan }}</div>
            @else
                <div style="font-size: 0.8125rem; opacity: 0.9;">Tetap semangat! Anda bisa mencoba di gelombang berikutnya atau jalur lain.</div>
            @endif
        </div>
    </div>
@else
    <div style="background: linear-gradient(135deg, var(--primary), var(--secondary)); color: white; border-radius: 1rem; padding: 1.25rem 1.5rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 1rem;">
        <div style="width: 42px; height: 42px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
            <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <div>
            <div style="font-weight: 700; font-size: 1rem; margin-bottom: 0.2rem;">Status: Menunggu Verifikasi</div>
            <div style="font-size: 0.8125rem; opacity: 0.9;">Data Anda sedang diproses oleh panitia. Mohon cek berkala untuk pembaruan status.</div>
        </div>
    </div>
@endif

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">

    {{-- ============ DATA PRIBADI ============ --}}
    <div class="card" style="padding: 1.5rem; grid-column: 1 / -1;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.25rem;">
            <div style="display: flex; align-items: center; gap: 0.75rem;">
                <div style="width: 36px; height: 36px; background: #F9FAFB; border-radius: 0.625rem; display: flex; align-items: center; justify-content: center;">
                    <svg width="18" height="18" fill="none" stroke="var(--primary)" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <h3 style="font-size: 0.9375rem; font-weight: 600; color: var(--primary); margin: 0;">Data Pribadi</h3>
            </div>
            @if($student->registration->status_verifikasi === 'pending')
                <a href="{{ route('student.registration.step1') }}"
                   style="display: inline-flex; align-items: center; gap: 0.375rem; font-size: 0.8rem; font-weight: 500; color: var(--primary); text-decoration: none; padding: 0.375rem 0.875rem; border: 1px solid var(--primary); border-radius: 0.375rem; transition: all 0.15s;"
                   onmouseover="this.style.background='var(--primary)';this.style.color='white'" onmouseout="this.style.background='transparent';this.style.color='var(--primary)'">
                    <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit Data Pribadi
                </a>
            @endif
        </div>

        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.25rem;">
            <div>
                <div style="font-size: 0.75rem; color: #9CA3AF; font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.3rem;">NISN</div>
                <div style="font-weight: 600; color: var(--text); font-size: 0.9375rem;">{{ $student->nisn ?? '-' }}</div>
            </div>
            <div>
                <div style="font-size: 0.75rem; color: #9CA3AF; font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.3rem;">Nama Lengkap</div>
                <div style="font-weight: 600; color: var(--text); font-size: 0.9375rem;">{{ $student->nama_lengkap }}</div>
            </div>
            <div>
                <div style="font-size: 0.75rem; color: #9CA3AF; font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.3rem;">Jenis Kelamin</div>
                <div style="font-weight: 600; color: var(--text); font-size: 0.9375rem;">{{ $student->jenis_kelamin_label }}</div>
            </div>
            <div>
                <div style="font-size: 0.75rem; color: #9CA3AF; font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.3rem;">Tempat Lahir</div>
                <div style="font-weight: 600; color: var(--text); font-size: 0.9375rem;">{{ $student->tempat_lahir }}</div>
            </div>
            <div>
                <div style="font-size: 0.75rem; color: #9CA3AF; font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.3rem;">Tanggal Lahir</div>
                <div style="font-weight: 600; color: var(--text); font-size: 0.9375rem;">{{ $student->tanggal_lahir->format('d F Y') }}</div>
            </div>
            <div>
                <div style="font-size: 0.75rem; color: #9CA3AF; font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.3rem;">No. HP</div>
                <div style="font-weight: 600; color: var(--text); font-size: 0.9375rem;">{{ $student->no_hp }}</div>
            </div>
            <div>
                <div style="font-size: 0.75rem; color: #9CA3AF; font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.3rem;">Asal Sekolah</div>
                <div style="font-weight: 600; color: var(--text); font-size: 0.9375rem;">{{ $student->asal_sekolah }}</div>
            </div>
            <div style="grid-column: span 2;">
                <div style="font-size: 0.75rem; color: #9CA3AF; font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.3rem;">Alamat</div>
                <div style="font-weight: 600; color: var(--text); font-size: 0.9375rem; line-height: 1.5;">{{ $student->alamat }}</div>
            </div>
        </div>
    </div>

    {{-- ============ JURUSAN PILIHAN ============ --}}
    <div class="card" style="padding: 1.5rem;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.25rem;">
            <div style="display: flex; align-items: center; gap: 0.75rem;">
                <div style="width: 36px; height: 36px; background: #F9FAFB; border-radius: 0.625rem; display: flex; align-items: center; justify-content: center;">
                    <svg width="18" height="18" fill="none" stroke="var(--primary)" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <h3 style="font-size: 0.9375rem; font-weight: 600; color: var(--primary); margin: 0;">Jurusan Pilihan</h3>
            </div>
        </div>

        {{-- Jurusan saat ini --}}
        <div style="background: #FDFDFD; border: 1px solid #E5E7EB; border-radius: 0.75rem; padding: 1rem; margin-bottom: 1.25rem;">
            <div style="font-size: 0.75rem; color: #6B7280; font-weight: 500; margin-bottom: 0.35rem;">Jurusan Dipilih</div>
            <div style="font-weight: 700; color: var(--primary); font-size: 1.0625rem;">{{ $student->registration->major->nama_jurusan }}</div>
        </div>

        @if($student->registration->status_verifikasi === 'pending')
            {{-- Form ganti jurusan --}}
            <form action="{{ route('student.registration.update.major') }}" method="POST" id="form-ganti-jurusan">
                @csrf
                @method('PUT')
                <label class="form-label" for="major_id">Ganti Jurusan</label>
                <div style="display: flex; gap: 0.625rem; margin-top: 0.25rem;">
                    <select name="major_id" id="major_id" class="form-input" style="flex: 1; padding: 0.5rem; border: 1px solid #E5E7EB; border-radius: 0.5rem;">
                        @foreach($majors as $major)
                            <option value="{{ $major->id }}" {{ $student->registration->major_id == $major->id ? 'selected' : '' }}>
                                {{ $major->nama_jurusan }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn-primary" style="padding: 0.5rem 1rem; font-size: 0.8125rem; white-space: nowrap;">
                        Simpan
                    </button>
                </div>
            </form>
        @endif

        <div style="margin-top: 1.25rem; padding-top: 1rem; border-top: 1px solid #F3F4F6;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                <span style="font-size: 0.8125rem; color: #6B7280;">Tanggal Daftar</span>
                <span style="font-size: 0.8125rem; font-weight: 600; color: var(--text);">{{ $student->registration->tanggal_daftar->format('d M Y') }}</span>
            </div>
        </div>
    </div>

    {{-- ============ DOKUMEN ============ --}}
    <div class="card" style="padding: 1.5rem;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.25rem;">
            <div style="display: flex; align-items: center; gap: 0.75rem;">
                <div style="width: 36px; height: 36px; background: #F9FAFB; border-radius: 0.625rem; display: flex; align-items: center; justify-content: center;">
                    <svg width="18" height="18" fill="none" stroke="var(--primary)" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h3 style="font-size: 0.9375rem; font-weight: 600; color: var(--primary); margin: 0;">Kelengkapan Dokumen</h3>
            </div>
            @if($student->registration->status_verifikasi === 'pending')
                <a href="{{ route('student.registration.step3') }}"
                   style="display: inline-flex; align-items: center; gap: 0.375rem; font-size: 0.8rem; font-weight: 500; color: var(--primary); text-decoration: none; padding: 0.375rem 0.875rem; border: 1px solid var(--primary); border-radius: 0.375rem; transition: all 0.15s;"
                   onmouseover="this.style.background='var(--primary)';this.style.color='white'" onmouseout="this.style.background='transparent';this.style.color='var(--primary)'">
                    <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                    </svg>
                    Kelola Dokumen
                </a>
            @endif
        </div>

        {{-- Progress dokumen --}}
        @php
            $totalDocs   = count($dokumenTypes);
            $uploadedCnt = count($uploadedDocs);
            $pct         = $totalDocs > 0 ? round(($uploadedCnt / $totalDocs) * 100) : 0;
        @endphp
        <div style="margin-bottom: 1rem;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 0.4rem;">
                <span style="font-size: 0.8rem; color: #6B7280;">{{ $uploadedCnt }} dari {{ $totalDocs }} dokumen diunggah</span>
                <span style="font-size: 0.8rem; font-weight: 600; color: {{ $pct === 100 ? '#059669' : '#D97706' }};">{{ $pct }}%</span>
            </div>
            <div style="height: 6px; background: #E5E7EB; border-radius: 9999px; overflow: hidden;">
                <div style="height: 100%; width: {{ $pct }}%; background: {{ $pct === 100 ? '#059669' : '#D97706' }}; border-radius: 9999px; transition: width 0.4s;"></div>
            </div>
        </div>

        <div style="display: flex; flex-direction: column; gap: 0.6rem;">
            @foreach($dokumenTypes as $key => $label)
                @php $doc = $uploadedDocs->get($key); @endphp
                <div style="display: flex; align-items: center; justify-content: space-between; padding: 0.6rem 0.875rem; background: {{ $doc ? '#F0FDF4' : '#FFF7ED' }}; border: 1px solid {{ $doc ? '#BBF7D0' : '#FED7AA' }}; border-radius: 0.5rem;">
                    <div style="display: flex; align-items: center; gap: 0.625rem;">
                        @if($doc)
                            <svg width="15" height="15" fill="none" stroke="#059669" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span style="font-size: 0.8125rem; font-weight: 500; color: #065F46;">{{ $label }}</span>
                        @else
                            <svg width="15" height="15" fill="none" stroke="#D97706" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span style="font-size: 0.8125rem; font-weight: 500; color: #92400E;">{{ $label }}</span>
                        @endif
                    </div>
                    @if($doc)
                        <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank"
                           style="font-size: 0.75rem; color: #059669; font-weight: 500; text-decoration: none;"
                           onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
                            Lihat
                        </a>
                    @else
                        <span style="font-size: 0.75rem; color: #D97706; font-weight: 500;">Belum ada</span>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

</div>

{{-- Bottom action bar (sticky) --}}
@if($student->registration->status_verifikasi === 'pending')
    <div style="margin-top: 1.5rem; background: white; border-radius: 1rem; padding: 1rem 1.5rem; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 1px 3px rgba(0,0,0,0.06), 0 4px 16px rgba(0,0,0,0.04); flex-wrap: wrap; gap: 0.75rem;">
        <div>
            <div style="font-size: 0.875rem; font-weight: 600; color: #1E3A5F;">Pendaftaran masih bisa diubah</div>
            <div style="font-size: 0.8rem; color: #6B7280;">Perubahan hanya bisa dilakukan selama status masih <strong>Menunggu Verifikasi</strong>.</div>
        </div>
        <div style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
            <a href="{{ route('student.registration.step1') }}" class="btn-secondary" style="padding: 0.5rem 1.125rem; font-size: 0.8125rem;">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Data Pribadi
            </a>
            <a href="{{ route('student.registration.step3') }}" class="btn-primary" style="padding: 0.5rem 1.125rem; font-size: 0.8125rem;">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                </svg>
                Kelola Dokumen
            </a>
        </div>
    </div>
@endif

@endsection
