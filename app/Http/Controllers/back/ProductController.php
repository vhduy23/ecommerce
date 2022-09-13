<?php

namespace App\Http\Controllers\back;

use DB;
use Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\System;
use App\Models\ProductImages;


class ProductController extends Controller
{

	public function __construct() {
        @session_start();

        $copyright = System::select('Description')->where('Code','copyright')->first();
        view()->share('copyright',$copyright);

    }
//product manage-------------------------------------------------------
 public function product_list(){
	$Products = DB::table('product')
	->leftjoin('categories', 'categories.id', '=', 'product.categoryId')
	->selectRaw('product.*, categories.category_name')
	->orderby('product.id', 'DESC')
	->get();
	return view('back.product.list', compact('Products'));
}
public function product_getadd(){
	$Categories = Category::Where('status',1)->get();
	$Products = Product::Where('status',1)->get();
	$ProductImages = ProductImages::get();
	return view('back.product.add', compact('Categories', 'Products', 'ProductImages'));
}
public function product_add(Request $request){
	if ($request->Name == '' || $request->Description == '' || $request->Code == '' ) {

		return redirect('admin/product/add/')->with(['flash_level' => 'danger' , 'flash_message' => 'Vui lòng điền vào các trường có dấu *']);
	}
	elseif($request->Discount < 0){
		return redirect('admin/product/add/')->with(['flash_level' => 'danger' , 'flash_message' => 'Khuyến mãi không được là số âm']);
	}
	$Products = new Product;
	$Products->status = $request->Status;
	$Products->name =  $request->Name;
	$Products->alias =  $request->Alias;
	$Products->views =  $request->Views;
	$Products->code =  $request->Code;
	$Products->author =  $request->Author;
	$Products->price = $request->Price;
	$Products->categoryId = $request->categoryId;
	$Products->highlight = $request->Highlight;
	$Products->quantity = $request->Quantity;
	$Products->metatitle = $request->MetaTitle;
	$Products->metadescription = $request->MetaDescription;
	$Products->metakeyword = $request->MetaKeyword;
	$Products->smalldescription = $request->SmallDescription;
	$Products->description = $request->Description;
	$Products->discount = $request->Discount;
	
	if ($request->hasFile('Images')) {
		$file = $request->file('Images');
		$random_digit = rand(000000000,999999999);
		$name = $random_digit.'-'.$file->getClientOriginalName();
		$duoi = strtolower($file->getClientOriginalExtension());

		if ($duoi != 'png' && $duoi != 'jpg' && $duoi != 'jpeg' && $duoi != 'svg') {
			return back()->with(['flash_level' => 'danger', 'flash_message' => 'Phần mở rộng ảnh không được hỗ trợ']);
		}

		$file->move('images/product',$name);

		$img = Image::make('images/product/'.$name);
		//kiểm tra nếu không tông tại thì tạo folder
		$filePath = "images/product/".date('Ymd');
		if (!file_exists($filePath)) {
			mkdir("images/product/".date('Ymd'),0777,true);
		}
		$img->fit(208, 141);
		$img->save('images/product/'.date('Ymd').'/'.$name);

		//delete images upload
		if (file_exists('images/product/'.$name)){
			unlink('images/product/'.$name);
		}

		$Products->Images = date('Ymd').'/'.$name;
	}

	$Flag = $Products->save();

	if ($Flag == true) {
			//hình  chi tiết sản phẩm
			$productImageDetails = $request->file('productImageDetails');
			if($request->hasFile('productImageDetails')) {
				foreach($request->file('productImageDetails') as $file){
					$ProductImages = new ProductImages();
					$ProductImages->productId = $Products->id;
					$random_digit = rand(00000000,999999999);
					$name = $random_digit.'-'.$file->getClientOriginalName();
	
					$file->move('images/product/details/', $name);
					$img = Image::make('images/product/details/'.$name);
	
					$filePath = "images/product/details/". date('ymd');
					if(!file_exists($filePath)){
						mkdir("images/product/details/". date('ymd'), 0777, true);
					}
					$img->fit(561, 561);
					$img->save('images/product/details/'. date('ymd').'/'.$name);
	
	
					//delete file
					if(file_exists('images/product/details/'.$name)){
						unlink('images/product/details/'. $name);
					}
					$ProductImages->images = date('ymd').'/'.$name;
					$ProductImages->save();
				}
			}
		 return redirect('admin/product/list')->with(['flash_level' => 'success' , 'flash_message' => 'Thêm tin tức thành công']);
	 }
	 else{
		 return redirect('admin/product/add')->with(['flash_level' => 'danger' , 'flash_message' => 'Lỗi thêm sản phẩm']);
	 } 
}
public function product_edit(Request $request, $id){

	if ($request->Name == '' || $request->Description == '' || $request->Code == '' ) {

		return redirect('admin/product/edit/')->with(['flash_level' => 'danger' , 'flash_message' => 'Vui lòng điền vào các trường có dấu *']);
	}
	elseif($request->Discount < 0){
		return redirect('admin/product/edit/')->with(['flash_level' => 'danger' , 'flash_message' => 'Khuyến mãi không được là số âm']);
	}

	$Products = Product::find($id);
	$Products->status = $request->Status;
	$Products->name =  $request->Name;
	$Products->alias =  $request->Alias;
	$Products->views =  $request->Views;
	$Products->code =  $request->Code;
	$Products->author =  $request->Author;
	$Products->price = $request->Price;
	$Products->highlight = $request->Highlight;
	$Products->categoryId = $request->categoryId;
	$Products->quantity = $request->Quantity;
	$Products->metatitle = $request->MetaTitle;
	$Products->metadescription = $request->MetaDescription;
	$Products->metakeyword = $request->MetaKeyword;
	$Products->smalldescription = $request->SmallDescription;
	$Products->description = $request->Description;
	$Products->discount = $request->Discount;
	
	if ($request->hasFile('Images')) {
		$file = $request->file('Images');
		$random_digit = rand(000000000,999999999);
		$name = $random_digit.'-'.$file->getClientOriginalName();
		$duoi = strtolower($file->getClientOriginalExtension());

		if ($duoi != 'png' && $duoi != 'jpg' && $duoi != 'jpeg' && $duoi != 'svg') {
			return back()->with(['flash_level' => 'danger', 'flash_message' => 'Phần mở rộng ảnh không được hỗ trợ']);
		}

		$file->move('images/product',$name);

		$img = Image::make('images/product/'.$name);
		//kiểm tra nếu không tông tại thì tạo folder
		$filePath = "images/product/".date('Ymd');
		if (!file_exists($filePath)) {
			mkdir("images/product/".date('Ymd'),0777,true);
		}
		$img->fit(323, 323);
		$img->save('images/product/'.date('Ymd').'/'.$name);

		//delete images upload
		if (file_exists('images/product/'.$name)){
			unlink('images/product/'.$name);
		}

		$Products->Images = date('Ymd').'/'.$name;
	}

	$Flag = $Products->save();

	if ($Flag == true) {

		//hình  chi tiết sản phẩm
		$productImageDetails = $request->file('productImageDetails');
		if($request->hasFile('productImageDetails')) {
			foreach($request->file('productImageDetails') as $file){
				$ProductImages = new ProductImages();
				$ProductImages->productId = $Products->id;
				$random_digit = rand(00000000,999999999);
				$name = $random_digit.'-'.$file->getClientOriginalName();

				$file->move('images/product/details/', $name);
				$img = Image::make('images/product/details/'.$name);

				$filePath = "images/product/details/". date('ymd');
				if(!file_exists($filePath)){
					mkdir("images/product/details/". date('ymd'), 0777, true);
				}
				$img->fit(561, 561);
				$img->save('images/product/details/'. date('ymd').'/'.$name);


				//delete file
				if(file_exists('images/product/details/'.$name)){
					unlink('images/product/details/'. $name);
				}
				$ProductImages->images = date('ymd').'/'.$name;
				$ProductImages->save();
			}
  
		}
		 return redirect('admin/product/list')->with(['flash_level' => 'success' , 'flash_message' => 'Thêm tin tức thành công']);
	 }
	 else{
		 return redirect('admin/product/edit')->with(['flash_level' => 'danger' , 'flash_message' => 'Lỗi thêm sản phẩm']);
	 } 
}
public function deleteImageProduct(Request $request){
	$ProductImages = ProductImages::find($request->productId);
	if($ProductImages ->images != ''){
		if(file_exists('images/product/details/'.$ProductImages->images)) {
			unlink('images/product/details/'.$ProductImages->images);
		}
	}
	$ProductImages->delete();
}
public function product_getedit(Request $request, $id){
	$Categories = Category::get();
	$Products = Product::find($id);
	$ProductImages = ProductImages::where('productId', $id)->orderBy('sort', 'ASC')->get();
	// dd($ProductImages);
	return view('back.product.edit', compact('Products','Categories', 'ProductImages'));
}
public function product_delete(Request $request, $id){
	$Products = Product::find($id);
	 if ($Products->images != '') {
			if (file_exists('images/news/'.$Products->images)) {
				unlink('images/news/'.$Products->images);
			}
		}

	$Flag = $Products->delete();
	$ProductImages = ProductImages::where('productId',$id);
	if($ProductImages ->images != ''){
		if(file_exists('images/product/details/'.$ProductImages->images)) {
			unlink('images/product/details/'.$ProductImages->images);
		}
	}
	$ProductImages->delete();
	if ($Flag == true) {
		 return redirect('admin/product/list')->with(['flash_level' => 'success' , 'flash_message' => 'Xóa tin tức thành công']);
	 }
	 else{
		 return redirect('admin/product/list')->with(['flash_level' => 'danger' , 'flash_message' => 'Lỗi xóa tin tức']);
	 } 
}
//product manage-------------------------------------------------------
}
