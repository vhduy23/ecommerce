@extends('back.template.master')

@section('title', 'Quản lý danh mục')
@section('heading', 'Thêm mạng danh mục')
@section('social', 'active')
@section('content')
<div class="col-md-12">
    <div class="card-header">
      <a class="btn btn-danger" href="{{url('admin/category/list')}}" title="Thêm">Quay lại</a>
    </div>
  <!-- general form elements -->
  <div class="card card-primary">
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action="{{url('admin/category/add')}}" method="POST">
      <div class="card-body"> 
        {!! csrf_field() !!}
        <div class="form-group">
          <label for="exampleInputEmail1">Tên danh mục<span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="Name" >
        </div>
        <select class="form-control" name="Status">
            <option value="1">
              Trạng thái: Bật
            </option> 
            <option value="0">
              Trạng thái: Tắt
            </option>
          </select>
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