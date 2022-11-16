@extends('admin.main')

@section('content')
    <div class="card-header">
        <h3 class="card-title">{{$title}}</h3>
    </div>
    <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Tên khách hàng</th>
            <th>Số loại sản phẩm</th>
            <th>Thành tiền</th>
            <th>Ngày lập</th>
            <th>Ngày giao</th>
            <th>Chi tiết</th>
            <th style="width:20px;">Xóa</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $key => $order)
            <tr>
                <td>{{$order->id}}</td>
                <td>{{$order->user->name}}</td>
                <td>{{$order->qty}}</td>
                <td>{{$order->total}}</td>
                <td>{{$order->created_at}}</td>
                <td>{{$order->updated_at}}</td>
                <!--<td>
                    <a class="btn btn-info" href="order_detail/{{ $order->id }}">Chi tiết</a>
                </td>-->
                <!--<td><a class='btn btn-info' onclick="details({{ $order->id }}, 'order_detail')">Chi tiết</a></td>-->
                <td><button class='btn btn-info viewdetails' data-id='{{ $order->id }}' >Chi tiết</button></td>

                <td>
                    <a class="btn btn-danger btn-sm" href="" onclick="removeRow({{ $order->id }}, 'order_destroy')"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
    
    <!--{{ $orders->links() }}-->
   @include('admin.modal.order_detail')

   <script type='text/javascript'>
   $(document).ready(function(){

      $('#example1').on('click','.viewdetails',function(){
          var orderid = $(this).attr('data-id');

          if(orderid > 0){

             // AJAX request
             var url = "order_detail/"+orderid;

             // Empty modal data
             $('#tblempinfo tbody').empty();

             $.ajax({
                 url: url,
                 dataType: 'json',
                 success: function(response){

                     // Add employee details
                     $('#tblempinfo tbody').html(response.html);

                     // Display Modal
                     $('#empModal').modal('show'); 
                 }
             });
          }
      });

   });
   </script>

@endsection
