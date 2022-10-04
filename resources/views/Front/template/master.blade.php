<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noodp,index,follow" />
    <meta name='revisit-after' content='1 days' />
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')"/>
    <meta name="keywords" content="@yield('keywords')"/>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('/images/favicon/'.$favicon->Description)}}" />
    <meta property="og:locale" itemprop="inLanguage" content="vi_VN"  />   
    <meta property="og:url" content="@yield('url')" /> 
    <meta property="og:type" content="article" />
    <meta property="og:title" content="@yield('title')" />
    <meta property="og:description" content="@yield('description')" />
    <meta property="og:image" content="@yield('images')" />    
    <meta property="og:site_name" content="SEA Book Store" />    
    <meta name="copyright" content="SEABook Store"/> 
    <meta name="author" content="SEABook Store">
    <meta name="geo.placename" content="Ho Chi Minh, Viet Nam"/>
    <meta name="geo.region" content="VN-HCM"/>

<!-- Google Web Fonts -->

<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 
<!-- <link href="{{url('public/front/css/css2.css')}}" rel="stylesheet"> -->



<!-- Font Awesome -->
<link href="{{asset('fontawesome-free-5.15.3/css/all.css')}}" rel="stylesheet" />


<!-- Libraries Stylesheet -->
<link href="{{asset('front/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
<link href="{{asset('front/css/style2.css')}}" rel="stylesheet" />
<!-- Customized Bootstrap Stylesheet -->
<link href="{{asset('front/css/style.css')}}" rel="stylesheet">
<link href="{{asset('front/css/c-style.css')}}" rel="stylesheet">

    <script type="text/javascript">var url ="{!!url('/')!!}";</script> 
</head>
<body id="trangchu">
<input type="hidden" id="_token" value="{{csrf_token()}}">
    <div id="wrapper">
      @include('Front.template.header')
      <div class="content">
        @yield('content')
      </div>
      @include('Front.template.footer')
    </div>     
</body>



  	<!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!-- <script src="{{asset('/public/front/js/jquery-3.4.1.min.js')}}"></script> -->
		<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script> -->
    <!-- <script src="{{url('public/front/js/bootstrap.bundle.min.js')}}"></script> -->
		<script src="{{asset('front/lib/easing/easing.min.js')}}"></script>
		<script src="{{asset('front/lib/owlcarousel/owl.carousel.min.js')}}"></script>

		<!-- Contact Javascript File -->
		<!-- <script src="{{asset('/public/front/mail/jqBootstrapValidation.min.js')}}"></script> -->
		<!-- <script src="{{asset('/public/front/mail/contact.js')}}"></script> -->

		<!-- Template Javascript -->
		<script src="{{asset('front/js/main.js')}} "></script>
    <script src="{{asset('front/js/front.js')}}"></script>


</html>