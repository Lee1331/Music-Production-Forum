@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')

<div class="card">
    <div class="card-body">
        @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-warning" role="alert">{{$error}}</div>
        @endforeach
        @endif
        <form action="{{ action('Backend\Admin\UserController@update', ['name' => $user->name]) }}" method="POST" accept="image/gif, image/jpeg, image/png" enctype="multipart/form-data">
            @include('partials.forms.user.edit', [
                'buttonText' => 'Edit User'
            ])
        </form>
    </div>
@endsection
