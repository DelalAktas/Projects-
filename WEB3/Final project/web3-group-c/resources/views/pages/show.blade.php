@extends('layouts.layout')
@extends('master')

@section('content')
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/public/css/style.css" rel="stylesheet">
            <h1>{{$pages->title}}</h1>
    <img style="width:250px" src="/uploads/avatars/{{$pages->cover_image}}">
    <br><br>
            <small>Written on {{$pages->created_at}} by {{$pages->user['name']}}</small>
    <div class="container">
        {!!$pages->description!!}
    </div>
    <hr>

    @if(!Auth::guest() && Auth::user()->id == $pages->user_id || session()->has('impersonate')) <!-- || Auth::guard('admin')-->

            <a href="/pages/{{$pages->id}}/edit" class="btn btn-outline-success mr-1">Edit blog</a>

            {!!Form::open(['action' => ['BlogController@destroy', $pages->id],'method' => 'POST', 'class' => 'float-left'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-outline-danger mr-1'])}}
            {!! Form::close() !!}

    @endif
    <br>
    <a href="{{action('BlogController@downloadPDF', $pages->id)}}">Download PDF</a>
@endsection