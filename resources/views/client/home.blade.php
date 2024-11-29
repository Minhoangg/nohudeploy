@extends('layouts.client.master-layout')

@section('content')
    <div class="home_wrap container-fluid p-0">
        <div class="container home_box">
            <div class="box_lobby">
                <div class="row">
                    @foreach ($lobbys as $lobby)
                    <div class="col-12 col-sm-6 col-md-4 lobby_item_parent">
                        <div class="lobby_item">
                            <a href="{{ route('client.list-game', $lobby->id) }}">
                                <img src="{{ asset('storage/' . $lobby->image) }}" height="auto" alt="{{ $lobby->title }}">
                                <div class="item_name">{{$lobby->name}}</div>
                                <div class="animation_item"
                                    style=" background-image: url('{{ asset('assets/img/loadrmbg.png') }}')">
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
