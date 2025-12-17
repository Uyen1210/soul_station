<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Import các Controller
use App\Http\Controllers\HomeController; // Của Ly (User)
use App\Http\Controllers\AdminController; // Của Hậu (Admin Dashboard + Xử lý mượn trả)
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ====================================================
// 1. ROUTE CHO USER (Phần của Ly + Hậu)
// ====================================================

// Ai cũng xem được
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/sach/{id}', [HomeController::class, 'detail'])->name('book.detail');

// Phải đăng nhập mới làm được
Route::middleware(['auth'])->group(function () {
    Route::post('/borrow/{id}', [HomeController::class, 'borrow'])->name('book.borrow');
    Route::get('/lich-su', [HomeController::class, 'history'])->name('history');
});


// ====================================================
// 2. ROUTE CHO ADMIN (Phần của Uyên + Hậu)
// ====================================================
Route::middleware(['auth', 'verified', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // --- Dashboard ---
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // --- Quản lý Users ---
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::patch('/users/{id}/toggle', [UserController::class, 'toggleStatus'])->name('users.toggle');

        // --- Quản lý Sách ---
        Route::resource('books', BookController::class);

        // --- Quản lý Danh mục ---
        Route::resource('categories', CategoryController::class);

        // --- Quản lý Mượn/Trả sách (QUAN TRỌNG: Đã mở full chức năng) ---
        
        // 1. Xem danh sách (Thiếu cái này là không vào được trang)
        Route::get('/borrows', [AdminController::class, 'index'])->name('borrows.index');
        
        // 2. Duyệt
        Route::post('/borrows/{id}/approve', [AdminController::class, 'approve'])->name('borrows.approve');
        
        // 3. Hủy (Đã mở comment)
        Route::post('/borrows/{id}/reject', [AdminController::class, 'reject'])->name('borrows.reject');
        
        // 4. Trả sách (Đã mở comment)
        Route::post('/borrows/{id}/return', [AdminController::class, 'returnBook'])->name('borrows.return');
    });


// ====================================================
// 3. CÁC ROUTE HỆ THỐNG
// ====================================================

Route::get('/dashboard', function () {
    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect('/');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::get('/force-logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/login');
});