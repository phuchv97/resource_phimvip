<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
class Support_Model {
	public static function AddLog($type,$mail,$text) {

			$type = intval($type);
			$content = RemoveHack($text);
			
			$username = $mail;
			if($type == '1') $type = 'Báo lỗi phim';
			else if($type == '2') $type = 'Báo lỗi video';
			else if($type == '3') $type = 'Báo lỗi hệ thống';
			else if($type == '4') $type = 'Yêu cầu chức năng';
			else if($type == '5') $type = 'Lỗi Khác';
			$title = $type." | Gửi từ $username";
			MySql::dbinsert("log","title,content","'$title','$content'");
			$_SESSION["RK_Support"] = 1;
			$arr = 'yêu cầu của bạn đã được gửi. cám ơn bạn đã ủng hộ '.SITE_URL;
		
		return $arr;
	}
}
