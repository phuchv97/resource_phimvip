<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
include View::UploadView('header'); 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once(RK_ROOT . '/include/lib/PHPMailer//Exception.php');
require_once(RK_ROOT . '/include/lib/PHPMailer/PHPMailer.php');
require_once(RK_ROOT . '/include/lib/PHPMailer/SMTP.php');
function sendMail($title, $content, $nTo, $mTo){
    $nFrom = 'phimvip.com';
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
    $mail->SetFrom('phimvipmedia@gmail.com', $nFrom);
    //chuyen chuoi thanh mang
    $mail->Subject    = $title;
    $mail->MsgHTML($body);
    $mail->AltBody = 'This is a plain-text message body';
    $address = $mTo;
    $mail->AddAddress($address, $nTo);
    $mail->AddReplyTo('phimvipmedia@gmail.com', 'phimvip.com');
    if(!$mail->Send()) {
        return 0;
    } else {
        return 1;
    }

} 
$page = $geturl[2];
$user = MySql::dbselect('username,email,lastlogin,lastreg,facebookid,fullname,ugroup,fav_feature,fav_playlist','user',"id = '".$_SESSION["RK_Userid"]."'");
$fullname = $user[0][5];
$username = $user[0][0];
$email = $user[0][1];
$lastlogin = GetDateT($user[0][2]);
$lastreg = GetDateT($user[0][3]);
$ugroup = LoginAuth::GroupUser($user[0][6]);
$facebookurl = $user[0][4];
require_once(RK_ROOT . '/include/lib/Facebook/autoload.php');

$fb = new Facebook\Facebook ([
  'app_id' => '1001025843422893', 
  'app_secret' => 'c0c8cc3b1c71c4c3035a40e959546ab1', 
  'default_graph_version' => 'v2.10',
  ]);

$helper = $fb->getRedirectLoginHelper();

try {
  $accessToken = $helper->getAccessToken();

} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (! isset($accessToken)) {
    $permissions = array('public_profile','email'); // Optional permissions
    $loginUrl = $helper->getLoginUrl(''.SITE_URL.'/dang-nhap-facebook/', $permissions); 
    echo '<a href="'.$loginUrl.'">Click để đăng nhập</a>'; 
    header("Location: ".$loginUrl); 
    exit; 
}


$response = $fb->get('/me?fields=id,name,email', $accessToken);
$me = $response->getGraphUser();
$fullname = $me->getName(); // Tên ngu?i dùng
$id = $me->getId();
$email_fb = $me->getEmail(); //L?y d?a ch? email
$_SESSION['fb_access_token'] = (string) $accessToken;
$token = $_SESSION['fb_access_token'];
if($email_fb) {
$getu = explode('@',$email_fb);
$username = $getu[0];
} else {
$username = $id ;
}
$fb_ID = trim($id);
$facebookurl = 'https://www.facebook.com/'.$fb_ID;
$codesecurity = rand(1000,9999);
$lastreg = time();
$email = trim(htmlspecialchars($email_fb));
$check = MySql::dbselect("id,username,email,password,codesecurity","user","username = '$username' OR email = '$email'");
if($check){
		$userid = $check[0][0];
		$lastlogin = time();
		MySql::dbupdate('user',"lastlogin = '$lastlogin', token = '$token'","id = '$userid'");
		$_SESSION["RK_Userid"] 	= $userid;
  header("Location: ".SITE_URL);

} else {
    $ran = rand(123456,1000000);
    $password = md5(md5($ran).$codesecurity);
		MySql::dbinsert("user","username,email,password,codesecurity,lastreg,lastlogin,facebookid,fullname,token","'$username','$email','$password','$codesecurity','$lastreg','$lastlogin','$facebookurl','$fullname','$token'");
		$userid = mysql_insert_id();
		$_SESSION["RK_Userid"] 	= $userid;
    header("Location: ".SITE_URL);
    if($email){
    $title = 'Thông tin xem phim tại phimvip.com';
    $content = 'Cảm ơn bạn đã đăng ký tham gia tại website xem phim miễn phí https://phimvip.com !<br /><br />
               Dưới đây là thông tin tài khoản của bạn:<br /><br />
               Tài khoản : <b>'.$username.'</b> <br />
               Mật khẩu : <b>'.$ran.'</b> <br />
               Bạn có thể đổi mật khẩu mặc định tại đây: <a href="https://phimvip.com/user/update">ĐỔI NGAY</a>';
    $nTo = $fullname;
    $mTo = $email;
    //test gui mail
    $mail = sendMail($title, $content, $nTo, $mTo);
    }
                          

}

// K?t thúc ph?n luu d? li?u
 
?>