@extends('layouts.track')

@section('title', 'Submit a Track')

@section('content')

@section('content')
    <div class="card">
        <div class="card-body">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-warning" role="alert">{{$error}}</div>
                @endforeach
            @endif
            <form action="{{ action('TrackController@store') }}" method="POST" enctype="multipart/form-data">
                @include('partials.forms.track.submit', [
                    'buttonText' => 'Submit Track'
                ])
            </form>
        </div>
    </div>
@endsection
