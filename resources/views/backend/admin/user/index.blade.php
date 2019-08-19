@extends('layouts.admin')

@section('title', 'Manage Users')

@section('content')
    <div class="card">
        <div class="card-header">
            @if ($errors->any())
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
                <a class="nav-link" href="{{route('user.create')}}">
                    <i class="fa fa-users"></i>
                    Create New User
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-fixed">
                    <thead class="thead-light">
                        <tr>
                            <th>#id</th>
                            <th>Email</th>
                            <th>Name</th>
                            <th>Bio</th>
                            <th>Profile Image</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>
                                        {{$user->email}}
                                </td>
                                <td>
                                    <a href="{{url('users/'. $user->name)}}">
                                        {{$user->name}}
                                    </a>
                                </td>
                                <td>{{$user->bio}}</td>
                                <td>
                                    @if( $user->profile_image )
                                        <img src="{{asset('images/'. $user->profile_image)}}" style="width:128px; height:128px;">
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('user.edit', $user->name) }}" >
                                        <button type="submit">
                                            <i class="fa fa-edit"></i>
                                            {!! csrf_field() !!}
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST">
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
            {{$users->render()}}
        </div>
@endsection
