# Module Chatbot Manual - JogjaCare

## Deskripsi
Module Chatbot Manual adalah modul chatbot berbasis web yang dibangun tanpa BotMan, dengan alur multi-step, quick reply, dan basis data Medical List & FAQ. Chatbot ini membantu pengguna mencari informasi layanan medis di Jogja secara interaktif.

## Fitur Utama
1. **Manajemen Medical List & FAQ**
   - CRUD Medical List (jenis layanan medis)
   - CRUD FAQ (pertanyaan & jawaban berdasarkan medical type & district)
   - Dashboard admin untuk mengelola data
2. **Widget Chatbot Manual**
   - Widget chat bubble custom (HTML+JS)
   - Multi-step: pilih medical type → pilih district → tampilkan jawaban FAQ
   - Quick reply button, feedback, animasi, dan auto-scroll
   - Riwayat chat tersimpan di session browser

## Struktur Module (Utama)
```
Modules/Chatbot/
├── Http/
│   └── Controllers/
│       └── ChatbotController.php   # Endpoint utama percakapan manual
├── Models/
│   ├── MedicalList.php            # Model jenis layanan medis
│   └── Faq.php                    # Model FAQ
├── Resources/
│   ├── views/
│   │   └── index.blade.php        # Tampilan utama chatbot manual
│   └── assets/
│       └── js/
│           └── app.js             # (Opsional, jika ada asset JS lama)
├── public/js/
│   └── custom-chatbot.js          # Widget chat manual (frontend)
├── Routes/
│   └── web.php                    # Route endpoint chatbot manual
└── README.md
```

## Flow User
1. User klik bubble chat di pojok kanan bawah.
2. Chatbot menyapa dan menampilkan pilihan jenis layanan medis (quick reply).
3. User memilih jenis layanan medis.
4. Chatbot menampilkan daftar kecamatan/district (quick reply).
5. User memilih district.
6. Chatbot menampilkan jawaban FAQ sesuai medical type & district.
7. User bisa memberi feedback (bermanfaat/tidak) atau mulai ulang percakapan.

## Flow Admin
1. Login ke dashboard admin.
2. Kelola **Medical List** (tambah/edit/hapus jenis layanan medis).
3. Kelola **FAQ** (tambah/edit/hapus pertanyaan & jawaban, kaitkan dengan medical type & district).
4. Data medical list & FAQ otomatis digunakan oleh chatbot manual.

## Konsep Program & File Utama
- **Frontend Widget:**
  - `public/js/custom-chatbot.js` → Widget chat bubble, window chat, quick reply, animasi, feedback, AJAX ke backend.
  - Di-include di layout utama frontend.
- **Backend Endpoint:**
  - `Modules/Chatbot/Http/Controllers/ChatbotController.php` → Method `conversation()` handle alur multi-step (step 1: medical type, step 2: district, step 3: FAQ/jawaban).
  - Route: `/chatbot/conversation` (POST)
- **Model:**
  - `MedicalList.php` → Jenis layanan medis
  - `Faq.php` → FAQ (pertanyaan & jawaban, relasi medical type & district)
- **View:**
  - `index.blade.php` → Halaman utama chatbot manual (untuk testing atau integrasi khusus)

## Cara Penggunaan
1. **Pastikan module Chatbot aktif.**
2. **Include** `public/js/custom-chatbot.js` di layout utama frontend.
3. **Kelola data** medical list & FAQ via dashboard admin.
4. **Akses website**: Widget chatbot akan muncul otomatis di pojok kanan bawah.

## Best Practices
- Gunakan pertanyaan & jawaban yang jelas, singkat, dan relevan.
- Update medical list & FAQ secara berkala.
- Uji alur chatbot dari sisi user untuk memastikan UX optimal.

## Troubleshooting
- **Widget tidak muncul:** Pastikan JS sudah di-include dan cache browser dibersihkan.
- **Data tidak muncul:** Pastikan medical list & FAQ sudah diisi di database.
- **Chatbot tidak merespon:** Cek endpoint `/chatbot/conversation` dan koneksi database.

## Lisensi
Module ini dilisensikan di bawah [MIT License](https://opensource.org/licenses/MIT).