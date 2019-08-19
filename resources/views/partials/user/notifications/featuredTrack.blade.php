Your Track, '{{$notification->data['track']['title']}}', has been featured in this weeks track selection!
<a href="{{route('track')}}">
    Go to this weeks picks
    {{$notification->markAsRead()}}
</a>
