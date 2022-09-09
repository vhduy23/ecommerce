<?php

namespace App\Http\Controllers;

use DB;
use File;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserLevel;
use App\Models\System;
use App\Models\Social;
use App\Models\Category;
use App\Models\Shopletter;
use App\Models\Slide;
use App\Models\Page;

class FrontController extends Controller
{
    public function __construct() {
        @session_start();

        $copyright = System::select('Description')->where('Code','copyright')->first();
        view()->share('copyright',$copyright);

        $address = System::select('Description')->where('Code','address')->first();
        view()->share('address',$address);

        $email = System::select('Description')->where('Code','email')->first();
        view()->share('email',$email);

        $phone = System::select('Description')->where('Code','phone')->first();
        view()->share('phone',$phone);

        $favicon = System::select('Description')->where('Code','favicon')->first();
        view()->share('favicon',$favicon);

        $logo = System::select('Description')->where('Code','logo')->first();
        view()->share('logo',$logo);

        $Social = Social::where('Status',1)->selectRaw('Name, Font, Alias')->orderBy('Sort','ASC')->get();
        view()->share('Social',$Social);

    }
    public function home(){

        $Category = Category::where('status',1)
        // ->join('product_categories','product_categories.category_id', '=', 'categories.id')
        // ->join('product', 'product.id', '=', 'product_categories.product_id')
        ->get();
        
        $Slider = Slide::where('status', '1')
        // ->selectRaw('Alias', 'Name', 'Images')
        ->get();

        $Page = Page::where('status', '1')
        ->get();



        // dd($Category);

        return view('Front.home.home', compact('Category', 'Slider', 'Page'));
    }
    

    // public function s

    public function subEmail(Request $request){
        if ($request->txtEmailSub != '') {
            $Shopletter = Shopletter::where('Email', $request->txtEmailSub)->get();
            if (isset($Shopletter) && count($Shopletter) > 0) {
                echo "error_exists_email";
            }else{
               $Shopletter = new Shopletter;
               $Shopletter->Name = $request->txtName;
               $Shopletter->Email = $request->txtEmailSub;
               $Flag = $Shopletter->save();
                
                if ($Flag == true) {
                    echo "finish";
                }
                else{
                    echo "error";
                }
            }
        }else{
            echo "error_22";
        }
    }
    // public function getCategory(Request $request){
    //     $category = 
    //     return view();
    // }
}
