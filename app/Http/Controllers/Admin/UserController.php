<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // 1. Hiển thị danh sách User
    public function index()
    {
        // Lấy danh sách user (không lấy admin), phân trang 10 người
        $users = User::where('role', 'user')->orderBy('id', 'desc')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    // 2. Xử lý Khóa / Mở khóa tài khoản
    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);

        // Đổi trạng thái: Nếu Active -> Blocked, ngược lại Blocked -> Active
        if ($user->status == 'active') {
            $user->status = 'blocked';
            $message = 'Đã khóa tài khoản thành công!';
        } else {
            $user->status = 'active';
            $message = 'Đã mở khóa tài khoản thành công!';
        }

        $user->save();

        return redirect()->back()->with('success', $message);
    }
}