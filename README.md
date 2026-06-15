# Website Profil Organisasi - HMSS
## Himpunan Mahasiswa Statistika

Website profil organisasi dinamis dan responsif berbasis **PHP**, **MySQL**, dan **Bootstrap 5**.

---

## 📋 Fitur Utama

| Halaman | Deskripsi |
|---|---|
| 🏠 **Beranda** | Hero section, berita terbaru, galeri preview, CTA |
| ℹ️ **Tentang Kami** | Sejarah, visi, misi, nilai, struktur organisasi, timeline |
| 👥 **Profil Anggota** | Daftar anggota dengan foto, jabatan, bio |
| 🖼️ **Galeri Kegiatan** | Grid foto kegiatan dengan lightbox modal |
| 📰 **Berita/Artikel** | Daftar berita dan halaman detail artikel |
| 📬 **Kontak** | Formulir kontak, info kontak, FAQ |
| 🔐 **Admin Panel** | Login, dashboard, CRUD lengkap |

### Admin Panel Features:
- ✅ Login/Logout aman dengan session
- ✅ Dashboard dengan statistik real-time
- ✅ CRUD Anggota (Create, Read, Update, Delete)
- ✅ CRUD Berita/Artikel
- ✅ CRUD Galeri/Kegiatan
- ✅ Kelola Pesan Masuk
- ✅ Upload foto/gambar

---

## 🗄️ Struktur Database

```
Database: website_profil_organisasi
├── users       → Login admin (id, username, email, password, role)
├── members     → Anggota (id, name, role, photo, bio)
├── events      → Galeri kegiatan (id, title, date, description, image)
├── news        → Berita (id, title, content, image, date)
└── contacts    → Pesan kontak (id, name, email, message, created_at)
```

---

## 📁 Struktur File

```
website-profil-organisasi/
├── 📄 index.php              → Halaman Utama
├── 📄 about.php              → Tentang Kami
├── 📄 members.php            → Profil Anggota
├── 📄 gallery.php            → Galeri Kegiatan
├── 📄 news.php               → Berita & Artikel
├── 📄 contact.php            → Halaman Kontak
├── 📄 db.php                 → Koneksi Database
├── 📄 database.sql           → Script SQL (import ke MySQL)
├── includes/
│   ├── header.php            → Header & Navbar
│   └── footer.php            → Footer
├── assets/
│   ├── css/style.css         → Custom CSS
│   └── images/               → Upload gambar
└── admin/
    ├── login.php             → Login Admin
    ├── logout.php            → Logout
    ├── dashboard.php         → Dashboard
    ├── members.php           → CRUD Anggota
    ├── news.php              → CRUD Berita
    ├── gallery.php           → CRUD Galeri
    ├── contacts.php          → Lihat Pesan
    ├── auth_check.php        → Middleware autentikasi
    ├── admin_header.php      → Template header admin
    └── admin_footer.php      → Template footer admin
```

---

## 🚀 Cara Instalasi & Penggunaan

### Persyaratan
- PHP >= 7.4
- MySQL >= 5.7 atau MariaDB
- Web Server: Apache (XAMPP/WAMP) atau Laragon

### Langkah Instalasi

**1. Persiapkan Web Server**
```
Pastikan XAMPP/Laragon sudah berjalan
Services yang harus aktif: Apache + MySQL
```

**2. Tempatkan File Proyek**
```
Salin folder project ke:
  XAMPP → C:/xampp/htdocs/website-profil-organisasi/
  Laragon → C:/laragon/www/website-profil-organisasi/
```

**3. Import Database**
```
1. Buka phpMyAdmin: http://localhost/phpmyadmin
2. Klik "Import" atau buat database baru bernama: website_profil_organisasi
3. Import file: database.sql
```

**4. Konfigurasi Database** (jika perlu)
```php
// Edit file: db.php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');       // Username MySQL Anda
define('DB_PASS', '');           // Password MySQL Anda
define('DB_NAME', 'website_profil_organisasi');
```

**5. Akses Website**
```
Website Utama : http://localhost/website-profil-organisasi/
Admin Panel   : http://localhost/website-profil-organisasi/admin/login.php
```

### Kredensial Admin Default
```
Username : admin
Password : password
```

> ⚠️ **Catatan Keamanan**: Ganti password admin setelah instalasi pertama!

---

## 🎨 Teknologi yang Digunakan

| Teknologi | Versi | Kegunaan |
|---|---|---|
| PHP | 7.4+ | Backend & logika aplikasi |
| MySQL | 5.7+ | Database |
| Bootstrap | 5.3 | Framework CSS responsif |
| Bootstrap Icons | 1.11 | Icon set |
| AOS.js | 2.3.1 | Animasi scroll |
| Google Fonts | - | Typography (Inter, Poppins) |


---

## 🔒 Keamanan

- Password di-hash menggunakan `password_hash()` (bcrypt)
- SQL Injection dicegah dengan `prepared statements` & `real_escape_string()`
- Session-based authentication untuk admin
- Input validation di sisi server
- XSS Protection dengan `htmlspecialchars()`

---

*© 2025 HMSS - Himpunan Mahasiswa Statistika*
