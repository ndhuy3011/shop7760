@extends('index')

@section('page')
<div class="contact" style="background-color:papayawhip">
<div class="container login" >
    <div class="row">
        <div class="col-5">
            <form class="form"  method="post" action="{{route('login')}}">
                @csrf
                <div class="row">
                    <h2 for="">ĐĂNG NHẬP</h2>
                </div>
                <div class="row">
                <label>Nếu bạn đã có tài khoản</label>
                </div>
                <div class="row">
                    <label>Email:</label>
                </div>
                <div class="row" >
                    <input type="email" name="email" id="" style="border-color:pink;border-radius:5px; width: 100%">
                </div>
                <div class="row">
                    <label>Mật khẩu:</label>
                </div>
                <div class="row">
                    <input type="password" name="password" id="" style=" border-color:pink;border-radius:5px;width: 100%">
                </div>
            <div class="row justify-content-end">   <button type="submit" style="background-color:pink" class="btn btn-light"> ĐĂNG NHẬP</button></div>
            </form>
        </div>
        <div class="col-1" ></div>
        <div class="col-5">
            <form class="form" action="{{route('register')}}" method="post" >
                @csrf
                <div class="row">
                    <h2 for="">ĐĂNG KÝ</h2>
                </div>
                <div class="row">
                <label>Nếu bạn chưa có tài khoản</label>
                </div>
                <div class="row">
                    <label>Tên:</label>
                </div>
                <div class="row">
                    <input type="text" name="name" id="" style="border-color:pink;border-radius:5px;width: 100%">
                </div>
                <div class="row">
                    <label>Email:</label>
                </div>
                <div class="row">
                    <input type="email" name="email" id="" style="border-color:pink;border-radius:5px;width: 100%">
                </div>
                <div class="row">
                    <label>Mật khẩu:</label>
                </div>
                <div class="row">
                    <input type="password" name="password" id="" style="border-color:pink;border-radius:5px;width: 100%">
                </div>
            <div class="row justify-content-end">   <button type="submit" style="background-color:pink" class="btn btn-light"> ĐĂNG KÝ</button></div>
            </form>
        </div>
    </div>
</div>  
@endsection

