{{-- Page Name:User lists
Developed on :2023/03/24
Updated on :2023/03/24
Objective : this page will lists all the normal users 
--}}
@extends('layout.admin.layout')
@section('title', 'Livestreams |User Lists')
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
                                    <h3 class="card-title">User / Lists </h3>
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
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">First Name</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Last Name</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Email</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Username</th>
                                                    {{-- <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Roles</th> --}}
                                                              <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Status</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">S.No</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">First Name</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Last Name</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Email</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Username</th>
                                                    {{-- <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Roles</th> --}}
                                                              <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Status</th>
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
         <div class="modal fade show" id="add-role-model" aria-modal="true" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Create Role </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Role 

                            </label>
                            <select class="select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                               @foreach($roles as $key => $role)
                                <option value="{{$role->id}}">{{ $role->name}}</option>
                               @endforeach
                                
                            
                            </select>
                            <input type="hidden" name="id" id="userId" />
                        </div>
                       
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="addRoles">Save changes</button>
                    </div>
                </div>

            </div>

        </div>
         <div class="modal fade show" id="add-livestream" aria-modal="true" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Livestream </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Livestreams

                            </label>
                            <select class="add-live" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                               @foreach($livestreams as $key => $livestream)
                                <option value="{{$livestream->id}}">{{ $livestream->name}}</option>
                               @endforeach
                                
                            
                            </select>
                            <input type="hidden" name="id" id="watcherId" />
                        </div>
                       
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="addLivestream">Save changes</button>
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
     $('.select2').select2({
        templateSelection: function(selected, options) {
            if (selected.id !== '') {
            return $('<span style="color: red;">' + selected.text + '</span>');
            }
            return selected.text;
        }
     })
      $('.add-live').select2({
        templateSelection: function(selected, options) {
            if (selected.id !== '') {
            return $('<span style="color: red;">' + selected.text + '</span>');
            }
            return selected.text;
        }
     })

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
      var end = "{{request()->segment(2)}}"
       var baseUrl= "{{url('/users')}}"
       console.log(baseUrl+'/'+end);
        $('#data-tables').DataTable({
            processing: true,
            serverSide: true,
            ajax: baseUrl+'/'+end,
             orderable: true,
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'firstName', name: 'firstName'},
                {data: 'lastName', name: 'lastName'},
                  {data: 'email', name: 'email'},
                {data: 'username', name: 'username'},
                {{-- {data: 'roles', name: 'roles'}, --}}
                  {data: 'status', name: 'status'},
                {data: 'action', name: 'action'},
                
            ]
        });
        
        $('body').on('change', '#order', function() {
            console.log($(this).val());
            var seg1 = "{{ request()->segment(1)}}";
            var seg2 = "{{ request()->segment(2)}}";
            var url = "{{ url('/users')}}";
            window.location.href = url;
        })
         $("body").on('click', '.add-roles', function(event) {
            let el = event.target;
            let id = el.getAttribute('data-id');
            let roles = el.getAttribute('data-roles');
            console.log(roles);
            $('#userId').val(id);
            var myArray = roles.replace(/\[|\]/g, '').split(',').map(function(item) {
            return parseInt(item.trim());
            });
             $('.select2').val(myArray).trigger('change');
            $("#add-role-model").modal("show");
        })
          $("body").on('click', '#addRoles', function(event) {

            var rolesId = $(".select2").val();
            console.log(rolesId);

            var id = $('#userId').val();

            if (rolesId == '') {
                alert('Please select the Role');
                return false;
            }
            $.ajax({
                url: "/add-user-roles"
                , type: "POST"
                , data: {
                    "_token": "{{ csrf_token() }}"
                    , id: id
                    , roles: rolesId,

                }
                , success: function(response) {
                    $("#add-role-model").modal("hide");
                     $('#data-tables').DataTable().draw();
                }
                , error: function(response) {

                }
            , });
        });
         $("body").on('click', '.add-livestream', function(event) {
            let el = event.target;
            let id = el.getAttribute('data-id');
            let livestream = el.getAttribute('data-livestrams');
            console.log(livestream);
            $('#watcherId').val(id);
            var myArray = livestream.replace(/\[|\]/g, '').split(',').map(function(item) {
            return parseInt(item.trim());
            });
             $('.add-live').val(myArray).trigger('change');
            $("#add-livestream").modal("show");
        })
         $("body").on('click', '#addLivestream', function(event) {

            var livestreamId = $(".add-live").val();
            console.log(livestreamId);

            var id = $('#watcherId').val();

            if (livestreamId == '') {
                alert('Please select the livestream');
                return false;
            }
            $.ajax({
                url: "/add-user-livestreams"
                , type: "POST"
                , data: {
                    "_token": "{{ csrf_token() }}"
                    , id: id
                    , livestream: livestreamId ,

                }
                , success: function(response) {
                    $("#add-livestream").modal("hide");
                     $('#data-tables').DataTable().draw();
                }
                , error: function(response) {

                }
            , });
        });

  $("body").on('click', '.change-status', function(event) {

           let id = $(this).attr('data-id');
           let account = $(this).attr('data-account');
           let username = $(this).attr('data-username');
           console.log(account);
            new swal({
                title: 'Are you sure',
                text: 'You want to '+ account+'  '+ username +'  account ?',
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: true
            })
            .then((result) => {
                 if (result.isConfirmed) {
                    $.ajax({
                        url: "/change-status",
                        type: "POST",
                        data: {
                                "_token": "{{ csrf_token() }}"
                                , id: id

                            },
                        success: function(response) {
                                $('#data-tables').DataTable().draw();
                            },
                        error: function(response) {

                            }
                         });
                 }
             },function(dismiss) {
                // dismiss can be 'cancel', 'overlay',
                // 'close', and 'timer'
                if (dismiss === 'cancel') {
                    swal('Cancelled', 'Delete Cancelled :)', 'error');
                }
             });
          
        });


    })

</script>

@endsection
