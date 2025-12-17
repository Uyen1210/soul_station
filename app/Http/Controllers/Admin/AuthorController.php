<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::latest()->paginate(10);
        return view('admin.authors.index', compact('authors'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255|unique:authors']);
        Author::create(['name' => $request->name]);
        return redirect()->route('admin.authors.index')->with('success', 'Đã thêm tác giả!');
    }

    public function destroy(Author $author)
    {
        $author->delete();
        return redirect()->route('admin.authors.index')->with('success', 'Đã xóa tác giả!');
    }
}