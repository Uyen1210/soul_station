<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use App\Models\Borrow;
use Carbon\Carbon; // <--- MỚI: Thêm cái này để xử lý ngày tháng

class AdminController extends Controller
{
    // 1. Dashboard (Thống kê nâng cao)
    public function dashboard()
    {
        // Đếm tổng sách
        $books = Book::count();

        // Đếm User (Chỉ đếm khách, không đếm Admin)
        $users = User::where('role', 'user')->count();

        // Đếm sách đang mượn
        $borrowing = Borrow::where('status', 'borrowed')->count();

        // Đếm sách quá hạn (Đang mượn nhưng quá ngày hẹn HOẶC đã bị đánh dấu late)
        $late = Borrow::where('status', 'borrowed')
                      ->where('due_date', '<', Carbon::now())
                      ->count();
        $late += Borrow::where('status', 'late')->count();

        // Lấy 5 đơn mới nhất
        $recentRequests = Borrow::with(['user', 'book'])->latest()->limit(5)->get();

        return view('admin.dashboard', compact('users', 'books', 'borrowing', 'late', 'recentRequests'));
    }

    // 2. Danh sách mượn trả
    public function index()
    {
        $borrows = Borrow::with(['user', 'book'])->latest()->paginate(10);
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

    // 4. Xử lý Hủy (Reject)
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
            return redirect()->back()->with('success', 'Đã hủy yêu cầu!');
        }
        return redirect()->back()->with('error', 'Lỗi thao tác!');
    }

    // 5. Xử lý Trả sách (Return)
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
            return redirect()->back()->with('success', 'Đã trả sách!');
        }
        return redirect()->back()->with('error', 'Lỗi thao tác!');
    }
}