<?php

namespace App\Http\Controllers\back;


// use Intervention\Image\Facades\Image as Image;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slide;
use App\Models\System;


class SlideController extends Controller
{


    public function __construct() {
        @session_start();

        $copyright = System::select('Description')->where('Code','copyright')->first();
        view()->share('copyright',$copyright);

    }

//slider  manage-------------------------------------------------------
    public function slider_list(){
        $Slider = Slide::selectRaw('*')
        ->orderby('id', 'DESC')
        ->get();
        return view('back.slider.list', compact('Slider'));
    }
    public function slider_getadd(){
        return view('back.slider.add');
    }
    public function slider_add(Request $request){
        if ($request->Name == '' || $request->Alias == '') {
            return redirect('admin/slider/add/')->with(['flash_level' => 'danger' , 'flash_message' => 'Vui lòng điền vào các trường có dấu *']);
        }
        $Slider = new Slide;
        $Slider->Status = $request->Status;
        $Slider->Name =  $request->Name;
        $Slider->Alias =  $request->Alias;
        $Slider->Sort =  $request->Sort;
        
        if ($request->hasFile('Images')) {
            $file = $request->file('Images');
            $random_digit = rand(000000000,999999999);
            $name = $random_digit.'-'.$file->getClientOriginalName();
            $duoi = strtolower($file->getClientOriginalExtension());

            if ($duoi != 'png' && $duoi != 'jpg' && $duoi != 'jpeg' && $duoi != 'svg') {
                return back()->with(['flash_level' => 'danger', 'flash_message' => 'Phần mở rộng ảnh không được hỗ trợ']);
            }

            $file->move('images/slider',$name);

            $img = Image::make('images/slider/'.$name);
            //kiểm tra nếu không tông tại thì tạo folder
            $filePath = "images/slider/".date('Ymd');
            if (!file_exists($filePath)) {
                mkdir("images/slider/".date('Ymd'),0777,true);
            }
            $img->fit(1920, 760);
            $img->save('images/slider/'.date('Ymd').'/'.$name);

            //delete images upload
            if (file_exists('images/slider/'.$name)){
                unlink('images/slider/'.$name);
            }

            $Slider->Images = date('Ymd').'/'.$name;
        }

        $Flag = $Slider->save();

        if ($Flag == true) {
            return redirect('admin/slider/list')->with(['flash_level' => 'success' , 'flash_message' => 'Thêm slideshow thành công']);
         }
         else{
            return redirect('admin/slider/add')->with(['flash_level' => 'danger' , 'flash_message' => 'Lỗi thêm slideshow']);
         } 
    }
    public function slider_edit(Request $request,$id){
        if ($request->Name == '' || $request->Alias == '') {
            return redirect('admin/slider/edit/'.$id)->with(['flash_level' => 'danger' , 'flash_message' => 'Vui lòng điền vào các trường có dấu *']);
        }
        $Slider = Slide::find($id);
        $Slider->Status = $request->Status;
        $Slider->Name =  $request->Name;
        $Slider->Alias =  $request->Alias;
        $Slider->Sort =  $request->Sort;
        
      if ($request->hasFile('Images')) {
            $file = $request->file('Images');
            $random_digit = rand(000000000,999999999);
            $name = $random_digit.'-'.$file->getClientOriginalName();
            $duoi = strtolower($file->getClientOriginalExtension());

            if ($duoi != 'png' && $duoi != 'jpg' && $duoi != 'jpeg' && $duoi != 'svg') {
                return back()->with(['flash_level' => 'danger', 'flash_message' => 'Phần mở rộng ảnh không được hỗ trợ']);
            }

            if ($Slider->Images != '') {
                if (file_exists('images/slider/'.$Slider->Images)) {
                    unlink('images/slider/'.$Slider->Images);
                }
            }

            //upload hinh anh len server
            $file->move('images/slider',$name);
            $img = Image::make('images/slider/'.$name);
            //kiểm tra nếu không tông tại thì tạo folder
            $filePath = "images/slider/".date('Ymd');
            if (!file_exists($filePath)) {
                mkdir("images/slider/".date('Ymd'),0777,true);
            }
            $img->fit(1920, 760);
            $img->save('images/slider/'.date('Ymd').'/'.$name);

            //delete images upload
            if (file_exists('images/slider/'.$name)){
                unlink('images/slider/'.$name);
            }

            $Slider->Images = date('Ymd').'/'.$name;
        }

        $Flag = $Slider->save();

        if ($Flag == true) {
            return redirect('admin/slider/list')->with(['flash_level' => 'success' , 'flash_message' => 'Thêm tin tức thành công']);
         }
         else{
            return redirect('admin/slider/add')->with(['flash_level' => 'danger' , 'flash_message' => 'Lỗi thêm tin tức']);
         } 
    }
    public function slider_getedit(Request $request, $id){
        $Slider = Slide::find($id);
        return view('back.slider.edit', compact('Slider'));
    }
    public function slider_delete(Request $request, $id){
        $Slider = Slide::find($id);

         if ($Slider->Images != '') {
                if (file_exists('images/slider/'.$Slider->Images)) {
                    unlink('images/slider/'.$Slider->Images);
                }
            }

        $Flag = $Slider->delete();

        if ($Flag == true) {
            return redirect('admin/slider/list')->with(['flash_level' => 'success' , 'flash_message' => 'Xóa slideshow thành công']);
         }
         else{
            return redirect('admin/slider/list')->with(['flash_level' => 'danger' , 'flash_message' => 'Lỗi xóa slideshow']);
         } 
    }
    //slider manage-------------------------------------------------------

}
