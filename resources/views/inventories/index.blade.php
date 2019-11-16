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
            @if(Auth::guard('admin')->check())
            <h2 style="margin-top: 0">Inventories Management</h2>       
            @else
            <h2 style="margin-top: 0">Inventories</h2> 
            @endif
        </div>
        <div class="col-md-5 text-right">
            <form action="{{route('admin.searchInventories')}}" method="get">
                <div class="input-group">
                    <input id="search" type="search" name="search" class="form-control">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true">
                        </span> Search</button>
                    </span>
                </div>
            </form>
            @include('back')
        </div>
    </div>
    <div class="row">
        <form id="addInventoriesForm" action="{{route('inventories.store')}}" style="width:50%" method="post" {{count($errors) > 0 ? '' : 'hidden'}}>
            <div class="form-row">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name"  value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" class="form-control" id="price" name="price" value="{{ old('price') }}"/>
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity') }}">
                </div>
                <div class="form-group">
                    <label for="supplier_id">Supplier ID</label>
                    <input type="number" class="form-control" id="supplier_id" name="supplier_id" value="{{ old('supplier_id') }}">
                </div>
                <div class="form-group">
                    <label for="imported_date">Import Date</label>
                    <input type="date" class="form-control" id="imported_date" name="imported_date" value="{{ old('imported_date') }}">
                </div>
            </div>
            <div class="form-row">
                {{ csrf_field() }} 
                <button type="submit" class="btn btn-success" style="margin-bottom: 50px;">Add Inventory</button>
                <a id="closeBtn" class="btn btn-warning" style="margin-bottom: 50px;" href="/inventories">Close</a>
            </div>
        </form>
    </div>
    < div class="row">
        <div class="table-responsive">
            <div class="col-md-2 col-md-offset-8 text-right">
                @if(Auth::guard('admin')->check())
                    <a id="addBtn" class="btn" style="{{count($errors) > 0 ? 'display:none;' : ''}}" title="Add inventory"><i class="material-icons">add</i></a>
                @endif
            </div>
            <table id="inventoriesTable" class="table table-hover">
                <thead class="text-primary">
                    <th>Id</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Supplier ID</th>
                    <th>Import Date</th>
                </thead>
                <tbody>
                    @foreach ($inventories as $inventory)
                        <tr>
                            <td>{{ $inventory->id}}</td>
                            <td>{{ $inventory->name }}</td>
                            <td>{{ $inventory->price }}</td>
                            <td>{{ $inventory->quantity }}</td>
                            <td>{{ $inventory->supplier_id }}</td>
                            <td>{{ $inventory->imported_date }}</td>
                            @if(Auth::guard('admin')->check())
                                <td>
                                    <form action="{{'/inventories/'.$inventory->id}}" onsubmit="return confirm('Do you really want to delete this inventory?')"  method="post">
                                        <a href="{{ action('InventoryController@edit', $inventory->id)}}" title="edit"><i class="material-icons md-18">edit</i></a>
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
                <a id="clearBtn" href="/inventories">Clear Filter</a>
            @endif
            {{$inventories->links()}}
        </div>
    </>
</div>

<script>
    jQuery(function($){
        //When addBtn is clicked
        $('#addBtn').click(function(){
            $('#addInventoriesForm').show();
            $(this).hide();
        });

        //Search bar autocomplete
        $('#search').autocomplete({
            source:function(request, response){
                $.ajax({
                    url: "{{route('inventoriesautocomplete')}}",
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
