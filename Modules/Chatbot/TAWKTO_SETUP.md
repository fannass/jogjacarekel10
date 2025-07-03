# Tawk.to Setup untuk Hybrid Chatbot

## Deskripsi
Chatbot JogjaCare sekarang menggunakan sistem **hybrid**:
- **Pertanyaan terstruktur** → Chatbot menjawab berdasarkan FAQ
- **Pertanyaan tidak terstruktur** → Redirect ke **Tawk.to live chat** dengan admin

## Cara Setup Tawk.to

### 1. Daftar di Tawk.to
1. Kunjungi [https://www.tawk.to](https://www.tawk.to)
2. Daftar akun gratis
3. Login ke dashboard

### 2. Buat Widget
1. Di dashboard, klik "Add Widget"
2. Pilih "Chat Widget"
3. Atur nama widget (misal: "JogjaCare Support")
4. Copy **Widget ID** yang muncul

### 3. Konfigurasi di Laravel
1. Edit file `.env`:
```env
TAWKTO_ENABLED=true
TAWKTO_WIDGET_ID=68507566a1bfba190de84b28/1itt4l687
TAWKTO_AUTO_REDIRECT_DELAY=3000
```

2. Atau edit file `Modules/Chatbot/Config/config.php`:
```php
'tawkto' => [
    'enabled' => true,
    'widget_id' => '68507566a1bfba190de84b28/1itt4l687',
    'auto_redirect_delay' => 3000,
],
```

### 4. Test Chatbot
1. Akses website
2. Klik chatbot bubble
3. Ketik pertanyaan tidak terstruktur (misal: "Saya butuh bantuan khusus")
4. Chatbot akan redirect ke Tawk.to live chat

## Flow Hybrid Chatbot

### Pertanyaan Terstruktur:
1. User: "Saya cari rumah sakit"
2. Bot: "Pilih jenis layanan medis" (button options)
3. User: Pilih "Rumah Sakit"
4. Bot: "Pilih district" (button options)
5. User: Pilih "Sleman"
6. Bot: Menampilkan FAQ tentang rumah sakit di Sleman

### Pertanyaan Tidak Terstruktur:
1. User: "Saya butuh bantuan khusus untuk operasi"
2. Bot: "I understand you're asking about: 'Saya butuh bantuan khusus untuk operasi'. Let me connect you with our support team."
3. Bot: Menampilkan button "💬 Connect to Live Chat"
4. Auto-redirect ke Tawk.to live chat setelah 3 detik
5. Admin bisa langsung chat dengan user

## Fitur Tawk.to yang Digunakan

### Auto-Maximize
- Widget Tawk.to akan otomatis terbuka saat redirect
- User tidak perlu klik manual

### Custom Styling
- Widget menggunakan styling default Tawk.to
- Bisa dikustomisasi dari dashboard Tawk.to

### Admin Dashboard
- Admin bisa melihat semua chat dari dashboard Tawk.to
- Bisa set auto-reply, offline message, dll
- Bisa assign chat ke agent tertentu

## Troubleshooting

### Widget tidak muncul:
1. Cek Widget ID sudah benar
2. Cek `TAWKTO_ENABLED=true`
3. Clear cache: `php artisan cache:clear`

### Redirect tidak bekerja:
1. Cek browser console untuk error
2. Pastikan endpoint `/chatbot/tawkto-config` bisa diakses
3. Cek network tab untuk request ke Tawk.to

### Admin tidak menerima chat:
1. Cek status online di dashboard Tawk.to
2. Pastikan notification email aktif
3. Cek setting auto-assignment

## Best Practices

### Untuk Admin:
1. Selalu online saat jam kerja
2. Set auto-reply untuk jam offline
3. Monitor dashboard secara berkala
4. Assign chat ke agent yang tepat

### Untuk User:
1. Berikan informasi detail saat chat
2. Siapkan dokumen yang diperlukan
3. Sabar menunggu response admin

## Konfigurasi Lanjutan

### Custom Auto-Reply
```javascript
// Di dashboard Tawk.to
Tawk_API.onLoad = function(){
    Tawk_API.addEvent('onChatStarted', function(){
        Tawk_API.sendMessage('Selamat datang di JogjaCare! Ada yang bisa kami bantu?');
    });
};
```

### Offline Message
```javascript
// Di dashboard Tawk.to
Tawk_API.onLoad = function(){
    Tawk_API.addEvent('onChatMaximized', function(){
        if (!Tawk_API.isAgentOnline()) {
            Tawk_API.sendMessage('Maaf, admin sedang offline. Kami akan balas segera.');
        }
    });
};
```

## Lisensi
Tawk.to menggunakan lisensi mereka sendiri. Pastikan membaca Terms of Service di [https://www.tawk.to/terms-of-service](https://www.tawk.to/terms-of-service). 