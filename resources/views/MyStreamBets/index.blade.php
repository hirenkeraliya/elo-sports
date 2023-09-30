@extends('master')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <section class="pt-md-5 pt-sm-3 ">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <h2 style="color:#fff">My Stream Bet List - {{ $game_info->name }}</h2>

                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Stream Name</th>
                                    <th scope="col">Started On</th>
                                    <th scope="col">Bet Description</th>
                                    <th scope="col">For Text</th>
                                    <th scope="col">Against Text</th>
                                    <th scope="col">Bet On</th>
                                    <th scope="col">Bet Amount</th>
                                    <th scope="col">Vig Amount</th>
                                    <th scope="col">Won Amount</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Bet Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (@$records as $key=>$result)
                                    <tr>
                                        <td>{{ $key+1 }} </td>
                                        <td>{{ $result->livestreams->name }}</td>
                                        <td>{{ date('Y-m-d h:i:s A',strtotime($result->livestreams->created_at)) }}</td>
                                        <td>{{ $result->betmain->description }}</td>
                                        <td>{{ $result->betmain->for_text }}</td>
                                        <td>{{ $result->betmain->against_text }}</td>
                                        <td>{{ ucfirst($result->bet_on) }}</td>
                                        <td>{{ $result->amount }}</td>
                                        <td>{{ $result->vig_amount }}</td>
                                        <td>{{ $result->win_amount }}</td>
                                        <td>
                                        @if($result->betmain->is_declared_result)
                                            @if($result->is_win)
                                                <label class="  btn-success btn-sm"> Won !!</label>
                                            @else
                                                <label class="  btn-danger btn-sm">Lossed</label>
                                            @endif
                                        @else
                                            @if($result->is_claimed)
                                                <label class="  btn-primary btn-sm"> Claimed !!</label>
                                            @else
                                                <label class="  btn-warning btn-sm">Pending</label>
                                            @endif
                                        @endif</td>
                                        <td>{{ date('Y-m-d h:i:s A',strtotime($result->created_at)) }}</td>
                                        <td><a href="{{ url('/stream/'.$result->livestreams->id) }}">View</a></td>
                                    </tr>
                                @endforeach
                            </tbody>

                            <tfoot>
                                {{ $records->links() }}
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
