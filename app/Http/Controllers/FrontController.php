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
use App\Models\Product;
use App\Models\ProductImages;

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
        $Products = Product::where('status', '1')
        ->orderBy('views', 'DESC')->limit(8)
        ->get();
        return view('Front.home.home', compact('Category', 'Slider', 'Page', 'Products'));
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
    public function product_list(Request $request, $slug){
        if(isset($slug) && $slug == 'san-pham'){
            $Products = Product::where('status',1)->get();
            $Alias = $slug ;
            $Cate = '';
            // dd($Products);
        }
        else{
            $Products = DB::table('categories')
            ->join('product', 'product.categoryId', '=', 'categories.id')
            ->where('categories.alias', $slug)
            ->get();
            $Alias = '';

            $Cate = Category::where('alias', $slug)
            ->selectRaw('categories.category_name')
            ->first();

        }
        return view('front.product.list', compact('Products','Alias', 'Cate'));
    }
    public function slugHtml(Request $request ,$slug){  
        $productDetail = DB::table('product as a')
        ->join('categories as b', 'a.categoryId', '=', 'b.id')
        ->join('product_images as c', 'a.id', '=', 'c.productId')
        ->where('a.status',1)
        ->where('a.alias',$slug)
        ->selectRaw('a.*, b.category_name, b.alias as categoryAlias, c.images as imgDetails, c.sort, b.id as cateId')
        ->orderBy('a.Views','DESC')
        ->get();

        $highlightProduct = Product::orderBy('highlight','DESC')
        ->limit(8)
        ->get();

        return view('front.product.detail', compact('productDetail', 'highlightProduct'));
    }
    // public function slug(Request $request ,$slug){
    //     $procductCate = Page::where('Status',1)->where('Alias',$slug)->first();

    //     if (isset($procductCate) && $procductCate != NULL ) {
    //         if (isset($request->sapxep) && $request->sapxep == 'luotxem') {
    //              $listNews = DB::table('product as a')
    //             ->join('categoties as b', 'a.categoryId', '=', 'b.id')
    //             ->where('a.status',1)
    //             ->where('b.alias',$slug)
    //             ->selectRaw('a.alias, a.name, a.images, a.smalldescription')
    //             ->orderBy('a.views','DESC')
    //             ->paginate(12);
    //             $sort = 'luotxem';
    //         }
    //         else{
    //              $listProduct = DB::table('product as a')
    //             ->join('categoties as b', 'a.categoryId', '=', 'b.id')
    //             ->where('a.status',1)
    //             ->where('b.alias',$slug)
    //             ->selectRaw('a.alias, a.name, a.images, a.smalldescription')
    //             ->orderBy('a.id','DESC')
    //             ->paginate(12);
    //             $sort = 'tinmoi';
    //         }
           
    //         return view('front.product.list', compact('newsCat','listProduct','sort'));
    //     }

        
    // }

    // public function getCategory(Request $request){
    //     $category = 
    //     return view();
    // }
}
