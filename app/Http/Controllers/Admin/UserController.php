<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {

        $users = User::where('role', 'user')->orderBy('id', 'desc')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);

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