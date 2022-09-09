@extends('back.template.master')

@section('title', 'Quản lý danh mục tin tức')
@section('heading', 'Chỉnh sửa danh mục tin tức')
@section('news', 'active')
@section('content')
<div class="col-md-12">
    <div class="card-header">
      <a class="btn btn-danger" href="{{url('admin/news_cat/list')}}" title="Thêm">Quay lại</a>
    </div>
  <!-- general form elements -->
  <div class="card card-primary">
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action="{{url('admin/news_cat/edit/'.$NewsCategory->id)}}" method="POST">
      <div class="card-body">
        {!! csrf_field() !!}
        <div class="form-group">
          <select class="form-control" name="Status">
            <option value="1" @if($NewsCategory->Status == 1) selected="" @endif>
              Trạng thái: Bật
            </option> 
            <option value="0" @if($NewsCategory->Status == 0) selected="" @endif>
              Trạng thái: Tắt
            </option>
          </select>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Tên trang<span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="Name" id="title" value="{{$NewsCategory->Name}}" onkeyup="ChangeToSlug();" >
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Đường dẫn</label>
          <input type="text" class="form-control" name="Alias" id="slug" value="{{$NewsCategory->Alias}}">
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