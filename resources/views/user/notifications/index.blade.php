@extends('layouts.user')

@section('title', 'Your Notifications')

@section('content')
    <div class="card">
        <div class="card-body">
            @if(!$notifications)
                Empty!
            @else
                @foreach($notifications as $notification)
                    <div class="card">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body">
                                    @include('partials.user.notifications.' . camel_case(class_basename($notification->type)))
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
