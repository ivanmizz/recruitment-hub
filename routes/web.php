<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;


// WELCOME PAGE FOR GUESTS
Route::get('/', function () {
    return view('welcome');
});

Route::get('listing/search', [ListingController::class, 'search'])->name('listing.search');
Route::get('company/search', [CompanyController::class, 'search'])->name('company.search');


//HOME PAGE after login or registration
Route::get('/dashboard', [HomeController::class, 'redirect'])->name('dashboard');
// Route::get('/dashboard', [HomeController::class, 'redirect'])->name('dashboard');



// PROFILE SETTINGS ROUTES
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ADMIN ROUTES
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
    Route::post('/admin/users/store', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{id}', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::patch('/admin/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
});



// RECRUITER ROUTES
Route::middleware(['auth', 'recruiter'])->group(function () {
    Route::get('/company', [CompanyController::class, 'index'])->name('company.index');
    Route::post('/company/store', [CompanyController::class, 'store'])->name('company.store');
    Route::get('/company/{company}/edit', [CompanyController::class, 'edit'])->name('company.edit');
    
    Route::get('/listing', [ListingController::class, 'index'])->name('listing.index');
    Route::get('/listing', [ListingController::class, 'create'])->name('listing.create');
    Route::post('/listing/store', [ListingController::class, 'store'])->name('listing.store');
    Route::get('/listing/{listing}', [ListingController::class, 'edit'])->name('listing.edit');
    Route::patch('/listing/{listing}', [ListingController::class, 'update'])->name('listing.update');

});


// RESOURCEFUL ROUTES 
Route::resource('users', UserController::class)->middleware(['auth', 'admin']);
Route::resource('categories', CategoryController::class)->middleware(['auth', 'admin']);
Route::resource('company', CompanyController::class)->middleware(['auth', 'recruiter']);
Route::resource('listing', ListingController::class)->middleware(['auth', 'recruiter']);


require __DIR__ . '/auth.php';
