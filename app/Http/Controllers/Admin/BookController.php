<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index()
    {
        // Lấy danh sách sách (tạm thời chưa join với tác giả/thể loại để tránh lỗi nếu thiếu model)
        $books = DB::table('books')->paginate(10);
        return view('admin.books.index', compact('books'));
    }
    
    // Các hàm Create, Store, Edit... Uyên sẽ viết sau
    public function create() { return view('admin.books.create'); }
    public function edit($id) { return view('admin.books.edit'); }
}