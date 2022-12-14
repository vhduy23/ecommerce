@extends('Back.template.master')
@section('title', 'Quản lý nhân viên')
@section('heading', 'Danh sách nhân viên')
@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="{{url('admin/staff/add')}}" title="Thêm">Thêm</a>
        </div>
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="text_align_center">STT</th>
                        <th>Họ và tên</th>
                        <th>Cập bậc</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th class="text_align_center"><i class="fas fa-hammer"></i> </th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($User) && count($User) > 0)
                    @foreach($User as $k => $v)
                    <tr>
                        <td class="text_align_center">{{$k+1}}</td>
                        <td>{{$v->fullname}}</td>
                        <td>{{$v->name}}</td>
                        <td>{{$v->email}}</td>
                        <td>{{$v->phone}}</td>
                        <td class="text_align_center">
                            <a href="{{url('admin/staff/edit/'.$v->id)}}" title="Chỉnh sửa" class="ad_button">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{url('admin/staff/delete/'.$v->id)}}" title="Xóa"
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
@stop