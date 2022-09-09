<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\System;
use App\Models\Social;

class SocialController extends Controller
{
    public function __construct() {
        @session_start();

        $copyright = System::select('Description')->where('Code','copyright')->first();
        view()->share('copyright',$copyright);

    }

    //social---
    public function social_list(){
        $Social = Social::where('Status',1)->get();
        return view('Back.social.list', compact('Social'));
    }

    public function social_add(){
        $Social = Social::get();
        return view('Back.social.add', compact('Social'));
    }
    public function social_add_post(Request $request){
       $count= DB::table('social')->count();
        if($count > 5){
            return redirect('admin/social/list')->with(['flash_level'=>'danger', 'flash_message'=>'Số kênh mạng xã hôi đã đạt mức tối đa!']);
        }
        else {
            if($request->Name == '' || $request->Font == '' || $request->Sort ==''){
                return redirect('admin/social/add')->with(['flash_level'=>'danger', 'flash_message'=>'Vui lòng điền vào các trường dấu *']);
            };
            $Social = new Social;
            $Social->Name = $request->Name;
            $Social->Alias = $request->Alias;
            $Social->Font = $request->Font;
            $Social->Sort = $request->Sort;
            $Social->Status = 1;
    
            $Flag = $Social->save();
            if ($Flag == true){
                return redirect('admin/social/list') -> with(['flash_level' => 'success', 'flash_message' => 'Thêm mới thành công!']);
            }
            else{
                return redirect('admin/social/list') -> with(['flash_level' => 'error', 'flash_message' => 'Lỗi thêm mới!']);
            }
        }   
    }
    public function social_edit(Request $request, $id){
        $Social = Social::find($id);
        return view('Back.social.edit', compact('Social'));
    }
    public function social_edit_post(Request $request , $id){
        if($request->Name == '' || $request->Font == '' || $request->Sort ==''){
            return redirect('admin/social/edit')->with(['flash_level'=>'danger', 'flash_message'=>'Vui lòng điền vào các trường dấu *']);
        };
    
        $Social = Social::find($id);
        $Social->Name = $request->Name;
        $Social->Alias = $request->Alias;
        $Social->Font = $request->Font;
        $Social->Sort = $request->Sort;
        $Social->Status = $request->Status;

        $Flag = $Social->save();
        if ($Flag == true){
            return redirect('admin/social/list') -> with(['flash_level' => 'success', 'flash_message' => 'Cập nhật thành công!']);
        }
        else{
            return redirect('admin/social/list') -> with(['flash_level' => 'error', 'flash_message' => 'Lỗi cập nhật!']);
        }
    }
    public function social_delete(Request $request, $id){
        $Social = Social::find($id);
        $Flag = $Social -> delete();

        if($Flag == true) {
            return redirect('admin/social/list')->with(['flash_level' => 'success', 'flash_message' => 'Xóa thành công !']);
        }
        else {
            return redirect('admin/social/list')->with(['flash_level' => 'danger', 'flash_message' => 'Lỗi xóa nhân viên !']);
        }
    }
//social---
}
