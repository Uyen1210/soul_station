<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BorrowAdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- ROUTE CHO USER (Sinh viên) ---
Route::middleware(['auth'])->group(function () {
    // Gửi yêu cầu mượn sách
    Route::post('/borrow/store', [BorrowController::class, 'store'])->name('borrow.store');
    // Xem lịch sử mượn
    Route::get('/my-borrows', [BorrowController::class, 'index'])->name('borrows.index');
});

// --- ROUTE CHO ADMIN (Quản trị viên) ---
Route::middleware(['auth', 'verified', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // 1. Dashboard Admin
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // 2. Quản lý Users
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::patch('/users/{id}/toggle', [UserController::class, 'toggleStatus'])->name('users.toggle');

        // 3. Quản lý Sách 
        Route::resource('books', BookController::class);

        // 4. Quản lý Danh mục
        Route::resource('categories', CategoryController::class);

        // 5. Quản lý Mượn/Trả sách
        Route::get('/borrows', [BorrowAdminController::class, 'index'])->name('borrows.index');
        Route::post('/borrows/{id}/approve', [BorrowAdminController::class, 'approve'])->name('borrows.approve');
        Route::post('/borrows/{id}/reject', [BorrowAdminController::class, 'reject'])->name('borrows.reject');
        Route::post('/borrows/{id}/return', [BorrowAdminController::class, 'returnBook'])->name('borrows.return');
    });


// --- XỬ LÝ CHUYỂN HƯỚNG SAU ĐĂNG NHẬP ---
Route::get('/dashboard', function () {
    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect('/');
})->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__ . '/auth.php';

// Route đăng xuất khẩn cấp
Route::get('/force-logout', function () {
    Illuminate\Support\Facades\Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/login');
});