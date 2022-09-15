@extends('Back.template.master')
@section('title', 'Quản lý danh mục')
@section('heading', 'Danh sách danh mục')
@section('category', 'active')
@section('content')

<div class="col-md-12">
  <!-- general form elements -->
   <div class="card">
      <div class="card-header">
          <a class="btn btn-primary" href="{{url('admin/category/add')}}" title="Thêm">Thêm</a>
      </div>
    <div class="card-body">
      <table id="example2" class="table table-bordered table-hover">
        <thead>
        <tr>
          <th class="text_align_center">STT</th>
          <th class="text_align_center">Tên trang</th>
          <th class="text_align_center">Trạng thái</th>
          <th class="text_align_center">Sắp xếp</th>
          <th class="text_align_center"><i class="fas fa-hammer"></i> </th>
        </tr>
        </thead>
        <tbody>
          @if(isset($Category) && count($Category) > 0)
          @foreach($Category as $k => $v)
            <tr>
              <td class="text_align_center">{{$k+1}}</td>
              <td>{{$v->category_name}}</td>
              <td class="text_align_center">
                @if($v->status == 1)
                  Bật
                @else
                  Tắt
                @endif
              </td>
              <td class="text_align_center">{{$v->sort}}</td>
              <td class="text_align_center">
                <a href="{{url('admin/category/edit/'.$v->id)}}" title="Chỉnh sửa" class="ad_button">
                  <i class="fas fa-edit"></i>
                </a>
                <a href="{{url('admin/category/delete/'.$v->id)}}" title="Xóa"
                    class="ad_button ad_button_delete">
                    <i class="fas fa-trash-alt"></i>
                </a>
              </td>
            </tr>
          @endforeach
          @endif
        </tbody>
        <tfoot>
        </tfoot>
      </table>
    </div>
  </div>
</div>
  <!-- /.card -->

@stop