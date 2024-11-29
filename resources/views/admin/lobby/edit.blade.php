@extends('layouts.admin.master')

@section('content')
<div style="padding: 100px">
    <h1>Thêm sảnh game</h1>
    <form action="{{ route('system.lobby-update', $lobby->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Tên sảnh:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $lobby->name }}" required>

            <!-- Hiển thị lỗi cho trường 'name' với chữ đỏ -->
            @error('name')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="image">Ảnh:</label>
            <input type="file" class="form-control" id="image" name="image" required>
            <img src="{{ asset('storage/' . $lobby->image) }}" width="300px" alt="{{ $lobby->title }}">

            <!-- Hiển thị lỗi cho trường 'image' với chữ đỏ -->
            @error('image')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
</div>
@endsection