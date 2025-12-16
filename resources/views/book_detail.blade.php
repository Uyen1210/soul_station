<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>{{ $book->title }} - Chi tiết</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f5f5dc] min-h-screen flex items-center justify-center p-6">
    <div class="bg-white max-w-4xl w-full rounded-2xl shadow-xl overflow-hidden flex flex-col md:flex-row">
        <div class="md:w-1/3 bg-gray-100">
            <img src="{{ $book->cover_image ?? 'https://via.placeholder.com/300x400' }}" class="w-full h-full object-cover">
        </div>
        
        <div class="md:w-2/3 p-8 relative">
            <a href="/" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">✕ Đóng</a>
            
            <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $book->title }}</h1>
            <p class="text-xl text-amber-600 font-medium mb-4">Tác giả: {{ $book->author }}</p>
            
            <div class="bg-amber-50 p-4 rounded-lg border border-amber-100 mb-6">
                <p class="text-gray-700 leading-relaxed">{{ $book->description ?? 'Chưa có mô tả cho cuốn sách này.' }}</p>
            </div>

            <div class="flex items-center gap-6 mb-8">
                <div>
                    <span class="block text-sm text-gray-500">Trạng thái</span>
                    <span class="font-bold {{ $book->quantity > 0 ? 'text-green-600' : 'text-red-600' }}">
                        {{ $book->quantity > 0 ? 'Còn hàng' : 'Hết hàng' }}
                    </span>
                </div>
                <div>
                    <span class="block text-sm text-gray-500">Số lượng</span>
                    <span class="font-bold">{{ $book->quantity }} bản</span>
                </div>
            </div>

            <div class="flex gap-4">
                @if($book->quantity > 0)
                    <button class="bg-amber-600 text-white px-8 py-3 rounded-lg font-bold hover:bg-amber-700 shadow-md">
                        Đăng ký Mượn
                    </button>
                @else
                    <button disabled class="bg-gray-300 text-gray-500 px-8 py-3 rounded-lg font-bold cursor-not-allowed">
                        Tạm hết sách
                    </button>
                @endif
                <a href="/" class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50">Quay lại</a>
            </div>
        </div>
    </div>
</body>
</html>