<?php

namespace App\Http\Controllers\back;


use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatus;
use App\Models\System;

class OrderController extends Controller
{
    public function __construct() {
        @session_start();

        $copyright = System::select('Description')->where('Code','copyright')->first();
        view()->share('copyright',$copyright);
    }

    public function order_list() {
        $Order = DB::table('orders as a')
        ->join('order_status as b', 'a.status', '=', 'b.id')
        ->selectRaw('a.id, a.fullname, a.code, a.total, b.name')
        ->paginate(10);
        // dd($Order);
        return view('Back.order.list', compact('Order'));
    }
    public function order_edit(Request $request, $id){
        $Orders = Order::find($id);
        $OrderStatus = OrderStatus::OrderBy('sort', 'asc')->get();

        $OrderDetails = DB::table('order_detail as a')
        ->join('product as b', 'a.productId', '=', 'b.id')
        ->where('a.orderId', $id)
        ->selectRaw('b.name, b.images, b.code, a.price, a.qty')
        ->orderBy('a.id', 'asc')
        ->get();
        return view('Back.order.edit', compact('Orders', 'OrderStatus', 'OrderDetails'));
    }
    public function order_edit_post(Request $request, $id){
        if ($request->fullname == '' || $request->phone == '' || $request->email == '' || $request->address == '') {
            return redirect('admin/order/edit/'.$id)->with(['flash_level' => 'danger' , 'flash_message' => 'Vui lòng điền vào các trường có dấu *']);
        }
        // dd($request->status);
        $Orders = Order::find($id);
        $Orders->fullname = $request->fullname;
        $Orders->status = $request->status;
        $Orders->phone = $request->phone;
        $Orders->email = $request->email;
        $Orders->address = $request->address;
 
        $Flag = $Orders->save();
 
        if ($Flag == true) {
             return redirect('admin/order/edit/'.$id)->with(['flash_level' => 'success' , 'flash_message' => 'Cập nhật hóa đơn thành công']);
         }
         else{
             return redirect('admin/order/edit/'.$id)->with(['flash_level' => 'danger' , 'flash_message' => 'Lỗi cập nhật hóa đơn']);
         } 
    }


}
