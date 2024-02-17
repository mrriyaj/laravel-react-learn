<?php
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProfileController;
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

// Brand routes
Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
Route::get('/brands/create', [BrandController::class, 'create'])->name('brands.create');
Route::post('/brands', [BrandController::class, 'store'])->name('brands.store');
Route::get('/brands/{brand}', [BrandController::class, 'show'])->name('brands.show');
Route::get('/brands/{brand}/edit', [BrandController::class, 'edit'])->name('brands.edit');
 Route::put('/brands/{brand}', [BrandController::class, 'update'])->name('brands.update');
 Route::delete('/brands/{brand}', [BrandController::class, 'destroy'])->name('brands.destroy');

Route::resource('brands', BrandController::class)->middleware('auth');

Route::get('/dashboard', function () {
    // Define $someData with the data you want to pass to the view
    $someData = [
        'exampleKey' => 'exampleValue',
        'anotherKey' => 'anotherValue',
        // Add more key-value pairs as needed
    ];

    return Inertia::render('Dashboard')->with('someData', $someData);
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
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
