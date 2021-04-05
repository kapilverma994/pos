@extends('layouts.admin')

@section('title', 'Product List')
@section('content-header', 'Order List')
@section('content-actions')
<a href="{{route('cart.index')}}" class="btn btn-primary">Open Pos</a>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-7">

            </div>
            <div class="col-md-5">
                <form action="{{route('orders.index')}}" method="get">
                    <div class="row">
                        <div class="col-md-5">
                            <input type="date" name="start_date" class="form-control" value="{{request('start_date')}}">
                        </div>
                        <div class="col-md-5">
                            <input type="date" name="end_date" class="form-control" value="{{request('end_date')}}">
                        </div>
<div class="col-md-2">
    <button class="btn btn-primary">Submit</button>
</div>
                    </div>
                </form>
            </div>

        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    {{-- <th>Image</th> --}}
                    <th>Total</th>
                    <th>Recived Amount</th>
                    {{-- <th>Quantity</th> --}}
                    <th>Status</th>
                    <th>To pay</th>
                    <th>Created At</th>
{{--
                    <th>Actions</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->getCustomerName()}}</td>
                    {{-- <td><img src="{{ Storage::url($order->image) }}" alt="" width="100"></td> --}}
                    <td>Rs {{$order->formattedTotal()}}</td>
                    <td>Rs {{$order->formattedRecivedAmount()}}</td>
                    <td>

                        @if($order->recivedAmount()==0)
<span class="badge badge-danger">Not Paid</span>
@elseif($order->recivedAmount()<$order->total())
<span class="badge badge-warning">Partial</span>
@elseif($order->recivedAmount()==$order->total())
<span class="badge badge-success">Paid</span>
@elseif($order->recivedAmount()>$order->total())
<span class="badge badge-info">Change</span>

                        @endif
                    </td>
                    <td>Rs {{number_format($order->total()-$order->recivedAmount(),2)}}</td>
                    {{-- <td>{{$order->quantity}}</td> --}}

                    <td>{{$order->created_at}}</td>


                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th> </th>
                    {{-- <th>Image</th> --}}
                    <th>Rs {{number_format($total,2)}}</th>
                    <th>Rs {{number_format($recivedAmount,2)}}</th>
                    {{-- <th>Quantity</th> --}}
                    <th></th>
                    {{-- <th>To pay</th> --}}
                    <th> </th>
                </tr>
            </tfoot>
        </table>
        {{ $orders->render() }}
    </div>
</div>
@endsection



