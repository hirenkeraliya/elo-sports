<!-- This page chat history list to admin -->
@extends('layout.admin.layout')
@section('title', 'Chat History')
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
<div class="content-wrapper" style="min-height: 419px;">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-3">
                    <h3 class="m-0">Chat History </h3>
                     <h3><span style="font-weight:800;"> Stream Title:</span>{{$streams->name}}</h3>
                </div>
                <div class="col-sm-0">
                    {{-- <form method="get" action="{{url('chat-lists')}}">
                        <div class="row">
                            <div class="col">
                                <div class='input-group date' id='datetimepicker2'>
                                    <input type='text' class="form-control" name="from" value="{{request()->get('from')}}"/>
                                    <input type="hidden" name="livestream_id" value="{{$streams->id}}" />
                                </div>
                            </div>
                            <div class="col">
                                <div class='input-group date' id='datetimepicker2'>
                                    <input type='text' class="form-control" name="to"  value="{{request()->get('to')}}"/>

                                </div>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-primary">Search</div>
                        </div>

                    </form> --}}
                </div>
            </div>
        </div>
    </div>



<section class="content">
    <div class="container-fluid">
      
                            <div class="row">
                                <div class="col-sm-12 col-md-8">
                                </div>
                                    <div class="col-sm-12 col-md-4">
                                        <div class="form-group">
                                            <label>Selecte date range:</label>
                                            <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">  <i class="fa fa-calendar"></i></span>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="reservation">
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-2">
                                    
                                      </div>
                                    </div>
                     <div class="card card-widget">

            <div class="card-footer card-comments">
                @foreach($chats as $key=>$chat)
                @php $img2 = (count($chat->avatars) > 0) ? $chat->avatars[0]->avatar_image :asset('dist/img/user3-128x128.jpg') @endphp
                <div class="card-comment">

                    <img class="img-circle img-sm" src="{{$img2}}" alt="{{ $chat->user->username}}">
                    <div class="comment-text">
                        <span class="username">
                            {{ $chat->user->username}}
                            <span class="text-muted float-right"> {{ $chat->created_at->format('d F Y h:i:s A')}}</span>
                        </span>
                        @if($chat->file_type)
                        <a href="{{ url('storage/'.$chat->file) }}" class="download-btn" title="Download file"
                                        target="_blank">
                                       <button class="btn-sm btn-success"> 
                                        <i class="fa fa-arrow-down"></i>
                                       
                                        </button>
                                    </a>
                        @else
                        {{ $chat->message}}
                        @endif
                    </div>

                </div>
                @endforeach


            </div>

            <div class="card-footer">

            </div>

        </div>



    </div>
</section>

</div>

@endsection
@section('js')
<script>
$('#reservation').daterangepicker()


// attach daterangepicker plugin

    $(document).ready(function() {
        $('#reservation').on('apply.daterangepicker', function(ev, picker) {
            console.log(picker.startDate.format('yyyy-mm-dd H:i:s'),picker.endDate.format('MMMM D, YYYY'));
            var date = {
                            
                        start_date: picker.startDate.subtract(1,'days').format('MMMM D, YYYY')
                            , end_date: picker.endDate.add(1,'days').format('MMMM D, YYYY')

                        }
            var url =baseUrl+'/chat-lists/?start_date='+picker.startDate.format('MMMM D, YYYY')+'&end_date='+picker.endDate.format('MMMM D, YYYY');
            $('#data-tables').DataTable().destroy();
            load_data(url);
                
            
        });

        {{-- $( window ).on( "load",function(){
            var url =baseUrl+'/chat-lists/';
            load_data(url);
        }); --}}
   })
   function load_data(url){
     var id = "{{ $streams->id}}"
       $.ajax({
                url: url+'&livestream_id='+id,
                type: 'GET',
                success: function(data) {
                    console.log(data);
                    $('.card-comments').empty();
                    $('.card-comments').html(data.html)
                }
            });
      
   }

     
</script>

@endsection
