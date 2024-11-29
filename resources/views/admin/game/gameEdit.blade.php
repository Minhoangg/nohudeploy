@extends('layouts.admin.master')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Cập nhật game</h3>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{ route('system.game-update', $game->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-header">
                                <div class="card-title">Cập nhật game</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="lobby_id">Lobby</label>
                                            <select name="lobby_id" class="form-control" id="lobby_id">
                                                @foreach ($lobbies as $lobby)
                                                    <option value="{{ $lobby->id }}" {{ $lobby->id == $game->lobby_id ? 'selected' : '' }}>
                                                        {{ $lobby->name }}
                                                    </option>
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
                                            <input type="text" name="title" class="form-control" id="title" value="{{ old('title', $game->title) }}" placeholder="Nhập tên game" />
                                            @error('title')
                                                <small class="form-text text-muted text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="image">Hình ảnh</label>
                                            <input type="file" name="image" class="form-control" id="image" />
                                            @if ($game->image)
                                                <img src="{{ asset('storage/' . $game->image) }}" alt="Game Image" width="100" />
                                            @endif
                                            @error('image')
                                                <small class="form-text text-muted text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-action">
                                <button type="submit" class="btn btn-success">Cập nhật Game</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
