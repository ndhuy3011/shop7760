@extends('admin')
@section('pageadmin')
<div class="container">

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
    <div class="row">
        <div class="col-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Sản phẩm</h6>
                </div>
                <div class="card-body">
                    <form action="{{route('admins.sanpham.update.product',$sanpham->idproduct)}}" method="post">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="" class="col-form-label">Mã nhà cung cấp</label>
                                <input type="text" name="manhacungcap" id="" class="form-control"
                                    value="{{$sanpham->idproducer}}">
                            </div>
                            <div class="form-group col-md-5">
                                <label for="" class="col-form-label">Tên sản phẩm</label>
                                <input type="text" name="tensanpham" id="" class="form-control"
                                    value="{{$sanpham->title}}">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="" class="col-form-label">Danh mục</label>
                                <select class="custom-select mr-sm-4" id="inlineFormCustomSelect" name="danhmuc">
                                    @if (isset($Category_Product))
                                    @foreach ($Category as $item)
                                    <option value="{{$item->idcategory}}"
                                        {{$Category_Product->categoryid==$item->idcategory?'selected':''}}>
                                        {{$item->title}}</option>
                                    @endforeach
                                    @else
                                    @foreach ($Category as $item)
                                    <option value="{{$item->idcategory}}">
                                        {{$item->title}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="" class=" col-form-label">Giá tiền</label>
                                <input type="number" name="giatien" id="" class="form-control"
                                    value="{{$sanpham->price}}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="" class=" col-form-label">Giá khuyến mãi</label>
                                <input type="number" name="giagiam" id="" class="form-control"
                                    value="{{$sanpham->discount}}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="" class="col-form-label">Trạng thái</label>
                                <select class="custom-select mr-sm-4" id="inlineFormCustomSelect" name="trangthai">
                                    <option value="1" selected>Hàng mới</option>
                                    <option value="2">Hàng bình thường</option>
                                </select>
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="" class=" col-form-label">Mô tả ngắn</label>
                                <textarea type="number" name="motangan" id=""
                                    class="form-control"> {{$sanpham->shortintroduction}}</textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="" class=" col-form-label">Mô tả chi tiết</label>
                                <textarea id="editor" name="mota">{{$sanpham->introduce}}</textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-check"></i>
                            </span>
                            <span class="text">Sửa sản phẩm</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Màu sắc</h6>
                </div>
                <div class="card-body">
                    @foreach ($color as $item)
                    <div class="form-row">
                        <label for="" class=" col-form-label">Tên màu hiện tại {{$item->title}}</label>
                    </div>
                    <form
                        action="{{route('admins.sanpham.update.color',$item->idcolorproduct."?product=".$sanpham->idproduct)}}"
                        method="post" class="form">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" name="color" id="" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-icon-split">
                                    <span class="text">sửa màu</span>
                                </button>
                            </div>
                        </div>
                    </form>
                    @endforeach
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Kích thước</h6>
                </div>
                <div class="card-body">
                    @foreach ($size as $value)
                    <form
                        action="{{route('admins.sanpham.update.size',$value->idcolorproduct."?product=".$sanpham->idproduct)}}"
                        method="post" class="form">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="" class=" col-form-label">Size: {{$value->sizetitle}}</label>
                                <input type="number" name="kichthuoc" id="" class="form-control"
                                    value="{{$value->amount}}">
                            </div>
                            <div class="form-group col-6">
                                <label for="" class=" col-form-label">Số lượng hiên tại {{$value->amount}}</label>
                                <button type="submit" class="btn btn-success btn-icon-split form-control">
                                    <span class="text">Sửa số lượng {{$value->colortitle}}</span>
                                </button>
                            </div>
                        </div>
                    </form>
                    @endforeach
                </div>
            </div>
            <form action="{{route('admins.sanpham.themcolor',$sanpham->idproduct)}}" method="post">
                @csrf
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Màu sắc <span style="color:red">*</span></h6>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <label for="" class=" col-form-label">Tên màu sắc <span style="color:red">*</span></label>
                            <input type="text" name="color" id="" class="form-control">

                        </div>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Kích thước <span style="color:red">*</span></h6>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="" class=" col-form-label">S</label>
                                <input type="number" name="kichthuoc[S]" id="" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="" class=" col-form-label">M</label>
                                <input type="number" name="kichthuoc[M]" id="" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="" class=" col-form-label">L</label>
                                <input type="number" name="kichthuoc[L]" id="" class="form-control">
                            </div>
                            {{-- <div class="form-group col-md-3">
                                <label for="" class=" col-form-label"></label>
                                <button  name="giatien" id="" class="btn btn-info btn-icon-split" style="margin-top: 12px;height: 55%;align-items: center;"> thêm kích thước </button>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-check"></i>
                    </span>
                    <span class="text">Thêm màu</span>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
@section('editor')
@include('admin.pluginjs.editor')
@endsection
