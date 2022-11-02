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
                <th>Name</th>
                <th>Active</th>
                <th>Update</th>
                <th style="width:20px;"></th>
                <th style="width:20px;"></th>
            </tr>
        </thead>
        <tbody>
            {!! \App\Helpers\Helper::category($categories) !!}
        </tbody>
    </table>
    </div>
    <!--{{ $categories->links() }}-->
@endsection
