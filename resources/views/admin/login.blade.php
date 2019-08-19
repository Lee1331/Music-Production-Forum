@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Admin Login</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.login.submit') }}">
                            @include('partials.forms.login.login')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

