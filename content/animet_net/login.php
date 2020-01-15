<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
$err = 'Đăng nhập vào quản trị website';
if($_POST['submit']) {
	$err = LoginAuth::loginAdmin($_POST['username'],$_POST['password']);
	if($err == 'user') $err = 'Sai tên đăng nhập hoặc tài khoản không được phép sử dụng ở đây';
	else if($err == 'pass') $err = 'Sai mật khẩu';
	else header('Location: '.SITE_URL.'/'.ADMINCP_NAME.'/');
	 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<title>Đăng nhập</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<meta name="apple-mobile-web-app-capable" content="yes"/>
<base href="<?php echo SITE_URL.'/'.ADMINCP_NAME.'/'?>" />
<!--
<link href="<?php echo ADMINCP_URL;?>css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo ADMINCP_URL;?>css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo ADMINCP_URL;?>css/font-awesome.min.css" rel="stylesheet"/>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet"/>
<link href="<?php echo ADMINCP_URL;?>css/ui-lightness/jquery-ui-1.10.0.custom.min.css" rel="stylesheet"/>
<link href="<?php echo ADMINCP_URL;?>css/base-admin-2.css" rel="stylesheet"/>
<link href="<?php echo ADMINCP_URL;?>css/base-admin-2-responsive.css" rel="stylesheet"/>
<link href="<?php echo ADMINCP_URL;?>css/pages/signin.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo ADMINCP_URL;?>css/custom.css" rel="stylesheet"/> -->
        <link rel="stylesheet" href="<?php echo ADMINCP_URL;?>bin/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">
        <link rel="stylesheet" href="<?php echo ADMINCP_URL;?>bin/vendors/bower_components/animate.css/animate.min.css">

        <!-- App styles -->
        <link rel="stylesheet" href="<?php echo ADMINCP_URL;?>bin/css/app.min.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
    <body data-sa-theme="3">
        <div class="login">

            <!-- Login -->
            <div class="login__block active" id="l-login">
                <div class="login__block__header">
                    <i class="zmdi zmdi-account-circle"></i>
                   Chào bạn! Vui Lòng Đăng Nhập 1 
		
                    <div class="actions actions--inverse login__block__actions">
                        <div class="dropdown">
                            <i data-toggle="dropdown" class="zmdi zmdi-more-vert actions__item"></i>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" data-sa-action="login-switch" data-sa-target="#" href="">Create an account</a>
                                <a class="dropdown-item" data-sa-action="login-switch" data-sa-target="#" href="">Forgot password?</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="login__block__body">
                	<form method="post"/>
                <p>
					<?php echo $err;?>
				</p>
                    <div class="form-group">
                        <input type="text" name="username" id="username" class="form-control text-center" placeholder="Tên Đăng Nhập">
                    </div>

                    <div class="form-group">
                        <input type="password" name="password" id="password" class="form-control text-center" placeholder="Mật Khẩu">
                    </div>
                    <button class="btn btn--icon login__block__btn" name="submit" value="submit"><i class="zmdi zmdi-long-arrow-right"></i></button>
                </form>
                </div>
            </div>

        </div>

        <!-- Older IE warning message -->
            <!--[if IE]>
                <div class="ie-warning">
                    <h1>Warning!!</h1>
                    <p>You are using an outdated version of Internet Explorer, please upgrade to any of the following web browsers to access this website.</p>

                    <div class="ie-warning__downloads">
                        <a href="http://www.google.com/chrome">
                            <img src="img/browsers/chrome.png" alt="">
                        </a>

                        <a href="https://www.mozilla.org/en-US/firefox/new">
                            <img src="img/browsers/firefox.png" alt="">
                        </a>

                        <a href="http://www.opera.com">
                            <img src="img/browsers/opera.png" alt="">
                        </a>

                        <a href="https://support.apple.com/downloads/safari">
                            <img src="img/browsers/safari.png" alt="">
                        </a>

                        <a href="https://www.microsoft.com/en-us/windows/microsoft-edge">
                            <img src="img/browsers/edge.png" alt="">
                        </a>

                        <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                            <img src="img/browsers/ie.png" alt="">
                        </a>
                    </div>
                    <p>Sorry for the inconvenience!</p>
                </div>
            <![endif]-->

        <!-- Javascript -->
        <!-- Vendors -->
        <script src="<?php echo ADMINCP_URL;?>bin/vendors/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="<?php echo ADMINCP_URL;?>bin/vendors/bower_components/popper.js/dist/umd/popper.min.js"></script>
        <script src="<?php echo ADMINCP_URL;?>bin/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

        <!-- App functions and actions -->
        <script src="<?php echo ADMINCP_URL;?>bin/js/app.min.js"></script>
    </body>
</html>
