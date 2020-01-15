<?php
error_reporting(E_ERROR | E_PARSE);
if (!defined('RK_MEDIA')) die("You does have access to this!");
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start('ob_gzhandler');
else ob_start();
session_save_path('/home/phimvip.com/public_html/sessions');
ini_set('session.gc_probability', 1); 
session_start(); 

header("Content-Type: text/html; charset=UTF-8");
date_default_timezone_set('Asia/Ho_Chi_Minh');
if (!ini_get('register_globals')) {
        $superglobals = array($_SERVER,$_ENV,$_FILES,$_COOKIE,$_POST,$_GET);
    if (isset($_SESSION)) {
        array_unshift($superglobals, $_SESSION);
    }
    foreach ($superglobals as $superglobal) {
        extract($superglobal, EXTR_SKIP);
    }
    ini_set('register_globals', true);
}
define('RK_ROOT', dirname(__FILE__));
require_once RK_ROOT.'/config.php';
define('CACHE_BIN', RK_ROOT.'/cache/phimvipcom');
define('CACHE_ADD', RK_ROOT.'/cache');
define('CACHE_PATH', RK_ROOT.'/content/cache/');
define('CACHE_TIME', 10800); // Thời gian cache lần tiếp theo
define('CACHE_EXT', '.animet_net'); // Đuôi file cache
define('TEMPLATE_PATH', RK_ROOT.'/content/SkinPC/');
define('TEMPLATE_URL', SITE_URL.'/content/SkinPC/');
define('TEMPLATE_M_PATH', RK_ROOT.'/content/SkinPC/');
define('TEMPLATE_M_URL', SITE_URL.'/content/SkinPC/');
define('UPLOAD_PATH', RK_ROOT.'/upload/');
define('UPLOAD_URL', SITE_URL.'/upload/');
define('IMG_URL', 'https://phimvip.com/upload/');
define('ADMINCP_PATH', RK_ROOT.'/content/animet_net/');
define('ADMINCP_URL', SITE_URL.'/content/animet_net/');
define('MEMUPLOAD_PATH', RK_ROOT.'/content/Up_Animet/');
define('MEMUPLOAD_URL', SITE_URL.'/content/Up_Animet/');
define('ADMINCP_NAME', 'PhimVipAD'); // Thư mục admincp
define('MEMBER_LOGIN', 'dang-nhap'); // Thư mục dang phim
define('MEMBER_REG', 'dang-ky'); // Thư mục dang phim
define('s404_URL', SITE_URL.'/ann/404/'); // Trang thông báo lỗi
require_once RK_ROOT.'/include/lib/mysql.php';
require_once RK_ROOT.'/include/lib/functions.php';
define('IS_LOGIN', LoginAuth::isLogin());
define('IS_ADMIN', LoginAuth::isLoginADMIN());
define('IS_UPLOADER', LoginAuth::isLoginUPLOAD());

define('MEMCACHED_HOST', '127.0.0.1');
define('MEMCACHED_PORT', '11211');
 
// Khỏi tạo kết nối memcache
$memcache = new Memcache;
$cacheAvailable = $memcache->connect(MEMCACHED_HOST, MEMCACHED_PORT);