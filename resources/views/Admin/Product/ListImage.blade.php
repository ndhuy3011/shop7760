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
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Thêm hình sản phẩm</h6>
                </div>
                <div class="card-body">
                    <form action="{{route('admins.sanpham.image.update',$productid)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-5">
                                <label> Thêm hình:</label>
                                <input type="file" name="hinh[]" id="" class="mx-sm-3 w-50" multiple>
                            </div>
                            <div class="col-md-5">
                                <label for="inlineFormCustomSelect"> Màu sắc:</label>
                                <select class="custom-select mx-sm-3 w-50" id="inlineFormCustomSelect" name="idColor">
                                    @foreach ($color as $item)
                                    <option value="{{$item->idcolorproduct}}" {{$loop->index==0?"selected":""}}>
                                        {{$item->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2"> <button type="submit" class="btn btn-success btn-icon-split">
                                    <span class="text">Thêm hình</span>
                                </button></div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Hình sản phẩm</h6>
                </div>
                <div class="card-body">
                    <table class="table " width="100%" cellspacing="0" id="dataTableList">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên Màu</th>
                                <th>Hình ảnh</th>
                                <th>Xoá</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($image as $item)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$item->tittlecolor}}</td>
                                <td><img src="{{asset("images/product/$item->url")}}" border=3 height=300 width=300></td>
                                <td>
                                    <a href="{{route('admins.sanpham.image.delete',"$item->idimage?id=$productid&path=$item->url")}}"
                                        class="btn btn-danger btn-circle btn-sm">
                                        <i class="fas fa-trash"></i>
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
</div>
@endsection
@section('editor')
@include('admin.pluginjs.datatable')
@endsection
