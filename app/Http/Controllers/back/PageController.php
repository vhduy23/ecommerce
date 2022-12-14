<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\System;  

use DB;
use File;
use Image;

class PageController extends Controller
{


    public function __construct() {
        @session_start();

        $copyright = System::select('Description')->where('Code','copyright')->first();
        view()->share('copyright',$copyright);

    }
      //page manage
    public function page_list(){
    $Page = Page::get();

    return view('Back.page.list',compact('Page'));
    }
    public function page_edit(Request $request, $id){
        $Page = Page::find($id);
        return view('Back.page.edit',compact('Page'));
    }
    public function page_edit_post(Request $request, $id){
        if ($request->Name == '') {
           return redirect('admin/page/edit/'.$id)->with(['flash_level' => 'danger' , 'flash_message' => 'Vui lòng điền vào các trường có dấu *']);
       }
        $Page = Page::find($id);
       $Page->Name = $request->Name;
       $Page->Status = $request->Status;
       $Page->Font = $request->Font;
       $Page->Alias = $request->Alias;
       $Page->MetaTitle = $request->MetaTitle;
       $Page->MetaDescription = $request->MetaDescription;
       $Page->MetaKeyword = $request->MetaKeyword;
       $Page->Description = $request->Description;

       if ($request->hasFile('Images')) {
           $file = $request->file('Images');
           $random_digit = rand(000000000,999999999);
           $name = $random_digit.'-'.$file->getClientOriginalName();
           $duoi = strtolower($file->getClientOriginalExtension());

           if ($duoi != 'png' && $duoi != 'jpg' && $duoi != 'jpeg' && $duoi != 'svg') {
               return back()->with(['flash_level' => 'danger', 'flash_message' => 'Phần mở rộng ảnh không được hỗ trợ']);
           }

           $file->move('public/images/page',$name);

           $img = Image::make('public/images/page/'.$name);
           //kiểm tra nếu không tông tại thì tạo folder
           $filePath = "public/images/page/".date('Ymd');
           if (!file_exists($filePath)) {
               mkdir("public/images/page/".date('Ymd'),0777,true);
           }
           $img->fit(300, 250);
           $img->save('public/images/page/'.date('Ymd').'/'.$name);

           //delete images upload
           if (file_exists('public/images/page/'.$name)){
               unlink('public/images/page/'.$name);
           }

           $Page->Images = date('Ymd').'/'.$name;
       }

       $Flag = $Page->save();

       if ($Flag == true) {
            return redirect('admin/page/edit/'.$id)->with(['flash_level' => 'success' , 'flash_message' => 'Cập nhật trang thành công']);
        }
        else{
            return redirect('admin/page/edit/'.$id)->with(['flash_level' => 'danger' , 'flash_message' => 'Lỗi cập nhật trang']);
        } 
    }
   //page manage
}
