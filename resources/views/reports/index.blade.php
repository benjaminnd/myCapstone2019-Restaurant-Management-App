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
            <h2 style="margin-top: 0">End of Day Sale Report</h2>
        </div>
        <div class="col-md-5 text-right">
            <form id="filterForm" action="{{route('admin.searchReport')}}" method="get">
                <div class="form-group row">
                    <label for="search" class="col-sm-2 col-form-label" style="margin-top: 9px;">For</label>
                    <div class="col-sm-10">
                        @if(isset($search))
                            <input id="search" type="date" value="{{$search}}" name="search" class="form-control">
                        @else
                            <input id="search" type="date" name="search" class="form-control">
                        @endif
                    </div>
                </div>
            </form>
        </div>
        @include('back')
    </div>
    <div class="row">
        @if(isset($search))
            @if($exist != null)
                <div class="table-responsive">
                    <table id="saleTotal" class="table panel panel-default">
                        <caption class="text-center"><h3><strong>Sale Report<strong><h3></caption>
                        <thead>
                            <tr>
                                <th></th><th></th><th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Food Sold: {{$food}}</strong></td><td></td><td>{{$total_food}}$</td>
                            </tr>
                            <tr>
                                <td><strong>Drink Sold: {{$drink}}</strong></td><td></td><td>{{$total_drink}}$</td>
                            </tr>
                            <tr>
                                <td></td><td></td><td><strong>{{$total_food + $total_drink}}$</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Debit Payments: {{$debit}}</strong></td><td></td><td>{{$total_debit}}$</td>
                            </tr>
                            <tr>
                                <td><strong>Cash Payments: {{$cash}}</strong></td><td></td><td>{{$total_cash}}$</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @else
                <p class="alert alert-danger" style="margin-bottom: 0px; padding: 9px; font-size: 15px;"><strong>No result</strong></p>
            @endif
        @else
            <p class="alert alert-info" style="margin-bottom: 0px; padding: 9px; font-size: 15px;"><strong>Pick a date to show report</strong></p>
        @endif
    </div>
</div>

<script>
    jQuery(function($){
        //Date input change event
        $('#search').on('change', function(){
            $('#filterForm').submit();
        })
    });
</script>
@endsection