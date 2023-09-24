@extends('master')

@section('content')
    @include('slider')

    <div class="page-wrapper">
        <div class="page-content">
            @include('home_live_streams')

            @include('home_twitch_streams')
        </div>
    </div>
@endsection
