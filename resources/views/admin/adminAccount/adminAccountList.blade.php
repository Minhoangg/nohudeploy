@extends('layouts.admin.master')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Quản lý admin</h3>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" style="display: flex; justify-content: space-between">
                            <h4 class="card-title">Danh sách admin</h4>
                            <a href="{{ route('system.adminAccount-create') }}" class="btn btn-success">Thêm admin</a>
                        </div>
                        <div class="card-body">
                            <!-- Search Form -->
                            <form action="{{ route('system.adminAccount-getall') }}" method="GET" class="mb-3">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Tìm kiếm theo tên, số điện thoại, hoặc Telegram" value="{{ request()->search }}">
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
                                            <th>Số điện thoại</th>
                                            <th>Telegram</th>
                                            <th>Xu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->phone_number }}</td>
                                                <td>{{ $user->telegram }}</td>
                                                <td>{{ $user->coin }}</td>
                                                <td class="d-flex justify-content-between">
                                                    <form action="{{ route('system.adminAccount-add-coin', $user->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="number" name="coin" class="form-control"
                                                            placeholder="Nhập xu" min="1" required
                                                            style="width: 100px; display: inline-block;" />
                                                        <button type="submit" class="btn btn-warning"
                                                            style="display: inline-block;">Thêm Xu</button>
                                                    </form>
                                                    <a href="{{ route('system.adminAccount-edit', $user->id) }}"
                                                        class="btn btn-primary">Sửa</a>
                                                    <a href="{{ route('system.adminAccount-delete', $user->id) }}"
                                                        class="btn btn-danger"
                                                        onclick="event.preventDefault(); 
                                                        if (confirm('Bạn có chắc chắn muốn xóa người dùng này?')) {
                                                            document.getElementById('delete-form-{{ $user->id }}').submit();
                                                        }">
                                                        Xóa
                                                    </a>

                                                    <!-- Form ẩn để gửi yêu cầu DELETE -->
                                                    <form id="delete-form-{{ $user->id }}"
                                                        action="{{ route('system.user-delete', $user->id) }}"
                                                        method="POST" style="display: none;">
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
