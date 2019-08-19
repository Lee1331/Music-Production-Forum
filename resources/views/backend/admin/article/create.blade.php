@extends('layouts.admin')

@section('title', 'Create Article')

@section('content')
    <div class="card">
        <div class="card-body">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-warning" role="alert">{{$error}}</div>
                @endforeach
            @endif
            <form action="{{ action('Backend\Admin\ArticleController@store') }}" method="POST" enctype="multipart/form-data">
                @include('partials.forms.article.create', [
                    'buttonText' => 'Create Article'
                ])
            </form>
        </div>
    </div>
@endsection
