@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Yêu cầu mượn sách</h2>

        <div class="card p-4 mt-3">
            <h4>{{ $book->title }}</h4>
            <p>Tác giả: {{ $book->author->name }}</p>
            <p>Thể loại: {{ $book->category->name }}</p>

            <form action="{{ route('borrow.store') }}" method="POST">
                @csrf

                <input type="hidden" name="book_id" value="{{ $book->id }}">

                <div class="mt-3">
                    <label>Ngày mượn:</label>
                    <input type="date" name="borrow_date" class="form-control" required>
                </div>

                <div class="mt-3">
                    <label>Ngày trả dự kiến:</label>
                    <input type="date" name="due_date" class="form-control" required>
                </div>

                <button class="btn btn-primary mt-3">Gửi yêu cầu</button>
            </form>
        </div>
    </div>
@endsection