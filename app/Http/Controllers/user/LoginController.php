<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
   public function index(){
        return view ('page.login');
    }
    public function Register(Request $request){
        
        $Data = $request->validate([
            'email'=>'required',
            'name'=>'required',
            'password'=>'required'
        ]);
       $check =   DB::table('user')->insert([
           'email'=> $Data['email'],
           'password'=>Hash::make($Data['password']) ,
           'name'=>$Data['name']
       ]);
       if($check){
           return redirect('/');
       }else{
           return redirect(route('login'));
       }
    }
    public function Login(Request $request){
        $data = $request->only([
            'email',
            'password'
        ]);

        $token = $request->except(['_token']);

        if(Auth::attempt($token)){
            return redirect('/');
        }else{
            return redirect(route('login'));
        }
    }

    public function Logout() {
		Auth::logout();
        return view('page.home');
	}
}
