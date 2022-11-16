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
                <th>Tên danh mục</th>
                <th>Khả dụng</th>
                <th>Ngày cập nhật</th>
                <th style="width:20px;">Sửa</th>
                <th style="width:20px;">Xóa</th>
            </tr>
        </thead>
        <tbody>
            {!! \App\Helpers\Helper::category($categories) !!}
        </tbody>
    </table>
    </div>
    <!--{{ $categories->links() }}-->
@endsection
