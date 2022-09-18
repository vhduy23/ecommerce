@extends('Front.template.master')
@section('title','Trang chủ')
@section('heading','Trang chủ')
@section('url', url('/'))
@section('content')
<!-- Navbar Start -->
    <div class="container-fluid mb-5">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">Danh mục</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="navbar-vertical">
                    <div class="navbar-nav w-100 overflow-hidden" id="fillter" style="height: 410px">
                        @if(isset($Category) && count($Category) > 0)
                            @foreach($Category as $category)
                                <a href="{{url('/'.$category->alias)}}" class="nav-item nav-link">{{$category->category_name}}</a>
                                <input type="hidden" id="cate" value="{{$category->alias}}">
                            @endforeach
                        @endif
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">SEA</span>book</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            @if(isset($Page) && count($Page) > 0)
                                @foreach($Page as $k=>$v)
                                    <a href="{{url('/'.$v->Alias)}}" title="{{$v->name}}" class="nav-item nav-link @if($k == 0) active @endif" >{{$v->Name}}</a>
                                @endforeach
                            @endif
                        </div>
                        @if(Auth::check())
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fas fa-user text-primary"></i> {{Auth::user()->fullname}}</a>
                                <div class="dropdown-menu rounded-0 m-0">
                                    <a href="cart.html" class="dropdown-item">Thông tin</a>
                                    <a href="{{url('/logout-customer')}}" class="dropdown-item">Đăng xuất</a>
                                </div>
                            </div>
                        @else
                        <div class="navbar-nav ml-auto py-0">
                            <a href="{{ url('/login') }}" class="nav-item nav-link">Đăng nhập</a>
                            <a href="{{ url('/register') }}" class="nav-item nav-link">Đăng ký</a>
                        </div>
                        @endif
                    </div>
                </nav>
                <div id="header-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">

                            @if(isset($Slider) && count($Slider) > 0)
                                @foreach($Slider as $k=>$v)
                                <div class="carousel-item @if($k==0) active @endif" style="height: 410px;">
                                    <img class="img-fluid" src="{{url('images/slider/'.$v->Images)}}" alt="{{$v->Name}}">
                                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                        <div class="p-3" style="max-width: 700px;">
                                            <!-- <h4 class="text-light text-uppercase font-weight-medium mb-3">{{$v->Name}}</h4> -->
                                            <a href="{{url('/')}}" class="btn btn-light py-2 px-3">Mua ngay</a>
                                        </div>
                                    </div>
                                    </div>
                                @endforeach
                            @endif
                    </div>
                    <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-prev-icon mb-n2"></span>
                        </div>
                    </a>
                    <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-next-icon mb-n2"></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
<!-- Navbar End -->


<!-- Featured Start -->
  <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Sản phẩm chất lượng</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                    <h5 class="font-weight-semi-bold m-0">Miễn phí giao hàng nội thành</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Đổi trả trong 14 ngày</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Hỗ trợ 24/7</h5>
                </div>
            </div>
        </div>
    </div>
<!-- Featured End -->


<!-- Products Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Sản phẩm yêu thích</span></h2>
        </div>
        <div class="row px-xl-5 pb-3">
        <?php $qty = 1; ?>
            @if(isset($Products) && count($Products) > 0)
                @foreach($Products as $k => $v)
                    <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                        <div class="card product-item border-0 mb-4">
                            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                <img class="img-fluid w-100" src="{{asset('images/product/'.$v->images)}}" alt="$v->images">
                            </div>
                            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                <h6 class="text-truncate mb-3">{{$v->name}}</h6>
                                <div class="d-flex justify-content-center">
                                @if($v->discount > 0)
                                        <h6> {{number_format($v->price - ($v->price * $v->discount / 100))}} VNĐ</h6><h6 class="text-muted ml-2"><del>{{number_format($v->price)}} VNĐ</del></h6>
                                        @else
                                        <h6>{{number_format($v->price)}} VNĐ</h6>
                                    @endif 
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between bg-light border">
                                <a href="{{url('/'.$v->alias)}}.html" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Xem chi tiết</a>
                                <a href="" class="btnAddCart"
                                data-id="{{$v->id}}" 
                                data-qty="{{$qty}}" 
                                data-price="{{$v->price - ($v->price * $v->discount / 100)}}" 
                                data-discount="{{$v->discount}}" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Thêm vào giỏ</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Sản phẩm mới nhất</span></h2>
        </div>
        <div class="row px-xl-5 pb-3">
        @if(isset($NewProducts) && count($NewProducts) > 0)
            @foreach($NewProducts as $k => $v)
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="card product-item border-0 mb-4">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="img-fluid w-100" src="{{url('images/product/'.$v->images)}}" alt="">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">{{$v->name}}</h6>
                            <div class="d-flex justify-content-center">
                            @if($v->discount > 0)
                                <h6> {{number_format($v->price - ($v->price * $v->discount / 100))}} VNĐ</h6><h6 class="text-muted ml-2"><del>{{number_format($v->price)}} VNĐ</del></h6>
                                @else
                                <h6>{{number_format($v->price)}} VNĐ</h6>
                            @endif 
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="{{url('/'.$v->alias)}}.html" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Xem chi tiết</a>
                            <a href="" class="btnAddCart"
                                data-id="{{$v->id}}" 
                                data-qty="{{$qty}}" 
                                data-price="{{$v->price - ($v->price * $v->discount / 100)}}" 
                                data-discount="{{$v->discount}}"class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Thêm vào giỏ</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
        </div>
    </div>
<!-- Products End -->




@stop