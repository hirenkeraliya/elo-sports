{{-- Page Name:Edit role page
Developed on :2023/03/24
Updated on :2023/03/24
Objective : this page is used to reate the roles of the user where user roles with permission is selected on this page
--}}
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
                 @if($errors->any())
                    @foreach ($errors->all() as $error)
                        <div style="color:red">{{ $error }}</div>
                    @endforeach
                @endif
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
           <form action="{{url('update-role/'.$role->id)}}" method="post">
           @csrf
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-7">
                                    <h3 class="card-title">Role/Lists </h3>
                                </div>
                                <div class="col-sm-5">
                                    @if(auth()->user()->can('create-role'))
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col">
                                            <input type="text" class="form-control" name="name" placeholder="Role name" value="{{$role->name}}" />
                                            </div>
                                            <div class="col">
                                             
                                                    <button type="submit" id="add-role" class="btn btn-primary">Submit Role</button>
                                                

                                            </div>
                                           

                                        </div>
                                    </div>
                                    @endif
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
                                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Check Out</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @php $rl = $role->permissions->pluck('id')->toArray() @endphp
                                                    @foreach($permissions as $key => $permission)
                                                    <tr>
                                                        <td>{{$key+1}} </td>
                                                        <td>{{$permission->name}} </td>
                                                        <td>{{$permission->slug}}  </td>
                                                        <td>
                                                            <input type="checkbox" name="permissions[]" @if(in_array($permission->id,$rl)) checked @endif value="{{ $permission->id}}" />

                                                        </td>
                                                    </tr>

                                                    @endforeach

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">S.No</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Name</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Slug</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Check Out</th>
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
            <form>

    </section>

</div>

@endsection
@section('js')
<script>
    $(document).ready(function() {


    })

</script>

@endsection
