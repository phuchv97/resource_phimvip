<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
include View::UploadView('header');
if($_SESSION["RK_Userid"]){
	header("Location: ".SITE_URL);
	exit;
}
$err = 'Đăng nhập vào hệ thống xem phim XLC MEDIA';
if($_POST['submit']) {
	$err = LoginAuth::loginUser($_POST['username'],$_POST['password'],$_POST['remember'],$_POST['security']);
	if($err == 'user') $err = 'Sai tên đăng nhập hoặc tài khoản không được phép sử dụng ở đây';
	else if($err == 'pass') $err = 'Sai mật khẩu';
	else if($err == 'captcha') $err = 'Sai mã xác nhận';
	else header('Location: '.SITE_URL.'/');
}
?>
<body>
<div class="container">
<div class="row main">
<div class="navbar-menu">
<div class="row col-xs-4 col-md-8 col-lg-8">
<div class="logo">
<a href='/'>
<img src="/logo.png" style="display: block !important;" class="img-responsive">
</a>
</div>
</div>
<div class="col-xs-8 col-md-4 col-lg-4 text-right">
<a href="/dang-nhap"> Đăng nhập </a> |<a href="/dang-ky"> Đăng ký </a>
</div>
</div>
<div class="bg-main" style="display:block">
<div class="col-xs-12 col-md-12">
<h1 class="title">Đăng nhập</h1>
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
<span id="title-login">Tài khoản/ Email</span>
</div>
</div>
<div class="row col-xs-12 col-md-10">
<input type="text" id="username" class="form-control" placeholder="Tên đăng nhập" name="username">
</div>
<div id="log-password" class="row">
<div class="col-xs-12">
<span>Mật khẩu</span>
</div>
</div>
<div class="row col-xs-12 col-md-10">
<input type="password" id="password" class="form-control" placeholder="Nhập mật khẩu" name="password">
<div class="message"></div>
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
<div class="col-xs-12 col-md-10 radio-text">
<div id="rememer-acc" class="col-xs-6 col-sm-6">
<label class="checkbox">
<input type="checkbox" name="remember" id="remember" value="yes" class="text-nomarl"> Nhớ tài khoản
</label>
</div>
<div id="forgot-pass-lo" class="row col-xs-6 col-sm-6 radio-right">
<p id="forgot-pass" class="forgotPwd">
<a href="/quen-mat-khau">Quên mật khẩu</a>
</p>
</div>
</div>
<div class="row col-xs-12 col-md-10 button-login">
<button class="btn btn-lg btn-block" name="submit" value="submit">Đăng nhập</button>
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