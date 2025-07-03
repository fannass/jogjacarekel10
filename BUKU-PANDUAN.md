BUKU PANDUAN PROJECT LARAVEL MODULAR – JOGJACAREKEL10

====================================================================

DAFTAR ISI
--------------------------------------------------------------------
1. Pendahuluan & Gambaran Umum Project
2. Struktur Folder & Fungsi Setiap Bagian
3. Alur Kerja Aplikasi (Request, Controller, Model, View)
4. Penjelasan Modul (Chatbot, MedicalTreatment, dst)
5. Konfigurasi & Penyimpanan Data
6. Pengelolaan Asset & File
7. Sistem Bahasa & Translasi
8. Testing & Pengujian
9. Cara Menjalankan & Pengembangan Lanjutan
10. Tips Presentasi/Wawancara

--------------------------------------------------------------------

1. PENDAHULUAN & GAMBARAN UMUM PROJECT
--------------------------------------------------------------------
Project ini adalah aplikasi web berbasis Laravel 11.x dengan arsitektur modular. Setiap fitur utama dipecah menjadi modul terpisah, sehingga mudah dikembangkan, dipelihara, dan diintegrasikan. Project ini cocok untuk aplikasi skala menengah hingga besar yang membutuhkan pemisahan logika dan pengelolaan fitur secara terstruktur.

Fitur utama:
- Autentikasi dan otorisasi user (login, register, role, permission)
- Manajemen user, role, dan permission
- Modul utama: Chatbot, MedicalTreatment, MedicalPoint, MedicalCost, MedicalCenter, MedicalCare, MedicalAlter
- Backend (admin) dan frontend (user) terpisah
- Sistem notifikasi, backup, log, dan pengelolaan setting
- Multi bahasa (multi language)

Tujuan aplikasi ini adalah memberikan pondasi kuat untuk pengembangan aplikasi web yang scalable, maintainable, dan mudah dikembangkan oleh tim.

--------------------------------------------------------------------

2. STRUKTUR FOLDER & FUNGSI SETIAP BAGIAN
--------------------------------------------------------------------

Penjelasan detail setiap folder/file utama:

app/
- Berisi logika inti aplikasi: model (struktur data), controller (pengatur alur), middleware (pengaman request), event, listener, service, dan helper.
- Contoh: app/Models/User.php (model user), app/Http/Controllers/Backend/UserController.php (controller admin user).

Modules/
- Berisi fitur utama yang dipisah per modul. Setiap modul seperti mini-aplikasi Laravel.
- Contoh: Modules/Chatbot, Modules/MedicalTreatment, dst.

routes/
- Berisi file routing utama: web.php (route web), api.php (route API), auth.php (route autentikasi), console.php (route command).
- Contoh: routes/web.php mendefinisikan URL dan controller tujuan.

resources/
- Berisi view (Blade), asset CSS/JS, komponen frontend, email template, dsb.
- Contoh: resources/views/backend/dashboard.blade.php (tampilan dashboard admin).

config/
- Berisi file konfigurasi aplikasi: database, modul, mail, permission, dsb.
- Contoh: config/database.php (setting database), config/modules.php (setting modul).

database/
- Berisi migrasi (struktur tabel), seeder (data awal), factory (data dummy).
- Contoh: database/migrations/2024_01_01_create_users_table.php.

public/
- Entry point web (index.php), asset publik (gambar, js, css, uploads).
- Contoh: public/index.php, public/uploads/avatar.jpg.

storage/
- Penyimpanan file, cache, log, session, file upload.
- Contoh: storage/app/public (file upload), storage/logs/laravel.log (log error).

lang/
- File bahasa dan translasi aplikasi (multi language).
- Contoh: lang/in.json (bahasa Indonesia), lang/en.json (bahasa Inggris).

tests/
- Pengujian aplikasi (unit test, feature test).
- Contoh: tests/Feature/AuthTest.php.

bootstrap/
- Bootstraping aplikasi Laravel (inisialisasi awal).
- Contoh: bootstrap/app.php.

vendor/
- Dependensi composer (library PHP, otomatis di-generate).

node_modules/
- Dependensi frontend (JS, CSS, otomatis di-generate).

.env
- Konfigurasi environment (database, mail, dsb).

composer.json
- Daftar dependensi PHP (Laravel, library lain).

package.json
- Daftar dependensi frontend (JS, CSS, tools build).

--------------------------------------------------------------------

3. ALUR KERJA APLIKASI (REQUEST, CONTROLLER, MODEL, VIEW)
--------------------------------------------------------------------

Penjelasan alur kerja aplikasi secara detail:

1. User mengakses aplikasi melalui browser (frontend) atau dashboard admin (backend).
2. Request masuk ke file public/index.php sebagai entry point Laravel.
3. Routing diatur di folder routes (web.php untuk web, api.php untuk API).
4. Route akan mengarahkan ke Controller yang ada di app/Http/Controllers atau Modules/.../Http/Controllers.
5. Controller memproses logika, melakukan validasi (melalui Request), dan mengakses data melalui Model yang ada di app/Models atau Modules/.../Models.
6. Model berinteraksi dengan database untuk melakukan operasi CRUD (Create, Read, Update, Delete) dan relasi data.
7. View yang ada di resources/views atau Modules/.../resources/views akan menampilkan hasil ke user.
8. Asset seperti CSS, JS, dan gambar diambil dari public atau resources.
9. File upload disimpan di storage/app/public atau public/uploads.
10. Log, cache, dan session disimpan di storage.
11. Semua konfigurasi diatur di config.
12. Sistem bahasa diatur di lang.

Contoh alur request:
- User membuka halaman web utama.
- Request masuk ke route '/' di routes/web.php.
- Route '/' diarahkan ke HomeController@index.
- HomeController mengambil data dari model (misal: Post::all()).
- Data dikirim ke view (resources/views/home.blade.php) untuk ditampilkan.

--------------------------------------------------------------------

4. PENJELASAN MODUL (CHATBOT, MEDICALTREATMENT, DLL)
--------------------------------------------------------------------

Setiap modul di dalam folder Modules memiliki struktur mirip mini-Laravel, yaitu:
- Http/Controllers: Berisi controller khusus modul tersebut (Backend dan Frontend).
- Models: Berisi model data khusus modul (struktur tabel, relasi, dsb).
- routes: Berisi routing khusus modul, biasanya ada web.php dan api.php.
- resources: Berisi view, asset, dan resource khusus modul.
- database: Berisi migrasi dan seeder khusus modul.
- config: Berisi konfigurasi khusus modul.
- Providers: Berisi service provider modul.

Contoh detail Modul Chatbot:
- Controllers: ChatbotController (logika chatbot), FaqController (FAQ), MedicalListController (daftar medis).
- Models: Faq (tabel FAQ), MedicalList (tabel daftar medis).
- Routes: web.php (route web chatbot), api.php (API chatbot).
- resources/views: Tampilan chatbot, FAQ, dsb.
- database/migrations: Struktur tabel chatbot.

Modul lain (MedicalTreatment, MedicalPoint, MedicalCost, MedicalCenter, MedicalCare, MedicalAlter):
- Setiap modul punya controller backend (admin) dan frontend (user).
- Model utama sesuai nama modul, misal MedicalTreatment.php, MedicalPoint.php, dst.
- Setiap modul bisa dikembangkan dan diintegrasikan secara independen.

--------------------------------------------------------------------

5. KONFIGURASI & PENYIMPANAN DATA
--------------------------------------------------------------------

Penjelasan detail:
- config: Semua pengaturan aplikasi (database, mail, modul, permission, dsb) diatur di sini.
- .env: Pengaturan environment (database, mail, dsb) yang sensitif dan mudah diubah.
- storage: Penyimpanan file upload (storage/app/public), cache, log (storage/logs), session.
- database: Migrasi (struktur tabel), seeder (data awal), factory (data dummy untuk testing).
- public/uploads: File upload yang bisa diakses publik (misal: foto profil user).

Contoh:
- Setting database di .env dan config/database.php.
- File upload user disimpan di storage/app/public, lalu di-link ke public/uploads.
- Log error aplikasi tersimpan di storage/logs/laravel.log.

--------------------------------------------------------------------

6. PENGELOLAAN ASSET & FILE
--------------------------------------------------------------------

Penjelasan detail:
- resources/css, js, sass: Sumber asset frontend (belum di-compile).
- public: Asset hasil build (CSS, JS, gambar, uploads) yang siap diakses user.
- storage/app/public: File upload yang di-link ke public/uploads.
- Vite dan Tailwind: Digunakan untuk build asset modern (otomatis minify, optimize, dsb).

Contoh:
- File CSS dikembangkan di resources/css, lalu di-build ke public/css menggunakan Vite.
- Gambar yang di-upload user disimpan di storage/app/public, lalu diakses dari public/uploads.

--------------------------------------------------------------------

7. SISTEM BAHASA & TRANSLASI
--------------------------------------------------------------------

Penjelasan detail:
- lang: Berisi file JSON untuk multi bahasa (in.json, en.json, dsb). Setiap file berisi key-value untuk translasi.
- LanguageController: Controller untuk mengatur pergantian bahasa aplikasi.
- View: Menggunakan helper __() untuk translasi otomatis di Blade.

Contoh:
- User memilih bahasa Indonesia, aplikasi akan mengambil string dari lang/in.json.
- Di view, gunakan {{ __("welcome") }} untuk menampilkan teks sesuai bahasa aktif.

--------------------------------------------------------------------

8. TESTING & PENGUJIAN
--------------------------------------------------------------------

Penjelasan detail:
- tests/Feature: Berisi pengujian fitur aplikasi (end-to-end, integrasi antar bagian).
- tests/Unit: Berisi pengujian unit logika aplikasi (fungsi, class, dsb).
- phpunit.xml: Konfigurasi testing (test suite, coverage, dsb).
- TestCase.php: Base class untuk semua test.

Contoh:
- tests/Feature/AuthTest.php menguji proses login user.
- tests/Unit/HelperTest.php menguji fungsi helper aplikasi.

--------------------------------------------------------------------

9. CARA MENJALANKAN & PENGEMBANGAN LANJUTAN
--------------------------------------------------------------------

Langkah instalasi detail:
1. Clone project dari repository (git clone ...).
2. Jalankan composer install untuk mengunduh dependensi PHP.
3. Jalankan npm install untuk mengunduh dependensi frontend.
4. Copy .env.example ke .env dan atur konfigurasi database, mail, dsb.
5. Jalankan migrasi database dengan php artisan migrate --seed untuk membuat tabel dan data awal.
6. Jalankan server lokal dengan php artisan serve atau gunakan Docker/Sail untuk environment container.
7. Build asset frontend dengan npm run dev (mode development) atau npm run build (mode production).

Pengembangan modul:
- Buat modul baru dengan php artisan module:build NAMA_MODUL.
- Tambahkan controller, model, route, dan view sesuai kebutuhan di dalam folder modul.
- Setiap modul bisa dikembangkan, diuji, dan diintegrasikan secara independen.

--------------------------------------------------------------------

10. TIPS PRESENTASI/WAWANCARA
--------------------------------------------------------------------

Tips detail untuk presentasi/wawancara:
- Jelaskan struktur modular: setiap fitur besar dipisah menjadi modul, sehingga scalable dan maintainable.
- Tunjukkan alur request: dari route ke controller, lalu ke model, dan akhirnya ke view.
- Tekankan keunggulan: mudah dikembangkan, bisa menambah fitur tanpa mengganggu fitur lain.
- Tunjukkan fitur multi bahasa, sistem notifikasi, backup otomatis, dan pengelolaan setting yang fleksibel.
- Jelaskan cara menambah modul/fitur baru: cukup buat folder di Modules, tambahkan controller, model, route, view.
- Tunjukkan adanya testing otomatis (unit & feature test) untuk menjaga kualitas aplikasi.
- Jelaskan pengelolaan asset modern menggunakan Vite dan Tailwind agar tampilan responsif dan cepat.
- Sampaikan bahwa dokumentasi dan struktur project sudah rapi, sehingga mudah dipelajari anggota tim baru.

--------------------------------------------------------------------

Buku panduan ini bisa langsung Anda copy ke Word dan dibagikan ke kelompok untuk referensi, diskusi, maupun persiapan wawancara. Jika ingin penjelasan lebih detail pada bagian tertentu, silakan minta bab tambahan! 