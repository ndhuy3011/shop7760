@extends('admin')
@section('pageadmin')

<div class="container">
    <div class="card 4">
        <div class="card-header ">
          <h6 class="m-0 font-weight-bold text-primary">Thêm danh mục</h6>
        </div>
        <div class="card-body">
        <form action="{{route('admins.danhmuc.them')}}" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label >Tên danh mục</label>
                        <input type="text" name="Title" id="" class="form-control" >
                    </div>
                    <div class="form-group col-md-2">
                        <label >Sắp xếp</label>
                        <input type="number" name="Sort" id="" class="form-control">
                    </div>
                    <div class="form-group col-md-2">
                        <label >danh mục cha</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="CategoryId">
                            <option value="">Không có</option>
                            @foreach ($Category as $item)
                            <option value="{{$item->idcategory??""}}">{{$item->title??""}}</option>
                            @endforeach
                          </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label >Trạng thái</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck" name="status">
                            <label class="form-check-label" for="gridCheck">
                              Hoạt động
                            </label>
                          </div>
                    </div>



                </div>
                    <button type="submit" class="btn btn-success btn-icon-split">
                        <span class="text">Thêm danh mục</span>
                    </button>
            </form>
        </div>
    </div>
</div>
@endsection
