<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Home extends Controller
{
    /*
    Trang của Home
    */
    function index(){
        return view('page.home');
    }
    
}
