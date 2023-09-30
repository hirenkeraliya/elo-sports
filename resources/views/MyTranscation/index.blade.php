@extends('master')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <section class="pt-md-5 pt-sm-3 ">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <h2 style="color:#fff">My Transactions</h2>
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Comment</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Transcation Id / Email Id </th>
                                    <th scope="col">Type</th>
                                    <th scope="col">On Date</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach (@$records as $key=>$result)
                                    <tr>
                                        <td>{{ $key+1 }} </td>
                                        <td>{{ $result->comment }}</td>
                                        <td>{{ $result->transaction_amount }}</td>
                                        @if($result->transaction_type=='credit')
                                        <td>{{ $result->transaction_id }}</td>
                                        @else
                                        <td>{{ $result->email_id }}</td>
                                        @endif
                                        <td>{{ ucfirst($result->transaction_type) }}</td>
                                        <td>{{ date('Y-m-d h:i:s A',strtotime($result->created_at)) }}</td>
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
