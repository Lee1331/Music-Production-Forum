@extends('layouts.admin')

@section('title', 'Create Category')

@section('content')

    <div class="card">
            <div class="card-body">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-warning" role="alert">{{$error}}</div>
                    @endforeach
                @endif
                <form action="{{ action('Backend\Admin\ForumCategoryController@store') }}" method="POST" enctype="multipart/form-data">
                    @include('partials.forms.category.create', [
                        'buttonText' => 'Create Category'
                    ])
                </form>
            </div>

@endsection
