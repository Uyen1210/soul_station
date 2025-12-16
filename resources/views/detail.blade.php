<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $book->title }} - Chi tiết</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f5f5dc] min-h-screen flex items-center justify-center p-6">
    
    <div class="bg-white max-w-4xl w-full rounded-2xl shadow-xl overflow-hidden flex flex-col md:flex-row border border-amber-200">
        <div class="md:w-1/3 bg-gray-100 flex items-center justify-center bg-amber-50">
            @if($book->cover_image)
                <img src="{{ $book->cover_image }}" class="w-full h-full object-cover">
            @else
                <span class="text-4xl">📖</span>
            @endif
        </div>
        
        <div class="md:w-2/3 p-8 relative">
            <a href="/" class="absolute top-4 right-4 text-gray-400 hover:text-red-500 font-bold text-xl">✕</a>
            
            <h1 class="text-3xl font-bold text-amber-900 mb-2">{{ $book->title }}</h1>
            
            <p class="text-lg text-amber-700 font-medium mb-4">
                ✍️ Tác giả: {{ $book->author->name ?? 'Đang cập nhật' }}
            </p>
            
            <div class="bg-amber-50 p-4 rounded-lg border border-amber-100 mb-6 text-gray-700 leading-relaxed h-40 overflow-y-auto">
                {{ $book->description ?? 'Chưa có mô tả cho cuốn sách này.' }}
            </div>

            <div class="flex items-center gap-8 mb-8">
                <div>
                    <span class="block text-sm text-gray-500">Trạng thái</span>
                    <span class="font-bold {{ $book->quantity > 0 ? 'text-green-600' : 'text-red-600' }}">
                        {{ $book->quantity > 0 ? 'Còn hàng' : 'Hết sách' }}
                    </span>
                </div>
                <div>
                    <span class="block text-sm text-gray-500">Số lượng kho</span>
                    <span class="font-bold text-gray-800">{{ $book->quantity }} bản</span>
                </div>
            </div>

            <div class="flex gap-4">
              <form action="{{ route('book.borrow', $book->id) }}" method="POST">
    @csrf
    @if($book->quantity > 0)
        <button type="submit" class="bg-amber-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-amber-700 shadow transition">
            Mượn Sách Ngay
        </button>
    @else
        <button type="button" disabled class="bg-gray-400 text-white px-6 py-3 rounded-lg font-bold cursor-not-allowed">
            Đã hết sách
        </button>
    @endif
</form>
                <a href="/" class="px-6 py-3 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-100 transition">
                    Quay lại
                </a>
            </div>
        </div>
    </div>

</body>
</html>