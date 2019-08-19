@extends('layouts.admin')

@section('title', 'Manage Forum Categories')

@section('content')
    <div class="card">
        <div class="card-header">
            @if($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-warning" role="alert">{{$error}}</div>
                @endforeach
            @endif
            @if(session('message'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
            @endif
            <div class="d-flex justify-content-center">
                <a class="nav-link" href="{{route('admin.category.create')}}">
                    <i class="far fa-clone"></i>
                    Create New Category
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th>#id</th>
                            <th>Name</th>
                            <th>Number of Threads</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>
                                    <a href="{{route('forum.category.show', $category->name)}}">
                                        {{$category->name}}
                                    </a>
                                </td>
                                <td>
                                    {{$category->threads->count()}}
                                </td>
                                <td>
                                    <form action="{{ route('admin.category.edit', $category->name) }}" >
                                        <button type="submit">
                                            <i class="fa fa-edit"></i>
                                            {!! csrf_field() !!}
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{ route('admin.category.destroy', $category->id) }}" method="POST">
                                        <button type="submit">
                                            <i class="fa fa-edit"></i>
                                            {!! csrf_field() !!}
                                            {{ method_field('DELETE') }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            {{$categories->render()}}
        </div>
@endsection
