<!-- This page shows the live stream . This page open by click thubnail on home page . This page allow  to user to create lable
	This page allow to create new bet  also place bed on exsisting created bets also user can claimed bet betting on bed.
	Also user can allow chat discusion on this page . chat icon place at right side   bottom. user can change avatar image , emojis and have discusion on chat

  -->
@extends('master')

@section('css')
<style>
    #myBtn {
        position: fixed;
        bottom: 20px;
        right: 30px;
        z-index: 99;
        font-size: 18px;
        border: none;
        outline: none;
        background-color: red;
        color: white;
        cursor: pointer;
        padding: 15px;
        border-radius: 4px;
    }

</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">

<link href="https://vjs.zencdn.net/7.8.2/video-js.css" rel="stylesheet" />
<script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
<script src="https://vjs.zencdn.net/7.8.2/video.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-flash/2.1.0/videojs-flash.min.js"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/video.js/7.15.4/video.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-flash/2.1.0/videojs-flash.min.js"></script> --}}


@endsection


@section('content')
<div id="app" class="container">
    @if($livestream->status != 'stopped')
    <chat :user_details="{{ auth()->user() }}" :livestm="{{$livestream}}"></chat>
    @endif
</div>

@if(isset($livestream))
@if(($livestream->status == "started")||($livestream->status == "created"))

<div class="row">
    <div class="col-md-12">
        <div class="video">
            <h3 class="text-light">{{ $livestream->name }}</h3>
        </div>
        <br>
        <div class="container">
            <div class="row justify-content-center">
                <video id="player" class="video-js" controls autoplay preload="auto" width="1280" height="720" data-setup="{}">
                    <source src=" {{ env('RMPT_STREAMING_LINK').'/'.$livestream->stream_id }}.m3u8" type="application/x-mpegURL" res="9999" label="auto" />
                    <p class="vjs-no-js">To view this video please enable JavaScript, and consider
                        upgrading to
                        a web
                        browser that <a href="https://videojs.com/html5-video-support/" target="_blank">supports
                            HTML5
                            video</a></p>
                </video>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mb-5">
        <div class="col-md-12">
            <div class="col-md-12">
                <p class="text-light stream">Stream Stats</p>

                <ul >
                    @if(isset($game_name))
                    <li class="text-light">{{$game_name}}</li>
                    @endif
                    <li class="text-light">Viewer Count: {{$livestream->viewer()->count()}}</li>
                </ul>

                {{-- </div> --}}


            {{-- <div class="col-md-4"> --}}
            @if(isset($player_stats['data']))
                <p class="text-light">Player Stats</p>
                <ul>
                    <li><img src="{{$player_stats['data']['platformInfo']['avatarUrl']}}"></li>

                    @if($game_name=="CSGO")
                    <li class="text-light">
                        Kills: {{$player_stats['data']['segments'][0]['stats']['kills']['value']}}
                    <li class="text-light">
                        Deaths: {{$player_stats['data']['segments'][0]['stats']['deaths']['value']}}</li>
                    <li class="text-light">Kill Death
                        Ratio: {{$player_stats['data']['segments'][0]['stats']['kd']['value']}}</li>
                    @elseif($game_name=="Apex Legends")
                    <li>Rank: {{$player_stats['data']['segments'][0]['stats']['level']['value']}}</li>
                    <li>Kills: {{$player_stats['data']['segments'][0]['stats']['kills']['value']}}</li>
                    @endif
                </ul>
            </div>
                @else
                <p class="text-light">Player Stats not found</p>
                @endif
                <hr>

            </div>
        </div>

        <div class="col-md-12">

                <div class="col-md-4">
                        @if($email >0 && $email !='')
                            <span class="text-light">Elo Balance : {{preg_replace('#[^\w()/.%\-&]#','',auth()->user()->elo_balance)}}</span>
                            &nbsp &nbsp &nbsp
                            <hr>
                        @endif
                        @if($email !='')
                            <button type="button" class="btn btn-danger" id="btn-bet" data-toggle="modal" data-bs-target="#exampleModalCentercreate_bet">
                                Create Own Bet
                            </button>
                            <button type="button" class="btn btn-success" data-toggle="modal" data-bs-target="#exampleModalCenter1">
                                Purchase ELO
                            </button>
                        @endif


                </div>
                <div class="col-md-4">

                          @if($count_bet == 2 && $count_bet <> 0 && $count_bet !=1)

                            <form action="{{route('room.submit')}}" method="post">@csrf
                                <div class="row">
                                    <div class="col-md-8">
                                        <input type="hidden" name="livestream_id" value="{{$livestream->id}}">
                                        <textarea type="text" name="room_name" class="form-control" placeholder="Enter Room Name only 200 charecter allowed"></textarea>
                                        <span class="text-danger">@error('room_name'){{$message}}@enderror</span>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="submit" name="create_first_room" class="form-control btn btn-primary" id="create_first_room" value="Submit">
                                    </div>
                                </div>
                            </form>

                            <!-- user having room in user table -->
                            @elseif($count_bet == 4 && $count_bet <> 0 && $count_bet !=2 && $count_bet !=3)
                                <div class="row">
                                    <div class="col-md-12">
                                        <span class="text-light">Room Name : Anonymous</span>
                                        <button class="btn btn-link" id="change_room">Change Room Name</button>




                                     <div class="col-md-12">
                                     <div id="show_room">
                                            <form action="{{route('update.room')}}" method="post">@csrf
                                                <input type="hidden" name="game_id" value="{{$livestream->id}}">

                                                <div class="col-md-6">
                                                    <select name="change_room" id="select_game_room" class="btn btn-primary dropdown-toggle text-light">
                                                        <option value="0" disabled>-Select Room--</option>
                                                        @foreach($user_room_names as $room)
                                                        <option value="{{$room->id}}">{{$room->room_name}}</option>
                                                        @endforeach
                                                        <option value="new_room">New Room</option>
                                                    </select>&nbsp
                                                </div>
                                                <div class="col-md-6 assign_room">
                                                    <input type="submit" name="submit_change_room" id="submit_change_room" class="btn btn-sm btn-primary" value="Submit">
                                                    <input type="button" id="cancel_change_room" class="btn btn-sm btn-secondary" value="Cancel">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- userroom have entry of that user then -->
                                    <div id="show_new_room" class="add_room">
                                        <form action="{{route('select.new.room.update')}}" method="post">@csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="hidden" name="game_id" value="{{basename(request()->path())}}">
                                                    <textarea type="text" name="room_name" class="form-control" placeholder="Enter Room Name only 200 charecter allowed" id="second_new_room_txt"></textarea>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="col-md-6">
                                                        <input type="submit" name="second_new_room" class="btn btn-primary" id="second_new_room_btn" value="Submit">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="button" name="cancel_select_new_room" class="btn btn-secondary" id="cancel_select_new_room" value="cancel">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                </div>
                                <!-- -------------------------------------------- -->

                            @elseif($count_bet == 1 && $count_bet <> 0 && $count_bet !=2)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <span class="text-light">Room Name : {{$current_room_names->game_room->room_name ?? Null}}</span>
                                              <hr>
                                            <button class="btn btn-link" id="change_room">Change Room Name</button>

                                            <div id="show_room">
                                                <form action="{{route('update.room')}}" method="post">@csrf
                                                    <input type="hidden" name="game_id" value="{{$livestream->id}}">
                                                    <input type="hidden" name="game_room_username" value="{{$current_room_names->username}}">
                                                    <div class="col-md-6">
                                                        <select name="change_room" id="select_game_room" class="btn btn-primary dropdown-toggle text-light">
                                                            <option value="0" disabled>-Select Room--</option>
                                                            @foreach(@$user_room_names as $room)
                                                            <option value="{{$room->id}}" {{(@$room->room_name == @$current_room_names->game_room->room_name) ? 'selected' : '' }}>{{$room->room_name}}</option>
                                                            @endforeach
                                                            <option value="new_room">New Room</option>
                                                        </select>&nbsp
                                                    </div>
                                                    <div class="col-md-6 assign_room">
                                                        <input type="submit" name="submit_change_room" id="submit_change_room" class="btn btn-sm btn-primary" value="Submit">
                                                        <input type="button" id="cancel_change_room" class="btn btn-sm btn-secondary" value="Cancel">
                                                    </div>
                                                </form>
                                                </div>



                                        <!-- second new room create -->
                                        <div id="show_new_room" class="add_room">
                                            <form action="{{route('select.new.room.update')}}" method="post">@csrf
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input type="hidden" name="username" value="{{$current_room_names->username}}">
                                                        <input type="hidden" name="room_id" value="{{$current_room_names->game_room->id}}">
                                                        <input type="hidden" name="game_id" value="{{$livestream->id}}">
                                                        <textarea type="text" name="room_name" class="form-control" placeholder="Enter Room Name only 200 charecter allowed" id="second_new_room_txt"></textarea>

                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-md-6">
                                                            <input type="submit" value="Submit" name="second_new_room" class="btn btn-primary" id="second_new_room_btn">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="button" name="cancel_select_new_room" class="btn btn-secondary" id="cancel_select_new_room" value="cancel">
                                                        </div>
                                                    </div>

                                                </div>
                                            </form>
                                        </div>
                                         </div>
                                    </div>
                                    @elseif($count_bet == 3 && $count_bet <> 0 && $count_bet !=2 && $count_bet !=1)
                                        <div class="row">
                                            <div class="col-md-8">
                                                <h5 class="text-light">Room Name: {{$rm_name}}</h5>
                                                  <hr>
                                            </div>
                                        </div>
                                        @else
                                        <div class="row">
                                            <div class="col-md-8">
                                              <span class="text-light">Room Name: Anonymous </span>
                                                <hr>
                                            </div>
                                        </div>
                            @endif



                </div>
                <div class="col-md-4">
                                @if($email !='')
                                    @if($count_label > 0)
                                        <div id="select_game_label">
                                            <form method="post" action="{{route('update.label')}}">@csrf
                                                <div class="row">
                                                    <input type="hidden" name="game_id" value="{{$livestream->id}}">
                                                    <div class="col-md-12">
                                                        <span class="text-light">Select Label</span>
                                                        <hr>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select name="game_label" id="game_label" class="btn btn-primary dropdown-toggle text-light game_label">
                                                            <option value="0" disabled>--Select Label--</option>
                                                            @foreach($chk_label as $label)
                                                            <option value="{{$label->label_game}}" {{($label->label_game == $label_name) ? 'selected' : '' }}>{{substr($label->label_game,0,30)}}</option>

                                                            @endforeach
                                                            <option value="new">New Label</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="hidden" name="game_id" value="{{$livestream->id}}">
                                                        <input type="submit" class="btn btn-primary not_empty_label" name="submit_label" id="submit_label" value="Add Label">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        {{-- hidden game txt label --}}
                                            <div id="txt_game_label">
                                                <form method="post" action="{{route('select.new.label.update')}}">@csrf
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <input type="hidden" name="game_id" value="{{$livestream->id}}">
                                                            <textarea type="text" class="form-control" name="onchange_label_name" placeholder="Enter Label only 200 alphabets" max="200" id="chk_empty_label1"></textarea>
                                                            <span style="color:red;">@error('user_label'){{$message}}@enderror</span>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="submit" id="chk_label1" class="btn btn-primary btn-sm add_label  " name="submit_label" value="Add Label">
                                                            <input type="button" class="btn btn-secondary btn-sm" name="cancel_label" id="cancel_label" value="Cancel">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                    @else
                                            <div class="row">
                                                <form method="post" action="{{route('submit.label')}}">@csrf
                                                    <div class="col-md-8">
                                                        <input type="hidden" name="game_id" value="{{$livestream->id}}">

                                                        <textarea type="text" class="form-control" name="user_label" placeholder="Enter Label only 200 alphabets" max="200"></textarea>
                                                        <span style="color:red;">@error('user_label'){{$message}}@enderror</span>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="submit" class="btn btn-primary " name="submit_label" value="Submit" id="" onclick="check_label()">
                                                    </div>
                                                </form>
                                            </div>
                                    @endif
                                @endif
                </div>
             <hr>
        </div>

    </div>
        {{-- label end --}}

        <div class="col-md-12"  id="active_bet_list">
            <p class="text-light">List of Active Bets <span style="float:right"> Pot Amount : {{ $pot_amount }}<span></p>
            <div style="min-height: 400px">

                <table class="table text-light table-bordered" style="background: black;">
                    <tr>
                        <th style="color: white;">#</th>
                        <th style="color: white;">Bet Type</th>
                        <th style="color: white;">Description</th>
                        <th style="color: white;">For</th>
                        <th style="color: white;">Against</th>
                        <th style="color: white;">Winning Amount</th>
                        <th style="color: white;">No Of. Bets</th>
                        <th style="color: white;">Active Hours</th>
                        <th style="color: white;"> Action</th>

                    </tr>
                    @foreach($active_bets as $key=>$active_bet)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$active_bet->master->description}}</td>
                        <td>{{$active_bet->description}}</td>
                        <td>{{$active_bet->for_text}}</td>
                        <td>{{$active_bet->against_text}}</td>
                        <td>{{$active_bet->betting_amount}}</td>
                        <td>{{$active_bet->bets()->count()}}/{{$setting->no_of_user_can_bet}}</td>
                        <td>{{$active_bet->created_diff}}</td>
                        <td>
						@if($active_bet->is_claim_bet)
							Claimed!!
						@else
						@if($active_bet->is_add_bet)
						<button type="button"  data-id="{{ $active_bet->id }}" class="btn btn-success claim_bet">
                               Claim Bet
                            </button>
						@else
						@if($livestream->status != "stopped")
						@if($livestream->is_declared_result == 0 )
						@if($active_bet->total<$setting->no_of_user_can_bet)
                            <button type="button" data-bet-type="{{$active_bet->master->description}}" data-betting_amount="{{ $active_bet->betting_amount }}" data-vig_amount={{ $setting->vig}} data-against_text="{{ $active_bet->against_text }}" data-for_text="{{ $active_bet->for_text }}" data-description="{{ $active_bet->description }}" data-id="{{ $active_bet->id }}" class="btn btn-primary bet_now_model">
                                Bet now
                            </button>
						@endif
						@endif
						@endif
						@endif
						@endif
                        </td>
                    </tr>
                    @endforeach
                </table>
				{{-- <button type="button" class="btn btn-link float-right" data-toggle="modal" id="show_all_bet" data-bs-target="#activebetsmodal">
                    Show All Bets
                </button> --}}
            </div>
            <br>

        </div>


</div>
</div>

@else
<div class="row">
    <div class="col-md-12">
        <div class="video">
            <h3 class="text-light">{{ $livestream->name }} stream has ended</h3>
        </div>
        <br>
        <div class="container">
            <div class="row justify-content-center">
                <video id="player" class="video-js vjs-default-skin" controls autoplay preload="auto" width="1280" height="720" data-setup='{}' >
                    <source src="https://live-streaming.elo-esports.com/{{ $livestream->stream_id }}.mp4" type="video/mp4" res="9999" label="auto" />
//                    <source src="{{ env('RMPT_STREAMING_URL').'/'.$livestream->stream_id }}.mp4" type="video/mp4" res="9999" label="auto" />
                    <p class="vjs-no-js">To view this video please enable JavaScript, and consider
                        upgrading to
                        a web
                        browser that <a href="https://videojs.com/html5-video-support/" target="_blank">supports
                            HTML5
                            video</a></p>
                </video>


            </div>
        </div>
    </div>
</div>
@endif
@else
<h1 class="text-danger">Stream Not Found.</h1>
@endif


<div class="modal fade" id="exampleModalCentercreate_bet" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <form method="{{url('/save-new_main_bet')}}" id="create_bet_frm">
        @method('POST')
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Create Own Bet</h5>
                </div>

                <div class="modal-body">
					<p>
					<label>Select Betting Amount</label>
					<select name="betting_amount" id="betting_amount" class="empty_select btn btn-primary dropdown-toggle text-light form-control">
					<option value="0" disabled>---</option>
						@foreach($betting_masters as $betting_master)
							<option value="{{$betting_master->id}}">{{$betting_master->betting_amount}}</option>

                                            @endforeach
						<option value="0">Custom</option>
					</select>
					</p>
					<p id="custom_p" style="display:none;">
                        <label>Enter Amount</label>
                        <input type="number" name="custom_amount" id="custom_amount" class="form-control empty_input"  placeholder="Enter Amount" maxlength="100" value="100">

                    </p>
                    <p>
					<label>Description</label>
                        <textarea name="description" id="description" class="form-control empty_input"
                               placeholder="Enter Description" maxlength="220"></textarea>

                                            </p>
					<p>
					<label>Enter   For</label>
                        <input type="text" name="for_text" id="for_text" class="form-control empty_input"
                               placeholder="Enter For" maxlength="100">

					</p>
					<p>
					<label>Enter   Against</label>
                        <input type="text" name="against_text" id="against_text" class="form-control empty_input"
                               placeholder="Enter Against" maxlength="100">

					</p>

                                        </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close_bet_popup" data-dismiss="modal">X</button>
                    <button type="button" value="Submit" class="btn btn-primary" id="submit_new_bet">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>


{{-- bet now modal --}}
<form action="" id="frm_submit">
    <div class="modal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: #d9140d;color: #fff;">
                    <h5 class="modal-title" id="exampleModalLongTitle">Bet Now</h5>
                     <button type="button" style="background:#ffffff;" class="close btn btn-sm btn-default bet_close_model" data-bs-dismiss="modal" aria-label="Close">
                        <span style="color:#000000;" aria-hidden="true">&times;</span>
                    </button>
                    {{-- <button type="button" class="btn btn-danger" style="float:right;" data-bs-dismiss="modal">X</button> --}}
                </div>

                 <div class="modal-body">
                 <div class="row">
                    <div class="col-md-12">
                        <label>Description: </label><br>
                        <p class='p_description'></p>
                    </div>
                    <hr>
                    <div class="col-md-4">

                        <label>Bet Type :   </label><br>
                        <p class='p_bet_type'></p>
                    </div>
                    <div class="col-md-4">

                        <label>For: </label><br>
                        <p class='p_for'></p>

                    </div>

                    <div class="col-md-4">
					<label>Against: </label><br>
					<p class='p_against'></p>
                    </div>
                     <hr>
                    <div class="col-md-4">
					<label>Bet Amount: </label><br>
					<p class='p_amount'></p>
                    </div>
                    <div class="col-md-4">
					<label>Vig Amount: </label><br>
					<p class='p_vig_amount'></p>
                    </div>

                    <div class="col-md-4">
					<label>Total: </label><br>
					<p class='p_total'></p>
                    </div>
                     <hr>
                     <div class="col-md-4">
                     <p>Place Your bet Now</p>
                     </div>
                    <div class="col-md-4">
                   <label><input type="radio" name="bet_on" class="bet_on" checked value="for"> For</label>&nbsp;
                    </div>
                     <div class="col-md-4">
                        <label><input type="radio" name="bet_on" class="bet_on" value="against"> Against</label>&nbsp;
                    </div>
                 </div>
					{{-- <p>
					<label>Description: </label>
					<label class='p_description'></label>
					</p>
					<p>
					<label>For: </label>
					<label class='p_for'></label>
					</p>
					<p>
					<label>Against: </label>
					<label class='p_against'></label>
					</p>
					<p>
					<label>Bet Amount: </label>
					<label class='p_amount'></label>
					</p>
					<p>
					<label>Bet On: </label>
					<label><input type="radio" name="bet_on" class="bet_on" checked value="for"> For</label>&nbsp;
					<label><input type="radio" name="bet_on" class="bet_on" value="against"> Against</label>&nbsp;
					</p>
                    <p>
					<label>Vig Amount: </label>
					<label class='p_vig_amount'></label>
					</p>
					<p>
					<label>Total: </label>
					<label class='p_total'></label>
					</p> --}}
                    </div>
                    <div class="modal-footer">
					<input type="hidden" name="game_id" id="model_game_id" value="{{$livestream->id}}">
					<input type="hidden" name="bet_main_id" id="main_betting_id" value="">
					<input type="hidden" name="vig_amount" id="vig_amount" value="">
					<input type="hidden" name="bet_amount" id="bet_amount" value="">
					<input type="hidden" name="bet_total_amount" id="bet_total_amount" value="">

                        <button type="button" value="Submit" class="btn btn-success" id="submit_bet">Submit</button>
                    </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Purchase ELO</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" id="close_modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body" id="model_body">
                    <div class="mb-3">
                        <label for="purchase_elo" class="form-label">Enter ELO</label>
                        <input type="number" class="form-control" id="purchase_elo" placeholder="How luch ELO you want to purchase?">
                        <small id="calcELO" class="text-muted"></small>
                    </div>
                </div>
                <div class="modal-footer d-inline-block">
                    <div id="paypal-button-container"></div>
                    <div class="col-md-12" id="completion-block" style="margin-bottom: 10px;display: none;">
                        <div class="card">
                            <div class="card-body text-center">
                                <p class="card-text text-success font-weight-bold" id="completion-text"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<input type="hidden" id="game_id" value="{{$livestream->id}}">
<hr>
{{-- Active bets modal --}}
<div class="modal fade" id="activebetsmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header"> I know I only have room for me as your wedding is on loan
                <h5 class="modal-title" id="exampleModalLongTitle">List of All Active Bets</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div style="max-height: 400px">
                    <table class="table table-bordered">
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Description</th>
                            <th>For</th>
                            <th>Against</th>
                            <th>Bet Amount</th>
                            <th> </th>
                        </tr>
                        <tbody id="all_bets">
                        </tbody>
                    </table>
                </div>
                <br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>



@endsection

@section('js')



<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="{{ asset('js/app.js') }}"></script>

{{-- this is bhup paypal AZgZGVtXyfUiH6iXIpdOq3ZGDeGVU92sc7SfiIy9eFhI3c9h3AK9ZY6qfjm-PgY5uLLpq0cw09GFVpmu --}}

  <script src="https://www.paypal.com/sdk/js?client-id={{ \Crypt::decryptString($setting->client_id) }}&currency=USD"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="https://unpkg.com/vue@3.1.1/dist/vue.global.prod.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.2.0/vue-resource.js"></script> --}}


<script>
    window.USER_DETAILS = '{{ auth()->user() }}';



    var game_id = "{{$livestream->id}}";


                 $('#show_all_bet').on('click', function() {
        $("#all_bets").html('');
        $.ajax({
            type: "GET"
            , url: "https://elo-esports.com/show-all-bet/" + game_id
            , dataType: 'JSON'
            , success: function(data) {
                $.each(data.data, function(key, val) {
                    var timestamp = val.created_at
                    var date = new Date(timestamp);
                    // var d = myString = val.created_at .replace(/T/, '');
                    // var dd = myString = val.created_at .replace(/Z/, '');
                    // console.log(dd);

                    var date_time = date.getFullYear() +
                        "-" + (date.getMonth() + 1) +
                        "-" + date.getDate() +
                        " " + date.getHours() +
                        ":" + date.getMinutes() +
                        ":" + date.getSeconds()




                    // console.log();

                    $("#all_bets").append("<tr><td>" + ++key + "</td><td>" + val.user.username + "</td><td>" + val.description + "</td><td>" + val.for_text + "</td><td>" + val.against_text + "</td><td>" + val.betting_amount + "</td><td><button type='button' data-id='" + val.id + "'  class='btn btn-primary bet_now_model' >Bet now</button></td></tr>");
                });

            }
        });
    });
    // Close modal
    $('#close_modal').click(function(e) {
        e.preventDefault();
        $("#myModal").remove();
        //location.reload();
    });
    $('#second_new_room_btn').on('click', function() {
        var second_new_room = $('#second_new_room_txt').val();

        if (second_new_room == '' || second_new_room == null) {
            alert('Please add room name');
            return false;
        }
    });

    $('#chk_label1').on('click', function() {
        var label_name = $('#chk_empty_label1').val();
        if (label_name == '' || label_name == null) {
            alert('Please add Label name');
            return false;
        }
    });

     $('#submit_change_room').on('click', function() {
        var label_name = $('#select_game_room').val();
        if (label_name == '' || label_name == null || label_name == 'new_room') {
            alert('Please select Room ');
            return false;
        }
    });


    function empty_label() {
        let label = $('#game_labe').val();
        if (label == 0) {
            alert('Please select label');
            return false;
        }
    }


    // validation hidden textbox
    function validation() {
        var label = $('.label').val();
        if (label == '') {
            alert('The Label field is required');
            return false;
        }
    }


    // game label change
    $('#txt_game_label').hide();
    $('#game_label').on('change', function() {
        var option = $('#game_label').val();
        // alert(option);
        if (option == 'new') {
            $('#select_game_label').hide();
            $('#txt_game_label').show();
        }
    });


    $('#cancel_label').on('click', function() {
        $('#game_label').prop("selectedIndex", 0);
        $('#select_game_label').show();
        $('#txt_game_label').hide();
    });




    // this shows textarea for new addition of room on change event
    $('#select_game_room').on('change', function() {
        let new_room = $('#select_game_room').val();
        if (new_room == 'new_room') {

            $('#show_new_room').show();
            $('#show_room').hide();
        }
    });

    // update room
    $('#show_room').hide();
    $('#show_new_room').hide();
    $('#change_room').click(function() {
        $('#change_room').hide();
        $('#show_room').show();
    });

    $('#cancel_change_room').click(function() {
        $('#select_game_room').prop("selectedIndex", 0);
        $('#change_room').show();
        $('#show_room').hide();
    });



    $('#cancel_select_new_room').click(function() {
        $('#select_game_room').prop("selectedIndex", 0);
        $('#change_room').show();
        $('#show_new_room').hide();
        $('#show_room').hide();
        //location.reload();
    });





    $(document).ready(function() {


        $('body').on('click', '.bet_on', function() {
			var bet_on=$('.bet_on:checked').val();
			var p_amount=$('#bet_amount').val();
			 $.ajax({
            type: "POST",
            url: "{{url('/calculate_vig')}}",
            data:{
                betting_main_id:$('#main_betting_id').val(),
                game_id:game_id,
				bet_on:bet_on
            },
            dataType:'JSON',
            success: function (data) {
                 var vig =data['vig'];
				 $('#vig_amount').val(vig);
				 var total=parseFloat(p_amount)+parseFloat(vig);
				 $('.p_vig_amount').html(vig);
				 $('.p_total').html(total);
				 $('#bet_total_amount').val(total);

        }
        });



        });
        $('body').on('click', '.claim_bet', function() {
			var id=$(this).attr('data-id');
			 $.ajax({
            type: "POST",
            url: "{{url('/claim_bet')}}",
            data:{
                betting_main_id:id
				, game_id: game_id
            },
            dataType:'JSON',
            success: function (data) {
                alert(data['msg']);
                //location.reload();
				if(data['update_html']==1){
					$('#active_bet_list').html(data['html']);
				}


            }
        });


		});

        $('body').on('click', '.bet_now_model', function() {
            var id=$(this).attr('data-id');
        var bet_on=$('.bet_on:checked').val();

        var p_amount=$(this).attr('data-betting_amount');
        $('#bet_amount').val(p_amount);
        var p_against=$(this).attr('data-against_text');
        var p_for=$(this).attr('data-for_text');
        var p_description=$(this).attr('data-description');
         var p_bet_Type=$(this).attr('data-bet-type');

        $('#main_betting_id').val(id);
        $('.p_amount').html(p_amount);
        $('.p_against').html(p_against);
        $('.p_for').html(p_for);
        $('.p_description').html(p_description);
        $('.p_bet_type').html(p_bet_Type);
        var amount=parseFloat(p_amount);
        $.ajax({
                    type: "POST",
                    url: "{{url('/calculate_vig')}}",
                    data:{
                        betting_main_id:id,
                        game_id:game_id,
                        bet_on:bet_on
                    },
                    dataType:'JSON',
                    success: function (data) {
                        var vig =data['vig'];
                        $('#vig_amount').val(vig);
                        var total=parseFloat(p_amount)+parseFloat(vig);
                        $('.p_vig_amount').html(vig);
                        $('.p_total').html(total);
                        $('#bet_total_amount').val(total);
                        $('#exampleModalCenter').modal('show');
                    }
                });

            });


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        @if($livestream-> type == 'twitch') {
            var options = {
                width: 1100
                , height: 380
                , @if(isset($data['data'][0]['user_login']))
                channel: "{{$data['data'][0]['user_login']}}"
                , @endif
                // Only needed if this page is going to be embedded on other websites
                //parent: ["embed.example.com", "othersite.example.com"]
            };
            var player = new Twitch.Player("SamplePlayerDivID", options);
            player.setVolume(0.5);
        }
        @endif



        $("#purchase_elo").keyup(function() {
            var conversion = "1";
            var val = this.value + ' ELO = ' + conversion * this.value + ' USD';
            $("#calcELO").text(val);
        });

        $('#submit').on('click', function() {
            var bet_amt = $('#bet_amt').val();
            var game_id = $('#game_id').val();

            // alert(bet_amt);
            // ------------------
			var bet_total_amount= Math.round(bet_total_amount)
           if (Number.isInteger(+bet_total_amount)) {
                if (bet_total_amount > 0) {
                    $.ajax({
                        type: "POST"
                        , url: "{{route('bet')}}"
                        , data: {
                            bet_amt: bet_amt
                            , game_id: game_id
                        }
                        , dataType: 'JSON'
                        , success: function(data) {
                            if (data['msg1'] == 0) {
                                alert(data['msg2']);
                                // $('#exampleModalCenter').modal('hide');
                                $('#elo_purchase').show();
                                //location.reload();
                            } else {
                                alert(data['msg2']);
                                // $('#exampleModalCenter').modal('hide');
                                location.reload();
                                // $('#elo_purchase').hide();
                            }

                        }
                    });
                } else {
                    alert('Bet amount must be greater than 0');
                }
            } else {
                alert('Please Enter only Integer value');
            }
        });
$('#betting_amount').on('change', function() {
var val = $(this).val();
var html = $('#betting_amount :selected').text();
if(val=='0')
{
	$('#custom_p').show();
	$('#custom_amount').val('');
}else{
	$('#custom_p').hide();
	$('#custom_amount').val(html);
}
});
$('#submit_bet').on('click', function() {
            var game_id = $('#model_game_id').val();
            var main_betting_id = $('#main_betting_id').val();
            var vig_amount = $('#vig_amount').val();
            var bet_total_amount = $('#bet_total_amount').val();
            var bet_amount = $('#bet_amount').val();
            var bet_on = $('.bet_on:checked').val();
            // alert(bet_amt);
            // ------------------
			var bet_total_amount= Math.round(bet_total_amount)
           if (Number.isInteger(+bet_total_amount)) {
                if (bet_total_amount > 0) {
                    $.ajax({
                        type: "POST"
                        , url: "{{route('bet')}}"
                        , data: {
                            main_betting_id: main_betting_id,
							game_id: game_id,
							vig_amount:vig_amount,
							bet_total_amount:bet_total_amount,
							bet_amount:bet_amount,
							bet_on:bet_on
                        }
                        , dataType: 'JSON'
                        , success: function(data) {
							 if(data['update_html']==1){
								$('#active_bet_list').html(data['html']);
							}
                            if (data['msg1'] == 0) {
                                alert(data['msg2']);
                                 $('#exampleModalCenter').modal('hide');
                                $('#elo_purchase').show();
                                //location.reload();
                            } else {
                                alert(data['msg2']);
                                // $('#exampleModalCenter').modal('hide');
                               // location.reload();

								$('.bet_close_model').trigger("click");

                                // $('#elo_purchase').hide();
                            }
                        }
                    });
                } else {
                    alert('Bet amount must be greater than 0');
                }
            } else {
                alert('Please Enter only Integer value');
            }
        });

        $('body').on('click','#submit_new_bet', function() {

            var betting_id = parseInt($('#betting_amount').val());
            var custom_amount = parseInt($('#custom_amount').val());

            var for_text = $('#for_text').val();
            var against_text = $('#against_text').val();
            var description = $('#description').val();
            var game_id = $('#game_id').val();
            // alert(bet_amt);
            // ------------------
            if (custom_amount > 0) {
				if ((custom_amount > 99)&&(custom_amount < 10001)) {
                if (for_text.length > 0) {
                    if (against_text.length > 0) {
                        if (description.length > 0) {
                            $.ajax({
                                type: "POST"
                                , url: "{{url('/save-new_main_bet')}}"
                                , data: {
                                    betting_id: betting_id
                                    , custom_amount: custom_amount
                                    , for_text: for_text
                                    , against_text: against_text
                                    , game_id: game_id
                                    , description: description
                                }
                                , dataType: 'JSON'
                                , success: function(data) {
									if(data['update_html']==1){
										$('#active_bet_list').html(data['html']);
									}
                                    if (data['msg1'] == 0) {
                                        alert(data['msg2']);
                                        // $('#exampleModalCenter').modal('hide');
                                        $('#elo_purchase').show();
                                        //location.reload();
                                    } else {
                                        alert(data['msg2']);
                                        // $('#exampleModalCenter').modal('hide');
										$('.empty_input').val('');
										$('.empty_input').val('');
										$(".empty_select").val($(".empty_select option").eq(1).val());
                                         $('.close_bet_popup').trigger("click");
										//location.reload();
                                        // $('#elo_purchase').hide();
                                    }



							   }
                            });
                        } else {
                            alert('Please enter description');
                        }
                    } else {
                        alert('Please enter against text');
                    }
                } else {
                    alert('Please enter for text');
                }
            } else {
                alert('Please enter betting amount must be greater than 100 and less than 10000 ');
            } }else {
                alert('Please select betting amount');
            }
        });

        var payment_success = 0;
        var transaction_id = 0;
        var status = 0;
        var base_url = "{{url('/')}}";
        var conversion = "{{$conversion->usd_amt}}";
        var username = "{{Cookie::get('username')}}";
        var purchase_elo = $('#purchase_elo').val();


        console.log("USD:" + purchase_elo);
        console.log("username:" + username);
        var usd_amount = purchase_elo * conversion;


        paypal.Buttons({
            // Sets up the transaction when a payment button is clicked
            createOrder: (data, actions) => {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: $('#purchase_elo').val() * conversion // Can also reference a variable or function
                        }
                    }]
                });
            },
            // Finalize the transaction after payer approval
            onApprove: (data, actions) => {
                return actions.order.capture().then(function(orderData) {
                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    const transaction = orderData.purchase_units[0].payments.captures[0];
                    //alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);


                    //if (transaction.status=='COMPLETED') {
                    transaction_id = transaction.id;
                    status = transaction.status;
                    console.log("inside COMPLETED status");

                    $('#model_body').hide();
                    $('#paypal-button-container').hide();

                    var completion_block = document.getElementById("completion-block");
                    completion_block.style.display = completion_block.style.display === 'none' ? 'block' : 'none';
                    // $('#completion-block').css('display:block');
                    if (transaction.status == 'COMPLETED')
                        $('#completion-text').text("Your payments processed successfully, Payment Status: " + transaction.status);
                    else
                        $('#completion-text').text("Your payments is on hold, Payment Status: " + transaction.status);

                    payment_success = 1;

                    // console.log("APP-URL:"+url('/'));
                    var purchase_elo = $('#purchase_elo').val();

                    console.log("purchase_elo:" + purchase_elo);

                    var usd_amount = purchase_elo * conversion;

                    var param = "?status=" + transaction.status + "&transaction_id=" + transaction.id + "&elo_amount=" + purchase_elo + "&usd_amount=" + usd_amount + "&user_name=" + username;

                    const url = base_url + '/ajax_file.php' + param;

                    // Message to send. In this example an object with a state property.
                    // You can change the properties to whatever you want.

 $.ajax({
						type: "POST",
						url: "{{url('/transfer_paypal_to_wallet')}}",
						data:{
							_token:"{{ csrf_token() }}",
							status: transaction.status
                        , transaction_id: transaction.id
                        , elo_amount: purchase_elo
                        , usd_amount: usd_amount
						},
						dataType:'JSON',
						success: function (data) {
						setTimeout(function() {
                        location.reload();
                    }, 5000);
					}
					});

                });

            }
        }).render('#paypal-button-container');


    });

</script>



@endsection


{{-- axay
Vj1234?!!! --}}


{{-- VJ1234?!!!VJ

ssh root@159.65.150.15 --}}
