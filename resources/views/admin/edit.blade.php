@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Sửa danh mục</h2>

    <form action="{{ route('categories.update', $category) }}" method="POST">
        @csrf @method('PUT')

        <label>Tên danh mục:</label>
        <input type="text" name="name" value="{{ $category->name }}" class="form-control">

        <button class="btn btn-primary mt-3">Cập nhật</button>
    </form>
</div>
@endsection
