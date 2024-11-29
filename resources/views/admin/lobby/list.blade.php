@extends('layouts.admin.master')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Quản lý sảnh game</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between">
                        <h4 class="card-title">Danh sách sảnh game</h4>
                        <a href="{{ route('system.lobby-create') }}" class="btn btn-success">Thêm Sảnh game</a>
                    </div>
                    <div class="card-body">
                        <!-- Hiển thị thông báo thành công nếu có -->
                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif

                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên sảnh</th>
                                        <th>Hình ảnh</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lobbies as $lobby)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $lobby->name }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $lobby->image) }}" width="50" height="50" alt="{{ $lobby->title }}">
                                        </td>
                                        <td class="d-flex justify-content-center gap-2">
                                            <a class="btn btn-warning" href="{{route('system.lobby-edit', $lobby->id)}}">Sửa</a>
                                            <a href=""
                                                class="btn btn-danger"
                                                onclick="event.preventDefault(); 
                                                        if (confirm('Bạn có chắc chắn muốn xóa người dùng này?')) {
                                                            document.getElementById('delete-form-{{$lobby->id}}').submit();
                                                        }">
                                                Xóa
                                            </a>

                                            <!-- Form ẩn để gửi yêu cầu DELETE -->
                                            <form
                                                id="delete-form-{{$lobby->id}}"
                                                action="{{ route('system.lobby-delete', $lobby->id) }}"
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