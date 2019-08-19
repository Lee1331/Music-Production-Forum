@extends('layouts.admin')

@section('title', 'Edit Post')

@section('content')
<div class="card">
    <div class="card-body">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-warning" role="alert">{{$error}}</div>
            @endforeach
        @endif
        <form action="{{ action('Backend\Admin\ForumPostController@update', ['id' => $post->id]) }}" method="POST" enctype="multipart/form-data">
            @include('partials.forms.post.edit', [
                'buttonText' => 'Edit Post'
            ])
        </form>
    </div>
</div>
@endsection
