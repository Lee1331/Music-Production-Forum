@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')

    <div id="app">
        <div class="row">
            <div class="col-12 text-center">
                <h3>Total Amount of...</h3>
                <hr>
            </div>
            <div class="col-md-4 center-block text-center">
                <featured-content-component :tracks="{!! json_encode($featuredTracks)!!}" :articles="{!! json_encode($featuredArticles)!!}" ></featured-content-component>
            </div>
            <div class="col-md-4 center-block text-center">
                <user-data-component :users="{!! json_encode($userCount)!!}" :threads="{!! json_encode($threadCount)!!}" :posts="{!! json_encode($postCount)!!}"></user-data-component>
            </div>
            <div class="col-md-4 center-block text-center">
                <view-data-component :articles="{!! $articleViews!!}" :threads="{!! $threadViews !!}"></view-data-component>
            </div>
        </div>
        <div class="row d-inline">
            <div class="col-12 text-center">
                <hr>
                <h3>Monthly Data for {{$monthName}}</h3>
            </div>
            <div class="row">
                <div class="col-12 center-block text-center">
                    <monthly-data-component :users="{!! json_encode($monthlyUserData)!!}" :articles="{!! json_encode($userCount)!!}"  :threads="{!! json_encode($monthlyThreadData)!!}" :posts="{!! json_encode($monthlyPostData)!!}" :tracks="{!! $monthlyTrackSubmissions !!}"></monthly-data-component>
                </div>
            </div>
        </div>
    </div>

@endsection
