@extends('layouts.client.master-layout')

@section('content')
    <div class="game_wrap container-fluid p-0">

        <div class="container game_box">
            <div class="box_game">
                <div class="back d-flex justify-content-between">
                    <i onclick="goBack()" class="fa-solid fa-backward"></i>
                    <div class="name_game">
                        <h4>{{ $lobby->name }}</h4>
                    </div>
                    <div>

                    </div>
                </div>
                <div class="row">
                    @foreach ($games as $game)
                        <div class="col-12 col-sm-6 col-md-4 lobby_item_parent">
                            <div class="lobby_item">
                                <a href="{{ route('client.get-score', $game->id) }}">
                                    <img src="{{ asset('storage/' . $game->image) }}" height="auto" alt="">
                                    <div class="item_name">{{ $game->title }}</div>
                                    <div class="animation_item">
                                        <img class="vortex"
                                            src="{{ asset('assets/img/z6075556668271_ffab7f49e36a81622c894714de7123f1-removebg-preview.png') }}"
                                            alt="" />
                                        <span>{{ $game->percent }}</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div>

                </div>
            </div>
        </div>
    </div>
@endsection
