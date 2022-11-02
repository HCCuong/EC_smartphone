@extends('admin.main')

@section('content')

    <div class="card-header mt-2">
        <h3 class="card-title">{{$title}}</h3>
    </div>
    <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Tên sản phẩm</th>
            <th>Loại sản phẩm</th>
            <th>Giá</th>
            <th>Tình trạng</th>
            <th>Ngày cập nhật</th>
            <th>Chi tiết</th>
            <th style="width:20px;">Sửa</th>
            <th style="width:20px;">Xóa</th>
        </tr>
        </thead>
        <tbody>
            @foreach($products as $key => $product)
            <tr>
                <td>{{$product->id}}</td>
                <td>{{$product->name}}</td>
                <td>{{$product->category->name}}</td>
                <td>{{$product->price}}</td>
                <td>{!! \App\Helpers\Helper::active($product->active) !!}</td>
                <td>{{$product->updated_at}}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="product_detail/{{ $product->id }}">Xem chi tiết</a>
                </td>
                <td>
                    <a class="btn btn-primary btn-sm" href="product_edit/{{ $product->id }}"><i class="fa fa-edit"></i></a>
                </td>
                <td>
                    <a class="btn btn-danger btn-sm" href="" onclick="removeRow( {{$product->id }}, 'product_destroy')"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    <!--{{ $products->links() }}-->
@endsection
