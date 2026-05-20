<img width="1024" height="488" alt="Dashboard Utama" src="https://github.com/user-attachments/assets/e3647a78-79f0-43cb-bd35-d2c1a63ad839" /><img width="1024" height="488" alt="Dashboard Utama" src="https://github.com/user-attachments/assets/a64261f0-1994-4fa9-af13-c44ab1ff81ad" /># PPDB Online: Sistem Pendaftaran Siswa Baru Terintegrasi

Sistem Penerimaan Peserta Didik Baru (PPDB) Online berbasis web yang dirancang untuk mendigitalisasi proses pendaftaran sekolah secara efisien, aman, dan transparan.

---

## 1. Deskripsi Proyek
Proyek ini dikembangkan menggunakan framework Laravel 12 untuk menggantikan sistem pendaftaran manual yang tidak efisien. Platform ini mencakup dua sisi utama: sisi calon siswa (untuk pendaftaran dan pemantauan status secara mandiri) dan sisi administrator sekolah (untuk verifikasi berkas dan pengelolaan kuota jurusan). Sistem dirancang dengan arsitektur modern untuk memastikan layanan dapat diakses secara stabil selama 24 jam.

---

## 2. Fitur Utama

### Sisi Calon Siswa (Client-Side)
* **Multi-step Registration Form:** Pengisian data terstruktur yang dibagi menjadi tahap Data Diri, Pilihan Jurusan, dan Unggah Berkas untuk mempermudah pengguna.
* **Card-Based UI Jurusan:** Tampilan pilihan jurusan menggunakan komponen kartu (card) yang bersih dan informatif.
* **Real-time Quota Tracker:** Indikator kapasitas yang menunjukkan sisa kuota kursi yang tersedia pada setiap jurusan secara langsung.
* **Detail & Preview Pendaftaran:** Halaman verifikasi mandiri bagi siswa untuk memeriksa kembali kebenaran data sebelum melakukan finalisasi (*locking data*).
* **Dashboard Status:** Halaman utama siswa untuk memantau status verifikasi dokumen (Diterima, Ditolak, atau Perlu Perbaikan).

### Sisi Administrator (Back-end)
* **Visualisasi Data Dashboard:** Ringkasan statistik jumlah pendaftar masuk harian dalam bentuk grafik.
* **Verifikasi Berkas Digital:** Modul khusus bagi panitia untuk memeriksa, menyetujui, atau menolak dokumen pendaftaran yang diunggah siswa.
* **Manajemen Kuota Dinamis:** Pengaturan batas kapasitas maksimum pendaftar pada tiap jurusan.
* **Otomasi Jadwal & Pengumuman:** Sistem rilis hasil kelulusan otomatis sesuai waktu yang telah dikonfigurasi.
* **Ekspor Data Excel:** Fitur mengunduh seluruh data pendaftar ke format .xlsx untuk kebutuhan pelaporan atau integrasi dengan Dapodik.

---

## 3. Tech Stack

Berikut adalah teknologi utama yang digunakan dalam pengembangan sistem PPDB Online ini:

| Komponen | Teknologi |
| :--- | :--- |
| **Back-end Framework** | ![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white) |
| **Database System** | ![MySQL](https://img.shields.io/badge/mysql-%2300f.svg?style=for-the-badge&logo=mysql&logoColor=white) |
| **Front-end Styling** | ![TailwindCSS](https://img.shields.io/badge/tailwindcss-%2338B2AC.svg?style=for-the-badge&logo=tailwind-css&logoColor=white) ![Bootstrap](https://img.shields.io/badge/bootstrap-%238511FA.svg?style=for-the-badge&logo=bootstrap&logoColor=white) |
| **Animations** | ![GSAP](https://img.shields.io/badge/GSAP-green?style=for-the-badge&logo=greensock&logoColor=white) |

---

## 4. Video Demo
Rekaman operasional sistem tanpa penjelasan suara dapat diakses melalui tautan berikut:
* [Link Video Demo PPDB Online](https://drive.google.com/drive/folders/1Rlhh9NYz9-vMlA35jrhbZHqzjkysKkSc)

---

## 5. Screenshot Website

### Landing Page (Dashboard Utama)
![Admin Panel](<img width="1024" height="488" alt="Dashboard Utama" src="https://github.com/user-attachments/assets/b90b3c80-8428-47fb-acf7-0f1d8b18f6ad" />
)
*Landing page mengenai informasi seputar PPDB*

### Dashboard Siswa
![Dashboard Siswa](<img width="1366" height="652" alt="Dashboard User" src="https://github.com/user-attachments/assets/0f152e0c-b505-4867-b6ea-a4d55bd7e9be" />
)
*Tampilan beranda pendaftaran dan pelacakan status berkas.*

### Panel Kendali Admin
![Admin Panel](<img width="1366" height="654" alt="Dashboard Admin" src="https://github.com/user-attachments/assets/33e2c1b3-9dcf-440f-a2a7-86870ff57858" />
)
*Pusat verifikasi dokumen dan pengelolaan kapasitas jurusan.*

---

## 6. Nama Kelompok dan Anggota
Proyek ini disusun oleh Kelompok [11]:

| No | Nama Anggota | NIM | Peran / Fokus Tugas |
|---|---|---|---|
| 1 | [Raditya Nurakmal Irsyad] | [27] | 
| 2 | [Khalifah Sayid Lathif] | [14] | 
| 3 | [Gianni Zidane] | [11] | 
