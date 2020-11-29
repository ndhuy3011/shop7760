@extends('admin')
@section('pageadmin')

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách khách hàng</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table " width="100%" cellspacing="0" id="dataTableList">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Email</th>
                            <th>Tên</th>
                            <th>SĐT</th>
                            <th>Điểm</th>
                            <th>Địa chỉ</th>
                            <th>Trạng thái</th>
                            <th>Lịch sử mua hàng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $item)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->numberphone}}</td>
                            <td>{{$item->point}}</td>
                            <td>{{$item->address}}</td>
                            <td>{{$item->status}}</td>
                            <td><a href="#" class="btn btn-info btn-circle btn-sm"><i
                                        class="fas fa-info-circle"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('dataTable',)
@include('Admin.PluginJs.dataTable')
@endsection
