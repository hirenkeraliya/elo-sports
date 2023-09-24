<!-- This page show list of betting amount master -->
@extends('layout.admin.layout')
@section('title', 'Filters')
@section('css')
@endsection
@section('content') 

 <div class="content-wrapper">  
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Betting Amount Master</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right"> 
			 <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li> 
              <li class="breadcrumb-item active">Betting Amount Master - List</li>
            </ol>
          </div>
        </div>
      </div> 
    </section>

    <!-- Main content -->
    <section class="content">
<div class="row">
      <!-- Default box -->
	   <div class="col-md-12">
	 <form method="post" action="{{url('/betting/list')}}" enctype="multipart/form-data">
	  @csrf
                        @method('get')
						
						 <div class="col-md-12">
<div class="alert alert-success alert-dismissible"  @if(@strlen((Session::get('status')))) style="display:block"  @else style="display:none"  @endif >
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> 
                 {{ Session::get('status') }}
                </div>
				
<div class="alert alert-danger alert-dismissible"  @if(( count($errors->all()))) style="display:block"  @else  style="display:none"  @endif >
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> 
                 @foreach ($errors->all() as $error)
                        {{ $error }} <br>
                    @endforeach
                </div>
				
                </div>
				 
  <div class="col-md-12 setting_div" style="float:left">
	  <div class="card"> 	   
        <div class="card-header">
          <h3 class="card-title">List</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            
          </div>
        </div>
        <div class="card-body">
          <table class="table">
		    <table id="example_php" class="table table-bordered table-striped col-xs-12" >
								<thead>
									<tr >
									     
										<th>#</th>
										<th>Betting Amount</th>
										<th>Description  </th> 
										<th>Created Date  </th> 
										<th>Action</th>  
									</tr>
								</thead>
								<tbody> 
									 
									 @foreach (@$records as $key=>$result)  
									<tr  >
									   
										 
										<td>{{ $key+1 }} </td>
										
										<td>{{ $result->betting_amount }}</td>
										<td>{{ $result->description }}</td> 
										<td>{{ $result->created_at->format('Y-m-d H:i:s A')  }}</td>  
										 <td>
                      @if(auth()->user()->can('edit-betting-master'))
									     <a class="btn btn-xs btn-info" href="{{ url('/betting/update/'.$result->id) }}" title="Edit"><i class="fas fa-pencil-alt "></i></a>
									  	@endif
                       @if(auth()->user()->can('delete-betting-master'))
                      <a class="btn btn-xs btn-danger confirm_delete" href="{{ url('/betting/delete/'.$result->id) }}" title="Delete"><i class="fa fa-trash"></i></a>
									 			 @endif
										</td> 
										 
									</tr>
									@endforeach

								</tbody>
								<tfooter>
								  {{ $records->links() }}
								  </tfooter>
							</table>
		
		  </table>
        </div> 
      </div>
	
      </div>
	     </form> 
	    </div>
	    </div>
	    </div>
	<!-- /.card -->    </section>
    <!-- /.content -->
  </div>
 
@endsection
@section('js')
<script>
    $(document).ready(function() {
        
        
    })

</script>

@endsection
