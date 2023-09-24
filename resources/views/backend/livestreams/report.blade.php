{{-- Page Name: Streams Report
Developed on :2023/03/24
Updated on :2023/03/24
Objective : this page will display all the live stream report as per user how many streas bets total bets total vig amount streamer fee and profit
when the page first load it will show today reports i when date rage is selected and this will show as per seleted date rage
--}}
@extends('layout.admin.layout')
@section('title', 'Livestream Report')
@section('css')
<style>
    table .dropdown {
        background: #f49e3f;
    }

    table .dropdown-menu li {
        padding: 2px 10px;

            {
                {
                -- background: #f49e3f;
                --
            }
        }
    }

    table .dropdown-menu li:first-child {
        border-bottom: 1px solid #bbcccc;
    }

    table .anchor-link {
        color: #edc094;
    }

</style>
@endsection
@section('content')
<div class="content-wrapper" style="min-height: 1302.12px;">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{-- <h1>DataTables</h1> --}}
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                        {{-- <li class="breadcrumb-item active">{{request()->segment(2)}}</li> --}}
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-9">
                                    <h3 class="card-title">Livestreams / {{request()->segment(2)}}</h3>
                                </div>
                                <div class="col-sm-3">
                                    <form method="get" action="{{url('livestreams/'.request()->segment(2))}}">
                                        <div class="row">
                                            {{-- <div class="col">
                                        {{-- <div style="float:right;displayblock;"> --}}

                                            {{-- <div class="form-group">
                                                <select class="form-control" name="username">
                                                    <option value="">sort by username</option>
                                                    <option value="asc">Ascending</option>
                                                    <option value="desc">Descending</option>
                                                    <select>
                                            </div> --}}
                                            {{-- </div>  --}}
                                            {{-- <div class="col">
                                        {{-- <div style="float:right;displayblock;"> --}}

                                            {{-- <div class="form-group">
                                                <select class="form-control" name="email">
                                                    <option value="">sort by email</option>
                                                    <option value="asc">Ascending</option>
                                                    <option value="desc">Descending</option>
                                                    <select>
                                            </div> --}}
                                            {{-- </div>  --}}
                                            <div class="col">
                                                {{-- <div style="float:right;displayblock;"> --}}

                                                {{-- <div class="form-group">
                                                <select class="form-control" name="orderBy" id="order">
                                                    <option  value="">sort by date</option>
                                                    <option value="asc">Ascending</option>
                                                    <option value="desc">Descending</option>
                                                    <select>
                                            </div> --}}
                                            </div>
                                            <div class="col">
                                                {{-- <button type="submit" class="btn btn-primary">Search</button> --}}
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                 <div class="col-sm-12 col-md-8">
                                 </div>
                                    <div class="col-sm-12 col-md-4">
                                        <div class="form-group">
                                            <label>Selecte date range:</label>
                                            <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">  <i class="fa fa-calendar"></i></span>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="reservation">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                      <div class="report-table">
                                        <table id="data-tables" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                                            <thead>
                                                <tr>
                                                   <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">S.No</th>
                                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Streamer Name</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Total Stream</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Total Bet Count</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Total Amount</th>
                                                                                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Total Vig Amount</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Total Streamer Fee</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Total Profit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               {{-- @foreach($users as $key=>$user)
                                                    <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$user->username}}</td>
                                                    <td>{{$user->streams->count()}}</td>
                                                    <td>{{ $user->streams->sum('bets_count') }}</td>
                                                    <td>{{ $user->streams->sum('bets_sum_amount')}}</td>
                                                     <td>{{ round($user->streams->sum('bets_sum_vig_amount')) }}</td>
                                                    <td>{{ round(($user->streams->sum('bets_sum_vig_amount')*$setting->streamer_per)/100)}}</td>
                                                    <td>{{ round(($user->streams->sum('bets_sum_vig_amount') -  ($user->streams->sum('bets_sum_vig_amount')*$setting->streamer_per)/100))}}</td>


                                                    </tr>

                                               @endforeach --}}

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                     <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">S.No</th>
                                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Streamer Name</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Total Stream</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Total Bet Count</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Total Amount</th>
                                                     <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Total Vig Amount</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Total Streamer Fee</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Total Profit</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-5">
                                        {{-- <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div> --}}
                                    </div>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                            {{-- {{$livestreams->links() }} --}}
                                            {{-- <ul class="pagination">
                                                <li class="paginate_button page-item previous disabled" id="example2_previous"><a href="#" aria-controls="example2" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
                                                <li class="paginate_button page-item active"><a href="#" aria-controls="example2" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                                                <li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                                                <li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
                                                <li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="4" tabindex="0" class="page-link">4</a></li>
                                                <li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="5" tabindex="0" class="page-link">5</a></li>
                                                <li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="6" tabindex="0" class="page-link">6</a></li>
                                                <li class="paginate_button page-item next" id="example2_next"><a href="#" aria-controls="example2" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li>
                                            </ul> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>

            </div>

        </div>
        <div class="modal fade show" id="add-deal-sec" aria-modal="true" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Chat Delay Time </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Add Sec

                            </label>
                            <input class="form-control" type="number" id="delayTime" max="10" min="0" name="delay_sec" />
                            <input type="hidden" name="stramId" id="add-dealy-time" />
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="addTime">Save changes</button>
                    </div>
                </div>

            </div>

        </div>

    </section>

</div>

@endsection
@section('js')
<script>
$('#reservation').daterangepicker()


// attach daterangepicker plugin

    $(document).ready(function() {
$('#reservation').on('apply.daterangepicker', function(ev, picker) {
    console.log(picker.startDate.format('yyyy-mm-dd H:i:s'),picker.endDate.format('MMMM D, YYYY'));
    var date = {

                  start_date: picker.startDate.subtract(1,'days').format('MMMM D, YYYY')
                    , end_date: picker.endDate.add(1,'days').format('MMMM D, YYYY')

                }
      var url =baseUrl+'/streaming-report/?start_date='+picker.startDate.format('MMMM D, YYYY')+'&end_date='+picker.endDate.format('MMMM D, YYYY');
      $('#data-tables').DataTable().destroy();
     load_data(url);


});

       $( window ).on( "load",function(){
         var url =baseUrl+'/streaming-report/';
         load_data(url);
   })





    })

     function load_data(url){
       console.log(url);
            $('#data-tables').DataTable({
                processing: true,
                serverSide: true,
                retrieve: true,
                paging: false,
                ajax: url,
                columns: [
                    {
                    data: 'DT_RowIndex'
                    , name: 'DT_RowIndex'
                },
                    {
                        data:'streamer_name',
                        name:'streamer_name'
                    },
                    {
                        data:'total_stream',
                        name:'total_stream'
                    },
                    {
                        data:'total_bet_count',
                        name:'total_bet_count'
                    },
                    {
                        data:'total_amount',
                        name:'total_amount'
                    },
                    {
                        data:'total_vig_amount',
                        name:'total_vig_amount'
                    },
                    {
                        data:'streamer_fee',
                        name:'streamer_fee'
                    },
                    {
                        data:'profit',
                        name:'profit'
                    }


                ]
            });
        }

</script>

@endsection
