<section class="py-4">
    <div class="container" style="box-shadow: -90px 5px 35px -48px #01102b;">
        <div class="d-flex align-items-center">
            <h5 class=" mb-0">Twitch Streams</h5>
        </div>

        <hr />

        <div class="product-grid">
            <div class="new-arrivals owl-carousel owl-theme">
                @if (array_key_exists('data', $data))
                    @foreach ($data['data'] as $elem)
                        <a href="{{ route('specific_stream', ['id' => $elem['user_id']]) }}">
                            <div class="item">
                                <div class="card rounded-0 product-card">
                                    <a href="#">
                                        <img src="{{ Str::replace('{width}x{height}', '350x200', $elem['thumbnail_url']) }}" class="card-img-top" alt="{{ $elem['title'] }}">
                                    </a>

                                    <div class="card-body">
                                        <div class="product-info">

                                            <a href="javascript:;">
                                                <h6 class="product-name text-ellipsis text-ellipsis mb-2 fs-6">
                                                    {{ $elem['title'] }}
                                                </h6>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>