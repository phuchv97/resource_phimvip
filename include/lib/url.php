<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
// Xử lý dữ liệu và chuyển thành liên kết
class Url {
    public static function get($id,$name,$type) {
		$id = intval($id);
		$name = Replace(VietChar($name));
		$type = Replace(VietChar($type));
		if($id !== 0) $name = "$id-$name";
		$url = "/$type/$name";
		return SITE_URL.$url;
	}
	public static function get_actor($name,$type) {
		
		$url = "/$type/$name";
		return SITE_URL.$url;
    }
	public static function curRequestURL() {
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["REQUEST_URI"];
		}
		return $pageURL;
    }
}