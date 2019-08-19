@extends('layouts.admin')

@section('title', 'Create Tag')

@section('content')
    <div class="card">
        <div class="card-body">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-warning" role="alert">{{$error}}</div>
                @endforeach
            @endif
            <form action="{{ action('Backend\Admin\TagController@store') }}" method="POST" enctype="multipart/form-data">
                @include('partials.forms.tag.create', [
                    'buttonText' => 'Create Tag'
                ])
            </form>
        </div>
    </div>
@endsection
