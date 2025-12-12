@extends('layouts.admin')

@section('header', 'Thêm sách mới')

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
                <h2 class="text-xl font-bold text-gray-700">Nhập thông tin sách mới</h2>
            </div>

            <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4">
                        <p class="font-bold">Đã có lỗi xảy ra:</p>
                        <ul class="list-disc ml-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tên sách <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="title" value="{{ old('title') }}" placeholder="Nhập tên sách..."
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500 border p-2"
                                required>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Danh mục <span
                                        class="text-red-500">*</span></label>
                                <select name="category_id"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500 border p-2"
                                    required>
                                    <option value="">-- Chọn --</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Số lượng <span
                                        class="text-red-500">*</span></label>
                                <input type="number" name="quantity" value="{{ old('quantity', 1) }}" min="0"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500 border p-2"
                                    required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tác giả <span
                                    class="text-red-500">*</span></label>
                            <select name="author_id"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500 border p-2"
                                required>
                                <option value="">-- Chọn --</option>
                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>
                                        {{ $author->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Mô tả</label>
                            <textarea name="description" rows="4" placeholder="Tóm tắt nội dung sách..."
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500 border p-2">{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <label class="block text-sm font-medium text-gray-700">Ảnh bìa sách</label>

                        <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                            <div class="mb-4">
                                <label class="text-xs font-bold text-gray-500 uppercase tracking-wide">Dán Link ảnh
                                    Online</label>
                                <input type="url" name="image_url" value="{{ old('image_url') }}"
                                    placeholder="https://example.com/anh-bia.jpg"
                                    class="w-full mt-1 border-gray-300 rounded-md text-sm focus:ring-amber-500 focus:border-amber-500 border p-2">
                                <p class="text-xs text-gray-400 mt-1">Copy địa chỉ hình ảnh từ Google và dán vào đây.</p>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-end gap-3 border-t border-gray-200 pt-5">
                    <button type="reset"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-medium">Làm
                        mới</button>
                    <button type="submit"
                        class="px-6 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 shadow-md font-bold transition transform hover:scale-105">
                        + Thêm sách
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection