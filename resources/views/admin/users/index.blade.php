@extends('layouts.admin')

@section('header', 'Quản lý Độc giả')

@section('content')
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        ID
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Tên
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Email
                    </th>
                    {{-- 1. THÊM CỘT TRẠNG THÁI --}}
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Trạng thái
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Hành động
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            {{ $user->id }}
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            {{ $user->name }}
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            {{ $user->email }}
                        </td>

                        {{-- 1. HIỂN THỊ TRẠNG THÁI MÀU SẮC --}}
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            @if($user->status === 'active')
                                <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                    <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                    <span class="relative">Hoạt động</span>
                                </span>
                            @else
                                <span class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                                    <span aria-hidden class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                    <span class="relative">Đã khóa</span>
                                </span>
                            @endif
                        </td>

                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            {{-- 3. KHÔNG CHO PHÉP TỰ KHÓA CHÍNH MÌNH --}}
                            @if(Auth::id() !== $user->id)
                                <form action="{{ route('admin.users.toggle', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')

                                    {{-- 2. ĐỔI MÀU NÚT BẤM DỰA TRÊN TRẠNG THÁI --}}
                                    @if($user->status === 'active')
                                        <button type="submit" class="text-red-600 hover:text-red-900 font-bold"
                                            onclick="return confirm('Bạn có chắc muốn khóa tài khoản này?')">
                                            Khóa
                                        </button>
                                    @else
                                        <button type="submit" class="text-green-600 hover:text-green-900 font-bold">
                                            Mở khóa
                                        </button>
                                    @endif
                                </form>
                            @else
                                <span class="text-gray-400 italic">Admin</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-4">
            {{ $users->links() }}
        </div>
    </div>
@endsection