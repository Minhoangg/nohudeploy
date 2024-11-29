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
                        <form action="{{ route('system.game-create') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-header">
                                <div class="card-title">Thêm game</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="lobby_id">Lobby</label>
                                            <select name="lobby_id" class="form-control" id="lobby_id">
                                                <!-- Example loop for lobbies -->
                                                @foreach ($lobbies as $lobby)
                                                    <option value="{{ $lobby->id }}">{{ $lobby->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('lobby_id')
                                                <small class="form-text text-muted text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="title">Tiêu đề</label>
                                            <input type="text" name="title" class="form-control" id="title" placeholder="Nhập tên game" />
                                            @error('title')
                                                <small class="form-text text-muted text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="image">Hình ảnh</label>
                                            <input type="file" name="image" class="form-control" id="image" />
                                            @error('image')
                                                <small class="form-text text-muted text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-action">
                                <button type="submit" class="btn btn-success">Thêm Game</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
