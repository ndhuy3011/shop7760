<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="{{asset('style/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet type=" text/css"> <!--
        Custom styles for this template-->
    <link href="{{asset("style/css/sb-admin-2.min.css")}}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row" style="place-content: center;">

                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Chào quản lý</h1>

                                        @if($errors->any())
                                        <div class="alert alert-danger">
                                            <strong>{{$errors->first()}}!</strong>
                                        </div>
                                        @endif

                                    </div>

                                    <form class="needs-validation user" method="post" action="{{url('admins/login')}}"
                                        novalidate>
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user was-validated"
                                                name="email" id="validationCustom01" aria-describedby="emailHelp"
                                                placeholder="Đăng nhập email..." required>
                                            <div class="invalid-feedback">
                                                Vui lòng bạn nhập đúng email
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <input type="password"
                                                class="form-control form-control-user needs-validation " name="password"
                                                id="validationCustom02" placeholder="Mật khẩu..." required>
                                            <div class="invalid-feedback">
                                                Vui lòng bạn nhập password
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Đăng nhập
                                        </button>
                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('style/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('style/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('style/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{asset('style/js/sb-admin-2.min.js')}}"></script>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
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
</body>

</html>
