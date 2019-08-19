@extends('layouts.admin')

@section('title', 'Edit Category')

@section('content')
<div class="card">
    <div class="card-body">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-warning" role="alert">{{$error}}</div>
            @endforeach
        @endif

        <form action="{{ action('Backend\Admin\ForumCategoryController@update', ['name' => $category->name]) }}" method="POST" enctype="multipart/form-data">
            @include('partials.forms.category.edit', [
                'buttonText' => 'Edit Category'
            ])
        </form>

    </div>
</div>
@endsection
