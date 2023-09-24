<!-- This page show bet list detail stream wise -->
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
            <h1>Active Bet List - {{$stram_info->name}} </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right"> 
			 <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li> 
			 <li class="breadcrumb-item"><a href="javascript:void();">Report</a></li> 
              <li class="breadcrumb-item active">Active Bet List  </li>
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
	 <form method="post" action="{{url('report/active_bet_list/$stram_info->id')}}" enctype="multipart/form-data">
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
          <h3 class="card-title"Active Bet >List</h3><br>
		  <p> Pot Amount : {{$stram_info->bets()->sum('amount')}} </p>

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
										<th>Description </th>
										<th>For   </th> 
										<th>Against </th> 
										<th>Bet Amount </th> 
										<th>Created By </th> 
										<th>Created On </th>  
										<th>Total Betters</th>
										<th>Action</th>  
									</tr>
								</thead>
								<tbody> 
									 
									 @foreach (@$records as $key=>$result)   
									<tr  >
									   
										 
										<td>{{ $key+1 }} </td>
										
										<td>{{ $result->description }} </td>
										<td>{{ $result->for_text }} [{{ $result->for_total }}]</td> 
										<td>{{ $result->against_text }} [{{ $result->against_total }}]</td> 
										<td>{{ $result->betting_amount }}</td> 
										<td>{{ $result->username }}</td> 
										<td>{{ date('Y-m-d h:i A',strtotime($result->created_at)); }}</td>  
										<td>{{ $result->total }}/{{$setting->no_of_user_can_bet}}</td>
										 <td>
									     <a class="btn btn-xs btn-info" href="{{ url('/report/better_list/'.$result->id) }}" title="View Better List"><i class="fas fa-eye "></i></a>
									   	@if($result->is_declared_result==0)
											<a class="btn btn-xs btn-success declare_result_btn" data-id="{{ $result->id }}" title="Close Bet"> Close Bet </a>
										@else
										<a class="btn btn-xs btn-danger "  href="javascript:void(0)" title="Closed"> Closed </a>
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
 
 
 
<div class="modal fade" id="result_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <form action="{{url('/set_win_result')}}" method="post" id="set_result_frm">
         @csrf
		 @method('post')
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Declare Result</h5>
                </div>

                <div class="modal-body">
                    
                    <p>
                        <label>Win Side</label>
                         <select name="won_side" id="won_side" class="form-control">
						 <option value="for">For  </option>
						 <option value="against">Against  </option>
						 </select>
                    </p>
                    
                </div>
                <div class="modal-footer">
				<input type="hidden" name="id" id="bet_main_id" value="">
				<input type="hidden" name="game_id" id="game_id" value="{{ $stram_info->id }}">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" value="Submit" class="btn btn-primary" id="submit_result">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>


@endsection
@section('js')
<script>
    $(document).ready(function() {
        
            $('body').on('click', '.declare_result_btn', function() {
				var id=$(this).attr('data-id');
				$('#bet_main_id').val(id);
			$('#result_model').modal('show');
			});  
			$('body').on('click', '#submit_result', function() {
				if (confirm("Are you sure, you want to close this bet ?") == true) {
					$('#set_result_frm').submit();
				}else{
					
				}
			});
    })

</script>

@endsection
