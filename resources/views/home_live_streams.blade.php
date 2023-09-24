<section class="py-4">
    <div class="container" style="box-shadow: -90px 5px 35px -48px #01102b;">
        <div class="d-flex align-items-center">
            <h5 class=" mb-3">Live Streams</h5>
        </div>

        <hr />

        <div class="row row-cols-1 row-cols-lg-3 row-cols-xl-4">
            @foreach($livestreams as $livestream)
                <div class="col">
                    <a href="{{ route('stream.live', [$livestream->id]) }}">
                        <div class="card rounded-0">
                            <div class="row g-0 align-items-center">
                                <div class="col-12">
                                    <img src="images/{{ $livestream->image }}" class="img-fluid" alt="{{ $livestream->name }}" />
                                </div>

                                <div class="col-12">
                                    <div class="card-body mt-n101">
                                        <p class="card-text text-ellipsis text-ellipsis fs-6">
                                            {{ $livestream->name }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>