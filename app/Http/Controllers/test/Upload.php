<?php

namespace App\Http\Controllers\test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class Upload extends Controller
{
    //
    public function index(){
        return view('test');
    }
    public function upload(Request $request){

       $hinh = $request->upload;
        $extension =$hinh->getClientOriginalExtension();
        $name = Str::random(10).'.'.$extension;
        $hinh->storeAs('images',$name);
      
    }
}
