<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/checkout', function () {
    return view('checkout');
});

Route::get('/dashboard', [HomeController::class, 'redirect'])->name('dashboard');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
});

// admin routes
Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users')->middleware(['auth', 'admin']);
Route::post('/admin/users/store', [UserController::class, 'store'])->name('admin.users.store')->middleware(['auth', 'admin']);
Route::get('/admin/users/{id}', [UserController::class, 'edit'])->name('admin.users.edit')->middleware(['auth', 'admin']);
Route::patch('/admin/users/{id}', [UserController::class, 'update'])->name('admin.users.update')->middleware(['auth', 'admin']);



// Recruiter routes
Route::get('/company', [CompanyController::class, 'index'])->name('company.index')->middleware(['auth', 'recruiter']);
Route::post('/company/store', [CompanyController::class, 'store'])->name('company.store')->middleware(['auth', 'recruiter']);
Route::get('/company/edit/{id}', [CompanyController::class, 'edit'])->name('company.edit')->middleware(['auth', 'recruiter']);
Route::patch('/company/update/{id}', [CompanyController::class, 'update'])->name('company.update')->middleware(['auth', 'recruiter']);


//resourceful routes
Route::resource('users', UserController::class)->middleware(['auth', 'admin']);
Route::resource('categories', CategoryController::class)->middleware(['auth', 'admin']);
Route::resource('company', CompanyController::class)->middleware(['auth', 'recruiter']);
Route::resource('listings', ListingController::class)->middleware(['auth', 'recruiter', 'admin']); 


require __DIR__.'/auth.php';
