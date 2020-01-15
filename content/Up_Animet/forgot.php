<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
include View::UploadView('header');
if($_SESSION["RK_Userid"]){
	header("Location: ".SITE_URL);
	exit;
}
$err = 'Forgot password';
if($_POST['submit']) {
	$err = LoginAuth::Forgot($_POST['email'],$_POST['security']);
	if($err == 'email') $err = 'Email không có trong hệ thống của chúng tôi, vui lòng kiểm tra lại';
	else if($err == 'captcha') $err = 'Sai mã bảo mật.';
	else {
		$err = 'THÀNH CÔNG ! VUI LÒNG KIỂM TRA EMAIL CỦA BẠN(Trong inbox hoặc spam)' ;
		echo '<meta http-equiv="refresh" content="5;url=https://phimvip.com/"> ';
	}
}
?>
<body>
<div class="container">
<div class="row main">
<div class="navbar-menu">
<div class="row col-xs-4 col-md-8 col-lg-8">
<div class="logo">
<a href='/'>
<img src="/assets/images/logo.png" style="display: block !important;" class="img-responsive">
</a>
</div>
</div>
<div class="col-xs-8 col-md-4 col-lg-4 text-right">
<a href="/dang-nhap"> Đăng nhập </a> |<a href="/dang-ky"> Đăng ký </a>
</div>
</div>
<div class="bg-main" style="display:block">
<div class="col-xs-12 col-md-12">
<h1 class="title">Quên Mật Khẩu</h1>
</div>
<div class="col-xs-12 col-md-12" style="display:block;">
<div class="row">
<div class="col-xs-12 col-md-6">
<div class="form-login">
<div class="row login">
<form name="login-cash" method="post" class="col-xs-12">
<div class="row">
<p><?php echo $err;?></p>
</div>
<div class="row">
<div class="col-xs-12">
<span id="title-login">Email</span>
</div>
</div>
<div class="row col-xs-12 col-md-10">
<input type="email" id="email" class="form-control" placeholder="Email của bạn" name="username">
</div>
<div id="log-captcha" class="row">
<div class="col-xs-12">
<span>Mã xác nhận</span>
</div>
</div>
<div class="row col-xs-12 col-md-10">
<input type="text" class="form-control" name="security" id="security" placeholder="Nhập mã xác nhận bên dưới" />
<div class="message"></div>
</div>
<div class="row col-xs-12 col-md-10">
	<img src='<?php echo SITE_URL; ?>/include/lib/security.php?<?php echo time();?>' style="height: 40px;" />
</div>
<div class="row col-xs-12 col-md-10 button-login">
<button class="btn btn-lg btn-block" name="submit" value="submit">Gửi Email</button>
</div>
</form>
</div>
</div>
</div>
<div class="col-xs-12 col-md-6">
<div class="form-social">
<div class="row">
<form name="login-cash" class="row col-xs-12 col-md-10 button-login">
<div class="row col-md-8 btn-padding">
<a href="/dang-nhap-facebook" id="fb-login" class="btn btn-lg btn-block btnLoginFacebook"><span style="font-size: 14px">Đăng nhập bằng Facebook</span></a>
</div>
<div class="row col-xs-12 col-md-10 button-login">
<input type="button" id="acc-register" class="btn btn-lg btn-block btn-register" onclick="window.location.href='/dang-ky'" value="Đăng ký tài khoản">
</div>
</form>
</div>
</div>
<div class="row">
</div>
</div>
</div>
</div> 
</div>
</div>
</div> 
<?php
include View::UploadView('footer');
?>