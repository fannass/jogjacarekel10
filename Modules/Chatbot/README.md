 # Module Chatbot - FAQ Based Chatbot

## Deskripsi
Module Chatbot adalah modul yang menyediakan fitur chatbot berbasis FAQ (Frequently Asked Questions) untuk website JogjaCare. Chatbot ini memungkinkan pengguna untuk mendapatkan jawaban cepat atas pertanyaan umum tentang layanan kesehatan di Jogja.

## Fitur Utama
1. **Manajemen FAQ**
   - CRUD (Create, Read, Update, Delete) untuk pertanyaan dan jawaban
   - Dashboard admin untuk mengelola konten FAQ
   - Validasi input untuk memastikan kualitas konten

2. **Widget Chatbot**
   - Tampilan widget yang responsif
   - Integrasi dengan BotMan untuk pemrosesan pesan
   - Pencarian jawaban berdasarkan pertanyaan pengguna

## Struktur Module
```
Modules/Chatbot/
├── Config/
├── Database/
│   └── Migrations/
│       └── create_faqs_table.php
├── Http/
│   └── Controllers/
│       └── FaqController.php
├── Models/
│   └── Faq.php
├── Providers/
│   ├── ChatbotServiceProvider.php
│   ├── EventServiceProvider.php
│   └── RouteServiceProvider.php
├── Resources/
│   ├── assets/
│   │   ├── js/
│   │   │   └── app.js
│   │   └── sass/
│   │       └── app.scss
│   └── views/
│       └── faqs/
│           ├── create.blade.php
│           ├── edit.blade.php
│           ├── index.blade.php
│           └── show.blade.php
├── Routes/
│   └── web.php
└── README.md
```

## Cara Penggunaan

### 1. Instalasi
Module ini sudah terintegrasi dengan Laravel Modules. Pastikan module sudah terinstall dan diaktifkan:
```bash
php artisan module:enable Chatbot
```

### 2. Migrasi Database
Jalankan migrasi untuk membuat tabel FAQ:
```bash
php artisan module:migrate Chatbot
```

### 3. Akses Dashboard Admin
- URL: `/admin/faqs`
- Fitur yang tersedia:
  - Melihat daftar FAQ
  - Menambah FAQ baru
  - Mengedit FAQ yang ada
  - Menghapus FAQ
  - Melihat detail FAQ

### 4. Penggunaan Chatbot
Chatbot akan muncul sebagai widget di halaman website. Pengguna dapat:
1. Klik ikon chatbot untuk membuka widget
2. Ketik pertanyaan di kolom input
3. Chatbot akan mencari jawaban yang paling sesuai dari database FAQ
4. Jika pertanyaan tidak ditemukan, chatbot akan memberikan pesan default

## Konfigurasi

### 1. Widget Chatbot
Widget chatbot menggunakan BotMan dan dapat dikonfigurasi di:
- `Modules/Chatbot/resources/assets/js/app.js`
- `Modules/Chatbot/resources/assets/sass/app.scss`

### 2. Route
Route untuk chatbot dan manajemen FAQ dapat ditemukan di:
- `Modules/Chatbot/Routes/web.php`

### 3. Model dan Controller
- Model FAQ: `Modules/Chatbot/Models/Faq.php`
- Controller: `Modules/Chatbot/Http/Controllers/FaqController.php`

## Panduan Pengembangan

### Menambah FAQ Baru
1. Login sebagai admin
2. Akses `/admin/faqs`
3. Klik tombol "Tambah FAQ"
4. Isi form dengan:
   - Pertanyaan: Pertanyaan yang sering diajukan
   - Jawaban: Jawaban yang informatif dan jelas
5. Klik "Simpan"

### Mengedit FAQ
1. Akses `/admin/faqs`
2. Klik tombol edit pada FAQ yang ingin diubah
3. Edit pertanyaan atau jawaban
4. Klik "Update"

### Menghapus FAQ
1. Akses `/admin/faqs`
2. Klik tombol hapus pada FAQ yang ingin dihapus
3. Konfirmasi penghapusan

## Best Practices
1. **Pertanyaan**
   - Gunakan bahasa yang jelas dan mudah dipahami
   - Hindari pertanyaan yang terlalu panjang
   - Gunakan kata kunci yang relevan

2. **Jawaban**
   - Berikan jawaban yang lengkap dan informatif
   - Gunakan format yang mudah dibaca (paragraf, bullet points)
   - Sertakan link jika diperlukan

3. **Manajemen FAQ**
   - Kelompokkan FAQ berdasarkan kategori
   - Perbarui FAQ secara berkala
   - Hapus FAQ yang sudah tidak relevan

## Troubleshooting
1. **Widget tidak muncul**
   - Pastikan module sudah diaktifkan
   - Periksa console browser untuk error JavaScript
   - Pastikan asset sudah di-compile (`npm run build`)

2. **FAQ tidak tersimpan**
   - Periksa validasi form
   - Pastikan database terhubung
   - Periksa permission folder storage

3. **Chatbot tidak merespon**
   - Periksa koneksi database
   - Pastikan ada FAQ di database
   - Periksa log Laravel untuk error

## Kontribusi
Untuk berkontribusi pada pengembangan module ini:
1. Fork repository
2. Buat branch fitur baru
3. Commit perubahan
4. Push ke branch
5. Buat Pull Request

## Lisensi
Module ini dilisensikan di bawah [MIT License](https://opensource.org/licenses/MIT).