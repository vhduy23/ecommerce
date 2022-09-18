@extends('Front.template.master')
@section('title','Giỏ hàng')
@section('heading','Giỏ hàng')
@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Giỏ hàng</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{url('/')}}">Trang chủ</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Giỏ hàng</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
<!-- Cart Start -->
        <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php  $total = 0; ?>
                        @foreach(Cart::content() as $row)
                        <?php 
                            $total += $row->qty*$row->price
                        ?>
                        <tr>
                            <td class="align-middle" style="text-align: left;"><img src="{{url('images/product/'.$row->options->images)}}" alt="{{$row->img}}" style="width: 50px;">{{$row->name}}</td>
                            <td class="align-middle">{{number_format($row->price)}}</td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <input type="number" class="form-control form-control-sm bg-secondary text-center txtQty{{$row->rowId}}" value="{{$row->qty}}">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary txtEditQty" data-id="{{$row->rowId}}">
                                        <i class="fa fa-sync-alt fa-fw"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle">{{number_format($row->qty*$row->price)}}</td>
                            <td class="align-middle" ><a href="{{url('xoa-san-pham/'.$row->rowId)}}"><button class="btn btn-sm btn-primary"><i class="fa fa-times"></i></button></a></td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
            <div class="col-lg-4">
                <!-- <form class="mb-5" action="">
                    <div class="input-group">
                        <input type="text" class="form-control p-4" placeholder="Mã giảm giá">
                        <div class="input-group-append">
                            <button class="btn btn-primary"></button>
                        </div>
                    </div>
                </form> -->
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Thông tin giỏ hàng</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Tổng tiền</h6>
                            <h6 class="font-weight-medium">{{number_format($total)}}</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Tiền ship</h6>
                            <h6 class="font-weight-medium">$10</h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Thành tiền</h5>
                            <h5 class="font-weight-bold">{{number_format($total)}}</h5>
                        </div>
                        @if(Auth::check())
                        <input type="hidden" class="txtName" value="{{Auth::user()->fullname}}"/>
                        <input type="hidden" class="txtEmail" value="{{Auth::user()->email}}"/>
                        <input type="hidden" class="txtPhone" value="{{Auth::user()->phone}}"/>
                        <input type="hidden" class="txtAddress" value="{{Auth::user()->address}}"/>
                        <input type="hidden" class="txtSession" value="true"/>
                        <button class="btn btn-block btn-primary my-3 py-3 btnSubmit" >Đặt hàng</button>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
    @if(Auth::check() == false)
    <div class="col-md-12 mb-3 "style="width: 40%;margin: auto;">
        <h5 class="font-weight-bold text-dark mb-4">Thông tin đặt hàng</h5>
        <form>
            <div class="form-group">
                <input type="text" class="form-control border-0 py-4" placeholder="Họ và tên(*)" required="required" 
                class="txtName"/>
            </div>
            <div class="form-group">
                <input type="email" class="form-control border-0 py-4" placeholder="Email" required="required" 
                class="txtEmail"/>
            </div>
            <div class="form-group">
                <input type="phone" class="form-control border-0 py-4" placeholder="Số điện thoại(*)" required="required" 
                class="txtPhone"/>
            </div>
            <div class="form-group">
                <input type="text" class="form-control border-0 py-4" placeholder="Địa chỉ(*)" required="required" 
                class="txtAddress"/>
            </div>
            <div>
                <input type="hidden" class="txtSession" value="false"/>
                <button class="btn btn-primary btn-block border-0 py-3 btnSubmit" class="btnSubmit">Đặt hàng</button>
            </div>
        </form>
    </div>
    @endif
    <!-- Cart End -->
@stop