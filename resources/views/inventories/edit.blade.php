@extends('layouts.masterAdmin')

@section('content')
<div class="row">
    <div class="col-lg-4"></div>
    <div class="col-lg-4">
        <form class="panel panel-default" style="padding:20px;" action="{{action('InventoryController@update', $inventory->id)}}" method="post">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <h4>Edit inventory ID {{ $inventory ->id}}</h4>
            <div class="form-row">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name"  value="{{ $inventory ->name }}">
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" class="form-control" id="price" name="price" value="{{ $inventory ->price}}"/>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $inventory ->quantity }}">
                    </div>
                    <div class="form-group">
                        <label for="supplier_id">Supplier ID</label>
                        <input type="number" class="form-control" id="supplier_id" name="supplier_id" value="{{ $inventory ->supplier_id }}">
                    </div>
                    <div class="form-group">
                        <label for="imported_date">Import Date</label>
                        <input type="date" class="form-control" id="imported_date" name="imported_date" value="{{ $inventory ->imported_date}}">
                    </div>
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