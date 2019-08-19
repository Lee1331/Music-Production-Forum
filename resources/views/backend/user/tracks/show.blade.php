@extends('layouts.user')

@section('title', 'User Accounts')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="media">
                @if($user['profile_image'])
                    <div class="media-left">
                        <div class="col-sm-12 col-md-6 col-lg-3 my-1">
                            <img src="{{asset('images/'. $user->profile_image)}}" alt="{{$user->name}}'s profile image">
                        </div>
                    </div>
                @endif()
                <div class="media-body">
                    <h3 class="media-heading"><a href="#"></a></h3>
                <div class="post-author-count">
                    <h4>{{$user['name']}} | ({{$user['email']}})</h4>
                    <hr>
                    <h4>User since {{$user['email_verified_at']}}</h4>
                </div>
                    <p>{{$user['bio']}}</p>
                </div>
            </div>
        </div>
    </div>

    @include('partials.user.homepageNavbar')

    <div class="row justify-content-md-center">
        <main class="py-4">
            <div class="container-fluid">
                <div class="row">
                    <main role="main" class="col-md-12 ">
                        <div id="app">
                            <div class="col-12">
                                <div class="card">
                                    @foreach($tracks as $track)
                                        <waveform-component
                                            :track='{!! json_encode($track->track)!!}'
                                            v-bind:path='{!! json_encode($server.'tracks/'. $track->track)!!}'
                                            :counter='{{$loop->iteration -1}}'
                                            :user='{!! json_encode($track->owner->name)!!}'
                                            v-bind:userpath='{!! json_encode($server.'users/'.$track->owner->name)!!}'
                                            :genre='{!! json_encode($track->genre)!!}'
                                            :title='{!! json_encode($track->title)!!}'
                                            v-bind:image='{!! json_encode($track->owner->profile_image)!!}'>
                                        </waveform-component>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </main>
    </div>

@endsection
