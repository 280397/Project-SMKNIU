=============================================================================
Sistem ini merupakan Aplikasi inventory integrasi dengan platform android

Peringatan!!!
- pastikan nama domain sama dengan folder aplikasi (root)
- awal konfigurasi menggunakan php-7 (belum diuji pada versi php dibawahnya)
- menggunakan framework codeigniter 3
- Sistem ini dilengkapi dengan REST API Android
- jangan mengaktifkan fitur "menu" di menu admin
- aktifkan user access menu pada menu "admin" sesuai kebutuhan
- pada menu inventory khusus data mengenai informasi inventory
- pada menu peminjaman khusus data mengenai informasi peminjaman
- JANGAN MERUBAH ATAUPUN MENGEKSEKUSI FILE PADA FOLDER application->controller->api dan application->models->m_api, karena folder tersebut berisi file konfigurasi REST API Android. kecuali ada perubahan yang sangat diperlukan. MERUBAH FOLDER TERSEBUT BERARTI HARUS MERUBAH RESPONSE SOURCE CODE ANDROID.

=============================================================================

Cara konfigurasi;
1. masuk ke folder applicaton->config->buka file database.php
    a. pada baris 76-96 merupakan konfigurasi database. isikan sesuai konfigurasi pada phpmyadmin server.
2. login website dengan user default "admin", password "admin"

=============================================================================


"jangan menuntut apa yang sudah kamu dapat. Tapi berfikirlah apa yang sudah kamu beri." (Cahoed, 2015)