<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowController extends Controller
{
    public function create(Book $book)
    {
        return view('user.borrow_request', compact('book'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'borrow_date' => 'nullable|date',
            'due_date' => 'nullable|date|after_or_equal:borrow_date',
        ]);

        $book = Book::findOrFail($request->book_id);

        if ($book->quantity < 1) {
            return back()->with('error', 'Sách này hiện đã hết hàng, vui lòng quay lại sau!');
        }

        $exists = Borrow::where('user_id', auth()->id())
            ->where('book_id', $book->id)
            ->whereIn('status', ['pending', 'borrowed'])
            ->exists();

        if ($exists) {
            return back()->with('error', 'Bạn đang mượn hoặc đã gửi yêu cầu mượn cuốn sách này rồi!');
        }

        Borrow::create([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
            'status' => 'pending',

            'borrow_date' => $request->borrow_date ?? now(),

            'due_date' => $request->due_date ?? now()->addDays(14),
        ]);

        return redirect()->route('borrows.index')->with('success', 'Yêu cầu mượn sách đã được gửi thành công!');
    }

    public function index()
    {
        $borrows = Borrow::where('user_id', auth()->id())
            ->with('book')
            ->latest()
            ->get();

        return view('user.borrows_history', compact('borrows'));
    }
}