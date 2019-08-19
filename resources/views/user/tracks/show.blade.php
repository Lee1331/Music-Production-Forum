
@extends('layouts.user')

@section('title', 'Featured Tracks')

@section('content')
    @include('partials.user.profileBanner')
    @if(empty($tracks->total))
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
    @endif
@endsection
