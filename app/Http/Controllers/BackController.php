<?php

namespace App\Http\Controllers;

use DB;
use File;
use Image;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserLevel;
use App\Models\System;
use App\Models\Social;
use App\Models\Shopletter;

class BackController extends Controller
{
    public function __construct() {
        @session_start();

        $copyright = System::select('Description')->where('Code','copyright')->first();
        view()->share('copyright',$copyright);

    }
    public function home(){
        return view('Back.home.home');
    }
    public function uploadImage(Request $request){
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
    
            $request->file('upload')->move('public/images/media',$fileName);

    
            $url = asset('public/images/media/'.$fileName);
            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);
        }
    }

//Shopletter---
    public function shopletter_list(){
        $Shopletter = Shopletter::orderby('id', 'DESC')-> get();
        return view('Back.shopletter.list', compact('Shopletter'));
    }
    public function shopletter_edit(Request $request, $id){
        $Shopletter = Shopletter::find($id);
        return view('Back.shopletter.edit',compact('Shopletter'));
    }
    public function shopletter_edit_post(Request $request, $id){
        if($request->Email == ''){
            return redirect('admin/shopletter/edit'.$id)->with(['flash_level' => 'danger', 'flash_message' => 'Vui lòng điền vào các trường dấu *']);
        }
        $Shopletter = Shopletter::find($id);
        $Shopletter-> Name = $request->Name;
        $Shopletter-> Email = $request-> Email;
        $Shopletter-> IsViews = $request-> IsViews;

        $Flag = $Shopletter -> save();
        if($Flag == true) {
            return redirect('admin/shopletter/list')->with(['flash_level' => 'success', 'flash_message' => 'Cập nhật thành công!']);
        }
        else {
            return redirect('admin/shopletter/edit'.$id)->with(['flash_level' => 'danger', 'flash_message' => 'Cập nhật thất bại!']);
        }
    }
    public function shopletter_delete(Request $request, $id){
        $Shopletter = Shopletter::find($id);
        $Flag = $Shopletter->delete();

        if ($Flag == true){
            return redirect('admin/shopletter/list')->with(['flash_level' => 'success', 'flash_message' => 'Xóa thành công !']);
        }
        else{
            return redirect('admin/shopletter/list')->with(['flash_level' => 'danger', 'flash_message' => 'Lỗi xóa tin!']);
        }
    }
//Shopletter---

    public function category_list(){
        $Category = Category::getAll();
    }
}
