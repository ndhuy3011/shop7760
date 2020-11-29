<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    public function index()
    {
        $user = DB::table('user')->get();

        return view('Admin.User.List', [
            'user' => $user,
        ]);
    }
}
