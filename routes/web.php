<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// ✅ Admin Controllers
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\HotelController as AdminHotelController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;

// ✅ User Controllers
use App\Http\Controllers\HotelController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReviewController as UserReviewController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AuthController;

//
// ✅ RUTE UTAMA USER
//

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [SearchController::class, 'index'])->name('search.index');

// 🏨 Hotel
Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');
Route::get('/hotels/{hotel}', [HotelController::class, 'show'])->name('hotels.show');
Route::post('/hotels/{hotel}/book', [HotelController::class, 'storeBooking'])->name('hotels.storeBooking');
Route::get('/hotels/{hotel}/book', [HotelController::class, 'book'])->name('hotels.book');

// ✍️ Review Hotel
Route::get('/hotels/{hotel}/reviews', [UserReviewController::class, 'index'])->name('hotels.reviews.index');
Route::post('/hotels/{hotel}/reviews', [UserReviewController::class, 'store'])->name('hotels.reviews.store');
Route::delete('/hotels/{hotel}/reviews/{review}', [UserReviewController::class, 'destroy'])->name('hotels.reviews.destroy');

// 📸 Foto Hotel
Route::get('/hotels/{hotel}/photos', [HotelController::class, 'photos'])->name('hotels.photos');
Route::post('/hotels/{hotel}/photos', [HotelController::class, 'uploadPhoto'])->name('hotels.photos.upload');

// 🛎️ Fasilitas Hotel
Route::get('/hotels/{hotel}/facilities', [HotelController::class, 'facilities'])->name('hotels.facilities');
Route::post('/hotels/{hotel}/facilities', [HotelController::class, 'updateFacilities'])->name('hotels.facilities.update');

// 📝 Deskripsi Hotel
Route::get('/hotels/{hotel}/description', [HotelController::class, 'description'])->name('hotels.description');
Route::post('/hotels/{hotel}/description', [HotelController::class, 'updateDescription'])->name('hotels.description.update');

// 📩 Info Tambahan
Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::view('/about', 'about')->name('about');
Route::view('/privacy', 'privacy')->name('privacy');
Route::view('/terms', 'terms')->name('terms');
Route::view('/faq', 'faq')->name('faq');

//
// ✅ AUTH USER
//

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//
// ✅ AREA USER TERLOGIN
//

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/password', [ProfileController::class, 'editPassword'])->name('profile.password.edit');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::get('/profile/bookings', [ProfileController::class, 'bookings'])->name('profile.bookings');
    Route::get('/profile/reviews', [ProfileController::class, 'reviews'])->name('profile.reviews');

    Route::resource('bookings', BookingController::class);
    Route::get('/bookings/{booking}/payment', [PaymentController::class, 'chooseMethod'])->name('bookings.payment');
    Route::post('/bookings/{booking}/pay', [PaymentController::class, 'pay'])->name('bookings.pay');
    Route::resource('reviews', UserReviewController::class)->only(['store', 'destroy']);
});

//
// ✅ ADMIN AREA
//

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');

    Route::middleware(['admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        // Hotel dan Room Management
        Route::get('hotels/{hotel}/rooms', [AdminHotelController::class, 'manageRooms'])->name('admin.hotels.rooms');
        Route::patch('/admin/rooms/{room}/toggle', [AdminHotelController::class, 'toggleRoomAvailability'])->name('admin.rooms.toggle');


        // Fitur lainnya bisa ditambahkan di sini
        Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    });
});
