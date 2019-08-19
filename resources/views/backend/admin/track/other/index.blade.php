@extends('layouts.admin')

@section('title', 'Manage Tracks')

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
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th>#id</th>
                            <th>Artist</th>
                            <th>Title</th>
                            <th>Genre</th>
                            <th>File</th>
                            <th>Week Submitted</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tracks as $track)
                            <tr>
                                <td>{{$track->id}}</td>
                                <td>{{$track->owner->name}}</td>
                                <td>{{$track->title}}</td>
                                <td>{{$track->genre}}</td>
                                <td>
                                    <audio controls>
                                        <source src="{{$server.'tracks/'. $track->track}}" type="audio/ogg">
                                    </audio>
                                </td>
                                <td>{{$track->featured->created_at->format('W')}}</td>

                            <td>
                                <form action="{{ route('admin.track.destroy', $track->id) }}" method="POST">
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
        <div class="card-footer"></div>
@endsection
