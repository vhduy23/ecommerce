@extends('Front.template.master')
@section('title','Sản phẩm')
@section('heading','Sản phẩm')
@section('content')
<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Cửa hàng</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="{{asset('/')}}">Trang chủ</a></p>
            <p class="m-0 px-2">-</p>
            @if($Alias == 'san-pham')
            <p class="m-0">Sản phẩm</p>
            @else  
            <?php $alias = 'san-pham'; ?>
            <p class="m-0"><a href="{{asset('/'.$alias)}}">Sản phẩm</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0 px-2">{{$Cate->category_name}}</p>
            @endif
        </div>
    </div>
</div>
<!-- Page Header End -->
 <!-- Shop Start -->
 <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <!-- Shop Product Start -->
            <div class="col-lg-12 col-md-12 " style="max-width: 80%; margin: auto;">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4 float-right">
                            <div class="dropdown ml-4 ">
                                <button class="btn border dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                            Sort by
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                                    <a class="dropdown-item" href="#">Latest</a>
                                    <a class="dropdown-item" href="#">Popularity</a>
                                    <a class="dropdown-item" href="#">Best Rating</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $qty = 1; ?>
                    @if(isset($Products) && count($Products) > 0)
                        @foreach($Products as $k => $v)
                        <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                            <div class="card product-item border-0 mb-4">
                                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                    <img class="img-fluid w-100" style="max-height: 236px;" src="{{url('images/product/'.$v->images)}}" alt="$v->images">
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
                                    data-discount="{{$v->discount}}" 
                                    class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Thêm vào giỏ</a>
                                    <input type="hidden" class="txtPrice" value="{{$v->price - ($v->price * $v->discount / 100)}}">
                                    <input type="hidden" class="txtDiscount" value="{{$v->discount}}">
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="col-12 pb-1">
                        <nav aria-label="Page navigation">
                          <ul class="pagination justify-content-center mb-3">
                            <li class="page-item disabled">
                              <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                              </a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item">
                              <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                              </a>
                            </li>
                          </ul>
                        </nav>
                    </div>
                    @else
                        <p class="text-center">Không có sản phẩm</p>
                    @endif
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@stop