@extends('layouts.layout')
@extends('master')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header"> <strong>Admin</strong> page</div>

                <div class="card-body">
                    <br>
                    <h3>List of users</h3>
                    <br>
                    <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Impersonate</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                        <td>{{$user->name }}</td>
                        <td>{{$user->email }}</td>
                        <td><a href="{{route('admin.impersonate',$user->id)}}" class="float-left"><button type="button" class="btn btn-success btn-sm">Impersonate</button></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
