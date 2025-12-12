<?php
// app/Http/Controllers/BorrowAdminController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Borrow;
use Illuminate\Http\Request;

class BorrowAdminController extends Controller
{
    public function index()
    {
        $borrows = Borrow::with(['user', 'book'])->latest()->paginate(10); // Hoặc số lượng bạn muốn, ví dụ 15 hoặc 20
        return view('admin.borrows.index', compact('borrows'));
    }

    public function approve(Borrow $borrow)
    {
        $borrow->update(['status' => 'approved']);
        return back()->with('success', 'Đã phê duyệt yêu cầu mượn!');
    }

    public function reject(Borrow $borrow)
    {
        $borrow->update(['status' => 'rejected']);
        return back()->with('error', 'Đã từ chối yêu cầu mượn!');
    }

    public function returnBook($id)
    {
        $borrow = Borrow::findOrFail($id);

        // Tính toán trễ hạn
        $status = 'returned';
        if (now() > $borrow->due_date) {
            $status = 'late'; // Quá hạn
        }

        $borrow->update([
            'status' => $status,
            'real_return_date' => now(),
        ]);

        $borrow->book->increment('quantity'); // Cộng lại kho 1 cuốn

        return back()->with('success', 'Đã trả sách thành công!');
    }
}
