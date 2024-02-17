<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Brands Routes
Route::middleware(['auth'])->group(function () {
    Route::group(['prefix' => 'brands'], function () {
        Route::get('/', [BrandController::class, 'index'])->name('brands.index');
        Route::get('/create', [BrandController::class, 'create'])->name('brands.create');
        Route::post('/', [BrandController::class, 'store'])->name('brands.store');
        Route::get('/{brand}', [BrandController::class, 'show'])->name('brands.show');
        Route::get('/{brand}/edit', [BrandController::class, 'edit'])->name('brands.edit');
        Route::put('/{brand}', [BrandController::class, 'update'])->name('brands.update');
        Route::delete('/{brand}', [BrandController::class, 'destroy'])->name('brands.destroy');
    });
});

// User Routes
Route::middleware(['auth'])->group(function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.index');
        Route::get('/create', [UserController::class, 'create'])->name('admin.create');
        Route::post('/store', [UserController::class, 'store'])->name('admin.store');
        Route::get('/{id}', [UserController::class, 'show'])->name('admin.show');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('admin.edit');
        Route::put('/{id}/update', [UserController::class, 'update'])->name('admin.update');
        Route::delete('/{id}/destroy', [UserController::class, 'destroy'])->name('admin.destroy');
    });
});

// Categories Routes
Route::middleware(['auth'])->group(function () {
    Route::resource('categories', CategoryController::class);
});

// Products Routes
Route::middleware(['auth'])->group(function () {
    Route::resource('products', ProductController::class);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth' ] )->group(function () {
    Route::get('/admin', [UserController::class, 'index'])->name('admin.index');
    Route::get('/admin/create', [UserController::class, 'create'])->name('admin.create');
    Route::post('/admin/store', [UserController::class, 'store'])->name('admin.store');
    Route::get('/admin/{id}', [UserController::class, 'show'])->name('admin.show');
    Route::get('/admin/{id}/edit', [UserController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/{id}/update', [UserController::class, 'update'])->name('admin.update');

    Route::delete('/admin/{id}/destroy', [UserController::class, 'destroy'])->name('admin.destroy');
});


require __DIR__.'/auth.php';
