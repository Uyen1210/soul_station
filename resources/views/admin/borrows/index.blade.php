@extends('layouts.admin')

@section('header', 'Quản lý Mượn/Trả')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-700">Danh sách Phiếu Mượn</h1>
        <span class="text-sm text-gray-500">Quản lý duyệt và trả sách</span>
    </div>

    @if(session('success'))
        <div class="mb-4 text-green-600 bg-green-100 p-3 rounded">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mb-4 text-red-600 bg-red-100 p-3 rounded">{{ session('error') }}</div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Người mượn</th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Sách</th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Ngày mượn</th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Trạng thái</th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($borrows as $borrow)
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <div class="font-bold">{{ $borrow->user ? $borrow->user->name : 'User đã xóa' }}</div>
                            <div class="text-xs text-gray-500">{{ $borrow->user ? $borrow->user->email : '' }}</div>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            {{ $borrow->book ? $borrow->book->title : 'Sách đã xóa' }}
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            {{ $borrow->borrow_date ? \Carbon\Carbon::parse($borrow->borrow_date)->format('d/m/Y') : '---' }}
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            @if($borrow->status == 'pending')
                                <span class="text-amber-600 font-bold">Chờ duyệt</span>
                            @elseif($borrow->status == 'borrowed')
                                <span class="text-blue-600 font-bold">Đang mượn</span>
                            @elseif($borrow->status == 'returned')
                                <span class="text-green-600 font-bold">Đã trả</span>
                            @elseif($borrow->status == 'late')
                                <span class="text-red-600 font-bold">Trễ hạn</span>
                            @elseif($borrow->status == 'rejected') <!-- Thêm nếu cần -->
                                <span class="text-red-600 font-bold">Đã từ chối</span>
                            @endif
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <div class="flex gap-2">
                                @if($borrow->status == 'pending')
                                    <form action="{{ route('admin.borrows.approve', $borrow->id) }}" method="POST">
                                        @csrf
                                        <button
                                            class="text-green-600 hover:text-green-900 font-bold text-xs uppercase">Duyệt</button>
                                    </form>
                                    <span class="text-gray-300">|</span>
                                    <form action="{{ route('admin.borrows.reject', $borrow->id) }}" method="POST">
                                        @csrf
                                        <button class="text-red-600 hover:text-red-900 font-bold text-xs uppercase"
                                            onclick="return confirm('Hủy yêu cầu này?')">Hủy</button>
                                    </form>
                                @elseif(in_array($borrow->status, ['borrowed', 'late']))
                                    <form action="{{ route('admin.borrows.return', $borrow->id) }}" method="POST">
                                        @csrf
                                        <button class="text-blue-600 hover:text-blue-900 font-bold text-xs uppercase"
                                            onclick="return confirm('Xác nhận đã nhận lại sách?')">
                                            Khách trả sách
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-400 text-xs">Hoàn tất</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-5 py-5 text-center text-gray-500 italic">Không có dữ liệu.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="p-4">
            {{ $borrows->links() }}
        </div>
    </div>
@endsection