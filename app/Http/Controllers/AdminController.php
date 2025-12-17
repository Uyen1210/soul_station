<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use App\Models\Borrow;

class AdminController extends Controller
{
    // 1. Dashboard (Thống kê)
    public function dashboard()
    {
        $users = User::count();
        $books = Book::count();
        $borrowing = Borrow::where('status', 'borrowed')->count();
        $pending = Borrow::where('status', 'pending')->count();
        $recentRequests = Borrow::with(['user', 'book'])->latest()->limit(5)->get();

        return view('admin.dashboard', compact('users', 'books', 'borrowing', 'pending', 'recentRequests'));
    }

    // 2. [QUAN TRỌNG] Hàm index này đang thiếu nên bị lỗi nè!
    public function index()
    {
        // Lấy danh sách phiếu mượn, sắp xếp mới nhất, phân trang 10 dòng
        $borrows = Borrow::with(['user', 'book'])->latest()->paginate(10);
        
        // Trả về view quản lý mượn trả
        return view('admin.borrows.index', compact('borrows'));
    }

    // 3. Xử lý Duyệt (Approve)
    public function approve($id)
    {
        $borrow = Borrow::find($id);
        if ($borrow && $borrow->status == 'pending') {
            $borrow->status = 'borrowed';
            $borrow->save();
            return redirect()->back()->with('success', 'Đã duyệt phiếu mượn!');
        }
        return redirect()->back()->with('error', 'Lỗi trạng thái hoặc không tìm thấy!');
    }

    // 4. Xử lý Hủy (Reject) - Trả lại số lượng sách vào kho
    public function reject($id)
    {
        $borrow = Borrow::find($id);
        if ($borrow && $borrow->status == 'pending') {
            $borrow->status = 'rejected';
            $borrow->save();

            // Cộng lại sách
            $book = Book::find($borrow->book_id);
            if($book) {
                $book->increment('quantity');
            }

            return redirect()->back()->with('success', 'Đã hủy yêu cầu và hoàn sách vào kho!');
        }
        return redirect()->back()->with('error', 'Lỗi thao tác!');
    }

    // 5. Xử lý Khách trả sách (Return) - Cộng lại số lượng sách
    public function returnBook($id)
    {
        $borrow = Borrow::find($id);
        if ($borrow && in_array($borrow->status, ['borrowed', 'late'])) {
            $borrow->status = 'returned';
            $borrow->real_return_date = now();
            $borrow->save();

            // Cộng lại sách
            $book = Book::find($borrow->book_id);
            if($book) {
                $book->increment('quantity');
            }

            return redirect()->back()->with('success', 'Xác nhận trả sách thành công!');
        }
        return redirect()->back()->with('error', 'Lỗi thao tác!');
    }
}