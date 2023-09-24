 {{-- Page Name:Lists of role page
Developed on :2023/03/24
Updated on :2023/03/24
Objective : will lists all the roles  --}}

@extends('layout.admin.layout')
@section('title', 'Livestreams |Role Lists')
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
                                    <h3 class="card-title">Role/Lists </h3>
                                </div>
                                <div class="col-sm-3">
                                    <div class="row">
                                       
                                        <div class="col">
                                        <div style="float:right;displayblock;">
                                        @if(auth()->user()->can('create-role'))
                                            <div class="form-group">
                                                
                                                <a href="{{url('/create-role')}}"  class="btn btn-primary">Create Role</a>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="col">
                                       </div>

                                    </div>
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
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Name</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Slug</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">S.No</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Name</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Slug</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                               
                            </div>
                        </div>

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
       var baseUrl= "{{url('/roles')}}"
        $('#data-tables').DataTable({
            processing: true,
            serverSide: true,
            ajax: baseUrl,
             orderable: true,
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'slug', name: 'slug'},
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

        $("body").on('click', '#add-roles', function(event) {
            let el = event.target;
            $("#add-role-model").modal("show");
        })
       
          $("body").on('click', '.delete-role', function(event) {

            var id = $(this).attr('data-id');
            var name = $(this).attr('data-name');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            new swal({
                title: 'Are you sure',
                text: 'You want to delete '+name+'?',
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
                url: '/delete-role'
                , type: 'POST'
                , dataType: 'json'
                , data: {
                    "id": id
                    , "_token": "{{ csrf_token() }}"
                , }
                , success: function(data) {
                    $('#data-tables').DataTable().draw();
                    // your success logic here
                }
                , error: function(data) {
                    console.log('Error:', data);
                    // your error logic here
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
