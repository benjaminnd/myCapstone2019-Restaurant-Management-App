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
                <h2 style="margin-top: 0">Transactions Management</h2>
            @else
                <h2 style="margin-top: 0">Add Transactions</h2>
            @endif
        </div>
        <div class="col-md-5 text-right">
        <form action="{{route('admin.searchTransaction')}}" method="get">
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
        <form id="addTransactionForm" action="{{route('transactions.store')}}" style="width:100%" method="post" {{count($errors) > 0 ? '' : 'hidden'}}>
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="name" style="margin-right: 50px;">Name</label>
                        <label><input type="text" class="form-control" id="name" name="name"  value="{{ old('name') }}"></label>
                    </div>
                    <div class="form-group">
                        <label for="phone" style="margin-right: 48px;">Phone</label>
                        <label><input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}"></label>
                    </div>
                    <div class="form-group">
                        <label for="address" style="margin-right: 33px;;">Address</label>
                        <label><input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}"></label>
                    </div>
                    <div class="form-group">
                        <label for="date" style="margin-right: 53px;">Date</label>
                        <label><input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}"></label>
                    </div>
                    <div class="form-group">
                        <label for="payment_option" style="margin-right: 50px;">Type</label> 
                        <label class="radio-inline"><input type="radio" name="payment_option" value="cash" checked="checked">Cash</label> 
                        <label class="radio-inline"><input type="radio" name="payment_option" value="debit">Debit</label>
                        <label class="radio-inline"><input type="radio" name="payment_option" value="credit">Credit</label>
                    </div>
                    <div class="form-group">
                        <label for="total"  style="margin-right: 50px;">Total</label>
                        <label><input type="number" class="form-control" id="total" name="total" value="0" readonly/></label>
                    </div>
                    <div class="form-group">
                        {{ csrf_field() }} 
                        <label><button id="addTransactionSubmit" class="btn btn-success" style="margin-bottom: 50px;">Add Transaction</button></label>
                        <label><a id="closeBtn" class="btn btn-warning" style="margin-bottom: 50px;" href="/transactions">Close</a></label>   
                    </div>
                    <input hidden type="text" id="items" name="items" />
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-5" style="padding-top: 11px;">
                            <label>Item</label>
                            <label>
                                <select id="addItem">
                                    @foreach($menu_items as $menu_item)
                                        <option value="{{$menu_item->name}}">{{$menu_item->name}}</option>
                                    @endforeach
                                </select>
                            </label>
                        </div>
                        <div class="col-lg-7">
                            <label>Quantity</label>
                            <label style="width:100px;">
                                <input type="number" id="quantity" value="1" style="line-height: normal; width: 60%;">
                            </label>
                                <a class="btn" id="addItemBtn"><i class="material-icons">add</i></a>
                        </div>
                    </div>
                    <div class="form-group">
                        <div id="tableContainer" class="panel panel-default" style="height:350px;overflow-y:auto; padding:18px;" hidden>
                            <table id="transactionItems" style="width:100%;" class="table table-striped">
                                <col width="150">
                                <col width="100">
                                <thead class="text-primary">
                                    <th colspan="4">Items</th>
                                    <th>Qty</th>
                                    <th></th>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="table-responsive">
            <div class="col-md-2 col-md-offset-8 text-right">
                    <a id="addBtn" class="btn" style="{{count($errors) > 0 ? 'display:none;' : ''}}" title="Add transaction"><i class="material-icons">add</i></a>
            </div>
            <table id="transactionsTable" class="table table-hover">
                <thead class="text-primary">
                    <th>Id</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Payment Option</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->id}}</td>
                            <td>{{ $transaction->name }}</td>
                            <td>{{ $transaction->phone }}</td>
                            <td>{{ $transaction->address }}</td>
                            <td>{{ $transaction->date }}</td>
                            <td>{{ $transaction->total }}</td>
                            <td>{{ $transaction->payment_option }}</td>
                            @if(Auth::guard('admin')->check())
                                <td>
                                    <form action="{{'/transactions/'.$transaction->id}}" onsubmit="return confirm('Do you really want to delete this transaction?')"  method="post">
                                        <a href="{{ action('TransactionController@edit', $transaction->id)}}" title="edit"><i class="material-icons md-18">edit</i></a>
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
                <a id="clearBtn" href="/transactions">Clear Filter</a>
            @endif
            {{$transactions->links()}}
        </div>
    </div>
</div>

<script>
    jQuery(function($){
        var total = 0;
        var price;
        var deleteItemClicked = 0;
        $.ajax({
            url: "{{route('showprice')}}",
            data: {
            },
            dataType: "json",
            success: function(data){
                // var resp = $.map(data,function(obj){
                //     console.log(data);
                //     return (obj.name);
                price = data;
                console.log(price[0]);
            }
        }); 
        var selectedItem = [];
        var quantities = [];
        $('#addTransactionSubmit').click(function(event){
            var jsonItems = {"items": []};
            //jsonItems.items.push({"name": "pho", "quantity": 5});
            var table = document.getElementById('transactionItems');
            var rowLength = table.rows.length;
            for(var i = 1; i < rowLength; i++){
                var row = table.rows[i];
                var item = {"name" : row.cells[0].innerHTML, "quantity" : row.cells[1].innerHTML};
                jsonItems.items.push(item);
            }
            console.log(jsonItems);
            $('#items').val(JSON.stringify(jsonItems));
            $('#addTransactionForm').submit();
            event.preventDefault();

        });

        $('#addItemBtn').click(function(){
            $('#tableContainer').show();
            var selectedItem = $('#addItem').children("option:selected").val();
            var qTy = $("#quantity").val()
            var newRow = '<tr><td class="itemName" colspan="4">' + selectedItem + '</td>' + '<td class="quantity">' + qTy + '</td><td><button class="btn btn-link deleteItem" title="delete"><i class="material-icons text-danger">delete</i></button></td></tr>';
            $("#transactionItems tbody").append(newRow);
            addTotal(selectedItem, qTy);
            event.preventDefault();
        })


        $('#transactionItems').on('click', '.deleteItem', function(event){
             var qTy = $(this).parent().prev().html();
             var selectedItem = $(this).parent().prev().prev().html();
            lessTotal(selectedItem, qTy);
            $(this).parent().parent().hide();
            event.preventDefault();
            var table = document.getElementById('transactionItems');
            var rowLength = table.rows.length;
            deleteItemClicked++;
            if(deleteItemClicked == rowLength - 1){
                $('#tableContainer').hide();
            }

        });
        function addTotal(item, quantity){
            var newValue = getPriceByName(item)[0].price * quantity;
            total += newValue;
            $("#addTransactionForm input[id=total]").val(total);
        }

        function lessTotal(item, quantity){
            var newValue = getPriceByName(item)[0].price * quantity;
            total -= newValue
            $("#addTransactionForm input[id=total]").val(total);
        }

        function getPriceByName(name) {
            return price.filter(function(data){
                return data.name == name;
            });
        }
        $('#addBtn').click(function(){
            $('#addTransactionForm').show();
            $(this).hide();
        });


        $('#search').autocomplete({
            source:function(request, response){
                $.ajax({
                    url: "{{route('transactionautocomplete')}}",
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
