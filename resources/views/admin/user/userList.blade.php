@extends('layouts.admin.master')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Quản lý người dùng</h3>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" style="display: flex; justify-content: space-between">
                            <h4 class="card-title">Danh sách người dùng</h4>
                            <a href="{{ route('system.user-create') }}" class="btn btn-success">Thêm Người Dùng</a>
                        </div>
                        <div class="card-body">
                            <!-- Search Form -->
                            <form action="{{ route('system.user-getall') }}" method="GET" class="mb-3">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Tìm kiếm theo tên hoặc số điện thoại" value="{{ request()->search }}">
                                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                                </div>
                            </form>

                            <!-- Hiển thị thông báo thành công nếu có -->
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Username</th>
                                            @if(auth()->user()->role == 1) <!-- Kiểm tra role của người dùng hiện tại -->
                                                <th>Số điện thoại</th>
                                            @endif
                                            <th>coin</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $user->name }}</td>

                                                <!-- Hiển thị Số điện thoại nếu role của người dùng là 1 -->
                                                @if(auth()->user()->role == 1)
                                                    <td>{{ $user->phone_number }}</td>
                                                @endif

                                                <td>{{ $user->coin }}</td>
                                                <td class="d-flex justify-content-between">
                                                    <form action="{{ route('system.user-add-coin', $user->id) }}" method="POST">
                                                        @csrf
                                                        <input type="number" name="coin" class="form-control" placeholder="Nhập coin" min="1" required style="width: 100px; display: inline-block;" />
                                                        <button type="submit" class="btn btn-warning" style="display: inline-block;">Thêm Coin</button>
                                                    </form>
                                                    <a href="{{ route('system.user-delete', $user->id) }}" class="btn btn-danger"
                                                        onclick="event.preventDefault(); 
                                                        if (confirm('Bạn có chắc chắn muốn xóa người dùng này?')) {
                                                            document.getElementById('delete-form-{{ $user->id }}').submit();
                                                        }">
                                                        Xóa
                                                    </a>

                                                    <!-- Form ẩn để gửi yêu cầu DELETE -->
                                                    <form id="delete-form-{{ $user->id }}" action="{{ route('system.user-delete', $user->id) }}" method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
