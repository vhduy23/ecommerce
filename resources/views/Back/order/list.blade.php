@extends('back.template.master')

@section('title', 'Quản lý đơn đặt hàng')
@section('heading', 'Danh sách đơn đặt hàng')
@section('order', 'active')
@section('content')
<div class="col-md-12">
  <!-- general form elements -->
   <div class="card">
    <div class="card-body">
      <table id="example2" class="table table-bordered table-hover">
        <thead>
        <tr>
          <th class="text_align_center">STT</th>
          <th class="text_align_center">Mã đơn hàng</th>
          <th class="text_align_center">Tên khách hàng</th>
          <th class="text_align_center">Tổng tiền(VNĐ)</th>
          <th class="text_align_center">Trạng thái</th>
          <th class="text_align_center"><i class="fas fa-hammer"></i> </th>
        </tr>
        </thead>
        <tbody>
          @if(isset($Order) && count($Order) > 0)
          @foreach($Order as $k => $v)
            <tr>
              <td class="text_align_center">{{$k+1}}</td>
              <td class="text_align_center">{{$v->code}}</td>
              <td>{{$v->fullname}}</td>
              <td class="text_align_center">{{number_format($v->total)}}</td>
              <td class="text_align_center">{{$v->name}}</td>
              <td class="text_align_center">
                <a href="{{url('admin/order/edit/'.$v->id)}}" title="Chỉnh sửa" class="ad_button">
                  <i class="fas fa-edit"></i>
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