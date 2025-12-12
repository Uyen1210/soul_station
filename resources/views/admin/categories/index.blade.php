@extends('layouts.admin')

@section('header', 'Quản lý Danh mục')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-700">Danh mục Sách</h1>

        <form action="{{ route('admin.categories.store') }}" method="POST" class="flex">
            @csrf
            <input type="text" name="name" placeholder="Nhập tên danh mục..." required
                class="border border-gray-300 rounded-l px-4 py-2 focus:outline-none focus:border-amber-500">
            <button type="submit" class="bg-amber-600 hover:bg-amber-700 text-white font-bold py-2 px-4 rounded-r shadow">
                + Thêm
            </button>
        </form>
    </div>

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
                        Tên Danh mục
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Ngày tạo
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Hành động
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            {{ $category->id }}
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm font-medium">
                            {{ $category->name }}
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            {{ $category->created_at->format('d/m/Y') }}
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                onsubmit="return confirm('Xóa danh mục này?')" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:text-red-900 font-bold">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4"
                            class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center text-gray-500 italic">
                            Chưa có danh mục nào.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="p-4">
            {{-- {{ $categories->links() }} --}}
        </div>
    </div>
@endsection