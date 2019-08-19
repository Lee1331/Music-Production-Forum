@extends('layouts.forum')

@section('title', 'Home')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Create Forum Thread</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-warning" role="alert">{{$error}}</div>
                @endforeach
            @endif
            <form action="{{ action('ForumThreadController@store') }}" method="POST">
                @include('partials.forms.thread.create', [
                    'buttonText' => 'Create New Thread'
                ])
            </form>
        </div>
    </div>
@endsection
