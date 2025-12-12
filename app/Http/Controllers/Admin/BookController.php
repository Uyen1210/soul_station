<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Dùng để xóa ảnh cũ

class BookController extends Controller
{
    /**
     * Hiển thị danh sách sách
     */
    public function index()
    {
        // Sử dụng Eager Loading (with) để lấy luôn thông tin Category và Author
        // giúp giảm số lượng truy vấn database (tránh lỗi N+1 query)
        $books = Book::with(['category', 'author'])
            ->latest() // Sắp xếp mới nhất trước
            ->paginate(10); // Phân trang 10 cuốn

        return view('admin.books.index', compact('books'));
    }

    /**
     * Hiển thị form thêm sách mới
     */
    public function create()
    {
        // Lấy danh sách danh mục và tác giả để hiển thị vào Select box
        $categories = Category::all();
        $authors = Author::all();

        return view('admin.books.create', compact('categories', 'authors'));
    }

    /**
     * Xử lý lưu sách mới vào Database
     */
    public function store(Request $request)
    {
        // 1. Validate dữ liệu
        $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:authors,id',
            'quantity' => 'required|integer|min:0',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Tối đa 2MB
            'description' => 'nullable',
        ], [
            'category_id.required' => 'Vui lòng chọn danh mục',
            'author_id.required' => 'Vui lòng chọn tác giả',
            'quantity.integer' => 'Số lượng phải là số',
        ]);

        // 2. Xử lý upload ảnh (nếu có)
        $imagePath = null;
        if ($request->hasFile('cover_image')) {
            // Lưu vào thư mục: storage/app/public/books
            $imagePath = $request->file('cover_image')->store('books', 'public');
        }

        // 3. Tạo sách mới
        Book::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'author_id' => $request->author_id,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'cover_image' => $imagePath,
        ]);

        return redirect()->route('admin.books.index')->with('success', 'Thêm sách thành công!');
    }

    /**
     * Hiển thị form sửa sách
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();
        $authors = Author::all();

        return view('admin.books.edit', compact('book', 'categories', 'authors'));
    }

    /**
     * Cập nhật thông tin sách
     */
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        // 1. Validate
        $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:authors,id',
            'quantity' => 'required|integer|min:0',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 2. Chuẩn bị dữ liệu update
        $data = [
            'title' => $request->title,
            'category_id' => $request->category_id,
            'author_id' => $request->author_id,
            'quantity' => $request->quantity,
            'description' => $request->description,
        ];

        // 3. Xử lý ảnh mới (nếu có upload ảnh mới)
        if ($request->hasFile('cover_image')) {
            // Xóa ảnh cũ nếu có
            if ($book->cover_image && Storage::disk('public')->exists($book->cover_image)) {
                Storage::disk('public')->delete($book->cover_image);
            }
            // Lưu ảnh mới
            $data['cover_image'] = $request->file('cover_image')->store('books', 'public');
        }

        // 4. Update
        $book->update($data);

        return redirect()->route('admin.books.index')->with('success', 'Cập nhật sách thành công!');
    }

    /**
     * Xóa sách
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        // Xóa ảnh bìa trong folder storage nếu có
        if ($book->cover_image && Storage::disk('public')->exists($book->cover_image)) {
            Storage::disk('public')->delete($book->cover_image);
        }

        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'Đã xóa sách khỏi kho!');
    }
}