@extends('Front.template.master')

@section('title', $PageInfor->MetaTitle)
@section('description', $PageInfor->MetaDescription)
@section('keywords', $PageInfor->MetaKeyword)
@section('url', url('/'.$PageInfor->Alias))

@section($PageInfor->Alias, 'active')

@section('content')
<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Liên hệ</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="{{url('/')}}">Trang chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Liên hệ</p>
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
            <div class="contact_map">
              {!!$Map->Description!!}
            </div>
            <div class="contact_form" >
              <input type="text" id="txtName" placeholder="Họ và tên..."/>
              <input type="email" id="txtEmail" placeholder="Email..."/>
              <input type="text" id="txtPhone" placeholder="Số điện thoại..."/>
              <textarea placeholder="Lời nhắn..." id="txtMessage" rows="8"></textarea>
              <button id="btnSendContact">Gửi liệ hệ</button>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
        </div>
      </div>
   </div>

@stop