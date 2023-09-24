<!-- This page allow to admin add  betting amount master -->
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
			 @if(@$betting->id)
              <li class="breadcrumb-item"><a href="{{url('/betting/list')}}">List</a></li>
              <li class="breadcrumb-item active">Edit</li>
			 @else	
              <li class="breadcrumb-item active">Add</li>
		 @endif
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
		@if(@$betting->id)
				<form method="post" action="{{url('/update-betting/'.@$betting->id)}}" enctype="multipart/form-data">
			@else	
				
			<form method="post" action="{{url('/save-betting')}}" enctype="multipart/form-data">
		@endif
	   
	 
	  @csrf
                        @method('PUT')
						
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
				 
  <div class="col-md-6 setting_div" style="float:left">
	  <div class="card"> 	   
        <div class="card-header">
          <h3 class="card-title">	Betting Record </h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            
          </div>
        </div>
        <div class="card-body">
           <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5 col-form-label">Betting Amount<label style="color:#FF0000">*</label></label>
                    <div class="col-sm-7">
						<input  type="text" maxlength="8" class="form-control required  no_space no_chara     " required  name="betting_amount" id="betting_amount" value="{{@$betting->betting_amount}}"  >
						
				   </div>
                </div>
			<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5 col-form-label">Description<label style="color:#FF0000">*</label></label>
                    <div class="col-sm-7">
					<textarea name="description" id="description" class="form-control" required  maxlength="255">{{@$betting->description}}</textarea>
					 
				   </div>
                </div>
			  
			  <!-- /.card-body -->
        <div class="card-footer"> 
		<input type="hidden" name="id" id="id" value="{{@$betting->id}}">
			<input type="submit" name="save" id="save" value="Save" class="btn btn-info btn_validator" data-frm="master_frrm_two"  style="  width:100%; " />
			 
        </div>
        <!-- /.card-footer-->
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
