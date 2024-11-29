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
                        <form action="{{ route('system.adminAccount-add') }}" method="POST">
                            @csrf
                            <div class="card-header">
                                <div class="card-title">Thêm admin</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="name">Tên người dùng</label>
                                            <input type="text" name="name" class="form-control" id="name" placeholder="Nhập tên người dùng" />
                                            @error('name')
                                                <small class="form-text text-muted text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="phone">Số điện thoại</label>
                                            <input type="text" name="phone" class="form-control" id="phone" placeholder="Nhập số điện thoại" />
                                            @error('phone')
                                                <small class="form-text text-muted text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" class="form-control" id="password" placeholder="Nhập mật khẩu" />
                                            @error('password')
                                                <small class="form-text text-muted text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="coin">Xu</label>
                                            <input type="number" name="coin" class="form-control" id="coin" placeholder="Nhập số lượng xu" />
                                            @error('coin')
                                                <small class="form-text text-muted text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="telegram">Telegram</label>
                                            <input type="number" name="telegram" class="form-control" id="telegram" placeholder="Nhập telegram" />
                                            @error('telegram')
                                                <small class="form-text text-muted text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-action">
                                <button type="submit" class="btn btn-success">Thêm</button>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
