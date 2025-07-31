<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// ✅ Admin Controllers
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\HotelController as AdminHotelController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\Admin\AdminLoginController;

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

// 🏠 Beranda
Route::get('/', [HomeController::class, 'index'])->name('home');

// 🔍 Pencarian Hotel
Route::get('/search', [SearchController::class, 'index'])->name('search.index');

// 🏨 Hotel
Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');
Route::get('/hotels/{hotel}', [HotelController::class, 'show'])->name('hotels.show');

// ✅ Form Booking
Route::post('/hotels/{hotel}/book', [HotelController::class, 'storeBooking'])->name('hotels.storeBooking');
Route::get('/hotels/{hotel}/book', [HotelController::class, 'book'])->name('hotels.book');

// 📦 Booking dan Pembayaran (wajib login)
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

// 📩 Kontak & Info Lainnya
Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/about', fn () => view('about'))->name('about');
Route::get('/privacy', fn () => view('privacy'))->name('privacy');
Route::get('/terms', fn () => view('terms'))->name('terms');
Route::get('/faq', fn () => view('faq'))->name('faq');

// ✅ Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 🏠 Dashboard user biasa (optional)
Route::get('/home', fn () => view('home'))->name('home')->middleware('auth');

// 🛡️ Rute Admin
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
    Route::middleware(['admin'])->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::resource('hotels', AdminHotelController::class);
        Route::resource('bookings', AdminBookingController::class)->only(['index', 'show']);
        Route::resource('users', AdminUserController::class);
        Route::resource('reviews', AdminReviewController::class)->only(['index']);
        Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    });
});
