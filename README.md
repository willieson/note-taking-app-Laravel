<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<b>Database Struktur</b>

<img src="https://github.com/willieson/note-taking-app-Laravel/blob/main/ERD_Database_pgs.png" width = "400"/>

<li>users : Default dari Laravel Breeze. Menyimpan data akun pengguna.</li>
<li>notes : Menyimpan catatan milik user. Memiliki kolom is_public untuk publikasi.</li>
<li>note_shares : Menyimpan catatan yang dibagikan ke user lain.</li>
<li>comments : Komentar untuk catatan publik. Disimpan bersama info user & note.</li>
</br>
<b>Relasi antar tabel</b>

<li>users ⟶ notes (1-to-many)</li>
<li>users ⟶ comments (1-to-many)</li>
<li>notes ⟶ comments (1-to-many)</li>
<li>notes ⟷ users melalui note_shares (many-to-many)</li>
</br>
<b>Alasan Struktur:</b>
 <p>   Menggunakan note_shares sebagai tabel pivot agar bisa kontrol siapa yang mendapat akses.
    Field is_public pada notes memudahkan memisahkan mana catatan publik dan privat.
    comments hanya diaktifkan untuk catatan publik.</p>
<b>Flow Aplikasi:</b>

`[Autentikasi] Registrasi -> Login -> Logout // Reset password (menggunakan bawaan dari Laravel Breeze)`

`[Dashboard] tampilan untuk catatan public yang dapat dilihat semua user. setiap user dapat memberikan komentar terhadap catatan yang bersifat public.`

`[Take Notes] User bisa membuat, mengedit, dan menghapus catatan.
user bisa memilih, apakah catatan bersifat publik atau privat.
dapat melihat catatan yang dibagikan oleh user lain.
Catatan dapat dibagi kebanyak user sekaligus dan pemilik dapat membatalkanya.`

<b>Library/Plugins yang digunakan:</b>

<li><b>Laravel breeze:</b> untuk Autentikasi sederhana (login, register dll.)</li>
<li><b>Tailwind CSS:</b> Untuk Styling Ui</li>
<li><b>Select2:</b> Styling form selection agar lebih baik</li>
<li><b>Jquery:</b> untuk menjalankan Select2</li>


<h1><b>##Setup</b></h1>

Required 

`PHP v8.2` ++

`composer 2.8.2` ++

NodeJS v24.4.1 ++

`npx & npm v11.4.2` ++

copy project `git clone https://github.com/willieson/note-taking-app-Laravel.git`

masuk direktori `cd note-taking-app-Laravel`

install dependencies 

`composer install`

`npm install`

siapkan database

setup .env `touch .env`

setting database di env contoh silahkan lihat di `env.example` ini menggunakan settingan postgresql

generate breeze key `php artisan key:generate`

migrasi database `php artisan migrate`

Running dev 

`npm run dev`

`php artisan serve`
