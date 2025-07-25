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

A complete Laravel-based **hotel booking web app** inspired by Agoda. This project allows users to search for hotels based on location and date, view hotel details, photos, facilities, and make bookings — just like real-world travel platforms.

---

## ✨ Features

- 🔍 Hotel search by location, check-in/out date, and number of guests
- 🏨 Hotel listing with rating, description, and facilities
- 🛏️ Room types and availability
- 📸 Hotel photo gallery
- 💳 Booking flow with dummy payment (QRIS, Transfer, COD)
- ✍️ Hotel reviews by users
- 🧑‍💻 Admin panel (CRUD: hotel, rooms, photos, facilities)
- 📄 Generate invoice PDF after booking
- 🎨 Responsive UI using Bootstrap

---

## ⚙️ Tech Stack

- Laravel 10
- PHP 8.2+
- MySQL / MariaDB
- Blade Template Engine
- Bootstrap 5 (via CDN)
- DomPDF for PDF generation

---

## 🚀 Getting Started

```bash
git clone https://github.com/your-username/hotel-booking-laravel.git
cd hotel-booking-laravel

cp .env.example .env
composer install
php artisan key:generate

php artisan migrate --seed
php artisan serve
