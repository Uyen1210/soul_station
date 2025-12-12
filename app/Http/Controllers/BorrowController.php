<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowController extends Controller
{
    // Hàm hiển thị form xác nhận mượn (nếu cần)
    public function create(Book $book)
    {
        return view('user.borrow_request', compact('book'));
    }

    // --- HÀM XỬ LÝ MƯỢN SÁCH (ĐÃ GỘP VÀ TỐI ƯU) ---
    public function store(Request $request)
    {
        // 1. Validate dữ liệu đầu vào (Kết hợp từ code cũ của bạn)
        $request->validate([
            'book_id' => 'required|exists:books,id', // Bắt buộc phải có ID sách và sách phải tồn tại
            'borrow_date' => 'nullable|date',        // Cho phép để trống (sẽ lấy ngày hiện tại)
            'due_date' => 'nullable|date|after_or_equal:borrow_date', // Hạn trả phải sau ngày mượn
        ]);

        // 2. Tìm sách
        $book = Book::findOrFail($request->book_id);

        // 3. Kiểm tra số lượng tồn kho
        if ($book->quantity < 1) {
            return back()->with('error', 'Sách này hiện đã hết hàng, vui lòng quay lại sau!');
        }

        // 4. Kiểm tra xem user này có đang mượn cuốn này chưa (Chặn spam)
        $exists = Borrow::where('user_id', auth()->id())
            ->where('book_id', $book->id)
            ->whereIn('status', ['pending', 'borrowed']) // Đang chờ duyệt hoặc đang mượn
            ->exists();

        if ($exists) {
            return back()->with('error', 'Bạn đang mượn hoặc đã gửi yêu cầu mượn cuốn sách này rồi!');
        }

        // 5. Tạo yêu cầu mượn vào Database
        Borrow::create([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
            'status' => 'pending', // Mặc định là Chờ duyệt

            // Logic thông minh: Nếu user chọn ngày thì lấy, không thì lấy ngày hiện tại (now)
            'borrow_date' => $request->borrow_date ?? now(),

            // Logic thông minh: Nếu user chọn hạn trả thì lấy, không thì tự cộng thêm 14 ngày
            'due_date' => $request->due_date ?? now()->addDays(14),
        ]);

        // 6. Chuyển hướng về trang lịch sử
        return redirect()->route('borrows.index')->with('success', 'Yêu cầu mượn sách đã được gửi thành công!');
    }

    // Hàm xem lịch sử mượn
    public function index()
    {
        // Lấy danh sách phiếu mượn của user hiện tại, sắp xếp mới nhất
        $borrows = Borrow::where('user_id', auth()->id())
            ->with('book') // Load kèm thông tin sách để hiển thị tên sách
            ->latest()
            ->get();

        return view('user.borrows_history', compact('borrows'));
    }
}