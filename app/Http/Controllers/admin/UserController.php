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
        return view('admin.user.list', [
            'user' => $user,
        ]);
    }
    public function history($id){
        $name = DB::table('user')->where('id','=',$id)->select('name')->first();
        $datainvoice = DB::table('invoice')
        ->where('userid','=',$id)
        ->join('invoicedetails','invoicedetails.invoiceid','=','invoice.idinvoice')
        ->groupBy('invoicedetails.invoiceid')
        ->select('invoice.*')->selectRaw('COUNT(invoicedetails.invoiceid) as soluong')
        ->get();

        return view('admin.user.history',[
            'datainvoice'=>$datainvoice,
            'name'=>$name
        ]);
    }
}
