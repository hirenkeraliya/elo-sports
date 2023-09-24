{{-- Page Name:Spam Filters word
Developed on :2023/03/24
Updated on :2023/03/24
Objective : this page will show all the filter words
--}}
@extends('layout.admin.layout')
@section('title', 'Filters')
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
    input[type="file"] {
    display: none;
}
.custom-file-upload {
    border: 1px solid #ccc;
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
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
                                <div class="col-sm-5">
                                    <h3 class="card-title">Filter Word</h3>
                                    @error('file')
                                        <div>{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-3">
                                
                                   @if(auth()->user()->can('create-spam'))
                                 <form method="post" action="{{url('/upload-filters')}}" enctype="multipart/form-data">
                                 @csrf
                                    <div class="row">
                                          <div class="col">
                                            <label class="custom-file-upload btn-primary">
                                                <input type="file" name="file" accept=".xlsx"/>
                                                   <i class="fas fa-cloud-upload"></i>
                                                  Browse
                                            </label>
                                          </div>
                                          
                                        <div class="col">
                                       

                                            <div class="form-group">
                                                 <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>

                                       

                                    </div>
                                 </form>
                                 @endif
                                </div>
                                <div class="col-sm-2">
                                 @if(auth()->user()->can('delete-spam'))
                                            <form method="POST" action="{{url('/delete-filters')}}" >
                                                @csrf
                                                 @method('DELETE')
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-danger">Clear All</button>
                                                </div>
                                            </form>

                                    @endif      
                                            
                                </div>
                                <div class="col-sm-2">
                                @if(auth()->user()->can('view-spam'))
                                  <div class="form-group">
                                                 <a href="{{url('/download-spam-word')}}" class="btn btn-primary" target="_blank">Export File</a>
                                            </div>
                                            @endif
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
                                        @foreach($words as $key => $value)
                                            {{$value}},
                                         @endforeach
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-5">
                                        {{-- <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div> --}}
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
        
        
    })

</script>

@endsection
