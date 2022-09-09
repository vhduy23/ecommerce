@extends('Back.template.master')
@section('tiltle','Quản lý nhận tin liên hệ')
@section('heading','Danh sách tin liên hệ')
@section('content')

<div class="col-md-12">
  <!-- general form elements -->
   <div class="card">
    <div class="card-body">
      <table id="example2" class="table table-bordered table-hover">
        <thead>
        <tr>
          <th class="text_align_center">STT</th>
          <th class=>Tên email</th>
          <th class=>Họ và tên</th>
          <th class="text_align_center">Trạng thái</th>
          <th class="text_align_center"><i class="fas fa-hammer"></i> </th>
        </tr>
        </thead>
        <tbody>
          @if(isset($Shopletter) && count($Shopletter) > 0)
          @foreach($Shopletter as $k => $v)
            <tr>
              <td class="text_align_center">{{$k+1}}</td>
              <td>{{$v->Email}}</td>
              <td>{{$v->Name}}</td>
              <td class="text_align_center">
                @if($v->IsViews == 1)
                  <span class="color_green">Đã xem</span>
                @else
                  <span class="color_red">Chưa xem</span>
                @endif
              </td>
              <td class="text_align_center">
                <a href="{{url('admin/shopletter/edit/'.$v->id)}}" title="Chỉnh sửa" class="ad_button">
                  <i class="fas fa-edit"></i>
                </a>
                <a href="{{url('admin/shopletter/delete/'.$v->id)}}" title="Xóa" class="ad_button ad_button_delete">
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

@stop