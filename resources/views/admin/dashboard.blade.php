@extends('layouts.admin')

@section('header', 'Tổng quan hệ thống')

@section('content')
    {{-- PHẦN 1: CÁC Ô THỐNG KÊ (Bấm vào được) --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        
        <a href="{{ route('admin.books.index') }}" class="block transform hover:scale-105 transition duration-300">
            <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-yellow-500 flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium uppercase">Tổng số sách</p>
                    <p class="text-3xl font-bold text-gray-700">{{ $books }}</p>
                </div>
                <div class="bg-yellow-100 p-3 rounded-full text-yellow-600">
                    📚
                </div>
            </div>
        </a>

        <a href="{{ route('admin.users.index') }}" class="block transform hover:scale-105 transition duration-300">
            <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500 flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium uppercase">Độc giả</p>
                    <p class="text-3xl font-bold text-gray-700">{{ $users }}</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-full text-blue-600">
                    👥
                </div>
            </div>
        </a>

        <a href="{{ route('admin.borrows.index') }}" class="block transform hover:scale-105 transition duration-300">
            <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-amber-500 flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium uppercase">Đang mượn</p>
                    <p class="text-3xl font-bold text-gray-700">{{ $borrowing }}</p>
                </div>
                <div class="bg-amber-100 p-3 rounded-full text-amber-600">
                    ⏳
                </div>
            </div>
        </a>

        <a href="{{ route('admin.borrows.index') }}" class="block transform hover:scale-105 transition duration-300">
            <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-red-500 flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium uppercase">Quá hạn</p>
                    <p class="text-3xl font-bold text-red-600">{{ $late }}</p>
                </div>
                <div class="bg-red-100 p-3 rounded-full text-red-600">
                    ⚠️
                </div>
            </div>
        </a>
    </div>

    {{-- PHẦN 2: BẢNG MƯỢN GẦN ĐÂY --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-bold text-gray-700 mb-4 border-b pb-2">📖 Sách mượn gần đây</h3>
            
            <div class="overflow-y-auto max-h-64">
                <table class="w-full text-left border-collapse">
                    <tbody>
                        @forelse($recentRequests as $item)
                        <tr class="border-b last:border-0 hover:bg-gray-50">
                            <td class="py-3 px-2">
                                <div class="font-bold text-gray-700">{{ $item->book->title ?? 'Sách đã xóa' }}</div>
                                <div class="text-xs text-gray-500">Người mượn: {{ $item->user->name ?? 'User đã xóa' }}</div>
                            </td>
                            <td class="py-3 px-2 text-right">
                                @if($item->status == 'pending')
                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-bold px-2 py-1 rounded">Chờ duyệt</span>
                                @elseif($item->status == 'borrowed')
                                    <span class="bg-blue-100 text-blue-800 text-xs font-bold px-2 py-1 rounded">Đang mượn</span>
                                @elseif($item->status == 'returned')
                                    <span class="bg-green-100 text-green-800 text-xs font-bold px-2 py-1 rounded">Đã trả</span>
                                @else
                                    <span class="bg-gray-100 text-gray-800 text-xs font-bold px-2 py-1 rounded">{{ $item->status }}</span>
                                @endif
                                <div class="text-xs text-gray-400 mt-1">{{ $item->created_at->diffForHumans() }}</div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="py-4 text-center text-gray-500 italic">Chưa có dữ liệu mượn sách.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4 text-center">
                <a href="{{ route('admin.borrows.index') }}" class="text-sm text-indigo-600 font-bold hover:underline">Xem tất cả yêu cầu →</a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-bold text-gray-700 mb-4 border-b pb-2">🔔 Thông báo hệ thống</h3>
            <ul class="space-y-3">
                <li class="flex items-start">
                    <span class="text-green-500 mr-2">●</span>
                    <span class="text-gray-600 text-sm">Hệ thống Soul Station đã hoạt động ổn định.</span>
                </li>
                <li class="flex items-start">
                    <span class="text-blue-500 mr-2">●</span>
                    <span class="text-gray-600 text-sm">Chào mừng Admin <b>{{ Auth::user()->name }}</b> quay trở lại!</span>
                </li>
                <li class="flex items-start">
                    <span class="text-gray-400 mr-2">●</span>
                    <span class="text-gray-500 text-sm italic">Phiên bản hiện tại: v1.0.0 (Beta)</span>
                </li>
            </ul>
        </div>
    </div>
@endsection