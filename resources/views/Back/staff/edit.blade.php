@extends('Back.template.master')
@section('title', 'Quản lý nhân viên')
@section('heading', 'Chỉnh sửa thông tin nhân viên')
@section('content')
<div class="col-md-12">
  <!-- general form elements -->
  <div class="card card-primary">
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action="{{url('admin/staff/edit/'.$User->id)}}" method="POST">
      <div class="card-body">
        {!! csrf_field() !!}
        <div class="form-group">
          <label for="exampleInputEmail1">Cấp bậc </label>
          <select class="form-control" name="level">
            @if(isset($UserLevel) && count($UserLevel) > 0)
              @foreach($UserLevel as $k => $v)
                <option value="{{$v->id}}" @if($v->id == $User->level) selected="" @endif>{{$v->name}}</option> 
              @endforeach
            @endif 
          </select>
        </div>
        <div class="form-group">
        <label for="exampleInputEmail1">Trạng thái</label>
          <select class="form-control" name="status">
            <option value="1" @if($User->status == 1) selected="" @endif>
              Bật
            </option>
            <option value="0" @if($User->status == 0) selected="" @endif>
              Tắt
            </option>
          </select>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Họ và tên<span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="fullname" value="{{$User->fullname}}">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Email<span class="text-danger">*</span></label>
          <input type="email" class="form-control" name="email" value="{{$User->email}}">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Số điện thoại<span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="phone" value="{{$User->phone}}">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Địa chỉ</label>
          <input type="text" class="form-control" name="address" value="{{$User->address}}">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Tài khoản<span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="username" value="{{$User->username}}" disabled="">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Mật khẩu<span class="text-danger">*</span></label>
           <input type="text" class="form-control" name="password">
           <p class="text-danger">Không nhập trường này nếu không đổi mật khẩu</p>
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