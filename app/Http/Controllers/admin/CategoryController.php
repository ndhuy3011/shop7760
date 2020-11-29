<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    //
    public function index()
    {
        $Category = DB::table('category')->get();

        return view('Admin.Category.List', [
            'Category' => $Category
        ]);
    }
    public function insertShow()
    {

        $Category = DB::table('category')->get();
        return view('Admin.Category.Insert', [
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
        $delete = DB::delete("delete from category where idcategory = ?", [$request->id]);
        if ($delete == true) {
            return  redirect('./admins/danhmuc');
        } else {
            return "lưu không thành công";
        }
    }
    public function updateShow(Request $request)
    {
        $ListCategory = DB::table('category')->get();
        $Category = DB::table('category')->where('idCategory', $request->id)->get();
        return view('Admin.Category.Update', [
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
