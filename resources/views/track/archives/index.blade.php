@extends('layouts.track')

@section('title', 'Archives')

@section('content')
    <div id="tracks">
        <div class="card">
            <div class="card-body">
                <div id="app">
                    <div class="col-12">
                        @if(count($tracksByWeek) > 0)
                            @php
                                $i = 0
                            @endphp
                            @if($i < $weeklyTrackCount)
                                @foreach($tracksByWeek as $week => $tracks)
                                    <div class="d-flex justify-content-center align-items-center">
                                        <h2>Tracks for week {{$week}}</h2>
                                    </div>
                                    @foreach($tracks as $key => $track)
                                        <div class="row justify-content-center">
                                            <waveform-component
                                                :track='{!! json_encode($track->track)!!}'
                                                v-bind:path='{!! json_encode($server.'tracks/'. $track->track)!!}'
                                                :user='{!! json_encode($track->owner->name)!!}'
                                                v-bind:userpath='{!! json_encode($server.'users/'.$track->owner->name)!!}'
                                                :genre='{!! json_encode($track->genre)!!}'
                                                :title='{!! json_encode($track->title)!!}'
                                                :counter='{{$i}}'
                                                v-bind:image='{!! json_encode($track->owner->profile_image)!!}'>
                                            </waveform-component>
                                            @php
                                                $i++
                                            @endphp
                                        </div>
                                        <hr>
                                    @endforeach
                                @endforeach
                            @endif
                        @else
                            <div class="d-flex justify-content-center">
                                <p>No tracks found</p>
                                <hr>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
