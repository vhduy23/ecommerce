 <!-- Footer Start -->
 <div class="container-fluid bg-secondary text-dark mt-5 pt-1">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5 logo">
                <a href="{{url('/')}}" class="text-decoration-none align-content-center">
                    <img src="{{url('images/logo/'.$logo->Description)}}" alt="logo">
                </a>
                <p>Chúng tôi nhận đặt hàng trực tuyến và giao hàng tận nơi. KHÔNG hỗ trợ đặt mua và nhận hàng trực tiếp tại văn phòng cũng như tất cả Hệ Thống SEA Bookstore trên toàn quốc.</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>{{$address->Description}}</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>{{$email->Description}}</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>{{$phone->Description}}</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Dịch vụ</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-dark mb-2" href="index.html"><i class="fa fa-angle-right mr-2"></i>Điều khoản sử dụng</a>
                            <a class="text-dark mb-2" href="shop.html"><i class="fa fa-angle-right mr-2"></i>Chính sách bảo mật</a>
                            <a class="text-dark mb-2" href="detail.html"><i class="fa fa-angle-right mr-2"></i>Chính sách bảo mật thanh toán</a>
                            <a class="text-dark mb-2" href="cart.html"><i class="fa fa-angle-right mr-2"></i>Hệ thống trung tâm - nhà sách</a>
                            <a class="text-dark" href="contact.html"><i class="fa fa-angle-right mr-2"></i>Giới thiệu về SEA Bookstore</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Hỗ trợ</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-dark mb-2" href="index.html"><i class="fa fa-angle-right mr-2"></i>Chính sách đổi - trả - hoàn tiền</a>
                            <a class="text-dark mb-2" href="shop.html"><i class="fa fa-angle-right mr-2"></i>Chính sách khách sỉ</a>
                            <a class="text-dark mb-2" href="detail.html"><i class="fa fa-angle-right mr-2"></i>Phương thức vận chuyển</a>
                            <a class="text-dark mb-2" href="cart.html"><i class="fa fa-angle-right mr-2"></i>Phương thức thanh toán và xuất HĐ</a>
                            <a class="text-dark" href="contact.html"><i class="fa fa-angle-right mr-2"></i>Tài khoản</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Liên hệ</h5>
                        <form>
                            <div class="form-group">
                                <input type="text" class="form-control border-0 py-4" placeholder="Họ và tên" required="required" 
                                id="txtName"/>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control border-0 py-4" placeholder="Email" required="required" 
                                id="txtEmailSub"/>
                            </div>
                            <div>
                                <button class="btn btn-primary btn-block border-0 py-3" type="submit" id="btnSendSub">Gửi ngay</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top border-light mx-xl-5 py-4">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-dark">
                    <a class="text-dark font-weight-semi-bold" href="#">Copyright &copy;{{date('Y')}} {{$copyright->Description}}</a>
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="img/payments.png" alt="">
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


		<!-- JavaScript Libraries -->
		<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
		<script src="lib/easing/easing.min.js"></script>
		<script src="lib/owlcarousel/owl.carousel.min.js"></script>

		<!-- Contact Javascript File -->
		<script src="mail/jqBootstrapValidation.min.js"></script>
		<script src="mail/contact.js"></script>

		<!-- Template Javascript -->
		<script src="js/main.js"></script>