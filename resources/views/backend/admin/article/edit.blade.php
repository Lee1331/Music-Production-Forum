@extends('layouts.admin')

@section('title', 'Edit Article')

@section('content')

<div class="card">
    <div class="card-body">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-warning" role="alert">{{$error}}</div>
            @endforeach
        @endif
            @include('partials.forms.article.edit', [
                'buttonText' => 'Edit Article'
            ])
    </div>
</div>
@endsection
