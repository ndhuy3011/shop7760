<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    //
    public function index()
    {
        $Category = DB::table('category')->get();

        return view('admin.category.list', [
            'Category' => $Category
        ]);
    }
    public function insertShow()
    {

        $Category = DB::table('category')->get();
        return view('admin.category.insert', [
            'Category' => $Category
        ]);
    }
    public function insert(Request $request)
    {
        $insert = DB::insert(
            'insert into category (title, url,sort,categoryid,status)
         values (?,?,?,?,?)',
            [
                $request->Title,
                Str::slug($request->Title),
                $request->Sort,
                $request->CategoryId,
                $request->status == 'on' ? '1' : '0',
            ]
        );
        if ($insert == true) {
            return  redirect('./admins/danhmuc');
        } else {
            return "lưu không thành công";
        }
    }
    public function delete(Request $request)
    {
        DB::beginTransaction();
        try {
            $categoryproducts = DB::table('category_products')->where('categoryid', '=', ' $request->id')->first();
            if (isset($categoryproducts)) {
                DB::rollback();
                return redirect()->back()->withErrors("Danh mục có sản phẩm không xoá được");
            }
            DB::table('category')->where('idcategory', '=', $request->id)->delete();
            Session::flash('Msg', "Xoá thành công");
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors("Danh mục có danh mục con không xoá được");
        };
        return redirect()->back();
    }
    public function updateShow(Request $request)
    {
        $ListCategory = DB::table('category')->get();
        $Category = DB::table('category')->where('idCategory', $request->id)->get();
        return view('admin.category.update', [
            'ListCategory' => $ListCategory,
            'Category' => $Category
        ]);
    }
    public function update(Request $request)
    {

        $update = DB::update(
            'update category set title = ?,url = ?, sort = ?, status = ? ,categoryId = ? where idcategory = ?',
            [
                $request->Title,
                Str::slug($request->Title),
                $request->Sort,
                $request->status == 'on' ? '1' : '0',
                $request->CategoryId,
                $request->id
            ]
        );
        if ($update == true) {
            return  redirect('./admins/danhmuc');
        } else {
            return "lưu không thành công";
        }
    }
}
