<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
// Xử lý thông thin thành viên
class LoginAuth {
	public static function isLogin() {
        if(!$_SESSION["RK_Userid"]) {
            return false;
        }else{
            return true;
        }
    }
	public static function isLoginADMIN() {
        if(!$_SESSION["RK_Adminid"]) {
            return false;
        }else{
            return true;
        }
    }
	public static function isLoginUPLOAD() {
        if(!$_SESSION["RK_Uploadid"]) {
            return false;
        }else{
            return true;
        }
    }
	public static function addUser($username,$password,$confirmpass,$email,$captcha) {
		$username = RemoveHack($username);
		$password = RemoveHack($password);
		$confirmpass = RemoveHack($confirmpass);
		$email = RemoveHack($email);
		$captcha = RemoveHack($captcha);
		if(MySql::dbselect("id","user","username = '$username'")) $arr = 'user';
		else if(MySql::dbselect("id","user","email = '$email'")) $arr = 'email';
		else if($password !== $confirmpass) $arr = 'pass';
		else if(strlen($password) < 6 OR strlen($password) > 25) $arr = 'pass2';
		else if($captcha !== $_SESSION["security_code"]) $arr = 'captcha';
		else {
			$codesecurity = rand(1000,9999);
			$password =	md5(md5($password).$codesecurity);
			$lastreg = time();
			MySql::dbinsert("user","username,password,email,codesecurity,lastreg","'$username','$password','$email','$codesecurity','$lastreg'");
			$user_id = mysql_insert_id();
			// Set session login
			$_SESSION["RK_Userid"] 	= $user_id;
			//$arr = '{"status":1,"message":"Register Success."}';
			header("Location: ".SITE_URL);
		}
		return $arr;
	}
	public static function loginUser($username,$password,$remember,$captcha) {
		$username = RemoveHack($username);
		$password = RemoveHack($password);
		$remember = RemoveHack($remember);
		$captcha = RemoveHack($captcha);
		$user = MySql::dbselect("id,username,password,codesecurity","user","username = '$username' OR email = '$username'");
		$upassword = $user[0][2];
		$password = md5(md5($password).$user[0][3]);
		if(!$user) $arr = 'user';
		else if($upassword !== $password) $arr = 'pass';
		else if($captcha !== $_SESSION["security_code"]) $arr = 'captcha';
		else {
			$userid = $user[0][0];
			$lastlogin = time();
			MySql::dbupdate('user',"lastlogin = '$lastlogin'","id = '$userid'");
			// Set session login
			$_SESSION["RK_Userid"] 	= $userid;
			$arr = 'done';
			//header("Location: ".SITE_URL);
		}
		return $arr;
	}
	public static function loginAdmin($username,$password) {
		$username = RemoveHack($username);
		$password = RemoveHack($password);
		$user = MySql::dbselect("id,username,password,codesecurity,ugroup","user","username = '$username' AND ugroup IN (1,2)");
		$upassword = $user[0][2];
		$password = md5(md5($password).$user[0][3]);
		if(!$user) $arr = 'user';
		else if($upassword !== $password) $arr = 'pass';
		else {
			$userid = $user[0][0];
			$ugroup = $user[0][4];
			// Set session login
			$_SESSION["RK_Admingroup"] = $ugroup;
			$_SESSION["RK_Adminid"] = $userid;
			$_SESSION["RK_Userid"] 	= $userid;
			$arr = 'done';
		}
		return $arr;
	}
	public static function loginUpload($username,$password) {
		$username = RemoveHack($username);
		$password = RemoveHack($password);
		$user = MySql::dbselect("id,username,password,codesecurity,ugroup","user","username = '$username' AND ugroup IN (0,2)");
		$upassword = $user[0][2];
		$password = md5(md5($password).$user[0][3]);
		if(!$user) $arr = 'user';
		else if($upassword !== $password) $arr = 'pass';
		else {
			$userid = $user[0][0];
			$ugroup = $user[0][4];
			// Set session login
			$_SESSION["RK_Uploadgroup"] = 3;
			$_SESSION["RK_Uploadid"] = $userid;
			$_SESSION["RK_Userid"] 	= $userid;
			$arr = 'done';
		}
		return $arr;
	}
	public static function Forgot($email,$captcha) {
		$email = RemoveHack($email);
		$captcha = RemoveHack($captcha);
		if($captcha !== $_SESSION["security_code"]) $arr = 'captcha';
		else {
			  $user = MySql::dbselect("id","user","email = '$email'");
		       if(!$user) $arr = 'email';
		       else {
		       	$userid = $user[0][0];
				MySql::dbupdate('user',"forgot = '1'","id = '$userid'");
				$arr = 'done';
		       }
		}
		return $arr;
	}
	public static function Edituser($fullname,$facebook,$old_password,$new_password) {
		$fullname = RemoveHack($fullname);
		$facebook = RemoveHack($facebook);
		$old_password = RemoveHack($old_password);	
		$new_password = RemoveHack($new_password);
		$userid = $_SESSION["RK_Userid"];		
		if($old_password) {
			$user = MySql::dbselect('password, codesecurity','user',"id = '".$_SESSION["RK_Userid"]."'");
			$codesecu = $user[0][1];
			$password = $user[0][0];
			$pass_old = md5(md5($password).$codesecu);
			if($old_password!=$pass_old){
				$arr = '{"status":0,"messages":{"old_password":"The Old password is wrong."}}';
			}else{
				if($new_password==""){
					$arr = '{"status":0,"messages":{"new_password":"The New Password field is required."}}';
				}else{
					$codesecurity = rand(1000,9999);
					$password =	md5(md5($new_password).$codesecurity);
					MySql::dbupdate('user',"password = '$password', codesecurity = '$codesecurity', fullname = '$fullname', facebookid = '$facebook'","id = '$userid'");
					$arr = '{"status":1,"message":"Update profile success."}';
				}				
			}			
		}else{
			MySql::dbupdate('user',"fullname = '$fullname', facebookid = '$facebook'","id = '$userid'");
			$arr = '{"status":1,"message":"Update profile success."}';
		}
		return $arr;
	}
	public static function UpdateBilling($bank,$fullname,$bankid,$diachi,$phone,$bank_brand) {
		$fullname = RemoveHack($fullname);
		$bank = RemoveHack($bank);
		$bankid = RemoveHack($bankid);	
		$diachi = RemoveHack($diachi);
		$phone = RemoveHack($phone);
		$bank_brand = RemoveHack($bank_brand);
		$userid = $_SESSION["RK_Userid"];	
		$userbank = MySql::dbselect('id','user_billing',"userid = '".$_SESSION["RK_Userid"]."'");
		if($userbank){
			MySql::dbupdate('user_billing',"bank = '$bank', fullname = '$fullname', bankid = '$bankid', bank_brand = '$bank_brand', diachi = '$diachi', phone = '$phone'","userid = '$userid'");
		$arr = '{"status":1,"message":"Update profile success."}';
		}else{
			MySql::dbinsert("user_billing","bank,fullname,bankid,bank_brand,diachi,phone,userid","'$bank','$fullname','$bankid','$bank_brand','$diachi','$phone','$userid'");
			$arr = '{"status":1,"message":"Update profile success."}';
		}			
		return $arr;
	}
	public static function Payment($amount,$payment) {		
		$payment = RemoveHack($payment);
		$amount = RemoveHack($amount);
		$userid = $_SESSION["RK_Userid"];
		$timeupdate = time();	
		MySql::dbinsert("payment","p_amount,p_type,user_id,p_status,p_timeupdate","'$amount','$payment','$userid','pending','$timeupdate'");
		$arr = '{"status":1,"message":"Request Payment success."}';
		return $arr;
	}
	public static function logoutUser() {
		if($_SESSION["RK_Userid"]) {
            session_destroy();
			header("Location: ".SITE_URL);
        }else{
            return false;
        }
    }
	public static function logoutAdmin() {
		if($_SESSION["RK_Adminid"]) {
            session_destroy();
			return 1;
        }else{
            return false;
        }
    }
	
	public static function GroupUser($id) {
		if($id == '2') $arr = 'Quản trị viên';
		else if($id == '1') $arr = 'Hợp tác viên';
		else if($id == '3') $arr = 'Thành viên Upload';
		else $arr = 'Thành viên thường';
		return $arr;
    }
}
