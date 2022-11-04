@extends('admin.main')

@section('content')
    <div class="card-header">
        <h3 class="card-title">{{$title}}</h3>
    </div>
    <div class="card-body">

    <div class="">
        <p>Tên khách hàng: {{$order->user->name}}</p>
        <p>Số loại sản phẩm: {{$order->qty}}</p>
        <p>Thành tiền: {{$order->total}}</p>
        <p>Phương thức thanh toán: {{$order->type}}</p>
        <p>Ghi chú: {{$order->note}}</p>
        <p>Số điện thoại: {{$order->phone}}</p>
        <p>Địa chỉ: {{$order->address}}</p>
        <p>Ngày lập: {{$order->created_at}}</p>
    </div>
    <div>
        <p class="bold"> Danh sách sản phẩm</p>
    <table class="table">
        <thead>
        <tr>
            <th>Order ID</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Update</th>
            <th style="width:20px;"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($order_details as $key => $detail)
            <tr>
                <td>{{$detail->o_id}}</td>
                <td>{{$detail->product->name}}</td>
                <td>{{$detail->qty}}</td>
                <td>{{$detail->product->price}}</td>
                <td>{{$detail->updated_at}}</td>
                <td>
                    <a class="btn btn-danger btn-sm" href="" onclick="removeRow({{ $detail->id }}, 'order_detail_destroy')"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
    </div>
@endsection
