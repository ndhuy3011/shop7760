<!DOCTYPE html>
<html lang="vi">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin - Shop 7760</title>

  <!-- Custom fonts for this template-->
  <link href="{{asset('style/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet type="text/css">
  <!-- Custom styles for this template-->
  <link href="{{asset("style/css/sb-admin-2.min.css")}}" rel="stylesheet">
  <link href="{{asset('style/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <link href="{{asset('style/vendor/datatables/Buttons/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->

@include('Admin.Layout.Navbaradmin')
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">
        @include('Admin.Layout.topbaradmin')

        @yield('pageadmin')
      </div>
      <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  



</body>

  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('style/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('style/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{asset('style/vendor/jquery-easing/jquery.easing.min.js')}}"></script>


  <!-- Page level plugins -->
 @yield('dataTable')



  <!-- Custom scripts for all pages-->
  <script src="{{asset('style/js/sb-admin-2.min.js')}}"></script>
  <!-- ConvertVie-->
    <script src="{{asset('style/js/ConvertVie.js')}}"></script>
  <!-- Page level plugins -->
  {{-- <script src="{{asset('style/vendor/chart.js/Chart.min.js')}}"></script> --}}

  <!-- Page level custom scripts -->
  {{-- <script src="{{asset('style/js/demo/chart-area-demo.js')}}"></script> --}}
  {{-- <script src="{{asset('style/js/demo/chart-pie-demo.js')}}"></script> --}}
@yield('editor')
</html>
