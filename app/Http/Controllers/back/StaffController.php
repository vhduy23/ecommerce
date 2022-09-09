<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;

use App\Models\User;
use App\Models\System;
use App\Models\UserLevel;


class StaffController extends Controller
{

    public function __construct() {
        @session_start();

        $copyright = System::select('Description')->where('Code','copyright')->first();
        view()->share('copyright',$copyright);

    }

//staff---
    public function staff_profile(){
        return view('Back.staff.profile');
    }
    public function staff_profile_post(Request $request){
        if($request->fullname =='' || $request->email =='' || $request->phone =='') {
            return redirect('admin/staff/profile') -> with(['flash_level' => 'danger', 'flash_message' => 'Vui lòng điền vào các trường có dấu *']);
        }
        $User = User::find($request->id);
        $User -> fullname = $request->fullname;
        $User -> email = $request->email;
        $User -> phone = $request->phone;
        $User -> address = $request->address;

        if(isset($request->password)){
            $User -> password = bcrypt($request->password);
        }
        $Flag = $User ->save();
        if($Flag == true){
            return redirect('admin/staff/profile') -> with(['flash_level' => 'success', 'flash_message' =>'Cập nhật thông tin thành công!']);
        }
        else {
            return redirect('admin/staff/profile') -> with(['flash_level' => 'danger', 'flash_message' => 'Lỗi cập nhật tài khoản!']); 
        }
    }
    public function staff_list(){
        $User = DB::table('users as a')
        ->join('user_level as b', 'a.level', '=', 'b.id')
        ->selectRaw('a.id, a.fullname, a.address,a.email, a.phone, b.name')
        ->where('b.id', '<', '3')
        ->get();
        return view('Back.staff.list', compact('User'));
    }
    public function staff_add(){
        $UserLevel = UserLevel::where('status',1)->get();
        return view('Back.staff.add', compact('UserLevel'));
    }
    public function staff_add_post(Request $request){
        if($request->fullname == '' || $request->email =='' || $request->phone == '' || $request->username == '' || $request->password == ''){
            return redirect('admin/staff/add') -> with(['flash_level' => 'danger', 'flash_message' =>'Vui lòng điền đầy đủ thông tin vào các trường có dấu *']);
        }
        $User = new User;
        $User -> level = $request->level;
        $User -> status = 1;
        $User -> fullname = $request->fullname;
        $User -> email = $request->email;  
        $User -> phone = $request->phone;
        $User -> username = $request->username;
        $User -> password = bcrypt($request->password);
        
        $Flag = $User ->save();
        if ($Flag == true){
            return redirect('admin/staff/list') -> with(['flash_level' => 'success', 'flash_message' =>'Thêm mới nhân viên thành công!']);
        }
        else{
            return redirect('admin/staff/list') -> with(['flash_level' => 'danger', 'flash_message' => 'Lỗi thêm mới nhân viên!']);
        }
    }
    public function staff_edit(Request $request, $id){

        $User = User::find($id);

    	$UserLevel = UserLevel::where('status',1)->get();
    	return view('Back.staff.edit', compact('User','UserLevel'));
    }
    public function staff_edit_post(Request $request, $id){
        if($request-> fullname =='' || $request->email == '' || $request->phone == '' || $request->address == '' || $request->address == ''){
            return redirect('admin/staff/list') -> with(['flash_level' => 'danger', 'flash_message' => 'Vui lòng điền đầy đủ thông tin vào các trường có dấu *']);
         }
         $User = User::find($id);
         $User -> level = $request->level;
         $User -> status = $request->status;
         if(isset($request-> password)){
            $User -> password = bcrypt($request->password);
         }
         $User-> fullname = $request-> fullname;
         $User-> email = $request-> email;
         $User-> phone = $request-> phone;
         $User-> address = $request-> address;

         $Flag = $User -> save();
         if($Flag == true){
             return redirect('admin/staff/list') -> with(['flash_level' => 'success', 'flash_message' => 'Chỉnh sửa thông tin thành công']);
         }
         else {
            return redirect('admin/staff/edit') -> with(['flash_level' => 'danger', 'flash_message' => 'Lỗi chỉnh sửa thông tin !']);
         }
    }
    public function staff_delete(Request $request, $id){
        $User = User::find($id);
        $Flag = $User -> delete();

        if($Flag == true) {
            return redirect('admin/staff/list')->with(['flash_level' => 'success', 'flash_message' => 'Xóa thành công !']);
        }
        else {
            return redirect('admin/staff/list')->with(['flash_level' => 'danger', 'flash_message' => 'Lỗi xóa nhân viên !']);
        }
    }
//staff---
}
