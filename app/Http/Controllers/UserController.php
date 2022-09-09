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
    	return redirect('/login');
    }
}