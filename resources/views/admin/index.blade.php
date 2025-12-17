@extends('layouts.admin')

@section('content')
<div class="container">

    <h2>📄 Danh sách yêu cầu mượn sách</h2>

    @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger mt-3">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>User</th>
                <th>Sách</th>
                <th>Ngày mượn</th>
                <th>Ngày trả</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>

        <tbody>
            @foreach($borrows as $b)
            <tr>
                <td>{{ $b->user->name }}</td>
                <td>{{ $b->book->title }}</td>
                <td>{{ $b->borrow_date }}</td>
                <td>{{ $b->return_date }}</td>
                <td>
                    @if($b->status == 'pending')
                        <span class="badge bg-warning">Chờ duyệt</span>
                    @elseif($b->status == 'approved')
                        <span class="badge bg-success">Đã duyệt</span>
                    @else
                        <span class="badge bg-danger">Từ chối</span>
                    @endif
                </td>

                <td>
                    @if($b->status == 'pending')
                        <form action="{{ route('admin.borrows.approve', $b) }}" method="POST" style="display: inline;">
                            @csrf
                            <button class="btn btn-success btn-sm">Duyệt</button>
                        </form>

                        <form action="{{ route('admin.borrows.reject', $b) }}" method="POST" style="display: inline;">
                            @csrf
                            <button class="btn btn-danger btn-sm">Từ chối</button>
                        </form>
                    @else
                        <em>Không có hành động</em>
                    @endif
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
