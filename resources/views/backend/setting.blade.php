<!-- This page allow   admin  to set setting allow to portal
-->
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
            <h1>Setting</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			 <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">Setting</li>
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
	 <form method="post" action="{{url('/save-setting')}}" enctype="multipart/form-data">
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
          <h3 class="card-title">Setting</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>

          </div>
        </div>
        <div class="card-body">
           <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5 col-form-label">Vig<label style="color:#FF0000">*</label></label>
                    <div class="col-sm-7">
						<input  type="text" maxlength="5" class="form-control required  no_space no_chara     " required  name="vig" id="vig" value="{{$setting->vig}}"  >

				   </div>
                </div>
			  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5 col-form-label">Extra Vig Division Factor<label style="color:#FF0000">*</label></label>
                    <div class="col-sm-7">
						<input  type="text" maxlength="2" class="form-control required  no_space no_chara     " required  name="extra_vig_division_factor" id="extra_vig_division_factor" value="{{$setting->extra_vig_division_factor}}"  >

				   </div>
                </div>
			  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5 col-form-label">How many No. of users can bet on a Bet <label style="color:#FF0000">*</label></label>
                    <div class="col-sm-7">
						<input  type="text" maxlength="3" class="form-control required  no_space no_chara     " required  name="no_of_user_can_bet" id="no_of_user_can_bet" value="{{$setting->no_of_user_can_bet}}"  >

				   </div>
                </div>
				<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5 col-form-label">Streamer Percentage<label style="color:#FF0000">*</label></label>
                    <div class="col-sm-6">
						<input  type="text" max="20" maxlength="2" class="form-control required  no_space no_chara     " required  name="streamer_per" id="streamer_per" value="{{$setting->streamer_per}}"  >

				   </div>
				   <div class="col-sm-1">%</div>
                </div>
			  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5 col-form-label">Minimum Wallet Transfer Amount <label style="color:#FF0000">*</label></label>
                    <div class="col-sm-7">
						<input  type="text" maxlength="5" class="form-control required  no_space no_chara     " required  name="min_wallet_trasfer_amount" id="min_wallet_trasfer_amount" value="{{$setting->min_wallet_trasfer_amount}}"  >

				   </div>
                </div>

        <!-- /.card-footer-->
        </div>
      </div>

      </div>

<div class="col-md-6 setting_div" style="float:left">
	  <div class="card">
        <div class="card-header">
          <h3 class="card-title">Paypal Setting</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>

          </div>
        </div>
        <div class="card-body">
           <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5 col-form-label">Client Id<label style="color:#FF0000">*</label></label>
                    <div class="col-sm-7">
						<input  style="width:92%; float:left;" type="password" maxlength="255" class="form-control required    " required  name="client_id" id="client_id" value="{{ \Crypt::decryptString($setting->client_id) }}"  >
						<i class="fas fa-eye show_password " style="margin-top: 11px;cursor: pointer;"></i>
						<i class="	fas fa-eye-slash close_password" style="margin-top: 11px;display:none;cursor: pointer;"></i>
				   </div>

                </div>
			  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5 col-form-label">API User Name<label style="color:#FF0000">*</label></label>
                    <div class="col-sm-7">
						<input style="width:92%; float:left;" type="password" maxlength="255" class="form-control required   " required  name="api_username" id="api_username" value="{{ \Crypt::decryptString($setting->api_username) }}"  >
						<i class="fas fa-eye show_password " style="margin-top: 11px;cursor: pointer;"></i>
						<i class="	fas fa-eye-slash close_password" style="margin-top: 11px;display:none;cursor: pointer;"></i>

				   </div>
				   <div class="col-sm-1"></div>
                </div>
			  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5 col-form-label">API Password <label style="color:#FF0000">*</label></label>
                    <div class="col-sm-7">
						<input  style="width:92%; float:left;"  type="password" maxlength="255" class="form-control required    " required  name="api_password" id="api_password" value="{{ \Crypt::decryptString($setting->api_password) }}"  >
						<i class="fas fa-eye show_password " style="margin-top: 11px;cursor: pointer;"></i>
						<i class="	fas fa-eye-slash close_password" style="margin-top: 11px;display:none;cursor: pointer;"></i>

				   </div>
                </div>

			  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5 col-form-label">API Signature <label style="color:#FF0000">*</label></label>
                    <div class="col-sm-7">
						<input  style="width:92%; float:left;"  type="password" maxlength="255" class="form-control required    " required  name="api_signature" id="api_signature" value="{{ \Crypt::decryptString($setting->api_signature) }}"  >
						<i class="fas fa-eye show_password " style="margin-top: 11px;cursor: pointer;"></i>
						<i class="	fas fa-eye-slash close_password" style="margin-top: 11px;display:none;cursor: pointer;"></i>

				   </div>
                </div>

			  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5 col-form-label">Environment <label style="color:#FF0000">*</label></label>
                    <div class="col-sm-7">
						<select  required  name="environment" id="environment"  class="form-control"  >
						<option value="live" {{($setting->environment == 'live') ? 'selected' : '' }} >Live</option>
						<option value="sandbox" {{($setting->environment == 'sandbox') ? 'selected' : '' }}>Sandbox</option>
						</select>
				   </div>
                </div>

			  <!-- /.card-body -->
        <div class="card-footer">
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
        $(document).on("click", ".show_password", function(event) {
			$(this).prev().attr('type','text');
			$(this).hide();
			$(this).next().show();
		});
		$(document).on("click", ".close_password", function(event) {
			$(this).prev().prev().attr('type','password');
			$(this).hide();
			$(this).prev().show();
		});

    })

</script>

@endsection
