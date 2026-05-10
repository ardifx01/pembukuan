# Dokumentasi Setup Laravel - Aplikasi Pembukuan

## 📋 Project Overview
- **Nama Project:** Aplikasi Pembukuan Laravel
- **Tujuan:** Uji kompetensi kampus
- **Framework:** Laravel 12 (versi terbaru)
- **Database:** MySQL (local)
- **Environment:** Development (XAMPP)
- **Timeline:** 22-30 Juli 2025 (8 hari)

---

## 🔧 System Requirements

- **PHP:** 8.2+ (recommended PHP 8.4)
- **Composer:** Latest version
- **Database:** MySQL 8.0+
- **Web Server:** Apache (via XAMPP)
- **Node.js:** Untuk asset compilation (optional)

---

## 🚀 Instalasi Step-by-Step

### 1. Install XAMPP
- Download dari [apachefriends.org](https://www.apachefriends.org)
- Pilih versi dengan PHP 8.4
- Install dengan komponen: Apache, MySQL, PHP
- Start Apache dan MySQL di XAMPP Control Panel

### 2. Install Composer
- Download dari [getcomposer.org](https://getcomposer.org)
- Download `Composer-Setup.exe` untuk Windows
- Saat install, set PHP path: `C:\xampp\php\php.exe`

**Verifikasi instalasi:**
```bash
composer --version
```

### 3. Update Composer
```bash
# Update ke versi terbaru
composer self-update
```

### 4. Create Laravel Project
```bash
# Masuk ke htdocs
cd C:\xampp\htdocs

# Create project baru
composer create-project laravel/laravel aplikasi-pembukuan

# Masuk ke folder project
cd aplikasi-pembukuan
```

### 5. Generate Application Key
```bash
php artisan key:generate
```

---

## ⚙️ Konfigurasi Environment

### File .env Configuration
```env
# Application Settings
APP_NAME="Aplikasi Pembukuan"
APP_ENV=local
APP_KEY=base64:xxxxxxxxxxxxxxxxxxxxx
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database Configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=aplikasi_pembukuan
DB_USERNAME=root
DB_PASSWORD=

# Session Configuration
SESSION_DRIVER=file
SESSION_LIFETIME=120

# Cache Configuration
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
```

---

## 🗄️ Setup Database

### 1. Buat Database di phpMyAdmin
- Akses: `http://localhost/phpmyadmin`
- Login: username=`root`, password=kosong
- Create database: `aplikasi_pembukuan`
- Collation: `utf8mb4_unicode_ci`

### 2. Test Koneksi Database
```bash
# Test dengan migration default
php artisan migrate
```

---

## 🔧 Troubleshooting & Fixes

### Problem 1: ZIP Extension Missing
**Error:** `The zip extension and unzip/7z commands are both missing`

**Solution:**
1. Edit `C:\xampp\php\php.ini`
2. Uncomment: `extension=zip`
3. Restart Apache

### Problem 2: OpenSSL Duplicate Loading Warning
**Error:** `Module "openssl" is already loaded`

**Solution:**
1. Edit `C:\xampp\php\php.ini`
2. Pastikan hanya aktif: `extension=openssl`
3. Comment yang lain: `;extension=php_openssl.dll`
4. Restart Apache

**Verifikasi fix berhasil:**
```bash
php -m | findstr openssl
# Output: openssl (tanpa warning)
```

### Required PHP Extensions untuk Laravel
```ini
# Pastikan extensions ini aktif di php.ini:
extension=curl
extension=fileinfo
extension=gd
extension=intl
extension=mbstring
extension=openssl
extension=pdo_mysql
extension=zip
extension=xml
```

---

## ✅ Verifikasi Setup Berhasil

### 1. Test Laravel Installation
```bash
# Cek versi Laravel
php artisan --version

# Start development server
php artisan serve
```

### 2. Akses di Browser
- URL: `http://localhost:8000`
- Seharusnya muncul halaman welcome Laravel

### 3. Test Database Connection
```bash
# Jika berhasil, akan create tables default
php artisan migrate
```

---

## 📁 Struktur Project
```
aplikasi-pembukuan/
├── app/
├── config/
├── database/
├── public/
├── resources/
├── routes/
├── storage/
├── tests/
├── .env
├── artisan
├── composer.json
└── README.md
```

---

## 🎯 Next Steps (Roadmap Overview)

1. **Hari 1:** ✅ Setup Environment & Laravel Installation (SELESAI)
2. **Hari 2:** Database Design & Migrations  
3. **Hari 3:** Authentication & Security Implementation
4. **Hari 4:** CRUD Operations & Clean Architecture
5. **Hari 5:** Frontend Development & UI/UX
6. **Hari 6:** Charts & Data Visualization
7. **Hari 7:** Reports & Export Functionality
8. **Hari 8:** Testing & Final Polish

---

## 🛠️ Development Tools Recommendation

- **IDE:** VS Code dengan extensions Laravel
- **Database Client:** phpMyAdmin (built-in XAMPP)
- **Version Control:** Git
- **Browser:** Chrome/Firefox dengan Developer Tools

---

## 📝 Notes & Tips

1. **Selalu backup** project sebelum major changes
2. **Commit ke Git** setiap selesai fitur
3. **Test setiap fitur** sebelum lanjut ke berikutnya
4. **Gunakan CMD** instead of PowerShell untuk command Laravel
5. **Restart Apache** setiap kali edit php.ini

---

## ✅ Setup Status: COMPLETED ✅

- ✅ XAMPP installed and running
- ✅ Composer installed and updated  
- ✅ Laravel project created successfully
- ✅ OpenSSL warning fixed
- ✅ PHP extensions configured
- ✅ Ready for database setup and development

**Setup berhasil! Siap untuk tahap development selanjutnya.**