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
    <form action="{{route('admins.sanpham.them')}}" method="POST" enctype="multipart/form-data" novalidate
        class="needs-validation">
        @csrf
        <div class="row">
            <div class="col-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Sản phẩm</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="" class="col-form-label">Mã nhà cung cấp <span
                                        style="color:red">*</span></label>
                                <input type="text" name="manhacungcap" id="" class="form-control" required>
                                <div class="invalid-feedback">
                                    Vui lòng bạn nhập lại
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="" class="col-form-label">Tên sản phẩm <span
                                        style="color:red">*</span></label>
                                <input type="text" name="tensanpham" id="" class="form-control" required>
                                <div class="invalid-feedback">
                                    Vui lòng bạn nhập lại
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="" class="col-form-label">Danh mục</label>
                                <select class="custom-select mr-sm-4" id="inlineFormCustomSelect" name="danhmuc">
                                    @foreach ($Category as $item)
                                    <option value="{{$item->idcategory}}" {{$loop->index==0?'selected':''}}>
                                        {{$item->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="" class=" col-form-label">Giá tiền <span style="color:red">*</span></label>
                                <input type="number" name="giatien" id="giatien" class="form-control" required min="0"
                                    onkeydown="vailgiatien()">
                                <div class="invalid-feedback">
                                    Vui lòng bạn nhập lại
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="" class=" col-form-label">Giá khuyến mãi</label>
                                <input type="number" name="giagiam" id="" class="form-control" min="0">
                                <div class="invalid-feedback">
                                    Vui lòng sửa lại
                                </div>
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
                                <textarea type="number" name="motangan" id="" class="form-control" required></textarea>
                                <div class="invalid-feedback">
                                    Vui lòng bạn nhập lại
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="" class=" col-form-label">Mô tả chi tiết</label>
                                <textarea id="editor" name="mota" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Màu sắc <span style="color:red">*</span></h6>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <label for="" class=" col-form-label">Tên màu sắc <span style="color:red">*</span></label>
                            <input type="text" name="color" id="" class="form-control" required>
                            <div class="invalid-feedback">
                                Vui lòng bạn nhập lại
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="" class=" col-form-label">Hình ảnh</label>
                                <div class="custom-file">
                                    <input type="file" class="form-control-file" id="exampleFormControlFile1"
                                        multiple="multiple" name="hinh[]" required>
                                    <div class="invalid-feedback">
                                        Vui lòng sửa lại
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="form-group col-md-3">
                                    <button  name="giatien" id="" class="btn btn-info btn-icon-split" style="height: 100%;align-items: center;">Thêm màu sắc</button>
                                </div> --}}
                        </div>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Kích thước <span style="color:red">*</span></h6>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="" class=" col-form-label">S</label>
                                <input type="number" name="kichthuoc[S]" id="" class="form-control" required min="0">
                                <div class="invalid-feedback">
                                    Vui lòng sửa lại
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="" class=" col-form-label">M</label>
                                <input type="number" name="kichthuoc[M]" id="" class="form-control" required min="0">
                                <div class="invalid-feedback">
                                    Vui lòng sửa lại
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="" class=" col-form-label">L</label>
                                <input type="number" name="kichthuoc[L]" id="" class="form-control" required min="0">
                                <div class="invalid-feedback">
                                    Vui lòng sửa lại
                                </div>
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
                    <span class="text">Thêm sản phẩm</span>
                </button>
                <button type="reset" class="btn btn-danger btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-trash"></i>
                    </span>
                    <span class="text">Xoá thông tin</span>
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
@section('editor')
@include('admin.pluginjs.editor')
<script>
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);

    })();

</script>
@endsection
