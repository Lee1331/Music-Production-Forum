@extends('layouts.admin')

@section('title', 'Create User')

@section('content')
    <div class="card">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
            @endif
            <form action="{{ route('user.store') }}" method="POST" role="form">
                @include('partials.forms.user.create', [
                    'buttonText' => 'Add User'
                ])
            </form>
        </div>
    </div>
@endsection
