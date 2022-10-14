@extends('Front.template.master')
@section('title','Về chúng tôi')
@section('heading', 'Về chúng tôi')
@section('content')


<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Về chúng tôi</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="{{url('/')}}">Trang chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">{{$PageInfor->Name}}</p>
        </div>
    </div>
</div>
    <!-- Page Header End -->
<div class="contact_wrap">
    <div class="container"> 
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="contact_page">
            <div class="contact_descripton">
              {!!$PageInfor->Description!!}
            </div>
           
          </div>
        </div>
        </div>
      </div>
   </div>
@stop