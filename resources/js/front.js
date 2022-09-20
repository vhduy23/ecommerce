//đăng kí nhân tin khuyến mãi footer
$('#btnSendSub').click(function(){

	var txtEmailSub = $('#txtEmailSub').val();
  var txtName = $('#txtName').val();
	var _token = $('#_token').val();

	//check email có trống hay không
	var reg =  /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

	if (reg.test(txtEmailSub) == false) {
		alert('Email này không hợp lệ, vui lòng kiểm tra lại !');
		return false;
	}
	  $.ajax({
      type: 'POST',
      url: url + "/nhan-email-lien-he",
      data: { 
        txtEmailSub : txtEmailSub, 
        txtName : txtName, 
        _token : _token 
      },
      success: function(data) {
        if (data == 'error_exists_email') {
          alert('Email này đã tồn tại, xin vui lòng kiểm tra lại !');
        } else if(data == 'error'){
          alert('Có lỗi trong quá trình thêm email, xin vui lòng kiểm tra lại !');
        }else{
          alert('Liên hệ thành công !');
          document.getElementById("#txtEmailSub").value ="";
          document.getElementById("#txtName").value ="";
        }
      }
  });
});

$('.btnAddCart').click(function() {
  if($(this).attr('data-qty') != undefined){
  var txtProductId = $(this).attr('data-id')
  var txtQty = $(this).attr('data-qty')
  var txtPrice = $(this).attr('data-price')
  var txtDiscount = $(this).attr('data-discount')
	var _token = $('#_token').val();
  var txtFee = 30000;

  }else{
    var txtProductId = $(this).attr('data-id')
    var txtQty = $('#txtQty').val();
    var txtPrice = $('#txtPrice').val();
    var txtDiscount = $('#txtDiscount').val();
    var _token = $('#_token').val();
    var txtFee = 30000;
  }

    $.ajax({
      type: 'POST',
      url: url + "/them-san-pham",
      data: { 
        txtProductId : txtProductId, 
        txtPrice : txtPrice, 
        txtDiscount : txtDiscount, 
        txtQty : txtQty, 
        txtFee : txtFee,
        _token : _token 
      },
      success: function(data) {
        if (data == 'error'){
          alert('Có lỗi trong quá trình thêm sản phẩm, xin vui lòng kiểm tra lại!');
        }else{
          window.location.href= url+"/gio-hang";
        }
      }
  });
})

$('.txtEditQty').click(function(){
  var rowId = $(this).attr('data-id');
  var txtQty = $('.txtQty'+ rowId).val();
	var _token = $('#_token').val();

  // alert('rowId:' + rowId);

  $.ajax({
    type: 'POST',
    url: url + "/cap-nhat-san-pham",
    data: { 
      rowId : rowId,
      txtQty : txtQty, 
      _token : _token 
    },
    success: function(data) {
      if (data == 'error'){
        alert('Lỗi cập nhật giỏ hàng, xin vui lòng kiểm tra lại!');
      }else{
        window.location.href= url+"/gio-hang";
      }
    }
});
})

$('#btnFee').change(function() {
  var fee = this.value;
	var rowId = $('#txtFeeId').val();

	var _token = $('#_token').val();

  // alert('txtFeeId: ' + txtFeeId)

  $.ajax({
    type: 'POST',
    url: url + "/cap-nhat-san-pham",
    data: { 
      rowId : rowId,
      fee : fee,
      _token : _token 
    },
    success: function(data) {
      if (data == 'error'){
        alert('Lỗi cập nhật phí ship, xin vui lòng kiểm tra lại!');
      }else{
        window.location.href= url+"/gio-hang";
      }

    }
});

});

$('.btnSubmit').click(function(){

  var txtName = $('.txtName').val();
  var txtEmail = $('.txtEmail').val();
  var txtPhone = $('.txtPhone').val();
  var txtAddress = $('.txtAddress').val();
  var txtSession = $('.txtSession').val();
	var _token = $('#_token').val();


	//check email có trống hay không
  if(txtName== "" || txtPhone== "" || txtAddress== ""){
    alert("Vui lòng điền vào các trường có dấu *");
    return false;
  }

	  $.ajax({
      type: 'POST',
      url: url + "/dat-hang",
      data: { 
        txtName : txtName, 
        txtEmail : txtEmail, 
        txtPhone : txtPhone, 
        txtAddress : txtAddress, 
        txtSession : txtSession,
        _token : _token 
      },
      success: function(data) {
        if (data == 'error'){
          alert('Có lỗi trong quá trình đặt hàng, xin vui lòng kiểm tra lại!');
        }else{
          alert('Đặt hàng thành công, chúng tôi sẽ sơm liên hệ tới bạn, xin cảm ơn!');
          window.location.href= url;
          if(txtSession){
            document.getElementById(".txtName").value ="";
            document.getElementById(".txtEmail").value ="";
            document.getElementById(".txtPhone").value ="";
            document.getElementById(".txtAddress").value ="";
            }
      }
      }
  });
})