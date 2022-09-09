<?php

namespace App\Http\Controllers\back;

use File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\System;



class SystemController extends Controller
{
    public function __construct() {
        @session_start();

        $copyright = System::select('Description')->where('Code','copyright')->first();
        view()->share('copyright',$copyright);

    }
    //system--- 
    public function system(){
        $name = System::where('Status', 1)->where('Code','name')->first();
        $email = System::where('Status',1)->where('Code','email')->first();
        $phone = System::where('Status',1)->where('Code','phone')->first();
        $address = System::where('Status',1)->where('Code','address')->first();
        $copyright = System::where('Status',1)->where('Code','copyright')->first();
        $favicon = System::where('Status',1)->where('Code','favicon')->first();
        $map = System::where('Status',1)->where('Code','map')->first();
        $logo = System::where('Status',1)->where('Code','logo')->first();

        return view('Back.system.system', compact('name','email','phone','address','copyright','favicon','map','logo'));
    }
    public function system_post(Request $request) {
        if($request->name == '' || $request->email == '' || $request->phone == ''){
            return redirect('admin/system')-> with(['flash_level' => 'danger', 'flash_message' => 'Vui lòng điền vào các trường có dấu *']);
        }

        System::where('Status', 1)->where('Code','name')
        ->update(['Description' => $request->name]);
        System::where('Status',1)->where('Code','email')
        ->update(['Description' => $request->email]);
        System::where('Status', 1)->where('Code','address')
        ->update(['Description' => $request->address]);
        System::where('Status', 1)->where('Code','phone')
        ->update(['Description' => $request->phone]);
        System::where('Status', 1)->where('Code','copyright')
        ->update(['Description' => $request->copyright]);
        System::where('Status', 1)->where('Code','map')
        ->update(['Description' => $request->map]);

        //logo---
        if(!empty($request->file('logo'))){
            $logo = System::where('Status',1)->where('Code','logo')->first();
            $path = 'images/logo'.$logo->Description;
            if(File::exists($path)) {
                File::delete($path);
            }
            //upload image
            $name = $request->file('logo')->getClientOriginalName(); // method upload file
            $request -> file('logo') -> move('images/logo', $name);
            $logo -> Description = $name;
            $logo -> save();
        }
        //favicon
        if(!empty($request->file('favicon'))){
            $favicon = System::where('Status',1)->where('Code','favicon')->first();
            $path = 'images/favicon'.$favicon-> Description;
            if(File::exists($path)){
                File::delete($path);
            }
            //upload favicon 
            $name = $request -> file('favicon')-> getClientOriginalName();
            $request -> file('favicon') -> move('images/favicon', $name);
            $favicon-> Description = $name;
            $favicon -> save();
        }
        return redirect('admin/system')-> with(['flash_level' => 'success', 'flash_message' => 'Chỉnh sửa thành công !']);
    }
//system--- 
}
