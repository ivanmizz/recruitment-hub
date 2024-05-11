<?php

use App\Http\Controllers\CategoriesController;
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


// Route::middleware('auth')->group(function () {
//     Route::get('/categories/{category}', [CategoriesController::class, 'edit'])->name('show');
//     Route::post('/categories', [CategoriesController::class, 'update'])->name('store');
//     Route::delete('/categories', [CategoriesController::class, 'destroy'])->name('destroy');

    
// });

Route::resource('users', UserController::class)->middleware(['auth', 'admin']);
Route::resource('categories', CategoriesController::class)->middleware(['auth', 'admin']);
Route::resource('company', CompanyController::class)->middleware(['auth', 'recruiter',  'admin']);
Route::resource('listings', ListingController::class)->middleware(['auth', 'recruiter', 'admin']); 


require __DIR__.'/auth.php';
