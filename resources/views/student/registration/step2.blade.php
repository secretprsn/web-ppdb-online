@extends('layouts.student')

@section('title', 'Pendaftaran - Langkah 2')

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
        <div class="step-circle active">2</div>
        <div class="step-label active">Pilih Jurusan</div>
    </div>
    <div class="step-line"></div>
    <div class="step-item">
        <div class="step-circle inactive">3</div>
        <div class="step-label inactive">Unggah Dokumen</div>
    </div>
</div>

<div class="card" style="padding: 2rem;">
    <h2 style="font-size: 1.25rem; font-weight: 700; color: #1E3A5F; margin-bottom: 0.5rem;">Pilih Jurusan Impian</h2>
    <p style="color: #6B7280; font-size: 0.875rem; margin-bottom: 2rem;">Silakan pilih satu jurusan yang paling sesuai dengan minat kamu.</p>

    <form method="POST" action="{{ route('student.registration.step2.store') }}">
        @csrf
        
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
            @foreach($majors as $major)
            <label style="cursor: pointer; display: block;">
                <input type="radio" name="major_id" value="{{ $major->id }}"
                       class="major-radio"
                       style="position: absolute; opacity: 0; pointer-events: none;" required>
                <div class="major-card" style="border: 2px solid #E5E7EB; border-radius: 1rem; padding: 1.5rem; transition: all 0.2s;">

                    <div style="display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 0.75rem; gap: 0.5rem;">
                        <h3 style="font-weight: 700; color: #1E3A5F; font-size: 0.9375rem; margin: 0; line-height: 1.3;">{{ $major->nama_jurusan }}</h3>
                        {{-- Lingkaran indikator --}}
                        <div class="radio-indicator">
                            <svg class="check-icon" width="14" height="14" fill="none" stroke="white" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3.5" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                    </div>

                    <p style="font-size: 0.8rem; color: #6B7280; line-height: 1.55; margin-bottom: 0;">{{ Str::limit($major->deskripsi, 100) }}</p>
                    <div style="margin-top: 0.875rem; font-size: 0.75rem; font-weight: 600; color: #3A7CA5;">Sisa Kuota: {{ $major->sisa_kuota }}</div>
                </div>
            </label>
            @endforeach
        </div>

        @error('major_id') <div class="form-error" style="margin-bottom: 1rem;">{{ $message }}</div> @enderror

        <div style="display: flex; justify-content: space-between; align-items: center;">
            <a href="{{ route('student.registration.step1') }}" style="color: #6B7280; font-size: 0.875rem; font-weight: 600; text-decoration: none;">Kembali</a>
            <button type="submit" class="btn-primary">Selanjutnya: Unggah Dokumen</button>
        </div>
    </form>
</div>

<style>
    /* Lingkaran Indikator Default */
    .radio-indicator {
        width: 24px;
        height: 24px;
        flex-shrink: 0;
        border: 2px solid #D1D5DB;
        border-radius: 50%;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }

    /* Ikon centang default sembunyi */
    .check-icon { 
        opacity: 0; 
        transform: scale(0.5);
        transition: all 0.2s; 
    }

    /* State terpilih: Card */
    .major-radio:checked + .major-card {
        border-color: #1E3A5F;
        background: linear-gradient(135deg, #EFF6FF 0%, #DBEAFE 100%);
        box-shadow: 0 4px 16px rgba(30,58,95,0.12);
    }

    /* State terpilih: Lingkaran jadi biru */
    .major-radio:checked + .major-card .radio-indicator {
        border-color: #1E3A5F;
        background: #1E3A5F;
    }

    /* State terpilih: Centang muncul */
    .major-radio:checked + .major-card .check-icon {
        opacity: 1;
        transform: scale(1);
    }

    /* Hover effect */
    .major-card:hover {
        border-color: #3A7CA5;
        box-shadow: 0 2px 8px rgba(58,124,165,0.1);
    }

    label { cursor: pointer; }
</style>
@endsection
