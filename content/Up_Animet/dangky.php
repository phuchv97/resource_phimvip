<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
include View::UploadView('header');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once(RK_ROOT . '/include/lib/PHPMailer//Exception.php');
require_once(RK_ROOT . '/include/lib/PHPMailer/PHPMailer.php');
require_once(RK_ROOT . '/include/lib/PHPMailer/SMTP.php');
function sendMail($title, $content, $nTo, $mTo){
    $nFrom = 'PhimAZ';
    $mFrom = 'SMTP_Injection';  //dia chi email cua ban 
    $mPass = '886bda93a996df22ed1948247b3c13cb4d63fa87';       //mat khau email cua ban
    $mail             = new PHPMailer();
    $body             = $content;
    $mail->IsSMTP(); 
    $mail->CharSet   = "utf-8";
    $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
    $mail->SMTPAuth   = true;                    // enable SMTP authentication
    $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
    $mail->Host       = "smtp.sparkpostmail.com";        
    $mail->Port       = 2525;
    $mail->Username   = $mFrom;  // GMAIL username
    $mail->Password   = $mPass;               // GMAIL password
    $mail->SetFrom('admin@phimaz.net', $nFrom);
    //chuyen chuoi thanh mang
    $mail->Subject    = $title;
    $mail->MsgHTML($body);
    $mail->AltBody = 'This is a plain-text message body';
    $address = $mTo;
    $mail->AddAddress($address, $nTo);
    $mail->AddReplyTo('admin@phimaz.net', 'PHIMAZ');
    if(!$mail->Send()) {
        return 0;
    } else {
        return 1;
    }

}
if($_SESSION["RK_Userid"]){
	header("Location: ".SITE_URL);
	exit;
}
$err = 'Đăng ký hệ thống xem phim miễn phí PhimAZ';
if($_POST['submit']) {
	$err = LoginAuth::addUser($_POST['username'],$_POST['password'],$_POST['confirm_password'],$_POST['email'],$_POST['captcha']);
	if($err == 'user') $err = 'Tài khoản đã được sử dụng.';
	else if($err == 'email') $err = 'Email đã được sử dụng.';
	else if($err == 'pass') $err = 'Xác nhận mật khẩu không đúng.';
	else if($err == 'pass2') $err = 'Mật khẩu không hợp lệ.';
	else if($err == 'captcha') $err = 'Sai mã bảo mật.';
	else header('Location: '.SITE_URL.'/');
	if($_POST['email']){
    $title = 'Thông tin xem phim tại BiPhim.Net';
    $content = 'Cảm ơn bạn đã đăng ký tham gia tại website xem phim miễn phí https://phimaz.net !<br /><br />
               Dưới đây là thông tin tài khoản của bạn:<br /><br />
               Tài khoản : <b>'.$_POST['username'].'</b> <br />
               Mật khẩu : <b>'.$_POST['password'].'</b> <br />
               Bạn có thể đổi mật khẩu mặc định tại đây: <a href="https://phimaz.net/user/update">ĐỔI NGAY</a>';
    $nTo = $_POST['username'];
    $mTo = $_POST['email'];
    //test gui mail
    $mail = sendMail($title, $content, $nTo, $mTo);
    }
}

?>
<body>
<div class="container">
<div class="row main">
<div class="navbar-menu">
<div class="col-xs-6 col-md-8 col-lg-8">
<div class="logo">
<a href="/">
<img src="/logo.png" class="img-responsive">
</a>
</div>
</div>
<div class="col-xs-6 col-md-4 col-lg-4 text-right">
</div>
</div>
</div>
<div class="bg-main" style="display:block">
<div class="col-xs-12 col-md-12">
<h1 class="title">Đăng ký tài khoản</h1>
<h5 class="des">Đăng ký tài khoản ngay hôm nay để xem phim với chất lượng cao hoàn toàn miễn phí</h5>
</div>
<div class="col-xs-12 col-md-12">
<div class="row">
<div class="col-xs-12 col-md-6">
<div class="form-login">
<div class="row login">
<form class="forms-horizontal col-xs-12" enctype="multipart/form-data" id="dangky-form" method="post" action="<?=SITE_URL?>/ajax/user_register"> 
<div class="form-group">
<div class="row">
<p id="error-username"></p>
</div>
<label class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-xxs-12 control-label">Họ và tên</label>
<div class="col-lg-9 col-md-7 col-sm-8 col-xs-8 col-xxs-12"><input type="text" id="username" name="username" class="form-control" placeholder="Nickname của bạn"/></div></div> 
<div class="form-group">
<div class="row">
<p id="error-email"></p>
</div>
<label class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-xxs-12 control-label">Email</label>
<div class="col-lg-9 col-md-7 col-sm-8 col-xs-8 col-xxs-12"><input type="text" id="email" name="email" class="form-control" placeholder="Email"/></div></div> 
<div class="form-group">
<div class="row">
<p id="error-password"></p>
</div>
<label class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-xxs-12 control-label">Mật khẩu</label>
<div class="col-lg-9 col-md-7 col-sm-8 col-xs-8 col-xxs-12"><input type="password" id="password" name="password" class="form-control" placeholder="Mật khẩu"/></div></div> 
<div class="form-group">
<div class="row">
<p id="error-confirm_password"></p>
</div>
<label class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-xxs-12 control-label">Xác nhận mật khẩu</label>
<div class="col-lg-9 col-md-7 col-sm-8 col-xs-8 col-xxs-12"><input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Xác nhận mật khẩu"/></div></div> 
<div class="form-group">
<div class="row">
<p id="error-captcha"></p>
</div>
<label class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-xxs-12 control-label">Mã xác nhận</label>
<div class="col-lg-9 col-md-7 col-sm-8 col-xs-8 col-xxs-12"><input type="text" id="captcha" name="captcha" class="form-control" placeholder="Nhập mã xác nhận bên dưới"/></div></div> 
<div class="form-group">
<label class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-xxs-12 control-label"></label>
<div class="col-lg-9 col-md-7 col-sm-8 col-xs-8 col-xxs-12"><img src='<?php echo SITE_URL; ?>/include/lib/security.php?<?php echo time();?>' style="height: 40px;"/></div></div> 

<div class="form-group">
<div class="col-lg-12 col-md-12 col-sm-8 col-xs-8 col-xxs-12">
<input type="checkbox" id="accept" name="accept" value="1"/> Tôi đồng ý với <a href="#" class="policy" target="_blank">điều khoản sử dụng</a></div></div> <div class="row col-md-12 button-login btn_register">
<button type="submit" class="btn btn-lg btn-block">Đăng ký</button>
</div>
</form> </div>
</div>
</div>
<div class="col-xs-12 col-md-6">
<div id="message-social" class="row col-md-8 button-login red-alert-social-mh"></div>
<div class="form-social">
<div class="row">
<form name="login-cash" class="col-xs-12">
<div class="row col-md-8 btn-padding">
<a href="/dang-nhap-facebook" id="fb-login" class="btn btn-lg btn-block btnLoginFacebook"><span style="font-size: 14px">Đăng nhập bằng Facebook</span></a>
</div>
<div class="row col-md-8 button-login">
<input type="button" onclick="location.href='/dang-nhap'" id="acc-register" class="btn btn-lg btn-block btn-register" value="Đăng nhập">
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
<script type="text/javascript" src="<?=SITE_URL?>/assets/js/user.min.js"></script>
	     </div>          
		</div><!-- /container -->
<?php
include View::UploadView('footer');
?>