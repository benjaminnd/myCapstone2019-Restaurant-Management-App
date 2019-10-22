@extends('layouts.masterAdmin')

@section('content')
<div class="row">
    <div class="col-lg-4"></div>
    <div class="col-lg-4">
        <form class="panel panel-default" style="padding:20px;" action="{{action('UserController@update', $user->id)}}" method="post">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <h4>Edit user ID {{ $user ->id}}</h4>
            <div class="form-group">
                
                <label for="name">Name</label>
                <input type="name" name="name" class="form-control" value="{{$user->name}}" placeholder="Name">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="{{$user->email}}" placeholder="Email">    
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="text" name="password" class="form-control" value="{{$user->password}}" placeholder="Password">  
            </div>
            
            <button type="submit" class="btn btn-success">Save</button>
        </form>
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            {{$error}}
            @endforeach
        </div>
        @endif
    </div>
    @include('back')
</div>
@endsection