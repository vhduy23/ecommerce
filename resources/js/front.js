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
        }
      }
  });
});