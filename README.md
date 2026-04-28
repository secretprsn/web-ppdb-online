# PPDB Online SMK Negeri 4 Bandung

## Deskripsi Proyek
PPDB Online adalah platform terpadu yang dirancang untuk mengelola proses Penerimaan Peserta Didik Baru secara digital. Sistem ini bertujuan untuk memberikan transparansi, kemudahan, dan akuntabilitas dalam setiap tahapan pendaftaran siswa baru, mulai dari pengisian data hingga verifikasi hasil.

## Fitur Utama
Sistem ini dilengkapi dengan berbagai fitur modern untuk mendukung pengalaman pengguna yang optimal:

1. Antarmuka Premium: Desain menggunakan tema Navy Blue yang elegan dengan estetika korporat profesional.
2. Latar Belakang Video Sinematik: Implementasi video latar belakang yang dinamis pada bagian beranda untuk kesan visual yang kuat.
3. Manajemen Jadwal: Informasi tahapan pendaftaran yang terintegrasi dan mudah dipantau.
4. Pilihan Jurusan: Katalog program keahlian lengkap dengan informasi kuota dan deskripsi kompetensi.
5. Dasbor Pengguna: Ruang kerja terpisah untuk Calon Siswa dan Admin sekolah.
6. Responsivitas Mobile: Tampilan yang dioptimalkan untuk berbagai perangkat, termasuk komputer, tablet, dan smartphone.
7. Animasi GSAP: Transisi elemen yang halus menggunakan GreenSock Animation Platform untuk pengalaman interaktif yang lebih hidup.

## Tumpukan Teknologi
Proyek ini dibangun menggunakan teknologi terkini:

* Framework: Laravel 12
* Bahasa Pemrograman: PHP, JavaScript
* Styling: Vanilla CSS (Custom Properties)
* Animasi: GSAP (GreenSock Animation Platform)
* Database: MySQL (didukung oleh Eloquent ORM)
* Aset Video: Local MP4 integration

## Persyaratan Sistem
Untuk menjalankan proyek ini di lingkungan lokal, pastikan Anda memiliki:

* PHP >= 8.2
* Composer
* Node.js dan NPM
* MySQL Server

## Panduan Instalasi

1. Salin repositori:
   git clone https://github.com/secretprsn/web-ppdb-online.git

2. Masuk ke direktori proyek:
   cd web-ppdb-online

3. Instal dependensi PHP:
   composer install

4. Instal dependensi JavaScript:
   npm install

5. Salin file konfigurasi lingkungan:
   cp .env.example .env

6. Generate key aplikasi:
   php artisan key:generate

7. Konfigurasi database di file .env, lalu jalankan migrasi:
   php artisan migrate

8. Jalankan server lokal:
   php artisan serve

## Lisensi
Hak Cipta (c) 2026 SMK Negeri 4 Bandung. Seluruh hak cipta dilindungi.
