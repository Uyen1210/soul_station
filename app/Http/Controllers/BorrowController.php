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
            'borrow_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:borrow_date',
        ]);

        Borrow::create([
            'user_id' => auth()->id(),
            'book_id' => $request->book_id,
            'borrow_date' => $request->borrow_date,
            'due_date' => $request->due_date,
            'status' => 'pending'
        ]);

        return redirect()->back()->with('success', 'Yêu cầu mượn đã được gửi thành công!');
    }
}
