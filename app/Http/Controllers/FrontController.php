<?php

namespace App\Http\Controllers;

use DB;
use File;
use Cart;

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

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatus;

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

        $Products = Product::where('status', '1')
        ->orderBy('views', 'DESC')->limit(8)
        ->get();

        $NewProducts = Product::where('status', '1')
        ->orderBy('created_at', 'DESC')->limit(8)
        ->get();

        return view('Front.home.home', compact('Category', 'Slider', 'Page', 'Products', 'NewProducts'));

    }
    

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
    public function add_item(Request $request){
        $Products = Product::where('id', $request->txtProductId)
        ->selectRaw('id, name, price, images')
        ->first();

        $flag = Cart::add([
            ['id' => $request->txtProductId, 'name' => $Products->name, 'qty' => $request->txtQty, 'price' => $request->txtPrice, 
                'discount' => $request->txtDiscount, 'options' => ['images' => $Products->images, 'id' => $Products->id]]
          ]);

        if($flag == true){
            echo 'finish';
        }
        else{
            echo 'error';
        }
    }
    public function delete_item(Request $request, $rowId){
        Cart::remove($rowId);
        return redirect('/gio-hang');
    }
    public function edit_item(Request $request){
        $flag = Cart::update($request->rowId, $request->txtQty);
        if($flag == true){
            echo 'finish';
        }
        else{
            echo 'error';
        }
    }
    public function order(Request $request){
        $Order = new Order;
        $Order->fullname = $request->txtName;
        $Order->address = $request->txtAddress;
        $Order->phone = $request->txtPhone;
        $Order->email = $request->txtEmail;
        $Order->code = rand(000000000,999999999);
        $Order->status = 1;
        $Order->total = 0;
        $flag = $Order->save();

        if($flag == true){
            $total = 0;
            if(Cart::content()->count() > 0){
                foreach(Cart::content() as $row){
                    $total += $row->qty*$row->price;
                    $OrderDetails = new OrderDetail;
                    $OrderDetails->orderId = $Order->id;
                    $OrderDetails->productId = $row->options->id;
                    $OrderDetails->qty = $row->qty;
                    $OrderDetails->price = $row->price;
                    $OrderDetails->save();
                }
            }
            $Order->total = $total ;
            $Order->save();
            Cart::destroy();

            echo 'finish';
        }else{
            echo 'error';
        }
    }

    public function slug(Request $request, $slug){
        // dd($slug);
        if(isset($slug) && $slug == 'gio-hang'){
            return view('front.cart.cart');
        }
        if(isset($slug) && $slug == 've-chung-toi'){

            $PageInfor = Page::where('Status', 1)->where('Alias','ve-chung-toi')
            ->selectRaw('Name, Images, Alias, MetaTitle, MetaDescription, MetaKeyword, Description ')
            ->first();
    
            return view('front.about.about', compact('PageInfor'));
        }
        if(isset($slug) && $slug == 'san-pham'){
            $Products = Product::where('status',1)
            ->get();
            // ->paginate(9);
            $Alias = $slug ;
            $Cate = ' ';
            return view('front.product.list', compact('Products','Alias', 'Cate'));
        }
        else{
            $Products = DB::table('categories')
            ->join('product', 'product.categoryId', '=', 'categories.id')
            ->where('categories.alias', $slug)
            ->get();
            // ->paginate(9);
            $Alias = '';

            $Cate = Category::where('alias', $slug)
            ->selectRaw('categories.category_name')
            ->first();

            return view('front.product.list', compact('Products','Alias', 'Cate'));
        }
    }

}
