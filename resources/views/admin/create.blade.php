@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>+ Thêm danh mục</h2>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        <label>Tên danh mục:</label>
        <input type="text" name="name" class="form-control" required>

        <button class="btn btn-primary mt-3">Lưu</button>
    </form>
</div>
@endsection
