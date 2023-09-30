<section class="py-4">
    <div class="container" style="box-shadow: -90px 5px 35px -48px #01102b;">
        <div class="d-flex align-items-center">
            <h5 class=" mb-0">Twitch Streams</h5>
        </div>

        <hr />

        <div class="row row-cols-1 row-cols-lg-3 row-cols-xl-4">
            @if (array_key_exists('data', $data))
                @foreach ($data['data'] as $elem)
                    <div class="col">
                        <a href="{{ route('specific_stream', ['id' => $elem['user_id']]) }}">
                            <div class="card rounded-0">
                                <div class="row g-0 align-items-center">
                                    <div class="col-12">
                                        <img src="{{ Str::replace('{width}x{height}', '251x141', $elem['thumbnail_url']) }}" class="card-img-top" alt="{{ $elem['title'] }}">
                                    </div>

                                    <div class="col-12">
                                        <div class="card-body mt-n101">
                                            <p class="card-text text-ellipsis text-ellipsis fs-6">
                                                {{ $elem['title'] }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>