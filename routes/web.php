<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProductImportExportController;
use App\Http\Controllers\ProductImportController;

Route::get('/', function () {
    return view('index');
});

// login
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::resource('/dashboard', DashboardController::class)->middleware('auth');
Route::middleware(['auth'])->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('products', ProductController::class);
    Route::resource('users', UserController::class);
});

Route::post('/products/export', [ProductController::class, 'export'])->name('products.export');
Route::post('/products/import', [ProductController::class, 'import'])->name('products.import');
