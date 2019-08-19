@extends('layouts.admin')

@section('title', 'Manage Forum Threads')

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
                            <th>Views</th>
                            <th>Owner</th>
                            <th>Category</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($threads as $thread)
                            <tr>
                                <td>{{$thread->id}}</td>
                                <td>
                                    <a href="{{route('forum.show', $thread->title)}}">
                                        {{$thread->title}}
                                    </a>
                                </td>
                                <td>
                                    {{$thread->body}}
                                </td>
                                <td>{{$thread->view_count}}</td>
                                <td>{{$thread->owner->name}}</td>
                                <td>{{$thread->category->name}}</td>
                                <td>
                                    <form action="{{ route('thread.edit', $thread->title) }}" >
                                        <button type="submit">
                                            <i class="fa fa-edit"></i>
                                            {!! csrf_field() !!}
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{ route('thread.destroy', $thread->id) }}" method="POST">
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
            {{$threads->render()}}
        </div>
@endsection
