@extends('admin.main')

@section('content')
    <div class="card-header mt-2">
        <h3 class="card-title">{{$title}}</h3>
    </div>
    <div class="card-body">
        <div class="mt-2 mb-3">
            <a class="btn" href="admin_add"><i class="fa fa-edit"></i> Thêm tài khoản quản trị</a>
        </div>
    <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Active</th>
            <th>Update</th>
            <th style="width:20px;"></th>
            <th style="width:20px;"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $key => $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->phone}}</td>
                <td>{{$user->address}}</td>
                <td>{!! \App\Helpers\Helper::useractive($user->status) !!}</td>
                <td>{{$user->updated_at}}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="admin_edit/{{ $user->id }}"><i class="fa fa-edit"></i></a>
                </td>
                <td>
                <a class="btn btn-danger btn-sm" href="" onclick="removeRow( {{$user->id }}, 'admin_destroy')"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
@endsection
