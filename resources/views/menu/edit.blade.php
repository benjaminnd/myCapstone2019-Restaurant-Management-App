@extends('layouts.masterAdmin')

@section('content')
<div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-8">
        <form class="panel panel-default" style="padding:20px;" action="{{action('MenuItemController@update', $item->id)}}" method="post">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <h4>Edit menu item {{ $item ->id}}</h4>
            <div class="form-row">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name"  value="{{ $item->name }}">
                </div>
                <div class="form-group">
                    <label for="recipe_id">Recipe ID</label>
                    <input type="number" class="form-control" id="recipe_id" name="recipe_id" value="{{ $item->recipe_id }}">
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" class="form-control" id="price" name="price" value="{{ $item->price }}"/>
                </div>
                <div class="form-group">
                    <label for="item_description">Item Description</label>
                    <input type="text" class="form-control" id="item_description" name="item_description" value="{{ $item->item_description }}">
                </div>
                <div class="form-group">
                    <label for="type" style="margin-right: 50px;">Type</label>
                    <label class="radio-inline"><input type="radio" name="type"  value="food" {{($item->type == 'food' ? 'checked' : '')}}>Food</label>
                    <label class="radio-inline"><input type="radio" name="type"  value="drink" {{($item->type == 'drink' ? 'checked' : '')}}>Drink</label>
                </div>
                <div class="form-group">
                    <label for="tags" style="margin-right: 15px;">Filter tags</label>
                    <label class="checkbox-inline"><input type="checkbox" name="tags[]" value="spicy" {{str_contains(strtolower($item->tags), 'spicy') ? 'checked' : ''}}>Spicy</label>
                    <label class="checkbox-inline"><input type="checkbox" name="tags[]" value="Halal" {{str_contains(strtolower($item->tags), 'halal') ? 'checked' : ''}}>Halal</label>
                    <label class="checkbox-inline"><input type="checkbox" name="tags[]" value="vegan" {{str_contains(strtolower($item->tags), 'vegan') ? 'checked' : ''}}>Vegan</label>
                    <label class="checkbox-inline"><input type="checkbox" name="tags[]" value="Vietnamese" {{str_contains(strtolower($item->tags), 'vietnamese') ? 'checked' : ''}}>Vietnamese</label>
                    <label class="checkbox-inline"><input type="checkbox" name="tags[]" value="Seafood" {{str_contains(strtolower($item->tags), 'seafood') ? 'checked' : ''}}>Seafood</label>
                    <label class="checkbox-inline"><input type="checkbox" name="tags[]" value="Chinese" {{str_contains(strtolower($item->tags), 'chinese') ? 'checked' : ''}}>Chinese</label>
                </div>
            </div>
            <div class="form-row">
                <button type="submit" class="btn btn-success">Save</button>
            </div>
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