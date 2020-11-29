<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


define('views', 'Admin.Product.');
class ProductController extends Controller
{
    //
    public function index()
    {
        $sanpham = DB::table('product')
            ->join('colorproduct', 'colorproduct.productid', '=', 'product.idproduct')
            ->select(
                'product.idproduct',
                'product.idproducer',
                'product.title as titleproduct',
                'product.price',
                'product.status',
                'product.discount',
                'colorproduct.idcolorproduct'
            )
            ->groupBy('product.idproduct')
            ->orderByDesc('product.idproduct')
            ->get();
        $image = DB::table('image')
            ->groupBy('colorproductid')
            ->select()
            ->get();
        return  view(views . 'List', [
            'Sanpham' => $sanpham,
            'Image' => $image
        ]);
    }

    /*
        Thêm sản phẩm
    */
    public function insertShow()
    {
        $Category = DB::table('category')->select('idcategory', 'title')->get();
        return  view(views . 'Insert', [
            'Category' => $Category
        ]);
    }
    public function insert(Request $request)
    {
        $request->validate([]);
        $idProduct = DB::table('product')->insertGetId([
            'idproducer' => $request->manhacungcap,
            'title' => $request->tensanpham,
            'price' => $request->giatien,
            'discount' => $request->giagiam ? $request->giagiam : 0,
            'shortintroduction' => $request->motangan,
            'introduce' => $request->mota,
            'url' => Str::slug($request->tensanpham)
        ]);
        DB::table('category_products')->insert([
            'categoryid' => $request->danhmuc,
            'productsid' => $idProduct
        ]);
        $idColor = DB::table('colorproduct')->insertGetId([
            'title' => $request->color,
            'productid' => $idProduct
        ]);
        foreach ($request->hinh as $key => $item) {
            $extension = $item->getClientOriginalExtension();
            $random = Str::random(10);
            $filename = $random . '_' . time() . '.' . $extension;
            $item->storeAs('images/product', $filename);
            DB::table('image')->insert([
                'title' => "product",
                'url' => $filename,
                'colorproductid' => $idColor
            ]);
        }
        foreach ($request->kichthuoc as $key => $item) {
            DB::table('sizeproduct')->insert([
                'colorproductid' => $idColor ? $idColor : 0,
                'title' => $key,
                'amount' => $item
            ]);
        }
        return redirect(route('admins.sanpham.index'));
    }
    public function insertColor(Request $request, $id)
    {
        $idColor = DB::table('colorproduct')->insertGetId([
            'title' => $request->color,
            'productid' => $id
        ]);
        foreach ($request->kichthuoc as $key => $item) {
            DB::table('sizeproduct')->insert([
                'colorproductid' => $idColor ? $idColor : 0,
                'title' => $key,
                'amount' => $item
            ]);
        }
        return redirect(route('admins.sanpham.update', $id));
    }
    /*
        Cập nhập sản phẩm
    */

    public function updateShow($id)
    {
        $Category = DB::table('category')->select('idcategory', 'title')->get();
        $sanpham = DB::table('product')->where('idproduct', '=', $id)->select()->get();
        $color = DB::table('colorproduct')->where('productid', '=', $sanpham[0]->idproduct)->select()->get();
        $array = [];
        foreach ($color as $value) {
            $size = DB::select(
                'SELECT sizeproduct.colorproductid, sizeproduct.idcolorproduct,sizeproduct.amount,sizeproduct.title as sizetitle, colorproduct.title as colortitle
                FROM `colorproduct`
                JOIN sizeproduct On sizeproduct.colorproductid = colorproduct.idcolorproduct
                AND sizeproduct.colorproductid = ? ',
                [$value->idcolorproduct]
            );
            array_push($array, $size);
        }
        $listsize = Arr::flatten($array);
        return view('Admin.Product.Update', [
            'sanpham' => $sanpham,
            'color' => $color,
            'size' => $listsize,
            'Category' => $Category
        ]);
    }
    public function updateProduct(Request $request, $id)
    {
        $check = DB::table('product')->where('idproduct', '=', $id)
            ->update([
                'idproducer' => $request->manhacungcap,
                'title' => $request->tensanpham,
                'price' => $request->giatien,
                'discount' => $request->giagiam,
                'shortintroduction' => $request->motangan,
                'introduce' => $request->mota,
                'url' => Str::slug($request->tensanpham)
            ]);

        $check2 = DB::table('category_products')->where('productsid', '=', $id)->get();
        if ($check2) {
            DB::table('category_products')->insert([
                'categoryid' => $request->danhmuc,
                'productsid' => $id
            ]);
        } else {
            DB::table('category_products')->where('productsid', '=', $id)->update([
                'categoryid' => $request->danhmuc,
                'productsid' => $id
            ]);
        }
        return redirect(route('admins.sanpham.update', $id));
    }
    public function updateNameColor(Request $request, $id)
    {
        $check = DB::table('colorproduct')
            ->where('idcolorproduct', '=', $id)
            ->update([
                'title' => $request->color
            ]);
        return redirect(route('admins.sanpham.update', $request->product));
    }
    public function updateSize(Request $request, $id)
    {
        $check = DB::table('sizeproduct')
            ->where('idcolorproduct', '=', $id)
            ->update([
                'amount' => $request->kichthuoc
            ]);
        return redirect(route('admins.sanpham.update', $request->product));
    }

    /*
        Xoá sản phẩm
    */

    public function delete($id)
    {
        $product = DB::table('product')->select('idproduct')->where('idproduct', '=', $id)->get();
        $color = DB::table('colorproduct')->select('idcolorproduct')->where('productid', '=', $product[0]->idproduct)->get();
        DB::delete('DELETE FROM `image` where `colorproductid` = ?', [$color[0]->idcolorproduct]);
        DB::delete("DELETE FROM `sizeproduct` WHERE `colorproductid` = ?", [$color[0]->idcolorproduct]);
        DB::delete("DELETE FROM `colorproduct` where `idcolorproduct` = ?", [$product[0]->idproduct]);
        DB::delete('DELETE FROM category_products where productsid = ?', [$id]);
        DB::delete("DELETE FROM `product` WHERE `idproduct` = ?", [$id]);
        return redirect(route('admins.sanpham.index'));
    }
    /*
    Xử lý hình ảnh
    */
    public function imageShow($id)
    {
        $dataimage = DB::table('image')
            ->where('colorproduct.productid', '=', $id)
            ->select('image.url', 'image.title', 'image.idimage', 'colorproduct.title as tittlecolor')
            ->join('colorproduct', 'colorproduct.idcolorproduct', '=', 'image.colorproductid')
            ->get();
        $datacolor = DB::table('colorproduct')
            ->where('productid', '=', $id)
            ->get();
        return view(
            'Admin.Product.ListImage',
            [
                'productid' => $id,
                'image' => $dataimage,
                'color' => $datacolor
            ]
        );
    }
    public function updateImage(Request $request, $id)
    {
        foreach ($request->hinh as $item) {
            $extension = $item->getClientOriginalExtension();
            $random = Str::random(10);
            $filename = $random . '_' . time() . '.' . $extension;
            $item->storeAs('images/product', $filename);
            DB::table('image')->insert([
                'title' => "product",
                'url' => $filename,
                'colorproductid' => $request->idColor
            ]);
        }
        return redirect(route('admins.sanpham.image', $id));
    }
    public function deleteImage($id, Request $request)
    {
        $check = Storage::delete("images/product/$request->path");
        if($check){
           DB::delete('DELETE FROM  `image` WHERE idimage = ?', [$id]);
        }
        return redirect(route('admins.sanpham.image', $request->id));
    }
}
