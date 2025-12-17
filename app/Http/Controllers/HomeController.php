<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // 1. Trang chủ + Tìm kiếm Nâng cao
    public function index(Request $request)
    {
        // Khởi tạo truy vấn
        // with(['author', 'category']): Kỹ thuật Eager Loading giúp lấy luôn tên Tác giả/Thể loại đi kèm (giúp web chạy nhanh hơn)
        $query = Book::with(['author', 'category']);

        // Nếu người dùng có nhập từ khóa tìm kiếm
        if ($request->filled('search')) {
            $keyword = $request->search;

            $query->where(function ($q) use ($keyword) {
                // 1. Tìm trong cột Tên sách
                $q->where('title', 'LIKE', "%{$keyword}%")

                    // 2. HOẶC tìm trong bảng Authors (dựa vào hàm author() bạn vừa khai báo)
                    ->orWhereHas('author', function ($qAuthor) use ($keyword) {
                        $qAuthor->where('name', 'LIKE', "%{$keyword}%");
                    })

                    // 3. HOẶC tìm trong bảng Categories (dựa vào hàm category() bạn vừa khai báo)
                    ->orWhereHas('category', function ($qCat) use ($keyword) {
                        $qCat->where('name', 'LIKE', "%{$keyword}%");
                    });
            });
        }

        // Lấy danh sách mới nhất + Phân trang 8 cuốn
        $books = $query->latest()->paginate(8);

        // Giữ lại từ khóa trên thanh URL khi bấm chuyển trang
        $books->appends(['search' => $request->search]);

        return view('welcome', compact('books'));
    }

    // 2. Chi tiết sách
    public function detail($id)
    {
        $book = Book::with(['author', 'category'])->findOrFail($id);
        return view('detail', compact('book'));
    }

    // 3. Xử lý Mượn sách
    public function borrow($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $book = Book::find($id);
        if ($book->quantity > 0) {
            $book->decrement('quantity');

            DB::table('borrows')->insert([
                'user_id' => Auth::id(),
                'book_id' => $id,
                'borrow_date' => now(),
                'due_date' => now()->addDays(7),
                'status' => 'pending', // Hoặc 'borrowed' tùy database bạn sửa lúc nãy
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->route('history')->with('success', 'Đã gửi yêu cầu mượn thành công! Vui lòng chờ Admin duyệt.');
        } else {
            return back()->with('error', 'Sách này đã hết!');
        }
    }

    // 4. Lịch sử mượn
    public function history()
    {
        $borrows = DB::table('borrows')
            ->join('books', 'borrows.book_id', '=', 'books.id')
            ->where('user_id', Auth::id())
            ->select('books.title', 'borrows.*')
            ->orderByDesc('borrows.created_at')
            ->get();

        return view('history', compact('borrows'));
    }

    public function profile()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        return view('profile', compact('user'));
    }

    // 6. Xử lý cập nhật thông tin người dùng
    public function updateProfile(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20', // Giả sử trường sdt là 'phone'
            'address' => 'nullable|string|max:255', // Giả sử trường địa chỉ là 'address'
            // Email không cho chỉnh sửa, hoặc nếu cho thì thêm validation unique
            // 'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($request->only(['name', 'phone', 'address'])); // Cập nhật các trường cho phép

        return redirect()->route('profile')->with('success', 'Thông tin đã được cập nhật thành công!');
    }
}
