<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<b>Database Struktur</b>
<img src="" width = "400"/>

<li>users : Default dari Laravel Breeze. Menyimpan data akun pengguna.</li>
<li>notes : Menyimpan catatan milik user. Memiliki kolom is_public untuk publikasi.</li>
<li>note_shares : Menyimpan catatan yang dibagikan ke user lain.</li>
<li>comments : Komentar untuk catatan publik. Disimpan bersama info user & note.</li>

<b>Relasi antar tabel</b>

users ⟶ notes (1-to-many)

users ⟶ comments (1-to-many)

notes ⟶ comments (1-to-many)

notes ⟷ users melalui note_shares (many-to-many)

<b>Alasan Struktur:</b>

    Menggunakan note_shares sebagai tabel pivot agar bisa kontrol siapa yang mendapat akses.

    Field is_public pada notes memudahkan memisahkan mana catatan publik dan privat.

    comments hanya diaktifkan untuk catatan publik.

<b>Flow Aplikasi:</b>
[Autentikasi] Registrasi -> Login -> Logout // Reset password (menggunakan bawaan dari Laravel Breeze)

[Dashboard] tampilan untuk catatan public yang dapat dilihat semua user. setiap user dapat memberikan komentar terhadap catatan yang bersifat public.

[Take Notes] User bisa membuat, mengedit, dan menghapus catatan.
bisa memilih, apakah catatan bersifat publik atau privat.
dapat melihat catatan yang dibagikan oleh user lain.
Catatan dapat dibagi kebanyak user sekaligus dan pemilik dapat membatalkanya.

<b>Library/Plugins yang digunakan:</b>

<li>Laravel breeze: untuk Autentikasi sederhana (login, register dll.)</li>
<li>Tailwind CSS: Untuk Styling Ui</li>
<li>Select2: Styling form selection agar lebih baik</li>
<li>Jquery: untuk menjalankan Select2</li>
