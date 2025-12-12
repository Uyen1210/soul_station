<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use App\Models\Borrow;

class AdminController extends Controller
{
    public function dashboard()
    {
        $users = User::count();
        $books = Book::count();
        $borrowing = Borrow::where('status', 'approved')->count();
        $pending = Borrow::where('status', 'pending')->count();

        $recentRequests = Borrow::with(['user', 'book'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'users', 'books', 'borrowing', 'pending', 'recentRequests'
        ));
    }
}
