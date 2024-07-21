<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\UserController;
 


// // Laravel starter home page
// Route::get('/welcome', function () {
//     return view('welcome');
// });

//HOME PAGE redirect for a specific role/usertype
Route::get('/dashboard', [HomeController::class, 'redirect'])->name('dashboard');

//HOME PAGE 
Route::get('/', [ListingController::class, 'showFeaturedJobs'])->name('home');


Route::get('/jobs', [ListingController::class, 'showAllJobs'])->name('jobs');
Route::get('jobs/search', [ListingController::class, 'search'])->name('listing.search');
Route::get('/jobs/{listing}/{title}', [ListingController::class, 'show'])->name('listing.showjob');


Route::get('/companies', [CompanyController::class, 'showAllCompanies'])->name('companies');
Route::get('company/search', [CompanyController::class, 'search'])->name('company.search');


// CANDIDATE ROUTES
Route::get('/applications', [ApplicationController::class, 'showMyApplication'])->name('application.showMyApplication');
Route::get('/applications/{application}', [ApplicationController::class, 'show'])->name('application.show');
Route::post('/applications', [ApplicationController::class, 'store'])->name('application.store');




// PROFILE SETTINGS ROUTES
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ADMIN ROUTES
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
    Route::get('/admin/users/search', [UserController::class, 'search'])->name('admin.users.search');
    Route::post('/admin/users/store', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{id}', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::patch('/admin/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
    Route::get('/admin/companies', [CompanyController::class, 'showCompanies'])->name('admin.company');

});



// RECRUITER ROUTES
Route::middleware(['auth', 'recruiter'])->group(function () {

    Route::get('/company', [CompanyController::class, 'index'])->name('company.index');
    Route::post('/company/store', [CompanyController::class, 'store'])->name('company.store');
    Route::get('/company/{company}/edit', [CompanyController::class, 'edit'])->name('company.edit');
    Route::get('/company/{company}/destroy', [CompanyController::class, 'destroy'])->name('company.destroy');

    
    Route::get('/listing', [ListingController::class, 'index'])->name('listing.index');
    Route::get('/listing', [ListingController::class, 'create'])->name('listing.create');
    Route::post('/listing/store', [ListingController::class, 'store'])->name('listing.store');

    Route::get('/listing/create', [ListingController::class, 'create'])->name('listing.create');
    Route::get('/listing/{listing}/show', [ListingController::class, 'show'])->name('listing.show');


    Route::get('/listing/{listing}/edit', [ListingController::class, 'edit'])->name('listing.edit');
    Route::patch('/listing/{listing}/edit', [ListingController::class, 'update'])->name('listing.update');

    Route::get('/applications', [ApplicationController::class, 'index'])->name('application.index');
    Route::get('/applications/{application}', [ApplicationController::class, 'showCandidateApplication'])->name('application.showCandidateApplication');
    Route::get('/applications/{application}', [ApplicationController::class, 'update'])->name('application.destroy');
    Route::get('/applications/{application}', [ApplicationController::class, 'destroy'])->name('application.destroy');

});


// RESOURCEFUL ROUTES 
Route::resource('users', UserController::class)->middleware(['auth', 'admin']);
Route::resource('categories', CategoryController::class)->middleware(['auth', 'admin']);
Route::resource('company', CompanyController::class)->middleware(['auth', 'recruiter']);
Route::resource('listing', ListingController::class)->middleware(['auth', 'recruiter']);


require __DIR__ . '/auth.php';
