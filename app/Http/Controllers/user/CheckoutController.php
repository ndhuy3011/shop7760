<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    //
    public function index()
    {
        if(Session('Cart')){

            return view('page.checkout');
        }else{
            return redirect('/');
        }
    }
    public function checkout(Request $request)
    {
        $sum = 0;
        $Cart = Session('Cart') ?? NULL;
        if ($Cart != NULL) {
            $id = DB::table('invoice')->insertGetId([
                'userid' => Auth::user()->id,
                'address' => $request->diachi,
                'phonenumber' => $request->sodienthoai,
            ]);
            foreach ($Cart as $key => $value) {
                $sum += $value['price'];
                DB::table('invoicedetails')
                    ->insert([
                        'amount' => $value['Amount'],
                        'invoiceid' => $id,
                        'productinfoId' => $value['Titleproduct'],
                        'productIdproduct' => $value['idproduct']
                    ]);
            }
            DB::table('invoice')->update(['totalmoney' => $sum]);
            $request->session()->forget('Cart');
            return redirect('/');
        }else{
            return redirect()->back();
        }
    }
}
