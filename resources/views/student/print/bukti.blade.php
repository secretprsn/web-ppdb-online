<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bukti Pendaftaran - {{ $student->nisn }}</title>
    <style>
        body { font-family: sans-serif; line-height: 1.5; color: #333; margin: 0; padding: 20px; }
        .header { text-align: center; border-bottom: 3px solid #3B82F6; padding-bottom: 15px; margin-bottom: 25px; }
        .header h1 { margin: 0; font-size: 24px; color: #3B82F6; text-transform: uppercase; }
        .header p { margin: 5px 0 0; font-size: 14px; color: #666; }
        .title { text-align: center; margin-bottom: 25px; }
        .title h2 { margin: 0; font-size: 18px; border-bottom: 1px solid #ccc; display: inline-block; padding-bottom: 5px; color: #3B82F6; }
        .info-table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        .info-table th { text-align: left; width: 35%; padding: 10px; border-bottom: 1px solid #eee; font-size: 14px; color: #666; font-weight: normal; }
        .info-table td { padding: 10px; border-bottom: 1px solid #eee; font-size: 14px; font-weight: bold; }
        .status-box { background: #F0F9FF; border: 1px solid #BFDBFE; padding: 20px; border-radius: 8px; margin-bottom: 30px; }
        .status-box h3 { margin: 0 0 10px; font-size: 16px; color: #1E3A8A; }
        .status-box p { margin: 0; font-size: 20px; font-weight: bold; color: #3B82F6; }
        .footer { position: fixed; bottom: 30px; width: 100%; font-size: 12px; color: #999; text-align: center; }
        .barcode { text-align: right; margin-top: 20px; font-family: monospace; font-size: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>PANITIA PENERIMAAN PESERTA DIDIK BARU</h1>
        <p>SMK NEGERI CONTOH - TAHUN AJARAN 2026/2027</p>
        <p>Jl. Pendidikan No. 123, Kota Pendidikan, Indonesia</p>
    </div>

    <div class="title">
        <h2>KARTU BUKTI PENDAFTARAN</h2>
    </div>

    <table class="info-table">
        <tr>
            <th>Nomor Pendaftaran</th>
            <td>PPDB-2026-{{ str_pad($student->id, 4, '0', STR_PAD_LEFT) }}</td>
        </tr>
        <tr>
            <th>NISN</th>
            <td>{{ $student->nisn }}</td>
        </tr>
        <tr>
            <th>Nama Lengkap</th>
            <td>{{ strtoupper($student->nama_lengkap) }}</td>
        </tr>
        <tr>
            <th>Jenis Kelamin</th>
            <td>{{ $student->jenis_kelamin == 'L' ? 'LAKI-LAKI' : 'PEREMPUAN' }}</td>
        </tr>
        <tr>
            <th>Tempat, Tanggal Lahir</th>
            <td>{{ strtoupper($student->tempat_lahir) }}, {{ $student->tanggal_lahir->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <th>Sekolah Asal</th>
            <td>{{ strtoupper($student->asal_sekolah) }}</td>
        </tr>
        <tr>
            <th>Jurusan Pilihan</th>
            <td>{{ strtoupper($student->registration->major->nama_jurusan) }}</td>
        </tr>
        <tr>
            <th>Tanggal Daftar</th>
            <td>{{ $student->registration->tanggal_daftar->format('d F Y') }}</td>
        </tr>
    </table>

    <div class="status-box">
        <h3>Status Verifikasi Saat Ini:</h3>
        <p>{{ strtoupper($student->registration->status_label) }}</p>
    </div>

    <div style="margin-top: 50px;">
        <table style="width: 100%;">
            <tr>
                <td style="width: 60%;"></td>
                <td style="text-align: center;">
                    <p>Ditetapkan di Kota Pendidikan,</p>
                    <p>{{ now()->format('d F Y') }}</p>
                    <br><br><br>
                    <p><strong>Panitia PPDB Online</strong></p>
                </td>
            </tr>
        </table>
    </div>

    <div class="footer">
        * Dokumen ini dicetak secara otomatis melalui sistem dan sah tanpa tanda tangan basah.
    </div>

    <div class="barcode">
        ID: {{ md5($student->id . $student->nisn) }}
    </div>
</body>
</html>
