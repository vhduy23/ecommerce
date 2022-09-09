@extends('back.template.master')

@section('title', 'Quản lý danh sách sản phẩm')
@section('heading', 'Thêm sản phẩm')
@section('product', 'active')
@section('content')
<div class="col-md-12">
  <!-- general form elements -->
  <div class="card">

    <div class="card-header">
        <a class="btn btn-danger" href="{{url('admin/product/list')}}" title="Thêm">Quay lại</a>
      </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action="{{url('admin/product/add')}}" method="POST" enctype="multipart/form-data">
      <div class="card-body">
        {!! csrf_field() !!}
        <div class="row">
          <div class="col-6">
            <div class="form-group">
            <label for="exampleInputEmail1">Trạng thái</label>
            <select class="form-control" name="Status">
              <option value="1">
                Bật
              </option> 
              <option value="0">
                Tắt
              </option>
            </select>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Tên sản phẩm<span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="Name" id="title" onkeyup="ChangeToSlug();">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Đường dẫn</label>
            <input type="text" class="form-control" name="Alias" id="slug">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Ảnh đại diện</label>
            <input type="file" class="form-control" name="Images">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Tác giả</label>
            <input type="text" class="form-control" name="Author">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Nhà xuất bản</label>
            <input type="text" class="form-control" name="Publisher">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Giá</label>
            <input type="number" class="form-control" name="Price">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Mã sản phẩm<span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="Code">
          </div>
        </div>
        <div class="col-6">
            <div class="form-group">
              <label for="exampleInputEmail1">Danh mục</label>
              <select class="form-control" name="categoryId">
                @if(isset($Categories) && count($Categories) > 0)
                  @foreach($Categories as $k => $v)
                    <option value="{{$v->id}}">{{$v->category_name}}</option> 
                  @endforeach
                @endif 
              </select>
            </div>
              <div class="form-group">
              <label for="exampleInputEmail1">Khuyến mãi</label>
              <input type="number" class="form-control" value="0"  name="Discount">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Lượt xem</label>
              <input type="number" name="Views" value="1" class="form-control" />
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Điểm nổi bật</label>
              <input type="number" name="Highlight" value="1" class="form-control" />
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Số lượng</label>
              <input type="number" name="Quantity" value="1" class="form-control" />
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Thẻ meta title</label>
              <textarea name="MetaTitle" rows="3" class="form-control"></textarea>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Thẻ meta keyword</label>
              <textarea name="MetaKeyword" rows="3" class="form-control"></textarea>
            </div>
        </div>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Thẻ meta description</label>
          <textarea name="MetaDescription" rows="3" class="form-control"></textarea>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Giới thiệu ngắn</label>
          <textarea name="SmallDescription" rows="4" class="form-control" id="ckeditor"></textarea>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1" >Mô tả sản phẩm<span class="text-danger">*</span></label>
          <textarea name="Description" rows="8" class="form-control" id="editor"></textarea>
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