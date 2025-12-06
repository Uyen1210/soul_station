<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BookController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Nhớ thêm dòng này để dùng Auth::user()

Route::get('/', function () {
    return view('welcome');
});

// --- ROUTE DASHBOARD (ĐÃ SỬA BẢO MẬT) ---
// Khi đăng nhập xong, mọi người đều vào đây.
// Nhưng ta sẽ phân loại: Admin -> Vào Admin Dashboard. User -> Về trang chủ.
Route::get('/dashboard', function () {
    if (Auth::user()->role === 'admin') {
        return view('admin.dashboard'); 
    }
    // Nếu là Uyên (User thường), đưa về trang chủ xem sách
    return redirect('/'); 
})->middleware(['auth', 'verified'])->name('dashboard');


// --- KHU VỰC ADMIN (ĐÃ THÊM KHOÁ BẢO VỆ) ---
// Thêm chữ 'admin' vào middleware để kích hoạt "Bác bảo vệ"
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard Admin (Route dự phòng)
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard_mirror');

    // Quản lý Users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::patch('/users/{id}/toggle', [UserController::class, 'toggleStatus'])->name('users.toggle');

    // Quản lý Sách
    Route::resource('books', BookController::class);
});

require __DIR__.'/auth.php';
// Route đăng xuất khẩn cấp (Dùng xong xóa đi cũng được)
Route::get('/force-logout', function () {
    Illuminate\Support\Facades\Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/login');
});