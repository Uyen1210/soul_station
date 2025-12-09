<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BorrowAdminController;
use App\Http\Controllers\CategoryController;

// routes borrow users
Route::middleware(['auth'])->group(function () {
    Route::get('/borrow/request/{book}', [BorrowController::class, 'create'])->name('borrow.request');
    Route::post('/borrow/store', [BorrowController::class, 'store'])->name('borrow.store');

});
// routes borrow admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/borrows', [BorrowAdminController::class, 'index'])->name('admin.borrows.index');
    Route::post('/admin/borrows/approve/{borrow}', [BorrowAdminController::class, 'approve'])->name('admin.borrows.approve');
    Route::post('/admin/borrows/reject/{borrow}', [BorrowAdminController::class, 'reject'])->name('admin.borrows.reject');
    Route::resource('/admin/categories', CategoryController::class);
});
