<?php

use Inertia\Inertia;
<<<<<<< HEAD
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;

=======
use App\Http\Controllers\UserController;
>>>>>>> e885c52fac4634a568dce93134433aeb2d07420f
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

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

<<<<<<< HEAD

// Product Routes
Route::resource('products', ProductController::class)
    ->middleware('auth');
=======
Route::middleware(['auth' ] )->group(function () {
    Route::get('/admin', [UserController::class, 'index'])->name('admin.index');
    Route::get('/admin/create', [UserController::class, 'create'])->name('admin.create');
    Route::post('/admin/store', [UserController::class, 'store'])->name('admin.store');
    Route::get('/admin/{id}', [UserController::class, 'show'])->name('admin.show');
    Route::get('/admin/{id}/edit', [UserController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/{id}/update', [UserController::class, 'update'])->name('admin.update');

    Route::delete('/admin/{id}/destroy', [UserController::class, 'destroy'])->name('admin.destroy');
});

>>>>>>> e885c52fac4634a568dce93134433aeb2d07420f

require __DIR__.'/auth.php';
