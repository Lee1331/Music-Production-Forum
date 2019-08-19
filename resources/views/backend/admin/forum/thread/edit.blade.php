@extends('layouts.admin')

@section('title', 'Edit Thread')

@section('content')

<div class="card">
    <div class="card-body">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-warning" role="alert">{{$error}}</div>
            @endforeach
        @endif

        <form action="{{ action('Backend\Admin\ForumThreadController@update', $thread->title) }}" method="POST" enctype="multipart/form-data">
            @include('partials.forms.thread.edit', [
                'buttonText' => ' Update Thread'
            ])
        </form>
    </div>
@endsection
