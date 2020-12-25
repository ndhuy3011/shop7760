@extends('admin')
@section('pageadmin')
<!-- Begin Page Content -->
<div class="container-fluid">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if (Session::has('Msg'))
    <div class="alert alert-success">
        <strong>{{Session('Msg')}}</strong>
    </div>
    @endif
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách sản phẩm
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table " width="100%" cellspacing="0" id="dataTableList">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã nhà cung cấp</th>
                            <th>Hình ảnhh</th>
                            <th>Tên</th>
                            <th>giá tiền</th>
                            <th>giá khuyến mãi</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Sanpham as $item)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$item->idproducer}}</td>
                            <td>@foreach ($Image as $itemimage)
                                @if ($itemimage->colorproductid==$item->idcolorproduct)
                                <a href="{{route('admins.sanpham.image',$item->idproduct)}}"
                                   >
                                    <img src="{{asset("images/product/$itemimage->url")}}" border=3 height=100
                                        width=100>
                                </a>
                                @else
                                {{NULL}}
                                @endif
                                @endforeach</td>
                            <td><a href="{{url("sanpham/$item->url")}}"
                                    style="color:#858796;">{{$item->titleproduct}}</a></td>
                            <td>{{number_format($item->price,0,'','.')}} ₫</td>
                            <td>{{number_format($item->discount,0,'','.')}} ₫</td>
                            <td>
                                @if ($item->status==1)

                                <a href="{{route('admin.sanpham.update.status',['id'=>$item->idproduct,'status'=>$item->status])}}" class="btn btn-success btn-circle btn-sm">
                                    <i class="fas fa-check"></i>
                                </a>
                                @elseif($item->status==2)

                                <a href="{{route('admin.sanpham.update.status',['id'=>$item->idproduct,'status'=>$item->status])}}" class="btn btn-warning btn-circle btn-sm">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </a>
                                @else

                                <a href="#" class="btn btn-warning btn-circle btn-sm">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </a>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('admins.sanpham.update',$item->idproduct)}}"
                                    class="btn  btn-info btn-circle btn-sm">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                <a href="{{route('admins.sanpham.xoa',$item->idproduct)}}"
                                    class="btn btn-danger btn-circle btn-sm">
                                    <i class="fas fa-trash"></i>
                                </a>
                                <a href="{{route('admins.sanpham.image',$item->idproduct)}}"
                                    class="btn btn-success btn-circle btn-sm">
                                    <i class="fas fa-image"></i>
                                </a>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
@endsection
@section('dataTable',)
@include('admin.pluginjs.datatable')
@endsection
