<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function Product()
    {

        $category = DB::table('category')->get();
        $category_products = DB::table('category_products')->get();
        $colorproduct = DB::table('colorproduct')->get();
        $image = DB::table('image')->get();
        $product = DB::table('product')
            ->join('colorproduct', 'colorproduct.productid', '=', 'product.idproduct')
            ->join('image', 'image.colorproductid', '=', 'colorproduct.idcolorproduct')
            ->groupBy('image.colorproductid')
            ->select('product.title', 'product.price', 'image.url as urlimage', 'product.idproduct','product.url')
            ->get();

        return view('page.shop', [
            'image' => $image,
            'product' => $product,
            'category' => $category

        ]);
    }
    public function showProduct($url)
    {
        $product = DB::table('product')->where('url', '=', $url)->first();
        $color = DB::table('colorproduct')->where('productid','=',$product->idproduct)->get();

        return view(
            'page.details',
            [
                'product' => $product,
                'color' => $color
            ]
        );
    }
    public function Category($url)
    {
        $image = DB::table('image')->get();
        $category = DB::table('category') ->get();
        $product = DB::table('category')
            ->join('category_products', 'category_products.categoryid', '=', 'category.idcategory')
            ->join('product', 'product.idproduct', '=', 'category_products.productsid')
            ->join('colorproduct', 'colorproduct.productid', '=', 'product.idproduct')
            ->join('image', 'image.colorproductid', '=', 'colorproduct.idcolorproduct')
            ->select('product.title', 'product.price', 'image.url as urlimage','category.url')
            ->where('category.url', '=', $url)
            ->get();
        return view('page.category',[
            'image' => $image,
            'product' => $product,
            'category' => $category

        ]); 
    }
}
