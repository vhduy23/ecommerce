@extends('Back.template.master')
@section('title', 'Quản lý nhận tin liên hệ')
@section('heading', 'Cập nhật nhận tin liên liên hệ')
@section('content')

<div class="col-md-12">
    <div class="card-header">
      <a class="btn btn-danger" href="{{url('admin/shopletter/list')}}" title="Thêm">Quay lại</a>
    </div>
  <!-- general form elements -->
  <div class="card card-primary">
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action="{{url('admin/shopletter/edit/'.$Shopletter->id)}}" method="POST">
      <div class="card-body">
        {!! csrf_field() !!}
        <div class="form-group">
          <select class="form-control" name="IsViews">
            <option value="1" @if($Shopletter->IsViews == 1) selected="" @endif>
              Trạng thái: Đã xem
            </option> 
            <option value="0" @if($Shopletter->IsViews == 0) selected="" @endif>
              Trạng thái: Chưa xem
            </option>
          </select>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Tên email<span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="Email" value="{{$Shopletter->Email}}">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Họ và tên<span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="Name" value="{{$Shopletter->Name}}">
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