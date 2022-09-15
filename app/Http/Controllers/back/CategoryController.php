<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
use App\Models\Category;
use App\Models\System;

class CategoryController extends Controller
{
    public function __construct() {
        @session_start();

        $copyright = System::select('Description')->where('Code','copyright')->first();
        view()->share('copyright',$copyright);

    }

    public function category_list(){
        $Category = Category::where('Status',1)->get();
        return view('Back.category.list', compact('Category'));
    }

    public function category_add(){
        $Category = Category::get();
        return view('Back.category.add', compact('Category'));
    }
    public function category_add_post(Request $request, Category $Category){

            if($request->Name == '' || $request->Status =='' || $request->Sort ==''){
                return redirect('admin/category/add')->with(['flash_level'=>'danger', 'flash_message'=>'Vui lòng điền vào các trường dấu *']);
            };
            $Category->category_name = $request->Name;
            $Category->sort = $request->Sort;
            $Category->alias = $request->Alias;
            $Category->status = $request->Status;
    
            $Flag = $Category->save();
            if ($Flag == true){
                return redirect('admin/category/list') -> with(['flash_level' => 'success', 'flash_message' => 'Thêm mới thành công!']);
            }
            else{
                return redirect('admin/category/list') -> with(['flash_level' => 'error', 'flash_message' => 'Lỗi thêm mới!']);
            }
        // }   
    }
    public function category_edit(Request $request, $id){
        $Category = Category::find($id);
        return view('Back.category.edit', compact('Category'));
    }
    public function category_edit_post(Request $request , $id){
        if($request->Name == '' || $request->Status =='' || $request->Sort ==''){
            return redirect('admin/category/edit')->with(['flash_level'=>'danger', 'flash_message'=>'Vui lòng điền vào các trường dấu *']);
        };
    
        $Category = Category::find($id);
        $Category->category_name = $request->Name;
        $Category->sort = $request->Sort;
        $Category->alias = $request->Alias;
        $Category->status = $request->Status;

        $Flag = $Category->save();
        if ($Flag == true){
            return redirect('admin/category/list') -> with(['flash_level' => 'success', 'flash_message' => 'Cập nhật thành công!']);
        }
        else{
            return redirect('admin/category/list') -> with(['flash_level' => 'error', 'flash_message' => 'Lỗi cập nhật!']);
        }
    }
    public function category_delete(Request $request, $id){
        $Category = Category::find($id);
        $Flag = $Category -> delete();

        if($Flag == true) {
            return redirect('admin/category/list')->with(['flash_level' => 'success', 'flash_message' => 'Xóa thành công !']);
        }
        else {
            return redirect('admin/category/list')->with(['flash_level' => 'danger', 'flash_message' => 'Lỗi xóa nhân viên !']);
        }
    }
}
