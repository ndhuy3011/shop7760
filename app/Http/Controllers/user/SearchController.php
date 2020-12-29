<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function Search(Request $req){
        $category = DB::table('category')->get();
        $category_products = DB::table('category_products')->get();
        $colorproduct = DB::table('colorproduct')->get();
        $image = DB::table('image')->get();
        $product = DB::table('product')
            ->join('colorproduct', 'colorproduct.productid', '=', 'product.idproduct')
            ->join('image', 'image.colorproductid', '=', 'colorproduct.idcolorproduct')
            
            ->select('product.title', 'product.price', 'image.url as urlimage')
            ->where ('product.title', 'LIKE', "%$req->key%")
            ->groupBy('image.colorproductid')
            ->get();


        return view('page.shop', [
            'image' => $image,
            'product' => $product,
            'category' => $category

        ]);
    }
}
