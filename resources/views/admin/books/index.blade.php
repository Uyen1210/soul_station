@extends('layouts.admin')

@section('header', 'Quản lý Sách')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-700">Kho Sách</h1>
        <a href="{{ route('admin.books.create') }}" class="bg-amber-600 hover:bg-amber-700 text-white font-bold py-2 px-4 rounded shadow">
            + Thêm sách mới
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Ảnh bìa</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tên sách</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Số lượng</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $book->id }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            @if($book->cover_image)
                                <img src="{{ $book->cover_image }}" alt="{{ $book->title }}" class="w-12 h-16 object-cover rounded">
                            @else
                                <div class="w-12 h-16 bg-gray-200 flex items-center justify-center text-gray-400 text-xs">No IMG</div>
                            @endif
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm font-medium">{{ $book->title }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $book->quantity }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <a href="{{ route('admin.books.edit', $book->id) }}" class="text-blue-600 hover:text-blue-900 mr-2">Sửa</a>
                            <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Bạn chắc chắn muốn xóa sách này?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-5 py-5 text-center text-gray-500 italic">Chưa có sách nào trong kho.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        
        <div class="p-4">
            {{ $books->links() }}
        </div>
    </div>
@endsection