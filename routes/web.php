<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\UserController;

// Semua orang bisa mengakses ini (tanpa login)
Route::get('/', [MovieController::class, 'index'])->name('home');
Route::get('/movies', [MovieController::class, 'movies']);
Route::get('/tv-show', [MovieController::class, 'tvShows']);
Route::get('/search', [MovieController::class, 'search']);

// Auth Routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 🔒 Middleware untuk user yang login
Route::middleware(['auth'])->group(function () {
    Route::get('/movie/{id}', [MovieController::class, 'movieDetails']);    
    Route::get('/tv/{id}', [MovieController::class, 'tvDetails']);

    //  Middleware admin manual
    Route::middleware('admin')->group(function () {
        Route::resource('users', UserController::class);
    });

    // Wishlist CRUD (nanti kita tambahkan)
    // Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
    // Route::post('/wishlist/add', [WishlistController::class, 'store'])->name('wishlist.add');
    // Route::delete('/wishlist/remove/{id}', [WishlistController::class, 'destroy'])->name('wishlist.remove');
});
