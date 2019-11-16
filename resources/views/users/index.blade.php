@extends('layouts.masterAdmin')

@section('content')
@include('successMessage')
@if (count($errors) > 0)
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            {{$error}}
        @endforeach
    </div>
@endif
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6" style="margin-bottom:50px;">
            <h2 style="margin-top: 0">Users Management</h2>
        </div>
        <div class="col-md-5 text-right">
        <form action="{{route('admin.searchUsers')}}" method="get">
                <div class="input-group">
                    <input id="search" type="search" name="search" class="form-control">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true">
                        </span> Search</button>
                    </span>
                </div>
            </form>
        </div>
        @include('back')
    </div>
    <div class="row">
        <div class="container">
        <form id="addUsersForm" action="{{route('users.store')}}" style="width:50%" method="post" {{count($errors) > 0 ? '' : 'hidden'}}>
           <fieldset>
               <legend>Add User</legend>
                {{ csrf_field() }} 
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name"  value="{{ old('name') }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"/>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="password">Password</label>
                        <input type="text" class="form-control" id="password" name="password" value="{{ old('password') }}">
                    </div>
                </div>
                <div class="form-row" style="margin-left: 15px;">
                    <button type="submit" class="btn btn-success" style="margin-bottom: 50px;">Add</button>
                    <a id="closeBtn" class="btn btn-warning" style="margin-bottom: 50px;" href="/users">Close</a>
                </div>
           </fieldset>
        </form>
    </div>
    <div class="row">
        <div class="table-responsive">
            <div class="col-md-2 col-md-offset-8 text-right">
                    <a id="addBtn" class="btn" style="{{count($errors) > 0 ? 'display:none;' : ''}}" title="Add user"><i class="material-icons">add</i></a>
            </div>
            <table id="usersTable" class="table table-hover">
                <thead class="text-primary">
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id}}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <form action="{{'/users/'.$user->id}}" onsubmit="return confirm('Do you really want to delete this user?')"  method="post">
                                    <a href="{{ action('UserController@edit', $user->id)}}" title="edit"><i class="material-icons md-18">edit</i></a>
                                    {{csrf_field()}}
                                    {{method_field('DELETE')}}
                                    <button class="btn btn-link" title="delete"><i class="material-icons text-danger">delete</i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if(isset($searching))
                <a id="clearBtn" href="/users">Clear Filter</a>
            @endif
            {{$users->links()}}
        </div>
    </div>
</div>

<script>
    jQuery(function($){
        $('#addBtn').click(function(){
            $('#addUsersForm').show();
            $(this).hide();
        });

        $('#search').autocomplete({
            source:function(request, response){
                $.ajax({
                    url: "{{route('userautocomplete')}}",
                    data: {
                        search: request.term
                    },
                    dataType: "json",
                    success: function(data){
                        var resp = $.map(data,function(obj){
                            console.log(data);
                            return (obj.name);
                        }); 
            
                        response(resp);
                    }
               }); 
            },
            minLength: 1
        });

        // setTimeout(function() {
        //     $('#successMessage').fadeOut('fast');
        // }, 1500); 

    });
</script>
@endsection
