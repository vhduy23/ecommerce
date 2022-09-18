 <!-- Topbar Start -->
 <div class="container-fluid">
        <div class="row bg-secondary py-2 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark" href="">FAQs</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Help</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Support</a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    @if(isset($Social) && count($Social)> 0)
                    @foreach($Social as $k=>$v)
                    <a class="text-dark px-2" href="{{$v->Alias}}" title="{{$v->Name}}" target="_blank">
                        {!!$v->Font!!}
                    </a>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block logo">
                <a href="{{url('/')}}" class="text-decoration-none">
                    <img src="{{url('images/logo/'.$logo->Description)}}" alt="logo">
                </a>
            </div>
            <div class="col-lg-6 col-6 text-left">
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Tìm kiếm sản phẩm...">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-3 col-6 text-right">
                <a href="" class="btn border">
                    <i class="fas fa-heart text-primary"></i>
                    <span class="badge">0</span>
                </a>
                <?php $alias='gio-hang' ?>
                <a href="{{url('/'.$alias)}}" class="btn border">
                    <i class="fas fa-shopping-cart text-primary"></i>
                    
                    <span class="badge">{{Cart::count()}}</span>
                </a>
            </div>
        </div>
    </div>
    <!-- Topbar End -->