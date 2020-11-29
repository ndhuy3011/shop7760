<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class CartController extends Controller
{
    //
    public function show()
    {
        return view("page.cart");
    }
    public function addCart(Request $request)
    {

        $product = DB::table('product')
            ->where('idproduct', '=', $request->id)->first();
        $color = DB::table('colorproduct')
            ->join("image","image.colorproductid","=","colorproduct.idcolorproduct")
            ->where('colorproduct.idcolorproduct', '=', $request->color)->first();
        $size = DB::table('sizeproduct')
            ->where([
                ['colorproductid', '=', $color->idcolorproduct],
                ['title', '=', $request->size]
            ])->first();
        $name = $product->title . ' / ' . $color->title . ' / ' . $request->size;
        $key =  Str::slug($name);
        $cart = [
            "idproduct" => $product->idproduct,
            "idColor" => $color->idcolorproduct,
            "idSize" => $size->idcolorproduct,
            "Titleproduct" => $name,
            "Amount" => $request->soluong,
            "price" => $product->price,
            "image" => $color->url
        ];
        $request->session()->put("Cart.$key", $cart);
        print_r(session('Cart'));
        return redirect("Cart");
    }
    public function remove(Request $request)
    {
        $request->session()->forget("Cart.$request->key");

        return redirect("Cart");
    }
    public function reset(Request $request)
    {
        $request->session()->forget('Cart');
        return redirect('/');
    }
}
