@extends('admin')
@section('pageadmin')

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách khách hàng</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table " width="100%" cellspacing="0" id="dataTable">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã nhà sản xuất</th>
                            <th>Tên sản phẩm mua</th>
                            <th>giá tiền 1 chiếc</th>
                            <th>Số lượng</th>
                            <th>Tổng tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$item->idproducer}}</td>
                            <td>{{$item->productinfoId}}</td>
                            <td>{{number_format($item->price,0,'','.')}} ₫</td>
                            <td>{{$item->amount}}</td>
                            <td>{{number_format($item->price*$item->amount,0,'','.')}} ₫</td>
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
