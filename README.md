# WartaDesa — NICHIRO SMKN KABUH

WartaDesa adalah aplikasi berbasis **Website + Android** untuk digitalisasi informasi desa, pengumuman, dan layanan masyarakat. Proyek ini dikembangkan oleh **TIM NICHIRO SMKN KABUH** untuk lomba Pemuda Pelopor 2025 bidang Inovasi Teknologi.

---

## 🚀 Cara Menjalankan Aplikasi (Panduan Juri)

Setelah mengunduh source code dari repository ini, silakan ikuti langkah berikut agar aplikasi dapat berjalan dengan benar:

### 1. **Siapkan XAMPP**
- Install XAMPP (PHP 7/8, MySQL).
- Jalankan **Apache** dan **MySQL**.

### 2. **Letakkan Project**
- Ekstrak folder project ini.
- Pindahkan folder **WartaDesa/** ke: C:/xampp/htdocs/

### 3. **Buat Database**
1. Buka phpMyAdmin → `http://localhost/phpmyadmin`
2. Klik **Create Database**
3. Buat database baru bernama: wds
4. Import file database: wartadesa.sql


### 4. **Login ke Sistem**
Aplikasi menggunakan OTP WhatsApp:

- Nomor login contoh: 0812345678
- OTP bisa dilihat langsung melalui phpMyAdmin:
- Buka tabel: WDuser -> column Kode


### 5. **Pengujian Notifikasi (WA Gateway)**
Untuk mengirim notifikasi via WhatsApp:

1. Buka: admin/pages/function.php
2. Ganti token WA Gateway dengan token akun Anda (daftar di **Fonnte** atau layanan sejenis).
3. Untuk mengirim notifikasi:
   - Masuk menu **Pengumuman**
   - Buat pengumuman baru
   - Akan muncul ikon **pesawat kertas (send)** untuk mengirim WA.

### 6. **Uji Pengumuman**
- Buka halaman **Pengumuman** pada web.
- Jika WA Gateway aktif, pesan akan terkirim otomatis.

### 7. **Download Aplikasi Android**
Versi APK Android dapat diunduh melalui link berikut:

👉 **https://wartadesa.zonasmk.com/apk/wartadesa.apk**

---

## 📌 Fitur Utama
- Login OTP WhatsApp
- Pengumuman desa + notifikasi WA
- Manajemen berita desa
- Dashboard admin
- Aplikasi Android sinkronisasi API
- Sistem token WA Gateway
- Full PHP Native + MySQL (tanpa framework)

---


---

## ⚠️ Lisensi & Hak Cipta

**Copyright © 2025  
TIM NICHIRO SMKN KABUH**

Aplikasi ini dilindungi oleh:

### **Undang-Undang Nomor 28 Tahun 2014 tentang Hak Cipta**

DILARANG KERAS:
- Mengcopy ulang
- Memperjualbelikan
- Mendistribusikan ulang
- Mengubah sebagian/seluruh source code
- Mengklaim sebagai karya pribadi  

**Tanpa izin resmi dari TIM NICHIRO SMKN KABUH (NICHIRO).**

Pelanggaran akan dikenakan sanksi pidana dan/atau denda sesuai ketentuan UU Hak Cipta Pasal 113.

---

## 👥 Authors (TIM NICHIRO)
- **Jessica Arjeti Ramadhani**  
- **Aulia Mayninda Arini**  
- **Nur Indah Farahfansyah**  
- **Fikri Busyra Jalaludin**  
- **Ja’far Faruq**

SMKN KABUH — Tim Inovasi Teknologi **NICHIRO**  
2025

---

## 🙏 Terima Kasih
Terima kasih kepada juri, pembimbing, serta seluruh pihak yang mendukung pengembangan WartaDesa.






