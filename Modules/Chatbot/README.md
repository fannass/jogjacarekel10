# Module Chatbot Manual - JogjaCare (Hybrid with Tawk.to)

## Deskripsi
Module Chatbot Manual adalah modul chatbot berbasis web yang dibangun tanpa BotMan, dengan alur multi-step, quick reply, dan basis data Medical List & FAQ. Chatbot ini membantu pengguna mencari informasi layanan medis di Jogja secara interaktif.

**Fitur Hybrid:**
- **Pertanyaan terstruktur** → Chatbot menjawab berdasarkan FAQ
- **Pertanyaan tidak terstruktur** → Redirect ke **Tawk.to live chat** dengan admin

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
3. **Hybrid Live Chat Integration**
   - Deteksi pertanyaan tidak terstruktur
   - Auto-redirect ke Tawk.to live chat
   - Seamless integration dengan admin support

## Struktur Module (Utama)
```
Modules/Chatbot/
├── Http/
│   └── Controllers/
│       └── ChatbotController.php   # Endpoint utama percakapan hybrid
├── Models/
│   ├── MedicalList.php            # Model jenis layanan medis
│   └── Faq.php                    # Model FAQ
├── Config/
│   └── config.php                 # Konfigurasi Tawk.to & chatbot behavior
├── Resources/
│   ├── views/
│   │   └── index.blade.php        # Tampilan utama chatbot manual
│   └── assets/
│       └── js/
│           └── app.js             # (Opsional, jika ada asset JS lama)
├── public/js/
│   └── custom-chatbot.js          # Widget chat hybrid (frontend)
├── Routes/
│   └── web.php                    # Route endpoint chatbot hybrid
├── README.md                      # Dokumentasi ini
└── TAWKTO_SETUP.md               # Panduan setup Tawk.to
```

## Flow User (Hybrid)

### Pertanyaan Terstruktur:
1. User klik bubble chat di pojok kanan bawah.
2. Chatbot menyapa dan menampilkan pilihan jenis layanan medis (quick reply).
3. User memilih jenis layanan medis.
4. Chatbot menampilkan daftar kecamatan/district (quick reply).
5. User memilih district.
6. Chatbot menampilkan jawaban FAQ sesuai medical type & district.
7. User bisa memberi feedback (bermanfaat/tidak) atau mulai ulang percakapan.

### Pertanyaan Tidak Terstruktur:
1. User mengetik pertanyaan bebas (misal: "Saya butuh bantuan khusus")
2. Chatbot mendeteksi input tidak terstruktur
3. Chatbot mencari FAQ yang relevan (fuzzy search)
4. Jika FAQ ditemukan → tampilkan jawaban
5. Jika FAQ tidak ditemukan → redirect ke Tawk.to live chat
6. Admin bisa langsung chat dengan user

## Flow Admin
1. Login ke dashboard admin.
2. Kelola **Medical List** (tambah/edit/hapus jenis layanan medis).
3. Kelola **FAQ** (tambah/edit/hapus pertanyaan & jawaban, kaitkan dengan medical type & district).
4. Data medical list & FAQ otomatis digunakan oleh chatbot hybrid.
5. **Setup Tawk.to** untuk live chat (lihat `TAWKTO_SETUP.md`).

## Konsep Program & File Utama
- **Frontend Widget:**
  - `public/js/custom-chatbot.js` → Widget chat bubble, window chat, quick reply, animasi, feedback, AJAX ke backend, Tawk.to integration.
  - Di-include di layout utama frontend.
- **Backend Endpoint:**
  - `Modules/Chatbot/Http/Controllers/ChatbotController.php` → Method `conversation()` handle alur hybrid (structured flow + unstructured detection + Tawk.to redirect).
  - Route: `/chatbot/conversation` (POST)
  - Route: `/chatbot/tawkto-config` (GET)
- **Model:**
  - `MedicalList.php` → Jenis layanan medis
  - `Faq.php` → FAQ (pertanyaan & jawaban, relasi medical type & district)
- **Configuration:**
  - `Config/config.php` → Konfigurasi Tawk.to dan behavior chatbot
- **View:**
  - `index.blade.php` → Halaman utama chatbot manual (untuk testing atau integrasi khusus)

## Cara Penggunaan
1. **Pastikan module Chatbot aktif.**
2. **Setup Tawk.to** (lihat `TAWKTO_SETUP.md`).
3. **Include** `public/js/custom-chatbot.js` di layout utama frontend.
4. **Kelola data** medical list & FAQ via dashboard admin.
5. **Akses website**: Widget chatbot akan muncul otomatis di pojok kanan bawah.

## Konfigurasi Tawk.to
Untuk setup Tawk.to live chat, ikuti panduan lengkap di `TAWKTO_SETUP.md`.

**Quick Setup:**
1. Daftar di [https://www.tawk.to](https://www.tawk.to)
2. Copy Widget ID
3. Edit `.env`:
```env
TAWKTO_ENABLED=true
TAWKTO_WIDGET_ID=YOUR_WIDGET_ID_HERE
TAWKTO_AUTO_REDIRECT_DELAY=3000
```

## Best Practices
- Gunakan pertanyaan & jawaban yang jelas, singkat, dan relevan.
- Update medical list & FAQ secara berkala.
- Uji alur chatbot dari sisi user untuk memastikan UX optimal.
- Monitor Tawk.to dashboard untuk live chat performance.
- Set auto-reply untuk jam offline di Tawk.to.

## Troubleshooting
- **Widget tidak muncul:** Pastikan JS sudah di-include dan cache browser dibersihkan.
- **Data tidak muncul:** Pastikan medical list & FAQ sudah diisi di database.
- **Chatbot tidak merespon:** Cek endpoint `/chatbot/conversation` dan koneksi database.
- **Tawk.to tidak redirect:** Cek konfigurasi Widget ID dan endpoint `/chatbot/tawkto-config`.
- **Live chat tidak muncul:** Cek status online di dashboard Tawk.to.

## Lisensi
Module ini dilisensikan di bawah [MIT License](https://opensource.org/licenses/MIT).
Tawk.to menggunakan lisensi mereka sendiri.