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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');
Route::get('/hotels/{hotel}', [HotelController::class, 'show'])->name('hotels.show');
Route::get('/search', [SearchController::class, 'index'])->name('search.index');
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::resource('bookings', BookingController::class);
    Route::post('/bookings/{booking}/pay', [PaymentController::class, 'pay'])->name('bookings.pay');
    
    Route::resource('reviews', ReviewController::class)->only(['store', 'destroy']);
});

Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/privacy', function () {
    return view('privacy');
})->name('privacy');
Route::get('/terms', function () {
    return view('terms');
})->name('terms');
Route::get('/faq', function () {
    return view('faq');
})->name('faq');

Route::get('/hotels/{hotel}/book', [BookingController::class, 'create'])->name('hotels.book');
Route::post('/hotels/{hotel}/book', [BookingController::class, 'store'])->name('hotels.book.store');
Route::get('/hotels/{hotel}/reviews', [ReviewController::class, 'index'])->name('hotels.reviews.index');
Route::post('/hotels/{hotel}/reviews', [ReviewController::class, 'store'])->name('hotels.reviews.store');
Route::delete('/hotels/{hotel}/reviews/{review}', [ReviewController::class, 'destroy'])->name('hotels.reviews.destroy');
Route::get('/hotels/{hotel}/photos', [HotelController::class, 'photos'])->name('hotels.photos');
Route::post('/hotels/{hotel}/photos', [HotelController::class, 'uploadPhoto'])->name('hotels.photos.upload');
Route::get('/hotels/{hotel}/facilities', [HotelController::class, 'facilities'])->name('hotels.facilities');
Route::post('/hotels/{hotel}/facilities', [HotelController::class, 'updateFacilities'])->name('hotels.facilities.update');
Route::get('/hotels/{hotel}/description', [HotelController::class, 'description'])->name('hotels.description');
Route::post('/hotels/{hotel}/description', [HotelController::class, 'updateDescription'])->name('hotels.description.update');

