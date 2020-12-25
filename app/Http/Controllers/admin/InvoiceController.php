<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    //
    public function NoProcess()
    {
        $data = DB::table('invoice')
            ->join('user', 'user.id', '=', 'invoice.userid')
            ->select('user.name', 'invoice.status', 'invoice.date', 'invoice.address', 'invoice.phonenumber', 'invoice.totalmoney', 'invoice.idinvoice')
            ->whereNotIn('invoice.status', [4])
            ->orderByDesc('invoice.idinvoice')
            ->get();
        return view('admin.invoice.noprocess', [
            'data' => $data
        ]);
    }
    public function handling($id)
    {
        $data = DB::table('invoice')
            ->where('idinvoice', '=', $id)
            ->select('status')->first();

        DB::table('invoice')
            ->where('idinvoice', '=', $id)
            ->update(['status' => ++$data->status]);
        return redirect()->back();
    }
    public function complete()
    {
        $data = DB::table('invoice')
            ->join('user', 'user.id', '=', 'invoice.userid')
            ->select('user.name', 'invoice.status', 'invoice.date', 'invoice.address', 'invoice.phonenumber', 'invoice.totalmoney', 'invoice.idinvoice')
            ->Where('invoice.status', '=', 4)
            ->orderByDesc('invoice.idinvoice')
            ->get();
        return view('admin.invoice.complete', [
            'data' => $data
        ]);
    }
    public function detail($id)
    {
        $data = DB::table('invoicedetails')
            ->join('product','product.idproduct','=','invoicedetails.productIdproduct')
            ->where('invoicedetails.invoiceid','=',$id)
            ->select()
            ->get();

            return view('admin.invoice.detail', [
                'data' => $data
            ]);

    }
}
