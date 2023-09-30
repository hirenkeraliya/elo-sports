@extends('master')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <section class="pt-md-5 pt-sm-3 ">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <h2 style="color:#fff">My Stream List </h2>
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Stream Name</th>
                                    <th scope="col">Started Date</th>
                                    <th scope="col">End Date</th>
                                    <th scope="col">Vig Amount</th>
                                    <th scope="col">Steamer Fees</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($streams as $key=>$stream)
                                    <tr>
                                    <td>{{ $key+1;}}</td>
                                        <td>

                                            <span>{{ $stream->name }}</span>
                                        </td>
                                        <td><span>{{ $stream->created_at }}</span></td>
                                        <td><span>@if($stream->status=='stopped'){{ $stream->updated_at }} @endif</span></td>
                                        <td><span>@if($stream->bets()->sum('vig_amount')){{  $stream->bets()->sum('vig_amount')  }} @else {{ 0.00 }} @endif</span></td>
                                        <td><span>@if($stream->betMain()->sum('streamer_fee')){{  $stream->betMain()->sum('streamer_fee')  }} @else {{ 0.00 }} @endif</span></td>
                                        <td><a href="{{ url('/stream_bet/'.$stream->id) }}">Details</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
