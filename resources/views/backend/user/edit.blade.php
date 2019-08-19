@extends('layouts.user')

@section('title', 'Edit Your Account')

@section('content')

    <div class="card">
        <div class="card-body">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-warning" role="alert">{{$error}}</div>
                @endforeach
            @endif

            <form action="{{ action('HomeController@update', ['name' => $user->name]) }}" method="POST" accept="image/gif, image/jpeg, image/png" enctype="multipart/form-data">
                @include('partials.forms.user.edit', [
                    'buttonText' => 'Submit Changes'
                ])
            </form>
        </div>
@endsection
