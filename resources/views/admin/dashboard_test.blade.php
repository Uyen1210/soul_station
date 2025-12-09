@extends('layouts.admin')

@section('content')
    <div class="container">

        <h2>📊 Dashboard Admin</h2>

        <div class="row mt-4">

            <div class="col-md-3">
                <div class="card p-3 text-center">
                    <h4>{{ $users }}</h4>
                    <p>Người dùng</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card p-3 text-center">
                    <h4>{{ $books }}</h4>
                    <p>Sách</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card p-3 text-center">
                    <h4>{{ $borrowing }}</h4>
                    <p>Sách đang mượn</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card p-3 text-center">
                    <h4>{{ $pending }}</h4>
                    <p>Yêu cầu chờ duyệt</p>
                </div>
            </div>

        </div>

        <h3 class="mt-5">📄 Yêu cầu mượn mới nhất</h3>

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Sách</th>
                    <th>Ngày mượn</th>
                    <th>Ngày trả</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentRequests as $r)
                    <tr>
                        <td>{{ $r->user->name }}</td>
                        <td>{{ $r->book->title }}</td>
                        <td>{{ $r->borrow_date }}</td>
                        <td>{{ $r->return_date }}</td>
                        <td>{{ $r->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection