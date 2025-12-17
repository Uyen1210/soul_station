<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Xử lý đăng nhập (Đã bỏ giới hạn 60 giây)
     */
    public function authenticate(): void
    {
        // 1. Kiểm tra Email và Mật khẩu
        // (Mình đã xóa dòng ensureIsNotRateLimited ở đây để không bị khóa 60s nữa)
        
        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            
            // Báo lỗi nếu sai tài khoản/mật khẩu
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        // 2. --- KIỂM TRA QUYỀN ADMIN ---
        // Nếu mật khẩu đúng, nhưng KHÔNG PHẢI ADMIN -> Đuổi ra
        if (Auth::user()->role !== 'admin') {
            Auth::logout(); // Đăng xuất ngay
            
            throw ValidationException::withMessages([
                'email' => 'Tài khoản này không có quyền truy cập trang Quản trị!',
            ]);
        }
    }
}