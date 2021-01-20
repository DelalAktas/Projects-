@extends('layouts.layout')
@extends('master')

@section('content')
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/public/css/style.css" rel="stylesheet">
    <div class="row">
        <div class="col-md-12">
            <br />
            <h3 align="center">Blogs overview</h3>
            <br />
            @foreach($pages as $blog)
                <div class="card padding p-3">
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <img style="width:250px" src="/uploads/avatars/{{$blog->cover_image}}">
                        </div>
                        <div class="col-md-8 col-sm-8">
                            <h3><a href="/pages/{{$blog->id}}">{{$blog->title}}</a></h3>
                            <p><p>{!!str_limit($blog->description,30)!!}</p>
                            <small>Written on {{$blog->created_at}} by {{$blog->user['name']}}</small>
                        </div>
                    </div>

                </div>
            @endforeach
            {{$pages->links()}}
        </div>
    </div>
    <!-- Page Content -->
    <div class="container">

        <hr>

        <!-- Call to Action Section -->
        <div class="row mb-4">
            <div class="col-md-8">
                <p>To see all of the content please go to "See our blogs in depth"</p>
            </div>
        </div>
    </div>
    <br><br><br><br>

@endsection