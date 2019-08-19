@extends('layouts.track')

@section('title', 'Tracks for week ' . $week)

@section('content')
    <div id="tracks">
        <div class="card">
            <div class="card-body">
                @if(count($tracks) > 0)
                    <div id="app">
                        <div class="col-12">
                        @foreach($tracks as $track)
                            <div class="row justify-content-center">
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
                            </div>
                            <hr>
                        @endforeach
                    @else
                        <div class="d-flex justify-content-center">
                            <p>No tracks found</p>
                            <hr>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
