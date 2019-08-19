@extends('layouts.admin')

@section('title', 'Manage Forum Posts')

@section('content')
    <div class="card">
        @if ($errors->any())
            <div class="card-header">
                @foreach ($errors->all() as $error)
                    <div class="alert alert-warning" role="alert">{{$error}}</div>
                @endforeach
            @endif
            @if(session('message'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
            </div>
        @endif
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th>#id</th>
                            <th>Title</th>
                            <th>Body</th>
                            <th>Owner</th>
                            <th>Thread</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{$post->id}}</td>
                                <td>
                                    {{$post->title}}
                                </td>
                                <td>
                                    {{$post->body}}
                                </td>
                                <td>
                                    {{$post->owner->name}}
                                </td>
                                <td>
                                    {{$post->forumThread->title}}
                                </td>
                            <td>
                                <form action="{{ route('admin.post.edit', $post->id) }}" >
                                    <button type="submit">
                                        <i class="fa fa-edit"></i>
                                        {!! csrf_field() !!}
                                    </button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('admin.post.destroy', $post->id) }}" method="POST">
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
            {{$posts->render()}}
        </div>
@endsection
