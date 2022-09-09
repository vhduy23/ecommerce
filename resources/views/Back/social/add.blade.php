@extends('back.template.master')

@section('title', 'Quản lý mạng xã hội')
@section('heading', 'Thêm mạng xã hội')
@section('social', 'active')
@section('content')
<div class="col-md-12">
    <div class="card-header">
      <a class="btn btn-danger" href="{{url('admin/social/list')}}" title="Thêm">Quay lại</a>
    </div>
  <!-- general form elements -->
  <div class="card card-primary">
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action="{{url('admin/social/add')}}" method="POST">
      <div class="card-body"> 
        {!! csrf_field() !!}
        <div class="form-group">
          <label for="exampleInputEmail1">Tên mạng xã hội<span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="Name" >
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Đường dẫn</label>
          <input type="text" class="form-control" name="Alias">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Font<span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="Font">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Sắp xếp<span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="Sort">
        </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Thêm</button>
      </div>
    </form>
  </div>
  <!-- /.card -->
</div>
@stop