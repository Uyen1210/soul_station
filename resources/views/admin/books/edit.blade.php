@extends('layouts.admin')

@section('header', 'Cập nhật thông tin sách')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-5">
            <a href="{{ route('admin.books.index') }}" class="text-gray-500 hover:text-amber-600 flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Quay lại danh sách
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="p-6 border-b border-gray-200 bg-gray-50">
                <h2 class="text-xl font-bold text-gray-700">Chỉnh sửa: {{ $book->title }}</h2>
            </div>

            <form action="{{ route('admin.books.update', $book->id) }}" method="POST" enctype="multipart/form-data"
                class="p-6">
                @csrf
                @method('PUT') <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tên sách</label>
                            <input type="text" name="title" value="{{ old('title', $book->title) }}"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500 border p-2"
                                required>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Danh mục</label>
                                <select name="category_id"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500 border p-2">
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ $book->category_id == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Số lượng</label>
                                <input type="number" name="quantity" value="{{ old('quantity', $book->quantity) }}" min="0"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500 border p-2"
                                    required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tác giả</label>
                            <select name="author_id"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500 border p-2">
                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}" {{ $book->author_id == $author->id ? 'selected' : '' }}>
                                        {{ $author->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Mô tả</label>
                            <textarea name="description" rows="4"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500 border p-2">{{ old('description', $book->description) }}</textarea>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <label class="block text-sm font-medium text-gray-700">Ảnh bìa sách</label>

                        <div
                            class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:bg-gray-50 transition">
                            @if($book->cover_image)
                                <div class="mb-3">
                                    <p class="text-xs text-gray-500 mb-2">Ảnh hiện tại:</p>
                                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover"
                                        class="mx-auto h-48 object-cover rounded shadow-md">
                                </div>
                            @else
                                <div
                                    class="mb-3 flex flex-col items-center justify-center h-48 bg-gray-100 rounded text-gray-400">
                                    <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span>Chưa có ảnh bìa</span>
                                </div>
                            @endif

                            <input type="url" name="image_url" placeholder="https://example.com/anh-sach.jpg"
                                value="{{ old('image_url', (isset($book) && Str::startsWith($book->cover_image, 'http')) ? $book->cover_image : '') }}"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500 border p-2 mt-1">
                            <p class="text-xs text-gray-500 mt-2">Chọn ảnh mới để thay thế (Nếu muốn)</p>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-end gap-3 border-t border-gray-200 pt-5">
                    <a href="{{ route('admin.books.index') }}"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-medium">Hủy bỏ</a>
                    <button type="submit"
                        class="px-6 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 shadow-md font-bold transition transform hover:scale-105">
                        Lưu thay đổi
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection