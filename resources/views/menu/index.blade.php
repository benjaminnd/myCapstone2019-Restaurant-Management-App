@extends(Auth::guard('admin')->check() ? 'layouts.masterAdmin' : 'layouts.app')

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
            <h2 style="margin-top: 0">Menu Management</h2>
        </div>
        <div class="col-md-5 text-right">
        <form action="{{route('admin.searchMenu')}}" method="get">
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
        <form id="addMenuItemsForm" action="{{route('menuItems.store')}}" style="width:50%" method="post" {{count($errors) > 0 ? '' : 'hidden'}}>
                <div class="form-row">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name"  value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="quantity">Recipe ID</label>
                        <input type="number" class="form-control" id="recipe_id" name="recipe_id" value="{{ old('recipe_id') }}">
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" class="form-control" id="price" name="price" value="{{ old('price') }}"/>
                    </div>
                    <div class="form-group">
                        <label for="item_description">Item Description</label>
                        <input type="text" class="form-control" id="item_description" name="item_description" value="{{ old('quantity') }}">
                    </div>
                    <div class="form-group">
                        <label for="type" style="margin-right: 50px;">Type</label>
                        <label class="radio-inline"><input type="radio" name="type" value="food">Food</label>
                        <label class="radio-inline"><input type="radio" name="type" value="drink">Drink</label>
                    </div>
                    <div class="form-group">
                        <label for="tags" style="margin-right: 15px;">Filter tags</label>
                        <label class="checkbox-inline"><input type="checkbox" name="tags[]" value="spicy">Spicy</label>
                        <label class="checkbox-inline"><input type="checkbox" name="tags[]" value="Halal">Halal</label>
                        <label class="checkbox-inline"><input type="checkbox" name="tags[]" value="vegan">Vegan</label>
                        <label class="checkbox-inline"><input type="checkbox" name="tags[]" value="Vietnamese">Vietnamese</label>
                        <label class="checkbox-inline"><input type="checkbox" name="tags[]" value="seafood">Seafood</label>
                        <label class="checkbox-inline"><input type="checkbox" name="tags[]" value="chinese">Chinese</label>
                    </div>
                </div>
                <div class="form-row">
                    {{ csrf_field() }} 
                    <button type="submit" class="btn btn-success" style="margin-bottom: 50px;">Add</button>
                    <a id="closeBtn" class="btn btn-warning" style="margin-bottom: 50px;" href={{ route('admin.manageMenu', ['showAll'=>$showAll, 'showFood' => $showFood]) }}>Close</a>
                </div>
            </form>
        </table>
    </div>
    <div class="row">
        <ul class="nav nav-tabs" role="tablist" style="margin-bottom: 15px;">
            <li class="{{$showAll ? 'active':''}}"><a href="/admin/menu/1/0">All</a></li>
            <li class="{{$showFood ? 'active':''}}"><a href="/admin/menu/0/1">Food</a></li>
            <li class="{{$showFood || $showAll ? '' : 'active'}}"><a href="/admin/menu/0/0">Drink</a></li>      
        </ul>
        <div class="table-responsive">
            <div class="col-md-2 col-md-offset-8 text-right">
                @if(Auth::guard('admin')->check())
                    <a id="addBtn" class="btn" style="{{count($errors) > 0 ? 'display:none;' : ''}}" title="Add item"><i class="material-icons">add</i></a>
                @endif
            </div>
            <table id="menuItemsTable" class="table table-hover">
                <thead class="text-primary">
                    <th class="dropdown">
                        @if(!$showAll && !$showFood)
                        @else
                        <a class="dropdown-toggle" data-toggle="dropdown">Filter
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href={{ route('admin.filterMenu', ['tag'=>'spicy', 'showAll'=>$showAll, 'showFood' => $showFood]) }}><i class="fas fa-pepper-hot"></i>Spicy</a></li>
                            <li><a href={{ route('admin.filterMenu', ['tag'=>'halal', 'showAll'=>$showAll, 'showFood' => $showFood]) }}><i class="fas fa-mosque"></i>Halal</a></li>
                            <li><a href={{ route('admin.filterMenu', ['tag'=>'seafood', 'showAll'=>$showAll, 'showFood' => $showFood]) }}><i class="fa fa-fish"></i>Seafood</a></li>
                            <li><a href={{ route('admin.filterMenu', ['tag'=>'vegan', 'showAll'=>$showAll, 'showFood' => $showFood]) }}><i class="fas fa-leaf"></i>Vegan</a></li>
                            <li><a href={{ route('admin.filterMenu', ['tag'=>'vietnamese', 'showAll'=>$showAll, 'showFood' => $showFood]) }}><i class="fas fa-flag"></i>Vietnamese</a></li>
                            <li><a href={{ route('admin.filterMenu', ['tag'=>'chinese', 'showAll'=>$showAll, 'showFood' => $showFood]) }}><i class="fas fa-yin-yang"></i>Chinese</a></li>
                            <li><a href={{ route('admin.filterMenu', ['tag'=>'drink', 'showAll'=>$showAll, 'showFood' => $showFood]) }}><i class="fas fa-wine-glass"></i>Drinks</a></li>
                        </ul>
                        @endif
                    </th>
                    <th>Name</th>
                    <th {{($showAll || $showFood) ? '' : 'hidden'}}>Description</th>
                    <th {{($showAll || $showFood) ? '' : 'hidden'}}>Recipe</th>
                    <th>Price</th>
                </thead>
                <tbody>
                    @foreach ($menu_items as $item)
                        @php
                            $halal = str_contains(strtolower($item->tags), 'halal');
                            $spicy = str_contains(strtolower($item->tags), 'spicy');
                            $seafood = str_contains(strtolower($item->tags), 'seafood');
                            $vegan = str_contains(strtolower($item->tags), 'vegan');
                            $chinese = str_contains(strtolower($item->tags), 'chinese');
                            $vietnamese = str_contains(strtolower($item->tags), 'vietnamese');
                            $drink = $item->type == 'drink';

                        @endphp
                        <tr>
                            <td>
                                @if($halal)
                                    <i class="fas fa-mosque" title="halal"></i>
                                @endif
                                @if($spicy)
                                    <i class="fas fa-pepper-hot" title="spicy"></i>
                                @endif
                                @if($seafood)
                                    <i class="fas fa-fish" title="seafood"></i>
                                @endif
                                @if($vegan)
                                    <i class="fas fa-leaf" title="vegan"></i>
                                @endif
                                @if($chinese)
                                    <i class="fas fa-yin-yang" title="chinese"></i>
                                @endif
                                @if($vietnamese)
                                    <i class="fas fa-flag" title="vietnamese"></i>
                                @endif
                                @if($drink)
                                    <i class="fas fa-wine-glass" title="drink"></i>
                                @endif
                            </td>
                            <td>{{ $item->name }}</td>
                            <td {{($showAll || $showFood) ? '' : 'hidden'}}>{{ $item->item_description }}</td>
                            <td {{($showAll || $showFood) ? '' : 'hidden'}}>
                            <a class="btn btn-link showRecipe" data-id="{{$item->recipe_id}}" style="{{$item->type == 'drink' ? 'display:none' : ''}}"><i class="material-icons">menu_book</i></a>  
                            </td>
                            <td>{{ $item->price }}</td>
                            @if(Auth::guard('admin')->check())
                                <td>
                                    <form action="{{'/menuItems/'.$item->id}}" onsubmit="return confirm('Do you really want to delete this menu item?')"  method="post">
                                        <a href="{{ action('MenuItemController@edit', $item->id)}}" title="edit"><i class="material-icons md-18">edit</i></a>
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                        <button class="btn btn-link" title="delete"><i class="material-icons text-danger">delete</i></button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if(isset($searching))
                <a id="clearBtn" href="{{ route('admin.manageMenu', ['showAll'=> $showAll, 'showFood' =>$showFood])}}">Clear Filter</a>
            @endif
            {{$menu_items->links()}}
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" id="recipeModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title"></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <p id="recipeContent">Modal body text goes here.</p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary close" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>

<script>
    jQuery(function($){
        $('#addBtn').click(function(){
            $('#addMenuItemsForm').show();
            $(this).hide();
        });
        $('.showRecipe').click(function(){
            var id = $(this).data("id");
            $.ajax({
                url: "{{route('showrecipe')}}",
                data: {
                    recipe_id: id 
                },
                dataType: "json",
                success: function(data){
                    $('#recipeModal').show();
                    $('.modal-title').html(data[0].name)
                    $('#recipeContent').html(data[0].description)
                    console.log(data[0].description);
                },
                error: function(req, status, error) {
                    console.log('Error');
                }   
            });
        })
        $('.close').click(function(){
            $("#recipeModal").css("display", "none");
        })
        $('#search').autocomplete({
            source:function(request, response){
                $.ajax({
                    url: "{{route('menuautocomplete')}}",
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

    });
</script>
@endsection
