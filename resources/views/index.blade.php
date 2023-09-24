@extends('master')
@section('css')
<style>
.watch-btn {
    position: absolute;
    top: 20px;
    right: 20px;
    color:#fff;
}
.watch-btn:hover{
    background: cadetblue;
    color:#fff;
}
</style>
@endsection

@section('content')

    <div class="d-flex justify-content-between">
        <div>
            <h1 class="text-danger">Live Streams</h1>
        </div>
        <div>
            <a href="{{ route('stream.form.index') }}" class="btn btn-success mt-2">Start Stream</a>
        </div>
    </div>
    <div class="row mt-5">
        @foreach($livestreams as $livestream)
            <div class="col">
                <div class="card" style="width: 350px; margin-bottom:25px;">
                    <a href="{{ route('stream.live', [$livestream->id]) }}">
                        <div class="btn btn-primary  watch-btn"> Watch</div>
                        <img class="card-img-top" src="images/{{ $livestream->image }}" alt="{{ $livestream->name }}"
                         width="350" height="200">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">{{ $livestream->name }}</h5>

                        {{-- <a href="{{ route('stream.live', [$livestream->stream_id]) }}" class="btn btn-primary">
                            Watch
                        </a> --}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <h1 class="text-danger">Twitch Streams</h1>
    <div class="row mt-5">
        @if(array_key_exists('data', $data))
            @foreach($data['data'] as $elem)
                <div class="col">
                    <a href="/streams/{{$elem['user_id']}}">{{$elem['title']}}</a>
                    <a href="/streams/{{$elem['user_id']}}">
                        <img src="{{Str::replace('{width}x{height}', '350x200', $elem['thumbnail_url'])}}" class="mb-5">
                    </a>
                </div>
            @endforeach
        @endif
    </div>

@endsection
