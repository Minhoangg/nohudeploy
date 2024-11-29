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
                    <form action="{{ route('system.user-update', $user->id) }}" method="POST">
                        @csrf
                        <div class="card-header">
                            <div class="card-title">Chỉnh sửa người dùng</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="name">Tên người dùng</label>
                                        <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $user->name) }}" placeholder="Nhập tên người dùng" />
                                        @error('name')
                                        <small class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="phone">Số điện thoại</label>
                                        <input type="text" name="phone" class="form-control" id="phone" value="{{ old('phone', $user->phone_number) }}" placeholder="Nhập số điện thoại" />
                                        @error('phone')
                                        <small class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="telegram">Liên hệ telegram</label>
                                        <input type="text" name="telegram" class="form-control" value="{{ old('telegram', $user->telegram) }}" id="telegram" placeholder="Nhập tên telegram" />
                                        @error('telegram')
                                        <small class="form-text text-muted text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <button type="submit" class="btn btn-success">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection