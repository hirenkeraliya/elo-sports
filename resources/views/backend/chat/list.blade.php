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