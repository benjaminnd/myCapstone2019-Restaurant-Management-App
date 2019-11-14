@extends('layouts.masterAdmin')

@section('content')
@include('back')
<div class="row">
    <div class="col-lg-1"></div>
    <div class="col-lg-11">
        <fieldset>
            <legend>Edit transaction {{ $transaction ->id}}</legend>
            <form id="editTransactionForm" action="{{action('TransactionController@update', $transaction->id)}}" method="post">
                {{csrf_field()}}
                {{method_field('PUT')}} 
                <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="name" style="margin-right: 50px;">Name</label>
                                <label><input type="text" class="form-control" id="name" name="name"  value="{{ $transaction->name }}"></label>
                            </div>
                            <div class="form-group">
                                <label for="phone" style="margin-right: 48px;">Phone</label>
                                <label><input type="text" class="form-control" id="phone" name="phone" value="{{ $transaction->phone }}"></label>
                            </div>
                            <div class="form-group">
                                <label for="address" style="margin-right: 33px;">Address</label>
                                <label><input type="text" class="form-control" id="address" name="address" value="{{ $transaction->address }}"></label>
                            </div>
                            <div class="form-group">
                                <label for="date" style="margin-right: 53px;">Date</label>
                                <label><input type="date" class="form-control" id="date" name="date" value="{{ $transaction->date }}"></label>
                            </div>
                            <div class="form-group">
                                <label for="payment_option" style="margin-right: 60px;">Payment type</label> 
                                <div>
                                    <label class="radio-inline"><input type="radio" name="payment_option" value="cash" {{$transaction->payment_option == 'cash' ? 'checked' : ''}}>Cash</label> 
                                    <label class="radio-inline"><input type="radio" name="payment_option" value="debit" {{$transaction->payment_option == 'debit' ? 'checked' : ''}}>Debit</label>
                                    <label class="radio-inline"><input type="radio" name="payment_option" value="credit" {{$transaction->payment_option == 'credit' ? 'checked' : ''}}>Credit</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="total"  style="margin-right: 50px;">Total</label>
                                <label><input type="number" class="form-control" id="total" name="total" value="{{$transaction->total}}" readonly/></label>
                            </div>
                            <div class="form-group">
                                <label><button id="editTransactionSubmit" class="btn btn-success" style="margin-bottom: 50px;">Save</button></label>
                            </div>
                            <input hidden type="text" id="items" name="items" />
                        </div>
                        <div class="col-lg-8">
                        <div class="row">
                                <div class="col-lg-6" style="padding-top: 11px;">
                                    <label>Item</label>
                                    <label>
                                        <select id="addItem">
                                            @foreach($menu_items as $menu_item)
                                                <option value="{{$menu_item->name}}">{{$menu_item->name}}</option>
                                            @endforeach
                                        </select>
                                    </label>
                                </div>
                                <div class="col-lg-6">
                                    <label>Quantity</label>
                                    <label style="width:100px;">
                                        <input type="number" id="quantity" value="1" style="line-height: normal; width: 60%;">
                                    </label>
                                        <a class="btn" id="addItemBtn"><i class="material-icons">add</i></a>
                                </div>
                            </div>
                            <div class="form-group">
                                <div style="max-height:350px;overflow-y:auto; padding: 18px;" class="panel panel-default">
                                    <table id="transactionItems" style="width:100%;" class="table table-striped">
                                        <col width="150">
                                        <col width="100">
                                        <thead class="text-primary">
                                            <th colspan="4">Items</th>
                                            <th>Qty</th>
                                            <th></th>
                                        </thead>
                                        <tbody>
                                            @foreach ($items->items as $item)
                                            <tr>
                                                <td class="itemName" colspan="4">{{$item->name}}</td>
                                                <td class="quantity">{{$item->quantity}}</td>
                                                <td>
                                                    <button class="btn btn-link deleteItem" title="delete"><i class="material-icons text-danger">delete</i></button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
        </fieldset>
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            {{$error}}
            @endforeach
        </div>
        @endif
    </div>
</div>
<script>
        jQuery(function($){
            var total = parseInt($('#total').val());
            var price;
            $.ajax({
                url: "{{route('showprice')}}",
                data: {
                },
                dataType: "json",
                success: function(data){
                    price = data;
                    console.log(price[0]);
                }
            }); 
            var selectedItem = [];
            var quantities = [];
            $('#editTransactionSubmit').click(function(event){
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
                $('#editTransactionForm').submit();
                event.preventDefault();
    
            });
    
            $('#addItemBtn').click(function(){
                var selectedItem = $('#addItem').children("option:selected").val();
                var qTy = $("#quantity").val()
    
                var newRow = '<tr><td class="itemName" colspan="4">' + selectedItem + '</td>' + '<td class="quantity">' + qTy + '</td><td><button class="btn btn-link deleteItem" style="margin-top: 24px;" title="delete"><i class="material-icons text-danger">delete</i></button></td></tr>';
                $("#transactionItems tbody").append(newRow);
                addTotal(selectedItem, qTy);
                event.preventDefault();
            })
    
    
            $('#transactionItems').on('click', '.deleteItem', function(event){
                 var qTy = $(this).parent().prev().html();
                 var selectedItem = $(this).parent().prev().prev().html();
                 console.log(selectedItem);
                 //console.log($(this).parents().find('.quantity').html())
                 //$(this).parents('tr').hide();
            // var newRow = '<tr><td class="itemName" colspan="4">' + selectedItem + '</td>' + '<td>' + qTy + '</td><td><button class="btn btn-link deleteItem" title="delete"><i class="material-icons text-danger">delete</i></button></td></tr>';
            // $("#transactionItems tbody").append(newRow);
                lessTotal(selectedItem, qTy);
                $(this).parent().parent().hide();
                event.preventDefault();
    
            });
            function addTotal(item, quantity){
                var newValue = getPriceByName(item)[0].price * quantity;
                total += newValue;
                $("#editTransactionForm input[id=total]").val(total);
            }
    
            function lessTotal(item, quantity){
                var newValue = getPriceByName(item)[0].price * quantity;
                total -= newValue
                $("#editTransactionForm input[id=total]").val(total);
            }
    
            function getPriceByName(name) {
                return price.filter(function(data){
                    return data.name == name;
                });
            }
            $('#addBtn').click(function(){
                $('#editTransactionForm').show();
                $(this).hide();
            });
    
        });
    </script>
@endsection