<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Soul Station</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f5f5dc] p-10 font-sans"> 
    
    <div class="flex justify-between items-center mb-8 border-b border-amber-200 pb-4">
        <h1 class="text-3xl font-bold text-amber-800">📚 Soul Station</h1>
        
        <div class="flex items-center gap-4">
            @if(Auth::check())
                <span class="text-gray-700">Chào, <b>{{ Auth::user()->name }}</b></span>
                <span class="text-gray-300">|</span>
                
                <a href="{{ route('history') }}" class="text-amber-700 font-bold hover:underline">
                    Lịch sử mượn
                </a>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-500 font-bold hover:underline text-sm border border-red-200 px-3 py-1 rounded hover:bg-red-50">
                        Đăng xuất
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-amber-700 font-bold hover:underline">
                    Đăng nhập
                </a>
                
                <a href="{{ route('register') }}" class="bg-amber-600 text-white px-4 py-2 rounded font-bold hover:bg-amber-700 shadow-sm transition">
                    Đăng ký
                </a>
            @endif
        </div>
    </div>

    <form class="mb-8 flex gap-2 max-w-2xl mx-auto" action="{{ route('home') }}" method="GET">
        <input type="text" name="search" value="{{ request('search') }}" 
               placeholder="Nhập tên sách hoặc tác giả..." 
               class="border border-amber-300 p-3 w-full rounded focus:outline-none focus:ring-2 focus:ring-amber-500">
        <button type="submit" class="bg-amber-600 text-white px-6 rounded font-bold hover:bg-amber-700">
            Tìm kiếm
        </button>
    </form>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($books as $book)
        <div class="bg-white p-4 rounded-xl shadow-sm hover:shadow-md border border-amber-100 transition duration-300">
            <h3 class="font-bold text-lg text-amber-900 mb-1 truncate">{{ $book->title }}</h3>
            
            <p class="text-gray-600 text-sm mb-2">
                ✍️ {{ $book->author->name ?? $book->author ?? 'Đang cập nhật' }}
            </p>
            
            <div class="flex justify-between items-end mt-4">
                <span class="text-xs font-bold {{ $book->quantity > 0 ? 'text-green-600' : 'text-red-500' }}">
                    {{ $book->quantity > 0 ? 'Còn: ' . $book->quantity : 'Hết hàng' }}
                </span>
                
                <a href="{{ route('book.detail', $book->id) }}" class="bg-amber-100 text-amber-800 px-3 py-1 rounded text-sm font-bold hover:bg-amber-200">
                    Chi tiết
                </a>
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="mt-8">
        {{ $books->links() }}
    </div>

</body>
</html>