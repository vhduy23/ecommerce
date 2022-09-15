@extends('back.template.master')

@section('title', 'Quản lý danh mục')
@section('heading', 'Chỉnh sửa danh mục')
@section('category', 'active')
@section('content')
<div class="col-md-12">
    <div class="card-header">
      <a class="btn btn-danger" href="{{url('admin/category/list')}}" title="Thêm">Quay lại</a>
    </div>
  <!-- general form elements -->
  <div class="card card-primary">
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action="{{url('admin/category/edit/'.$Category->id)}}" method="POST">
      <div class="card-body">
        {!! csrf_field() !!}

        <div class="form-group">
            <label for="exampleInputEmail1">Tên danh mục<span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="Name" value="{{$Category->category_name }}" id="title" onkeyup="ChangeToSlug();">
          </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Đường dẫn</label>
            <input type="text" class="form-control" name="Alias" value="{{$Category->alias}}" id="slug">
          </div>
        <div class="form-group">
          <select class="form-control" name="Status">
            <option value="1" @if($Category->status == 1) selected="" @endif>
              Trạng thái: Bật
            </option> 
            <option value="0" @if($Category->status == 0) selected="" @endif>
              Trạng thái: Tắt
            </option>
          </select>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Sắp xếp<span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="Sort" value="{{$Category->sort}}">
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