@if($notification->data['user']['profile_image'])
    <img src="{{asset('images/'. $notification->data['user']['profile_image'])}}" alt="{{$notification->data['user']['name']}}'s profile image">
@endif
<a href="{{route('home.show', ['user' => $notification->data['user']['name']])}}">
    {{$notification->data['user']['name']}}
</a>
liked your post '{{$notification->data['post']['title']}}' in

<a href="{{route('forum.show', ['thread' => $notification->data['post']['forum_thread']['title'] ])}}">
    <div id="tooltip">
        <p class="media-heading">
                {{$notification->data['post']['forum_thread']['title']}}
                {{$notification->markAsRead()}}
            </a>
        </p>
        <span id="tooltiptext">Go to thread</span>
    </div>
</a>
