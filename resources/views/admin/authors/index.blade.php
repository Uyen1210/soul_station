@extends('layouts.admin')

@section('header', 'Quản lý Tác Giả')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-700">Danh sách Tác Giả</h1>

        <form action="{{ route('admin.authors.store') }}" method="POST" class="flex">
            @csrf
            <input type="text" name="name" placeholder="Nhập tên tác giả..." required
                class="border border-gray-300 rounded-l px-4 py-2 focus:outline-none focus:border-amber-500">
            <button type="submit" class="bg-amber-600 hover:bg-amber-700 text-white font-bold py-2 px-4 rounded-r shadow">
                + Thêm
            </button>
        </form>
    </div>

    @if(session('success'))
        <div class="mb-4 text-green-600 bg-green-100 p-3 rounded">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        ID</th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Tên Tác Giả</th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Ngày Tạo</th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($authors as $author)
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $author->id }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm font-medium">{{ $author->name }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            {{ $author->created_at?->format('d/m/Y') }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <form action="{{ route('admin.authors.destroy', $author) }}" method="POST"
                                onsubmit="return confirm('Xóa tác giả này?')" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:text-red-900 font-bold">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4"
                            class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center text-gray-500 italic">Chưa có
                            tác giả nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="p-4">
            {{ $authors->links() }}
        </div>
    </div>
@endsection