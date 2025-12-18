<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use App\Models\Borrow;
use Carbon\Carbon;

class AdminController extends Controller
{

    public function dashboard()
    {
        $books = Book::count();

        $users = User::where('role', 'user')->count();

        $borrowing = Borrow::where('status', 'borrowed')->count();

        $late = Borrow::where('status', 'borrowed')
            ->where('due_date', '<', Carbon::now())
            ->count();
        $late += Borrow::where('status', 'late')->count();

        $recentRequests = Borrow::with(['user', 'book'])->latest()->limit(5)->get();
        return view('admin.dashboard', compact('users', 'books', 'borrowing', 'late', 'recentRequests'));
    }

    public function index()
    {
        $borrows = Borrow::with(['user', 'book'])->latest()->paginate(10);
        return view('admin.borrows.index', compact('borrows'));
    }

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

    public function reject($id)
    {
        $borrow = Borrow::find($id);
        if ($borrow && $borrow->status == 'pending') {
            $borrow->status = 'rejected';
            $borrow->save();

            $book = Book::find($borrow->book_id);
            if ($book) {
                $book->increment('quantity');
            }
            return redirect()->back()->with('success', 'Đã hủy yêu cầu!');
        }
        return redirect()->back()->with('error', 'Lỗi thao tác!');
    }

    public function returnBook($id)
    {
        $borrow = Borrow::find($id);
        if ($borrow && in_array($borrow->status, ['borrowed', 'late'])) {
            $borrow->status = 'returned';
            $borrow->real_return_date = now();
            $borrow->save();

            $book = Book::find($borrow->book_id);
            if ($book) {
                $book->increment('quantity');
            }
            return redirect()->back()->with('success', 'Đã trả sách!');
        }
        return redirect()->back()->with('error', 'Lỗi thao tác!');
    }
}