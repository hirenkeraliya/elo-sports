@extends('master')

@section('content')
<div class="page-wrapper">
    <div class="page-content">

        <section class="pt-md-5 pt-sm-3 ">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8">
                        @if (isset($livestream) && $livestream->status != 'stopped')
                            <h1 class="white-text">Update Stream Status</h1>

                            <p class="text-light">
                                Stream Server:
                                <b>rtmp:{{ env('RMPT_SERVER')}}/show</b>
                            </p>

                            <p class="text-light">
                                Stream Url:
                                <b>
                                    <a href="{{ route('stream.live', [$livestream->id]) }}" target="_blank">
                                        {{ route('stream.live', [$livestream->id]) }}
                                    </a>
                                </b>
                            </p>

                            <form action="{{ route('stream.form.stop.submit') }}" method="post">
                                @csrf
                                <input type="hidden" name="stream_id" class="form-control" required value="{{ $livestream->id }}">
                                <button type="submit" class="btn btn-danger">Stop Stream</button>
                            </form>
                        @else
                            <h1 class="white-text">Start New Stream</h1>
                            <form action="{{ route('stream.form.submit') }}" method="post" enctype="multipart/form-data" style="background-color:#0e2375;padding: 82px 36px;">
                                @csrf

                                <div class="form-group mb-4">
                                    <label for="name" class="text-white">Stream Name: </label>
                                    @if($errors->has('name'))
                                        <div class="text-danger">{{ $errors->first('name') }}</div>
                                    @endif
                                    <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                                </div>

                                <div class="form-group mb-4">
                                    <label for="image" class="text-white">Stream Description</label>
                                    @if($errors->has('description'))
                                        <div class="text-danger">{{ $errors->first('description') }}</div>
                                    @endif
                                    <textarea name="description" class="form-control" rows="4" cols="50">{{ old('description') }}</textarea>
                                </div>

                                <div class="form-group mb-2">
                                    <label for="image" class="text-white">Stream Thumbnail: (1280px,720px), 5mb)</label>
                                    @if($errors->has('image'))
                                        <div class="text-danger">{{ $errors->first('image') }}</div>
                                    @endif
                                    <br>
                                    <input type="file" name="image" class="form-control-file" required>
                                </div>

                                <button type="submit" class="btn btn-danger mt-4">Start Stream</button>
                            </form>
                        @endif
                    </div>

                    <div class="col-sm-4">
                        <h1 class="white-text">Instructions</h1>

                        <p class="text-light">
                            Please follow below instructions before you start the streaming.
                            <br>
                            <br>
                            1. Install OBS on your system based on your operating system and configurartion. <br>
                            Download OBS from below URL, <br>
                            https://obsproject.com/ <br>
                            <br>
                            2. Start streaming on https://elo-esports.com <br>
                            <br>
                            3. Copy Stream server from Elo-esports and paste it in OBS -> Settings -> Stream -> Custom in Server<br>
                            box.<br>
                            Also Copy Stream Key and paste it in OBS -> Settings -> Stream -> Custom in Stream Key<br>
                            box.<br>
                            <br>
                            4. Sources -> Click + Sign -> Select your source from the given dropdown.<br>
                            <br>
                            5. Start Streaming in OBS.<br>
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
