@if($notification->data['user']['profile_image'])
    <img src="{{asset('images/'. $notification->data['user']['profile_image'])}}" alt="{{$notification->data['user']['name']}}'s profile image">
@endif
<a href="{{route('home.show', ['user' => $notification->data['user']['name']])}}">
    {{$notification->data['user']['name']}}
</a>
replied to your thread

<div id="tooltip">
    <a href="{{route('forum.show', ['thread' => $notification->data['thread']['title'] ])}}">
        <p class="media-heading">
            {{$notification->data['thread']['title']}}
            {{$notification->markAsRead()}}
        </p>
    </a>
    <span id="tooltiptext">Go to thread</span>
</div>
