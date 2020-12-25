<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InsertColorProductRequest;
use App\Http\Requests\Admin\InsertProductRequest as AdminInsertProductRequest;
use App\Http\Requests\Admin\UpdateColorRequest;
use App\Http\Requests\Admin\UpdateImageRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Http\Requests\Admin\UpdateSizeRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

define('views', 'admin.product.');
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
                'colorproduct.idcolorproduct',
                'product.url'
            )
            ->groupBy('product.idproduct')
            ->orderByRaw('product.status')
            ->get();
        $image = DB::table('image')
            ->groupBy('colorproductid')
            ->select()
            ->get();

        return  view(views . 'list', [
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
        return  view(views . 'insert', [
            'Category' => $Category
        ]);
    }
    public function insert(AdminInsertProductRequest $request)
    {
        DB::beginTransaction();
        try {
            $idProduct = DB::table('product')->insertGetId([
                'idproducer' => $request->manhacungcap,
                'title' => $request->tensanpham,
                'price' => $request->giatien,
                'discount' => $request->giagiam ? $request->giagiam : 0,
                'shortintroduction' => $request->motangan,
                'introduce' => $request->mota,
                'url' => Str::slug($request->tensanpham),
                'status' => $request->trangthai
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
            DB::commit();
            $request->session()->flash('Msg', "Thêm sản phẩm thành công");
            return redirect()->back();
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors("Thêm sản phẩm không thành công");
        }
        return redirect()->back();
    }
    public function insertColor(InsertColorProductRequest $request, $id)
    {
        DB::beginTransaction();
        try {
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
            DB::commit();
            $request->session()->flash('Msg', "Thêm màu sắc thành công");
            return redirect()->back();
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors("Thềm màu sắc không thành công");
        }
    }
    /*
        Cập nhập sản phẩm
    */

    public function updateShow($id)
    {

        $Category = DB::table('category')
            ->select('idcategory', 'title')
            ->get();
        $Product = DB::table('product')
            ->where('idproduct', '=', $id)
            ->select()
            ->first();
        $Category_Product = DB::table('category_products')
            ->where('productsid', '=', $id)
            ->select()
            ->first();

        $color = DB::table('colorproduct')
            ->where('productid', '=', $id)
            ->select()
            ->get();
        $array = [];
        foreach ($color as $value) {
            $size = DB::select(
                'SELECT sizeproduct.colorproductid, sizeproduct.idcolorproduct,sizeproduct.amount,
                            sizeproduct.title as sizetitle, colorproduct.title as colortitle
                    FROM `colorproduct`
                    JOIN sizeproduct On sizeproduct.colorproductid = colorproduct.idcolorproduct
                    AND sizeproduct.colorproductid = ? ',
                [$value->idcolorproduct]
            );
            array_push($array, $size);
        }
        $listsize = Arr::flatten($array);

        return view('admin.product.update', [
            'sanpham' => $Product,
            'color' => $color,
            'size' => $listsize,
            'Category' => $Category,
            'Category_Product' => $Category_Product
        ]);
    }
    public function updateProduct(UpdateProductRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            DB::table('product')->where('idproduct', '=', $id)
                ->update([
                    'idproducer' => $request->manhacungcap,
                    'title' => $request->tensanpham,
                    'price' => $request->giatien,
                    'discount' => $request->giagiam,
                    'shortintroduction' => $request->motangan,
                    'introduce' => $request->mota,
                    'url' => Str::slug($request->tensanpham),
                    'status' => $request->trangthai
                ]);

            $insertCategory = DB::table('category_products')->where('productsid', '=', $id)->update([
                'categoryid' => $request->danhmuc,
            ]);
            if ($insertCategory == 0) {
                DB::table('category_products')->insert([
                    'productsid' => $id,
                    'categoryid' => $request->danhmuc
                ]);
            }
            DB::commit();
            $request->session()->flash('Msg', "Cập nhập thông tin thành công");
            return redirect()->back();
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors('Cập nhập sản phẩm không thành công');
        }
        return redirect()->back();
    }
    public function updateNameColor(UpdateColorRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            DB::table('colorproduct')
                ->where('idcolorproduct', '=', $id)
                ->update([
                    'title' => $request->color
                ]);
            DB::commit();
            $request->session()->flash('Msg', "Cập nhập tên màu thành công");
            return redirect()->back();
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors('Cập nhập tên màu sắc không thành công');
        }
        return redirect()->back();
    }
    public function updateSize(UpdateSizeRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            DB::table('sizeproduct')
                ->where('idcolorproduct', '=', $id)
                ->update([
                    'amount' => $request->kichthuoc
                ]);
            DB::commit();
            $request->session()->flash('Msg', "Cập nhập số lượng thành công");
            return redirect()->back();
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors("cập nhập số lượng không thành công");
        }
        return redirect()->back();
    }
    public function updateStatus(Request $request,$id){
        DB::beginTransaction();
        try{
            DB::table('product')->where(
                'idproduct','=',$id,
            )->update([
                'status'=>$request->status==1?2:1,
            ]);
            DB::commit();
        }catch(Exception $e){
            DB::rollback();
        }
        return redirect()->back();
    }
    /*
        Xoá sản phẩm
    */

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $color = DB::table('colorproduct')->select('idcolorproduct')->where('productid', '=', $id)->first();
            $image = DB::table('image')->select('url')->where('colorproductid', '=', $color->idcolorproduct)->get();
            DB::table('product')->where('idproduct', '=', $id)->delete();
            DB::commit();
            foreach ($image as $value) {
                Storage::delete("images/product/$value->url");
            }
            Session::flash('Msg', "Xoá thành công");
            return redirect()->back();
        } catch (Exception $e) {
            DB::rollback();
            DB::table('product')->where('idproduct', '=', $id)->update([
                'status' => 2
            ]);
            return redirect()->back()->withErrors('Không được xoá, chuyển về ngừng kinh doanh sản phẩm đã được bán');
        }
        return redirect()->back();
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
            'admin.product.listimage',
            [
                'productid' => $id,
                'image' => $dataimage,
                'color' => $datacolor
            ]
        );
    }
    public function updateImage(UpdateImageRequest $request)
    {

        foreach ($request->hinh as $item) {
            $extension = $item->getClientOriginalExtension();
            $random = Str::random(10);
            $filename = $random . '_' . time() . '.' . $extension;
            DB::table('image')->insert([
                'title' => "product",
                'url' => $filename,
                'colorproductid' => $request->idColor
            ]);
            $item->storeAs('images/product', $filename);
        }
        Session::flash('Msg', "Thêm thành công");
        return redirect()->back();
    }
    public function deleteImage($id, Request $request)
    {
        DB::beginTransaction();
        try {
            DB::delete('DELETE FROM  `image` WHERE idimage = ?', [$id]);
            DB::commit();
            Storage::delete("images/product/$request->path");
        } catch (Exception $e) {
            DB::rollback();
        }
        Session::flash('Msg', "Xoá thành công");
        return redirect()->back();
    }
}
