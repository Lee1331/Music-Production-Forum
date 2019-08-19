@extends('layouts.admin')

@section('title', 'Edit Tag')

@section('content')

<div class="card">
    <div class="card-body">
        @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-warning" role="alert">{{$error}}</div>
        @endforeach
        @endif
        <form action="{{ action('Backend\Admin\TagController@update', ['id' => $tag->id]) }}" method="POST">
            @include('partials.forms.tag.edit', [
                'buttonText' => 'Edit Tag'
            ])
        </form>
    </div>
@endsection
