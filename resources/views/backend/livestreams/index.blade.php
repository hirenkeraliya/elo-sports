{{-- Page Name Livestream lists:
Developed on :2023/03/25
Updated on :2023/03/25
Objective : this page will display all the streams that are selected by the user eithe completed or in-complete
--}}
@extends('layout.admin.layout')
@section('title', 'Livestreams |'.request()->segment(2))
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
                                    <h3 class="card-title">Livestreaming Reports</h3>
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
                                    <div class="col-sm-12 col-md-6"></div>
                                    <div class="col-sm-12 col-md-6"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="data-tables" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                                            <thead>
                                                <tr>
                                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">S.No</th>
                                                                                     <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Type</th>
                                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Stream Name</th>
                                                    {{-- <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">First Name</th> --}}
                                                    {{-- <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Last Name</th> --}}
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Email</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Username</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Start Date</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">End Date</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- @foreach($livestreams as $key=>$livestream)
                                                <tr class="odd">
                                                    <td class="dtr-control sorting_1" tabindex="0">{{ $key+1}}</td>
                                                <td>{{ $livestream->name }}</td>
                                                {{-- <td>{{ $livestream->user ? $livestream->user->firstName :null }}</td> --}}
                                                {{-- <td>{{ $livestream->user ? $livestream->user->lastName :null }}</td> --}}
                                                {{-- <td>{{ $livestream->user ? $livestream->user->email :null }}</td>
                                                <td>{{ $livestream->user ? $livestream->user->username :null }}</td>
                                                <td>{{ $livestream->user ? $livestream->created_at :null }}</td>
                                                <td>{{ $livestream->user ? $livestream->updated_at :null }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">
                                                            <span class="caret"></span></button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a href="{{url('stream/'.$livestream->id)}}" class="anchor-link" target="_blank"> Visit</a>
                                                            </li>
                                                            @if($livestream->chats()->count() > 0)
                                                            <li>
                                                                <a href="{{url('chat-lists?livestream_id='.$livestream->id)}}" class="anchor-link" target="_blank">Chat</a>
                                                            </li>

                                                            @endif
                                                            @if(request()->segment(2) == 'in-progress')
                                                            <li>
                                                                <a href="javascrip:void(0)" data-id="{{$livestream->id}}" data-time="{{$livestream->delay_time}}" class="anchor-link delay_moal"> Add Delay</a>

                                                            </li>
                                                            @endif

                                                        </ul>
                                                    </div>




                                                </td>
                                                </tr>
                                                @endforeach --}}

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">S.No</th>
                                                                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Type</th>
                                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Stream Name</th>
                                                    {{-- <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">First Name</th> --}}
                                                    {{-- <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Last Name</th> --}}
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Email</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Username</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Start Date</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">End Date</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
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
    $(document).ready(function() {
        var end = "{{request()->segment(2)}}"
        var baseUrl = "{{url('/livestreams')}}"
        console.log(baseUrl + '/' + end);
        $('#data-tables').DataTable({
            processing: true
            , serverSide: true
            , ajax: baseUrl + '/' + end,
            orderable: true
            , columns: [{
                    data: 'DT_RowIndex'
                    , name: 'DT_RowIndex'
                }
                , {
                    data: 'type'
                    , name: 'type'
                }
                , {
                    data: 'name'
                    , name: 'name'
                }
                , {
                    data: 'email'
                    , name: 'email'
                }
                , {
                    data: 'username'
                    , name: 'username'
                },

                {
                    data: 'created_at'
                    , name: 'created_at'
                }
                , {
                    data: 'updated_at'
                    , name: 'updated_at'
                }
                
                , {
                    data: 'action'
                    , name: 'action'
                },

            ]
        });

        $('body').on('change', '#order', function() {
            console.log($(this).val());
            var seg1 = "{{ request()->segment(1)}}";
            var seg2 = "{{ request()->segment(2)}}";
            var url = "{{ url('/')}}" + "/" + seg1 + "/" + seg2 + "?orderBy=" + $(this).val();
            window.location.href = url;
        })


        $("body").on('click', '.delay_moal', function(event) {
            let el = event.target;

            let id = el.getAttribute('data-id');
            $("#add-dealy-time").val(id);
            let oldTime = el.getAttribute('data-time');
            $("#delayTime").val(oldTime);
            $("#add-deal-sec").modal("show");
        })

        $("body").on('click', '#addTime', function(event) {
            var id = $("#add-dealy-time").val();

            var time = $('#delayTime').val();

            if (time == '') {
                alert('please add time between 0 to 10');
                return false;
            }
            $.ajax({
                url: "/add-delay-time"
                , type: "POST"
                , data: {
                    "_token": "{{ csrf_token() }}"
                    , id: id
                    , time: time,

                }
                , success: function(response) {
                    location.reload();
                }
                , error: function(response) {

                }
            , });
        });

        $("body").on('click', '.live-delete', function(event) {

            var id = $(this).attr('data-id');

            console.log(id, 'delete');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/streams-delete'
                , type: 'POST'
                , dataType: 'json'
                , data: {
                    "id": id
                    , "_token": "{{ csrf_token() }}"
                , }
                , success: function(data) {
                    location.reload();
                    // your success logic here
                }
                , error: function(data) {
                    console.log('Error:', data);
                    // your error logic here
                }
            });
        });
    })

</script>

@endsection
