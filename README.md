<p align="center">
  <img src="https://user-images.githubusercontent.com/396987/82162573-6940f500-98c7-11ea-974e-888b4f866c74.jpg" alt="JogjaCare Logo" width="230">
</p>

<h1 align="center" style="font-size:2.8rem;letter-spacing:1px;">JogjaCare</h1>
<p align="center" style="font-size:1.3rem;">
  <b>✨ One-Stop Health & Tourism Platform for Yogyakarta ✨</b><br>
  <i>Semua Kebutuhan Wisata & Kesehatan Anda di Jogja, Dalam Satu Genggaman</i>
</p>

<p align="center">
  <a href="#deskripsi">Deskripsi</a> •
  <a href="#fitur-unggulan">Fitur</a> •
  <a href="#demo--tangkapan-layar">Demo</a> •
  <a href="#instalasi">Instalasi</a> •
  <a href="#panduan-penggunaan">Panduan</a> •
  <a href="#teknologi">Teknologi</a> •
  <a href="#kontribusi">Kontribusi</a>
</p>

---

## 🩺 Deskripsi

**JogjaCare** adalah platform digital inovatif yang mengintegrasikan informasi layanan kesehatan dan pariwisata di Yogyakarta. Dengan UI modern, chatbot pintar, dan direktori lengkap, JogjaCare hadir untuk membantu pengunjung dan warga lokal dalam menemukan fasilitas medis terbaik, konsultasi seputar kesehatan, hingga rekomendasi wisata dan budaya secara mudah dan cepat.

<p align="center">
  <img src="https://img.shields.io/badge/Health-First-2ecc71?style=for-the-badge&logo=heartbeat" />
  <img src="https://img.shields.io/badge/Tourism-Explore-1abc9c?style=for-the-badge&logo=earth" />
  <img src="https://img.shields.io/badge/Yogyakarta--Friendly-3498db?style=for-the-badge&logo=smile" />
</p>

---

## 🚀 Fitur Unggulan

<div align="center">

| <b>🤖 Chatbot Interaktif</b>   | Widget chatbot modern: multi-step, quick reply, feedback, dan animasi. Konsultasi layanan medis & info dengan UX terbaik. |
|-------------------------------|--------------------------------------------------------------------------------------------------------------|
| <b>📋 Direktori Medis</b>     | Pencarian fasilitas kesehatan (klinik, RS, lab, dsb) lengkap dengan detail layanan, lokasi, kontak, peta, dan rating.      |
| <b>🌍 Wisata Sehat</b>        | Rekomendasi wisata & budaya untuk pengalaman holistic health tourism selama pengobatan atau pemulihan.                     |
| <b>🔐 Aman & Terbagi</b>      | Sistem login user/admin, dashboard role-based, dan keamanan data berstandar industri.                                     |
| <b>🛠️ Dashboard Admin</b>    | Panel admin modern: kelola data medis & FAQ (CRUD), monitoring aktivitas, kelola konten & pengguna.                       |
| <b>🗄️ Backup & Audit</b>      | Backup otomatis & audit sistem untuk menjaga keandalan dan keamanan data.                                                 |
| <b>🎨 Responsif & Fresh</b>   | Frontend-backend terpisah, mobile-friendly, dark/light mode, dan tema elegan.                                             |

</div>

---

## 🎥 Demo & Tangkapan Layar

<p align="center">
  <img src="https://user-images.githubusercontent.com/396987/83609224-5a4e0f00-a59e-11ea-9f7a-efb4d1e618b0.gif" width="370" alt="JogjaCare Chatbot Demo"/><br>
  <i>Chatbot Interaktif JogjaCare dalam aksi (simulasi multi-step)</i>
</p>

---

## ⚡ Instalasi Cepat

```bash
# 1. Clone repository
git clone https://github.com/fannass/jogjacarekel10.git
cd jogjacarekel10

# 2. Install dependencies
composer install
npm install

# 3. Konfigurasi environment
cp .env.example .env
# Edit .env untuk database dan konfigurasi lain

# 4. Generate key & storage link
php artisan key:generate
php artisan storage:link

# 5. Migrasi & isi database (demo opsional)
php artisan migrate --seed
# atau demo data: php artisan laravel-starter:insert-demo-data --fresh

# 6. Jalankan server
php artisan serve
```

Buka di browser: [http://localhost:8000](http://localhost:8000)

---

## 🧭 Panduan Penggunaan

#### 👤 Untuk Pengguna
- Buka website JogjaCare.
- Klik bubble chatbot di pojok kanan bawah.
- Pilih layanan medis & lokasi.
- Dapatkan jawaban FAQ & info fasilitas medis real-time.
- Eksplorasi rekomendasi wisata terbaik!

#### 🛡️ Untuk Admin
- Login ke dashboard admin.
- Kelola data layanan medis & FAQ (CRUD).
- Monitoring aktivitas & data sistem.
- Semua data langsung terintegrasi ke chatbot & direktori.

#### ✨ Modul Chatbot Manual
- Widget chatbot: `public/js/custom-chatbot.js` (otomatis di-load frontend).
- Backend: Endpoint `/chatbot/conversation` (multi-step AJAX).
- Data FAQ & layanan medis dikelola dari dashboard admin.

---

## 🧩 Teknologi

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-11.x-red?style=flat-square&logo=laravel" />
  <img src="https://img.shields.io/badge/PHP-^8.2-blue?style=flat-square&logo=php" />
  <img src="https://img.shields.io/badge/Blade-Template-orange?style=flat-square&logo=laravel" />
  <img src="https://img.shields.io/badge/JavaScript-ES6-yellow?style=flat-square&logo=javascript" />
  <img src="https://img.shields.io/badge/Bootstrap-5-purple?style=flat-square&logo=bootstrap" />
  <img src="https://img.shields.io/badge/Tailwind-UI-06B6D4?style=flat-square&logo=tailwindcss" />
  <img src="https://img.shields.io/badge/CoreUI-Theme-green?style=flat-square" />
  <img src="https://img.shields.io/badge/MySQL-Database-blue?style=flat-square&logo=mysql" />
</p>

- **Laravel 11.x** (Backend modular & scalable)
- **Blade Template** (Frontend dinamis)
- **JavaScript** (Widget chatbot interaktif)
- **Bootstrap 5**, **Tailwind**, **CoreUI** (UI/UX modern)
- **MySQL/PostgreSQL/SQLite** (Database)
- **Struktur Modular** (berbasis Laravel Starter)

---

## ⭐️ Kontribusi

Kontribusi sangat dianjurkan untuk pengembangan fitur, perbaikan bug, maupun peningkatan dokumentasi!  
Jangan ragu membuat [issue](https://github.com/fannass/jogjacarekel10/issues) atau Pull Request untuk berdiskusi & berkolaborasi bersama kami.

---

## ⚖️ Lisensi

JogjaCare dilisensikan di bawah [MIT License](LICENSE).

---

<p align="center" style="font-size:1.18rem;">
  <b>JogjaCare</b> mendukung kemajuan layanan kesehatan & wisata Indonesia <br>
  <span style="color:#3b82f6;font-weight:bold;">— dari Yogyakarta untuk Nusantara & Dunia! 🌏</span>
</p>
