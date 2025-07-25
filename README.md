<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <a href="https://github.com/your-username/hotel-booking-laravel/actions">
    <img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/l/laravel/framework" alt="License">
  </a>
</p>

---

## 🏨 Hotel Booking App

A complete Laravel-based hotel booking web app inspired by Agoda. Users can search hotels, view details, and book rooms easily.

---

## ✨ Features

- 🔍 Search hotels by location and date
- 🛏️ Room availability and types
- 📸 Hotel photo gallery
- 💳 Booking with dummy payment (QRIS, Transfer, COD)
- 📝 Review system
- 📄 Invoice PDF generation
- ⚙️ Admin dashboard for CRUD management

---

## 📸 Screenshots

### 🏨 Hotel Listing Page
![Hotel Listing](<img width="1295" height="641" alt="Screenshot (644)" src="https://github.com/user-attachments/assets/aca22cfa-cc92-47ce-93da-fa6cfd8f6e65" />
)

### 🛏️ Room Detail Page
![Room Detail](<img width="1277" height="641" alt="Screenshot (645)" src="https://github.com/user-attachments/assets/1e6bbc4b-7d98-481a-87c7-58cb9664cfe1" />
)

### 💳 Booking 
![Booking Success](<img width="1191" height="487" alt="Screenshot (646)" src="https://github.com/user-attachments/assets/106f2efd-5c0b-4e9d-ad41-4ad9fd49f485" />
)

---

## ⚙️ Tech Stack

- Laravel 10
- PHP 8.2+
- MySQL / MariaDB
- Blade + Bootstrap 5
- DomPDF for PDF generation

---

## 🚀 Installation

```bash
git clone https://github.com/your-username/hotel-booking-laravel.git
cd hotel-booking-laravel

cp .env.example .env
composer install
php artisan key:generate
php artisan migrate --seed
php artisan serve
