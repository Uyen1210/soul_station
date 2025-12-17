<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Lịch sử mượn - Soul Station</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f5f5dc] p-10 font-sans">
    <div class="max-w-4xl mx-auto">
        
        <div class="flex justify-between items-center mb-8 border-b border-amber-200 pb-4">
            <div class="text-gray-600">
                Xin chào, <b class="text-amber-800">{{ Auth::user()->name ?? 'Bạn' }}</b>
            </div>
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-red-600 font-bold hover:underline text-sm flex items-center gap-1">
                    Đăng xuất
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                    </svg>
                </button>
            </form>
        </div>

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-amber-800">📜 Lịch sử mượn sách</h1>
            <a href="/" class="text-amber-600 font-bold hover:underline">← Quay về trang chủ</a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow-md rounded-lg overflow-hidden border border-amber-200">
            <table class="w-full text-left">
                <thead class="bg-amber-100 text-amber-900">
                    <tr>
                        <th class="p-4">Tên sách</th>
                        <th class="p-4">Ngày mượn</th>
                        <th class="p-4">Hạn trả</th>
                        <th class="p-4">Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($borrows as $item)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-4 font-bold text-gray-700">{{ $item->title }}</td>
                        <td class="p-4">{{ $item->borrow_date }}</td>
                        <td class="p-4">{{ $item->due_date }}</td>
                        <td class="p-4">
                            {{-- PHẦN ĐÃ SỬA: Logic hiển thị trạng thái chuẩn --}}
                            @if($item->status == 'pending')
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-bold px-2 py-1 rounded border border-yellow-300">
                                    ⏳ Đang chờ duyệt
                                </span>
                            @elseif($item->status == 'borrowed' || $item->status == 'borrowing')
                                <span class="bg-blue-100 text-blue-800 text-xs font-bold px-2 py-1 rounded border border-blue-300">
                                    📖 Đang mượn
                                </span>
                            @elseif($item->status == 'returned')
                                <span class="bg-green-100 text-green-800 text-xs font-bold px-2 py-1 rounded border border-green-300">
                                    ✅ Đã trả
                                </span>
                            @elseif($item->status == 'late')
                                <span class="bg-red-100 text-red-800 text-xs font-bold px-2 py-1 rounded border border-red-300">
                                    ⚠️ Quá hạn
                                </span>
                            @else
                                <span class="text-gray-500 text-xs">{{ $item->status }}</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-6 text-center text-gray-500">
                            Bạn chưa mượn cuốn sách nào. <a href="/" class="text-amber-600 underline">Đi mượn ngay!</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>