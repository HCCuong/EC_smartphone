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
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Active</th>
            <th>Update</th>
            <th style="width:20px;">Khóa</th>
            <th style="width:20px;">Xóa</th>
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
                    <a class="btn btn-primary btn-sm" href="user_edit/{{ $user->id }}">Khóa</a>
                </td>
                <td>
                <a class="btn btn-danger btn-sm" href="" onclick="removeRow( {{$user->id }}, 'admin_destroy')"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
    <!--{{ $users->links() }}-->
@endsection
