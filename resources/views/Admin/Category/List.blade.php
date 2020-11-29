
  @extends('admin')
  @section('pageadmin')
  <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Danh sách danh mục
                </h6>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table "  width="100%" cellspacing="0" id="dataTableList">
                    <thead>
                      <tr>
                        <th>Tên danh mục</th>
                        <th>đường dẫn</th>
                        <th>sắp xếp</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($Category as $item)
                        <tr>
                            <td>{{$item->title}}</td>
                            <td>{{$item->url}}</td>
                            <td>{{$item->sort}}</td>
                            <td>
                            <a href="#" class="btn btn-success btn-circle btn-sm">
                                <i class="fas fa-check"></i>
                              </a>
                            </td>
                            <td>
                            <a href="{{route('admins.danhmuc.update',"$item->url?id=$item->idcategory")}}"class="btn  btn-info btn-circle btn-sm">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                <a href="{{route('admins.danhmuc.delete',"?id=$item->idcategory")}}" class="btn btn-danger btn-circle btn-sm">
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
          <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->
        @endsection
        @section('dataTable')
        @include('Admin.PluginJs.dataTable')
        @endsection
