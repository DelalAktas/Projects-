@extends('layouts.layout')
@extends('master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <br>
                        <a href="/pages/create" class="btn btn-primary">Create a blog</a>
                        <br>
                        <br>
                        <h3>Your Blogs</h3>
                        @if(count($pages) > 0)
                            <table class="table table-striped">
                                <tr>
                                    <th>Title</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                @foreach($pages as $blog)
                                    <tr>
                                        <td>{{$blog->title}}</td>
                                    <td><a href="/pages/{{$blog->id}}/edit" class="btn btn-primary">Edit</a></td>
                                        <td>
                                            {!!Form::open(['action' => ['BlogController@destroy', $blog->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                            {!!Form::close()!!}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                            <p>You have no blogs</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br><br><br><br><br>
@endsection
