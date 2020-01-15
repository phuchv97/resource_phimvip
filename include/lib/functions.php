<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
# Load lên các file có trong thư mục được chỉ định
function __autoload($class) {
	$class = strtolower($class);
	if (file_exists(RK_ROOT . '/include/model/' . $class . '.php')) {
		require_once(RK_ROOT . '/include/model/' . $class . '.php');
	} elseif (file_exists(RK_ROOT . '/include/lib/' . $class . '.php')) {
		require_once(RK_ROOT . '/include/lib/' . $class . '.php');
	} elseif (file_exists(RK_ROOT . '/include/controller/' . $class . '.php')) {
		require_once(RK_ROOT . '/include/controller/' . $class . '.php');
	} else {
		die($class . ' không có trong hệ thống');
	}
}
function get_ajaxpage($ttrow, $limit, $page, $url, $type = '') {
    $total = ceil($ttrow / $limit);
    $main .= '<ul class="pagination no-pading no-margin pull-right">';    
    if ($total <= 1)
        return '';
    if ($page <> 1) {
        $main .= "<li><a title='Sau' href='" . $url . ($page - 1) . ");'>←</a></li>";
    }
    for ($num = 1; $num <= $total; $num++) {
        if ($num < $page - 1 || $num > $page + 4)
            continue;
        if ($num == $page)
            $main .= "<li class=\"active\"><a href='#'>$num</a></li>";
        else {
            $main .= "<li><a href=\"$url$num);\">$num</a></li>";
        }
    }
    if ($page <> $total) {
        $main .= "<li><a title='Tiếp' href='" . $url . ($page + 1) . ")'>→</a></li>";
    }
    $main .= '</ul>';
    return $main;
}
function urlimg($url){
    $js = explode('https://', $url);
    $js =  $js[1] ;
    return $js;
}
//Ham gui mail
function timex($time){
			$h = "7";
			$hm = $h * 60; 
			$ms = $hm * 60;
			$gmdate = gmdate($time, time()+($ms));
			return $gmdate;
	}
# Lấy thông tin cấu hình của cache
function get_jsonconfig($config_name,$file) {
	$table = str_replace('site','',$file);
	$file = CACHE_PATH."config/$file".CACHE_EXT;
	$data = Cache::BEGIN_CACHE($file);
	if(!$data) {
		$arr = MySql::dbselect('config_name,config_content',"$table","config_name != ''");
		for($i=0;$i<count($arr);$i++) {
			$_config_name = $arr[$i][0];
			$_config_content = $arr[$i][1];
			$data[$_config_name] = $_config_content;
		}
		$data = json_encode($data);
		Cache::END_CACHE($data,$file);
	}
	$html = json_decode($data);
	$rs = $html->$config_name;
	return $rs;
}
# Info head
function head_site($data,$config_name) {
	$html = get_jsonconfig($config_name,'siteconfig_other');
	$html = str_replace('%name%',$data,$html);
	return $html;
}
# Info head
function VideoYoutubeID($url) {
	preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $url, $matches);
	$id = $matches[0];
	return $id;
}
# Lấy tên đuôi file
function get_type($filename) {
    $start = explode(".", $filename);
    $count = count($start) - 1;
    return $start[$count];
}
# Loại bỏ những ký tự dư thừa
function doStripslashes() {
	if (get_magic_quotes_gpc()) {
		$_GET = stripslashesDeep($_GET);
		$_POST = stripslashesDeep($_POST);
		$_COOKIE = stripslashesDeep($_COOKIE);
		$_REQUEST = stripslashesDeep($_REQUEST);
	}
}
# Nén dữ liệu trang
function sanitize_output($buffer) {
    $html = Cache::SanitizeOutput($buffer);
    return $html;
}
# Sửa lỗi tag
function FixTags($code) {
	$code 	= str_replace(",,,,",",",$code);
	$code 	= str_replace(",,,",",",$code);
	$code 	= str_replace(",,",",",$code);
	$code 	= str_replace(",",", ",$code);
	$tags 	= trim($code);
	return $tags;
}
function injection($str) {

    $chars = array('chr(', 'chr=', 'chr%20', '%20chr', 'wget%20', '%20wget', 'wget(','cmd=', '%20cmd', 'cmd%20', 'rush=', '%20rush', 'rush%20', 'union%20', '%20union', 'union(', 'union=', 'echr(', '%20echr', 'echr%20', 'echr=', 'esystem(', 'esystem%20', 'cp%20', '%20cp', 'cp(', 'mdir%20', '%20mdir', 'mdir(', 'mcd%20', 'mrd%20', 'rm%20', '%20mcd', '%20mrd', '%20rm', 'mcd(', 'mrd(', 'rm(', 'mcd=', 'mrd=', 'mv%20', 'rmdir%20', 'mv(', 'rmdir(', 'chmod(', 'chmod%20', '%20chmod', 'chmod(', 'chmod=', 'chown%20', 'chgrp%20', 'chown(', 'chgrp(', 'locate%20', 'grep%20', 'locate(', 'grep(', 'diff%20', 'kill%20', 'kill(', 'killall', 'passwd%20', '%20passwd', 'passwd(', 'telnet%20', 'vi(', 'vi%20', 'insert%20into', 'select%20', 'nigga(', '%20nigga', 'nigga%20', 'fopen', 'fwrite', '%20like', 'like%20', '$_request', '$_get', '$request', '$get', '.system', 'HTTP_PHP', '&aim', '%20getenv', 'getenv%20', 'new_password', '&icq','/etc/password','/etc/shadow', '/etc/groups', '/etc/gshadow', 'HTTP_USER_AGENT', 'HTTP_HOST', '/bin/ps', 'wget%20', 'uname\x20-a', '/usr/bin/id', '/bin/echo', '/bin/kill', '/bin/', '/chgrp', '/chown', '/usr/bin', 'g\+\+', 'bin/python', 'bin/tclsh', 'bin/nasm', 'perl%20', 'traceroute%20', 'ping%20', '.pl', '/usr/X11R6/bin/xterm', 'lsof%20', '/bin/mail', '.conf', 'motd%20', 'HTTP/1.', '.inc.php', 'config.php', 'cgi-', '.eml', 'file\://', 'window.open', '<SCRIPT>', 'javascript\://','img src', 'img%20src','.jsp','ftp.exe', 'xp_enumdsn', 'xp_availablemedia', 'xp_filelist', 'xp_cmdshell', 'nc.exe', '.htpasswd', 'servlet', '/etc/passwd', 'wwwacl', '~root', '~ftp', '.js', '.jsp', 'admin_', '.history', 'bash_history', '.bash_history', '~nobody', 'server-info', 'server-status', 'reboot%20', 'halt%20', 'powerdown%20', '/home/ftp', '/home/www', 'secure_site, ok', 'chunked', 'org.apache', '/servlet/con', '<script', '/robot.txt' ,'/perl' ,'mod_gzip_status', 'db_mysql.inc', '.inc', 'select%20from', 'select from', 'drop%20', '.system', 'getenv', 'http_', '_php', 'php_', 'phpinfo()', '<?php', '?>', 'sql=','\'');

    foreach ($chars as $key => $arr)

        $str = str_replace($arr, '*', $str); 

    return $str;



}
# Chống hành động xấu khi nhập dữ liệu
function RemoveHack($str) {
	$str = htmlchars(stripslashes(trim(urldecode(injection($str)))));
	return $str;
}
# Xóa file hoặc folder
function FDelete($dir, $rf = "") {
    echo 'Đang cập nhật dữ liệu.';
    $mydir = opendir($dir);
    while (false !== ($file = readdir($mydir))) {
        if ($file != "." && $file != "..") {
            if (!is_dir($dir . $file)) {
                unlink($dir . $file) or DIE("Không thể xóa $dir$file<br />");
            } 
        }
    }
    closedir($mydir);
    if ($rf != "") header("Location: /index.php");
    exit();
}
# Tính thời gian theo giờ:phút buổi ngày/tháng năm
function GetTimeDate($date) {
    $date = date("g:i A d/m/Y", $date);
    return $date;
}
# Tính thời gian theo ngày/tháng năm
function GetDateT($date) {
    $date = date("d/m/Y g:i:s", $date);
    return $date;
}
# Tính chi tiết thời gian
function smartDate($datetemp, $dstr = 'H:i d/m/Y') {
	$timezone = date_default_timezone_set('Asia/Ho_Chi_Minh');
	$op = '';
	$sec = time() - $datetemp;
	$hover = floor($sec / 3600);
	if ($hover == 0) {
		$min = floor($sec / 60);
		if ($min == 0) {
			$op = $sec . ' giây trước';
		} else {
			$op = "$min phút trước";
		}
	} elseif ($hover < 24) {
		$op = "khoảng {$hover} giờ trước";
	} else {
		$op = gmdate($dstr, $datetemp + $timezone * 3600);
	}
	return $op;
}
# Chuyển đổi chars sang html
function UnHtmlChars($str) {
    $data = str_replace(array('&lt;','&gt;','&quot;','&amp;','&#92;','&#39','&#039;'), array('<','>','"','&',chr(92),"'",chr(39)), $str);
	return $data;
}
# Chuyển đổi html sang chars
function HtmlChars($str) {
    $data = str_replace(array('&','<','>','"',chr(92),chr(39)), array('&amp;','&lt;','&gt;','&quot;','&#92;','&#39'), $str);
	return $data;
}
# Chuyển đổi ký tự tiếng việt sang dạng ascii
function VietChar($str) {
    $vietChar    = 'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ|é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|ó|ò|ỏ|õ|ọ|ơ|ớ|ờ|ở|ỡ|ợ|ô|ố|ồ|ổ|ỗ|ộ|ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|í|ì|ỉ|ĩ|ị|ý|ỳ|ỷ|ỹ|ỵ|đ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ|Ó|Ò|Ỏ|Õ|Ọ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự|Í|Ì|Ỉ|Ĩ|Ị|Ý|Ỳ|Ỷ|Ỹ|Ỵ|Đ';
    $engChar     = 'a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|e|e|e|e|e|e|e|e|e|e|e|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|u|u|u|u|u|u|u|u|u|u|u|i|i|i|i|i|y|y|y|y|y|d|A|A|A|A|A|A|A|A|A|A|A|A|A|A|A|A|A|E|E|E|E|E|E|E|E|E|E|E|O|O|O|O|O|O|O|O|O|O|O|O|O|O|O|O|O|U|U|U|U|U|U|U|U|U|U|U|I|I|I|I|I|Y|Y|Y|Y|Y|D';
    $arrVietChar = explode("|", $vietChar);
    $arrEngChar  = explode("|", $engChar);
    return str_replace($arrVietChar, $arrEngChar, $str);
}
#Chuyển đổi ký tự tiếng việt sang không dấu
function utf8convert($str) {

    if(!$str) return false;

    $utf8 = array(

'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',

'd'=>'đ|Đ',

'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',

'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',

'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',

'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',

'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',

                                    );

    foreach($utf8 as $ascii=>$uni) $str = preg_replace("/($uni)/i",$ascii,$str);

return $str;

}
#Chuyển đổi ký tự '','%',... sang '-' để tối ưu url đúng chuẩn SEO
function utf8tourl($text){
    $text = strtolower(utf8convert($text));
    $text = str_replace( "ß", "ss", $text);
    $text = str_replace( "%", "", $text);
    $text = preg_replace("/[^_a-zA-Z0-9 -] /", "",$text);
    $text = str_replace(array('%20', ' '), '-', $text);
    $text = str_replace("----","-",$text);
    $text = str_replace("---","-",$text);
    $text = str_replace("--","-",$text);
return $text;
}
# Thay thế khoảng trắng sang dấu gạch ngang, loại bỏ ký tự đặc biệt
function Replace($string) {
    $string = strtolower($string);
    $string = preg_replace(array('/[^a-zA-Z0-9 -]/','/[ -]+/','/^-|-$/'), array('','-',''), htmlspecialchars_decode($string));
    return $string;
}
# Cắt chữ
function CutName($str, $len) {
    $str = trim($str);
    if (strlen($str) <= $len)
        return $str;
    $str = substr($str, 0, $len);
    if ($str != "") {
        if (!substr_count($str, " "))
            return $str . " ...";
        while (strlen($str) && ($str[strlen($str) - 1] != " "))
            $str = substr($str, 0, -1);
        $str = substr($str, 0, -1) . " ...";
    }
    return $str;
}
# Kiểm tra dữ liệu
function CheckName($name,$text = "N/A") {
    if ($name == "") $name = $text;
    return $name;
}
# Loại bỏ html
function RemoveHtml($document) {
    $search = array(
        '@<script[^>]*?>.*?</script>@si', // Chứa javascript
        '@<[\/\!]*?[^<>]*?>@si', // Chứa các thẻ HTML
        '@<style[^>]*?>.*?</style>@siU', // Chứa các thẻ style
        '@<![\s\S]*?--[ \t\n\r]*>@' // Xóa toàn bộ dữ liệu bên trong các dấu ngoặc "<" và ">"
    );
    $text   = preg_replace($search, '', $document);
    $text   = strip_tags($text);
	$text   = trim($text);
    return $text;
}
# Chống fool, Spam
function AntiSpam() {
    $_SESSION['current_message_post'] = time();
    $timeDiff_post                    = $_SESSION['current_message_post'] - $_SESSION['prev_message_post'];
    $floodInterval_post               = 10;
    $wait_post                        = $floodInterval_post - $timeDiff_post;
    if ($timeDiff_post <= $floodInterval_post) return true;
    else return false;
}
# Kiểm tra thiết bị di động
function CheckMobile() {
    if (preg_match('/(alcatel|amoi|android|avantgo|blackberry|benq|cell|cricket|docomo|elaine|htc|iemobile|iphone|ipad|ipaq|ipod|j2me|java|midp|mini|mmp|mobi|motorola|nec-|nokia|palm|panasonic|philips|phone|sagem|sharp|sie-|smartphone|sony|symbian|t-mobile|telus|up\.browser|up\.link|vodafone|wap|webos|wireless|xda|xoom|zte)/i', $_SERVER['HTTP_USER_AGENT'])) 
	return true;
}
# Lấy chính xác địa chỉ ip thật của người dùng
function GetRealIPAddress() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        //check ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        //to check ip is pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
# Encode Link
function encrypt_decrypt($action, $string) {
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'hackcaigi';
    $secret_iv = 'hacklamcho';
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ($action == 'encrypt') {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if ($action == 'decrypt') {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}
function showLinkEpisode($link = null) {
    if (strpos($link, 'picasaweb.google.com/lh/photo/')) {
        $link = encrypt_decrypt('decrypt', str_replace('https://picasaweb.google.com/lh/photo/', '', $link));
    }
    return $link;
}
function hideLinkEpisode($link = null) {
    if (strpos($link, 'picasaweb.google.com/lh/photo/')) {
        $link = 'https://picasaweb.google.com/lh/photo/' . encrypt_decrypt('encrypt', $link);
    }
    return $link;
}
function gkplugins_encrypt($string, $key = 'hay__phimtv') {
    $string = hideLinkEpisode($string);
    $result = '';
    for ($i = 0; $i < strlen($string); $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key)) - 1, 1);
        $ordChar = ord($char);
        $ordKeychar = ord($keychar);
        $sum = $ordChar + $ordKeychar;
        $_char = chr($sum);
        $result.=$_char;
    }
    return "phim-vn.com**" . base64_encode($result);
}
# Decode uf8
function unescapeUTF8EscapeSeq($str) {
    return preg_replace_callback("/\\\u([0-9a-f]{4})/i",create_function('$matches','return html_entity_decode(\'&#x\'.$matches[1].\';\', ENT_QUOTES, \'UTF-8\');'), $str);
}
# Get BY Curl
function curlGet($URL) {
    $ch = curl_init();
    $timeout = 3;
    curl_setopt( $ch , CURLOPT_URL , $URL );
    curl_setopt( $ch , CURLOPT_RETURNTRANSFER , 1 );
    curl_setopt( $ch , CURLOPT_CONNECTTIMEOUT , $timeout );
	/* if you want to force to ipv6, uncomment the following line */ 
	//curl_setopt( $ch , CURLOPT_IPRESOLVE , 'CURLOPT_IPRESOLVE_V6');
    $tmp = curl_exec( $ch );
    curl_close( $ch );
    return $tmp;
}
# Function Explode Editor by Văn Toàn
function explode_by($begin,$end,$data) {
    $data = explode($begin,$data);
	$data = explode($end,$data[1]);
    return $data[0];
}

// thu nho anh
function imagesthumb($target, $newcopy, $ext, $w = 250, $h = 500)
{
    list($w_orig, $h_orig) = getimagesize($target);
    $scale_ratio = $w_orig / $h_orig;
    if (($w / $h) > $scale_ratio) {
        $w = $h * $scale_ratio;
    } else {
        $h = $w / $scale_ratio;
    }
    $img = "";
    $ext = strtolower($ext);
    if ($ext == "gif") {
        $img = imagecreatefromgif($target);
    } else if ($ext == "png") {
        $img = imagecreatefrompng($target);
    } else {
        $img = imagecreatefromjpeg($target);
    }
    $tci = imagecreatetruecolor($w, $h);
    // imagecopyresampled(dst_img, src_img, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)
    imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orig, $h_orig);
    if ($ext == "gif") {
        imagegif($tci, $newcopy);
    } else if ($ext == "png") {
        imagepng($tci, $newcopy);
    } else {
        imagejpeg($tci, $newcopy, 80);
    }
}
// cat anh
function cropimages($target, $newcopy, $ext, $w = 250, $h = 160)
{
    list($w_orig, $h_orig) = getimagesize($target);
    $src_x = ($w_orig / 2) - ($w / 2);
    $src_y = ($h_orig / 2) - ($h / 2);
    $ext   = strtolower($ext);
    $img   = "";
    if ($ext == "gif") {
        $img = imagecreatefromgif($target);
    } else if ($ext == "png") {
        $img = imagecreatefrompng($target);
    } else {
        $img = imagecreatefromjpeg($target);
    }
    $tci = imagecreatetruecolor($w, $h);
    imagecopyresampled($tci, $img, 0, 0, $src_x, $src_y, $w, $h, $w, $h);
    if ($ext == "gif") {
        imagegif($tci, $newcopy);
    } else if ($ext == "png") {
        imagepng($tci, $newcopy);
    } else {
        imagejpeg($tci, $newcopy, 100);
    }
}

// upload ảnh
function ipupload($name, $foder, $fileoner, $array_ext = array('jpg', 'jpeg', 'png', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF', 'srt', 'SRT', 'vtt', 'VTT'))
{
    $ichphienpro = $foder;
    $oldumask    = umask(0);
    @mkdir(UPLOAD_PATH, 0777);
    @mkdir(UPLOAD_PATH .  date("Y"), 0777);
    @mkdir(UPLOAD_PATH .  date("Y") . "/" . date("m"), 0777);
    @mkdir(UPLOAD_PATH .  date("Y") . "/" . date("m") . "/" . date("d"), 0777);
    @mkdir(UPLOAD_PATH .  date("Y") . "/" . date("m") . "/" . date("d") . "/" . $foder, 0777);
    umask($oldumask);
    $foder = date("Y") . "/" . date("m") . "/" . date("d") . "/" . $foder;
    if ($_FILES["$name"]['name'] != "") {
        $fileupload = NOW . $_FILES["$name"]['name'];
        $file_EXT   = get_type($fileupload);
        if (!in_array($file_EXT, $array_ext)) {
            return 1;
        } else {
            $fileupload = $fileoner . '.' . $file_EXT;
            $uploaddir  = UPLOAD_PATH .  $foder . "/" . $fileupload;
            // tiến hành upload ảnh
            if (@move_uploaded_file($_FILES["$name"]['tmp_name'], $uploaddir)) {
                if ($ichphienpro == "film") {
                    imagesthumb($uploaddir, $uploaddir, $file_EXT, 250);
                    $images = IMG_URL .  $foder . "/" . $fileupload;
                } elseif ($ichphienpro == "film2") {
                    $images = IMG_URL .  $foder . "/" . $fileupload;
                } elseif ($ichphienpro == "info") {
                    imagesthumb($uploaddir, $uploaddir, $file_EXT, 950);
                    watermark($uploaddir, $uploaddir);
                    $images = IMG_URL .  $foder . "/" . $fileupload;
                } else {
                    $images = IMG_URL .  $foder . "/" . $fileupload;
                }
            }
            return $images;
        }
    }
}

// gắn watermark cho ảnh
function watermark($file, $destination, $overlay = "https://phimvip.com/logo.png", $X = 10, $Y = 100){
$watermark =    imagecreatefrompng($overlay);
$source_mime = get_type($file);
if($source_mime == "png"){
$image = imagecreatefrompng($file);
}else if($source_mime == "jpg"){
$image = imagecreatefromjpeg($file);
}else if($source_mime == "gif"){
$image = imagecreatefromgif($file);
}
imagecopy($image, $watermark, imagesx($image)-imagesx($watermark)-10, imagesy($image)-imagesy($watermark)-5, 0, 0, imagesx($watermark), imagesy($watermark));
imagepng($image, $destination);
return $destination;
}
function uploadurl($url,$ipid,$fodernew) {
	if ($url) {
		$folderst	=	$fodernew;
		$name	=	basename($url);
		$fileupload			=	strtolower(substr(strrchr($name, '.'), 1));
		$foder	=	UPLOAD_PATH."images/".$folderst."/".$ipid.".".$fileupload;
		$upload = file_put_contents($foder,file_get_contents($url));	
		$uploaddir			=	UPLOAD_PATH."images/".$fodernew."/".$ipid.".".$fileupload;
		$uploaddirTHUMB = UPLOAD_PATH."images/".$fodernew."/".$ipid.".".$fileupload;
		if($folderst == "info") {
		    imagesthumb($uploaddir, $uploaddirTHUMB, $fileupload,1600,600);	
			watermark($uploaddir, $uploaddir);
        }elseif($folderst == "film"){
		imagesthumb($uploaddir, $uploaddir, $fileupload,250);	
		}else{
		watermark($uploaddir, $uploaddir);
		}
		
		$urlshow = IMG_URL."images/".$fodernew."/".$ipid.".".$fileupload;
		
	}
	else {$urlshow = '';}
	return $urlshow;
}
?>