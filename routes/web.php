<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HotelController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;

// 🏠 Beranda
Route::get('/', [HomeController::class, 'index'])->name('home');

// 🔍 Pencarian Hotel
Route::get('/search', [SearchController::class, 'index'])->name('search.index');

// 🏨 Hotel
Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');
Route::get('/hotels/{hotel}', [HotelController::class, 'show'])->name('hotels.show');

// ✅ 👉 Tambahan Baru: Form Booking Hotel (menampilkan dropdown kamar)
Route::get('/hotels/{hotel}/book', [HotelController::class, 'book'])->name('hotels.book');

// 📦 Booking dan Pembayaran
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::resource('bookings', BookingController::class);
    Route::post('/bookings/{booking}/pay', [PaymentController::class, 'pay'])->name('bookings.pay');

    Route::resource('reviews', ReviewController::class)->only(['store', 'destroy']);
});

// ✍️ Review Hotel
Route::get('/hotels/{hotel}/reviews', [ReviewController::class, 'index'])->name('hotels.reviews.index');
Route::post('/hotels/{hotel}/reviews', [ReviewController::class, 'store'])->name('hotels.reviews.store');
Route::delete('/hotels/{hotel}/reviews/{review}', [ReviewController::class, 'destroy'])->name('hotels.reviews.destroy');

// 📸 Foto Hotel
Route::get('/hotels/{hotel}/photos', [HotelController::class, 'photos'])->name('hotels.photos');
Route::post('/hotels/{hotel}/photos', [HotelController::class, 'uploadPhoto'])->name('hotels.photos.upload');

// 🛎️ Fasilitas Hotel
Route::get('/hotels/{hotel}/facilities', [HotelController::class, 'facilities'])->name('hotels.facilities');
Route::post('/hotels/{hotel}/facilities', [HotelController::class, 'updateFacilities'])->name('hotels.facilities.update');

// 📝 Deskripsi Hotel
Route::get('/hotels/{hotel}/description', [HotelController::class, 'description'])->name('hotels.description');
Route::post('/hotels/{hotel}/description', [HotelController::class, 'updateDescription'])->name('hotels.description.update');

// 📩 Kontak & Info Lainnya
Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/about', fn () => view('about'))->name('about');
Route::get('/privacy', fn () => view('privacy'))->name('privacy');
Route::get('/terms', fn () => view('terms'))->name('terms');
Route::get('/faq', fn () => view('faq'))->name('faq');
