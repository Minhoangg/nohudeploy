@extends('layouts.admin.master')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Quản lý game</h3>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" style="display: flex; justify-content: space-between">
                            <h4 class="card-title">Danh sách game</h4>
                            <a href="{{ route('system.game-create') }}" class="btn btn-success">Thêm game</a>
                        </div>
                        <div class="card-body">
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
                                            <th>Tên Game</th>
                                            <th>Lobby</th>
                                            <th>Ảnh</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($games as $game)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $game->title }}</td>
                                                <td>{{ $game->lobby->name }}</td> <!-- Assuming 'lobby' has a name field -->
                                                <td><img src="{{ asset('storage/' . $game->image) }}" width="50" height="50" alt="{{ $game->title }}"></td>
                                                <td class="d-flex justify-content-between">
                                                    <a href="{{ route('system.game-edit', $game->id) }}" class="btn btn-primary">Sửa</a>
                                                    <a href="{{ route('system.game-delete', $game->id) }}" class="btn btn-danger"
                                                       onclick="event.preventDefault(); 
                                                       if (confirm('Bạn có chắc chắn muốn xóa game này?')) {
                                                           document.getElementById('delete-form-{{ $game->id }}').submit();
                                                       }">
                                                       Xóa
                                                    </a>

                                                    <!-- Form ẩn để gửi yêu cầu DELETE -->
                                                    <form id="delete-form-{{ $game->id }}" 
                                                          action="{{ route('system.game-delete', $game->id) }}" 
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
