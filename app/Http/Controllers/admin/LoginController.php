<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index()
    {
        if(Auth::check()){
            return redirect("admins");
        }
        return view("Admin.login");
    }
    public function login(LoginRequest $request)
    {
        // $request->validate([
        //     'email' => ['email:rfc,dns'],
        //     'password' => ['password:api']
        // ]);
        $request->except("_token");
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect("admins");
        } else {
            return view("Admin.login", ["error" => "tài khoản hoặc mật khẩu sai"]);
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect("admins/login");
    }
}
