@extends('back.template.master')
@section('title', 'Quản lý đơn đặt hàng')
@section('heading', 'Chỉnh sửa đơn đặt hàng')
@section('order', 'active')
@section('content')
<div class="col-md-12">
    <div class="card-header">
      <a class="btn btn-danger" href="{{url('admin/order/list')}}" title="Thêm">Quay lại</a>
    </div>
  <!-- general form elements -->
  <div class="card card-primary">
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action="{{url('admin/order/edit/'.$Orders->id)}}" method="POST" enctype="multipart/form-data">
        <div class="card-body">
            {!! csrf_field() !!}
            <div class="col-md-12">Thông tin khách hàng</div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Mã đơn hàng</label>
                        <input type="text" class="form-control"  value="{{$Orders->code}}" readonly="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Ngày tạo</span></label>
                        <input type="text" class="form-control"  value="{{date('d/m/Y H:i:s', strtotime($Orders->created_at))}}" readonly="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Trạng thái</label>
                        <select class="form-control" name="status">
                            @if(isset($OrderStatus) && count($OrderStatus) > 0)
                            @foreach($OrderStatus as $k => $v)
                            <option value="{{$v->id}}" @if($Orders->status == $v->id) selected="" @endif>
                            {{$v->name}}
                            </option>
                            @endforeach 
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Tổng tiền(VNĐ)</label>
                        <input type="text" class="form-control" value="{{number_format($Orders->total)}}" readonly="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên khách hàng<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="fullname" value="{{$Orders->fullname}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Số điện thoại<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="phone" value="{{$Orders->phone}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="email" value="{{$Orders->email}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Địa chỉ<span class="text-danger">*</span></label>
                        <textarea name="address" rows="3" class="form-control" >{{$Orders->address}}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-12">Thông tin sản phẩm</div>
            <div class="col-md-12 col-sm-12 col-xl-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Ảnh</th>
                        <th scope="col">Số lượng </th>
                        <th scope="col">Đơn giá(VNĐ)</th>
                        <th scope="col">Thành tiền(VNĐ)</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($OrderDetails) && count($OrderDetails) > 0)
                    @foreach($OrderDetails as $k => $v)
                    <tr>
                        <th scope="row">{{$k+1}}</th>
                        <td>{{$v->name}} [{{$v->code}}]</td>
                        <td><img style="width: 70%;" src="{{url('images/product/'.$v->images)}}" alt="{{$v->name}}"></td>
                        <td>{{$v->qty}}</td>
                        <td>{{number_format($v->price)}}</td>
                        <td>{{number_format($v->qty*$v->price)}}</td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            </div>
       </div>

      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Cập nhật</button>
      </div>
    </form>
  </div>
  <!-- /.card -->
</div>
@stop