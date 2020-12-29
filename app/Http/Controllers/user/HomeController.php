<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    function index()
    {
        $productnew = DB::table('product')
            ->join('colorproduct', 'colorproduct.productid', '=', 'product.idproduct')
            ->join('image', 'image.colorproductid', '=', 'colorproduct.idcolorproduct')
            ->select('product.url', 'image.url as imageurl', 'product.title', 'product.price')->limit('8')
            ->groupBy('product.idproduct')
            ->inRandomOrder()
            ->get();
        $productHot = DB::table('product')
        ->join('colorproduct', 'colorproduct.productid', '=', 'product.idproduct')
            ->join('image', 'image.colorproductid', '=', 'colorproduct.idcolorproduct')
            ->select('product.url', 'image.url as imageurl', 'product.title', 'product.price')->limit('3')
            ->groupBy('product.idproduct')
            ->inRandomOrder()
            ->get();
        $productbest = DB::table('product')
        ->join('colorproduct', 'colorproduct.productid', '=', 'product.idproduct')
            ->join('image', 'image.colorproductid', '=', 'colorproduct.idcolorproduct')
            ->select('product.url', 'image.url as imageurl', 'product.title', 'product.price')->limit('3')
            ->groupBy('product.idproduct')
            ->inRandomOrder()
            ->get();
        $productfeature = DB::table('product')
        ->join('colorproduct', 'colorproduct.productid', '=', 'product.idproduct')
            ->join('image', 'image.colorproductid', '=', 'colorproduct.idcolorproduct')
            ->select('product.url', 'image.url as imageurl', 'product.title', 'product.price')->limit('3')
            ->groupBy('product.idproduct')
            ->inRandomOrder()
            ->get();

          
        return view('page.home', [
            'new' => $productnew,
            'hot' => $productHot,
            'best' => $productbest,
            'feature' => $productfeature
        ]);
    }
}
