<!-- This page show bet list stream wise -->
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
            <h1>Active Betting List  </h1> 
			<h5>Stream Name -  {{$stram_info->name}}</h5>
			<h5>Bet Description -  {{$bet_info->description}} </h5>
			<h5>Bet For -  {{$bet_info->for_text}}  ||  Bet Against -  {{$bet_info->against_text}} </h5>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right"> 
			 <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li> 
			 <li class="breadcrumb-item"><a href="javascript:void();">Report</a></li> 
              <li class="breadcrumb-item active">Active Betting List   </li>
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
          <h3 class="card-title"Active Bet >List</h3>

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
										<th>Username </th>
										<th>Bet On   </th>  
										<th>Bet Amount </th> 
										<th>Vig </th> 
										<th>Total </th>  
										<th>Created On </th>   
										<th>Winning Amount </th>   
										<th>Status</th>   
									</tr>
								</thead>
								<tbody> 
									 
									 @foreach (@$records as $key=>$result) 
									<tr  >
									   
										 
										<td>{{ $key+1 }} </td>
										
										<td>{{ $result->user->username }}</td> 
										<td>{{ ucfirst($result->bet_on) }}</td> 
										<td>{{ $result->amount }}</td> 
										<td>{{ $result->vig_amount }}</td> 
										<td>{{ $result->total_amount }}</td>  
										<td>{{ date('Y-m-d h:i A',strtotime($result->created_at)); }}</td>   
										
										<td>{{ $result->win_amount }}</td> 
										<td> 
										@if($bet_info->is_declared_result)   
											@if($result->is_win == 1)   
												<label class="  btn-success btn-sm"> Won </label>
											@elseif($result->is_win == '-4')
                                            <label class="  btn-danger btn-sm">Abandoned</label>
											@else
												<label class="  btn-danger btn-sm"> Lost </label>
											@endif
										@else
											@if($result->is_claimed)   
											<label class="  btn-primary btn-sm"> Claimed </label> 
										
											@endif
										@endif
										
										</td>
									</tr>

									@endforeach

								</tbody>
								 <tfoot>
                                                <tr>
          											<td   colspan="3" ></td>
                                                    <td    >{{ $bet_info->bets()->sum('amount')}}</td>
                                                    <td   >{{ $bet_info->bets()->sum('vig_amount')}}</td>
                                                    <td    >{{ $bet_info->bets()->sum('total_amount')}}</td>
                                                <td   colspan="3" > </td>
                                             
											    </tr>
                                            </tfoot>
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
