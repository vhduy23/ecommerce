<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;


class UserController extends Controller
{
    public function __construct() {
        @session_start();
    }
    public function getLogin(){
        return view('Auth.login');
    }
    public function postLogin(Request $requets){
        if (Auth::attempt(['username' => $requets->username, 'password' => $requets->password]) ) {
            if(Auth::user()->level == 1 || Auth::user()->level == 2){
                return redirect('admin/home');
            }
            else {
                return redirect('/admin')->with('notice','Bạn không có quyền đăng nhập vào trang này');
            }
        }
        else {
            return redirect('/admin')->with('notice','Tài khoản hoặc mật khẩu không chính xác');
        }
        
    }

    public function getCusRegister(){
        return view('Auth.cusRegister');
    }
    
    public function postCusRegister(Request $request){
        $User = User::selectRaw('username')->get();
        $checkUserName = false;
        $checkPhone = false;
        $checkEmail = false;
        if(isset($User) && count($User) > 0){
            foreach($User as $k => $v){
                if($request->username == $v->username){
                    $checkUserName = true;
                }
            }
        }
        if($checkUserName){
            return redirect('/register')->with('notice','Tên đăng nhập đã tồn tại!');
        }
        else{
            $User = new User;
            $User->level = 3;
            $User->status = 1;
            $User->username = $request->username;
            $User->password = bcrypt($request->password);
            $User->fullname = $request->fullname;
            $User->address = $request->address;
            $User->email = $request->email;
            $User->phone = $request->phone;
            $flag = $User->save();
            if($flag == true){
                return redirect('/login');
            }
            return redirect('/register')->with('notice','Đăng ký tài khoản không thành công!');
        }
    }

    public function getCusLogin() {
        return view('Auth.cusLogin');
    }

    public function postCusLogin(Request $requets){
        if (Auth::attempt(['username' => $requets->username, 'password' => $requets->password]) ) { 
            return redirect('/');
        }
        else {
            return redirect('/login')->with('notice','Tài khoản hoặc mật khẩu không chính xác.');
        }
    }

    public function getLogout(){
    	Auth::logout();
    	return redirect('/admin');
    }

    public function getLogoutCus(){
        Auth::logout();
    	return redirect('/login');
    }
}