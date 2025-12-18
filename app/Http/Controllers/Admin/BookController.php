<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Hiển thị danh sách sách
     */
    public function index()
    {
        $books = Book::with(['category', 'author'])
            ->latest()
            ->paginate(10);

        return view('admin.books.index', compact('books'));
    }

    /**
     * Hiển thị form thêm sách mới
     */
    public function create()
    {
        $categories = Category::all();
        $authors = Author::all();

        return view('admin.books.create', compact('categories', 'authors'));
    }

    /**
     * Xử lý lưu sách mới vào Database
     */
    public function store(Request $request)
    {
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

        $imagePath = null;
        if ($request->hasFile('cover_image')) {
            $imagePath = $request->file('cover_image')->store('books', 'public');
        }

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

        $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:authors,id',
            'quantity' => 'required|integer|min:0',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'title' => $request->title,
            'category_id' => $request->category_id,
            'author_id' => $request->author_id,
            'quantity' => $request->quantity,
            'description' => $request->description,
        ];

        if ($request->hasFile('cover_image')) {
            if ($book->cover_image && Storage::disk('public')->exists($book->cover_image)) {
                Storage::disk('public')->delete($book->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('books', 'public');
        }

        $book->update($data);

        return redirect()->route('admin.books.index')->with('success', 'Cập nhật sách thành công!');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        if ($book->cover_image && Storage::disk('public')->exists($book->cover_image)) {
            Storage::disk('public')->delete($book->cover_image);
        }

        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'Đã xóa sách khỏi kho!');
    }
}