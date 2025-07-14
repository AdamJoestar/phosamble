# Dokumentasi Alur Kode Website Phosamble

Dokumentasi ini menjelaskan alur kode website Phosamble secara runtut mulai dari proses login, registrasi, CRUD memory, CRUD user, hingga bagaimana user bisa bergabung ke memory user lain.

---

## 1. Autentikasi (Login, Registrasi, Reset Password)

Website menggunakan Laravel Breeze untuk fitur autentikasi standar, yang meliputi:

- **Registrasi**  
  Pengguna mendaftar melalui `RegisteredUserController` di `app/Http/Controllers/Auth/RegisteredUserController.php`.  
  Proses registrasi:  
  - Menampilkan form registrasi (`create()` method)  
  - Validasi input (nama, email, password)  
  - Membuat user baru di database  
  - Login otomatis setelah registrasi  
  - Redirect ke halaman daftar boards (`boards.index`)

- **Login**  
  Login dikelola oleh `AuthenticatedSessionController` di `app/Http/Controllers/Auth/AuthenticatedSessionController.php`.  
  Proses login:  
  - Menampilkan form login (`create()` method)  
  - Validasi dan autentikasi menggunakan `LoginRequest` (validasi email dan password, rate limiting)  
  - Jika berhasil, redirect ke halaman boards (`boards.index`)  
  - Logout juga dikelola di controller ini

- **Reset Password dan Verifikasi Email**  
  Laravel Breeze juga menyediakan fitur reset password dan verifikasi email melalui controller terkait di folder `Auth`.

---

## 2. Model dan Controller Board (Papan)

- **Model Board (`app/Models/Board.php`)**  
  - Memiliki atribut `title`, `code` (kode unik 6 karakter), dan `user_id` (pemilik)  
  - Relasi:  
    - `user()`: pemilik board (belongsTo User)  
    - `memories()`: memory yang ada di board (hasMany Memory)  
    - `comments()`: komentar di board (hasMany Comment)  
    - `members()`: user yang menjadi anggota board (belongsToMany User melalui tabel pivot `board_user`)

- **BoardController (`app/Http/Controllers/BoardController.php`)**  
  - `index()`: menampilkan daftar board yang dimiliki user atau yang user menjadi anggota  
  - `store()`: membuat board baru dengan kode acak 6 karakter  
  - `show()`, `edit()`, `update()`, `destroy()`: operasi CRUD board, hanya bisa dilakukan oleh pemilik atau anggota  
  - `joinByCode()`: user bisa bergabung ke board lain dengan memasukkan kode board, jika belum menjadi anggota maka akan ditambahkan ke anggota

---

## 3. Model dan Controller Memory (Kenangan)

- **MemoryController (`app/Http/Controllers/MemoryController.php`)**  
  - `store()`: menambah memory baru ke board, bisa berupa gambar atau catatan (story)  
  - `edit()`: menampilkan form edit memory  
  - `update()`: memperbarui memory, termasuk mengganti gambar jika ada  
  - `destroy()`: menghapus memory dan file gambar terkait jika ada

- Memory terkait langsung dengan board, sehingga setiap memory berada dalam konteks board tertentu.

---

## 4. UserController (Profil Pengguna)

- `show()`: menampilkan profil publik user beserta daftar board yang dimiliki user tersebut.

---

## 5. Relasi Antar Model

- User memiliki banyak Board (sebagai pemilik)  
- Board memiliki banyak Memory dan Comment  
- Board memiliki banyak anggota (members) yang merupakan User juga, melalui tabel pivot `board_user`  
- User bisa bergabung ke board lain sebagai anggota menggunakan kode board

---

## 6. Alur Penggunaan Website

1. Pengguna melakukan registrasi atau login melalui Laravel Breeze.  
2. Setelah login, pengguna diarahkan ke halaman daftar boards yang dimiliki atau yang dia ikuti.  
3. Pengguna dapat membuat board baru dengan judul dan kode unik.  
4. Pengguna dapat bergabung ke board lain dengan memasukkan kode board.  
5. Dalam board, pengguna dapat menambah, mengedit, dan menghapus memories (gambar atau catatan).  
6. Pengguna dapat melihat profil pengguna lain beserta boards yang dimiliki.

---

Dokumentasi ini memberikan gambaran menyeluruh tentang bagaimana kode website Phosamble bekerja secara runtut dari autentikasi hingga operasi CRUD dan interaksi antar pengguna.
