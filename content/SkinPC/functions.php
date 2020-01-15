<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
require_once("phpfastcache.php");
$Cache = phpFastCache();
$main_title = Config_Model::ConfigName('site_name');
$main_description = Config_Model::ConfigName('site_description');
$main_keywords = Config_Model::ConfigName('site_keywords');
//***********************************************************************************************************************************//
// youtube 

class YoutbeDownloader
{
    private static $endpoint = "http://www.youtube.com/get_video_info";

    public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new static();
        }

        return $instance;
    }

    public function getLink($id)
    {
        $API_URL = self::$endpoint . "?&video_id=" . $id;
        $video_info = $this->curlGet($API_URL);

        $url_encoded_fmt_stream_map = '';
        parse_str($video_info);
        if(isset($reason))
        {
            return $reason;
        }
        if (isset($url_encoded_fmt_stream_map)) {
            $my_formats_array = explode(',', $url_encoded_fmt_stream_map);
        } else {
            return 'No encoded format stream found.';
        }
        if (count($my_formats_array) == 0) {
            return 'No format stream map found - was the video id correct?';
        }
        $avail_formats[] = '';
        $i = 0;
        $ipbits = $ip = $itag = $sig = $quality = $type = $url = '';
        $expire = time();
        foreach ($my_formats_array as $format) {
            parse_str($format);
            $avail_formats[$i]['itag'] = $itag;
            $avail_formats[$i]['quality'] = $quality;
            $type = explode(';', $type);
            $avail_formats[$i]['type'] = $type[0];
            $avail_formats[$i]['url'] = urldecode($url) . '&signature=' . $sig;
            parse_str(urldecode($url));
            $avail_formats[$i]['expires'] = date("G:i:s T", $expire);
            $avail_formats[$i]['ipbits'] = $ipbits;
            $avail_formats[$i]['ip'] = $ip;
            $i++;
        }
        return $avail_formats;
    }

    function curlGet($URL)
    {
        $ch = curl_init();
        $timeout = 3;
        curl_setopt($ch, CURLOPT_URL, $URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $tmp = curl_exec($ch);
        curl_close($ch);
        return $tmp;
    }
} 
function viewsource($url) {
$ch = curl_init();  
$timeout = 15;  
curl_setopt($ch, CURLOPT_URL, $url);  
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.57 Safari/537.36");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);  
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);  
curl_setopt($ch, CURLOPT_MAXREDIRS, 10);  
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);  
$data = curl_exec($ch);  
curl_close($ch);  
return $data;    
}
function YouTube_cURL($link) {
    if ($get = viewsource($link)) {
        if (preg_match('/;ytplayer\.config\s*=\s*({.*?});/', $get, $data)) {
            $jsonData  = json_decode($data[1], true);
            $streamMap = $jsonData['args']['url_encoded_fmt_stream_map'];
            $videoUrls = array();
            foreach (explode(',', $streamMap) as $url){
                $url = str_replace('\u0026', '&', $url);
                $url = urldecode($url);
                parse_str($url, $data);
                $dataURL = $data['url'];
                unset($data['url']);
                $videoUrls[] = array($data['itag'],$data['quality'],$dataURL.'&'.urldecode(http_build_query($data)));
            }
            return $videoUrls;
        }
    }
    return array();
}
function getyt($curl){
    $data = YouTube_cURL($curl);
    if(isset($data[0][2])){
        $AnimeVN = "{file: '".$data[0][2]."',label: \"720p\", type: \"video/mp4\"},{file: '".$data[1][2]."',label: \"360p\", type: \"video/mp4\"}";
    } else {
        $AnimeVN = "{file: '".$data[1][2]."',label: \"360p\", type: \"video/mp4\"}";
    }
    return $AnimeVN;
}

function youtube($url){
$qualitys = YoutbeDownloader::getInstance()->getLink($url);
if(is_string($qualitys))
{
    echo    $qualitys;
}
else {

foreach($qualitys as $video => $value) {
if($value['itag'] == '22') {
echo '{"file":"'.$value[url].'","title":720}';
}
if($value['itag'] == '18') {
echo ',{"file":"'.$value[url].'","title":480}';
}
if($value['itag'] == '17') {
echo ',{"file":"'.$value[url].'","title":240}';
}
}
}

}
function get_ascii($st)
{
    $vietChar    = 'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ|é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|ó|ò|ỏ|õ|ọ|ơ|ớ|ờ|ở|ỡ|ợ|ô|ố|ồ|ổ|ỗ|ộ|ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|í|ì|ỉ|ĩ|ị|ý|ỳ|ỷ|ỹ|ỵ|đ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ|Ó|Ò|Ỏ|Õ|Ọ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự|Í|Ì|Ỉ|Ĩ|Ị|Ý|Ỳ|Ỷ|Ỹ|Ỵ|Đ';
    $engChar     = 'a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|e|e|e|e|e|e|e|e|e|e|e|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|u|u|u|u|u|u|u|u|u|u|u|i|i|i|i|i|y|y|y|y|y|d|A|A|A|A|A|A|A|A|A|A|A|A|A|A|A|A|A|E|E|E|E|E|E|E|E|E|E|E|O|O|O|O|O|O|O|O|O|O|O|O|O|O|O|O|O|U|U|U|U|U|U|U|U|U|U|U|I|I|I|I|I|Y|Y|Y|Y|Y|D';
    $arrVietChar = explode("|", $vietChar);
    $arrEngChar  = explode("|", $engChar);
    return str_replace($arrVietChar, $arrEngChar, $st);
}

if(!function_exists('ip')){
    function ip() {
        if (!empty($_server['HTTP_CLIENT_IP'])) {
            $ip = $_server['HTTP_CLIENT_IP'];
        } elseif (!empty($_server['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_server['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_server['REMOTE_ADDR'];
        }
        return $ip;
    }
}
// porn.com
function porn($link, $quality){

    $content = file_get_contents($link);
   preg_match('#<video poster="data:image/gif,AAAA" autoplay="autoplay" src="(.+?)"></video>#is',$content,$linka);
   print_r($link);
}
//xhamster.com
function xhamster($link, $quality){

    $content = file_get_contents($link);
    preg_match("/file: '(.+?)',/is", $content, $stream);
    return $stream[1];
}



function get($url){
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: text/html','charset:UTF-8'));
curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (iPad; CPU OS 6_0 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) Version/6.0 Mobile/10A5355d Safari/8536.25');
curl_setopt($curl, CURLOPT_REFERER, 'http://google.com');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_TIMEOUT, 30);
$data = curl_exec($curl);
curl_close($curl);
return $data;
}
function get_direct($url){    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $result = curl_exec($ch);
    if(preg_match('#Location: (.*)#', $result, $r))
    return trim($r[1]);
}


if(!function_exists('tw_get_content_xvideos')){
    function tw_get_content_xvideos($url){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_USERAGENT, 'iPhone (iPhone; U; CPU iPhone OS 3_0 like Mac OS X; en-us) AppleWebKit/528.18 (KHTML, like Gecko) Version/4.0 Mobile/7A341 Safari/528.16');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_URL, $url);
        $data = curl_exec($curl);
        return $data;
    }
}

function getXMLLink($url){
    $source = curlx($url);
    $start = strpos($source, 'https://picasaweb.google.com/data/feed/base/user/');
    $end = strpos($source, '?alt=');
    $link = substr($source, $start, $end - $start);
    $pos = strpos($url, '#');
    $photoid_array = explode('#', $url);
    $photoid = trim($photoid_array[1], ' ');
    
    $link .= '/photoid/' . $photoid . '?';
    $link .= 'alt=jsonm&authkey=';
    
    $authkey_array = explode('authkey=', $url);
    $authkey = $authkey_array[1];
    
    $authkey_array = explode('#', $authkey);
    $authkey = $authkey_array[0];
    
    $link .= $authkey;
    $link = str_replace('base', 'tiny', $link);
    
    //$link = str_replace(' ', '', $link);
    
    return $link;
}
function getJson($xml_link){
    $sourceJson = curlx($xml_link);
    $decodeJson = json_decode($sourceJson);
    return $decodeJson->feed->media->content;
}
function viewweb($url)
{
    $ch = @curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    $head[] = "Connection: keep-alive";
    $head[] = "Keep-Alive: 300";
    $head[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
    $head[] = "Accept-Language: en-us,en;q=0.5";
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36');
    curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
    $page = curl_exec($ch);
    curl_close($ch);
    return $page;
}
function animetvn($link) {
       global $Cache;
        $name = 'play-'.md5($link);
        $data_cache = $Cache->get($name);
        if($data_cache != null){
            $html = $data_cache; 
        }else{
                $diachi = viewweb($link);
                $js = explode('sources: [',$diachi);
                $js = explode('],', $js[1]);
                $html = $js[0] ;
                if($html != '') $Cache->set($name, $html, CACHED_TIME);
        }
        return $html;
}
function phimbathu($link) {
        global $Cache;
        $name = 'play-'.md5($link);
        $data_cache = $Cache->get($name);
        if($data_cache != null){
            $html = $data_cache; 
        }else{
               $diachi =file_get_contents("http://api.phimaz.net/film/phimbathu.php?k=" .$link);
                $js = explode('link_stream":[',$diachi);
                $js = explode('],', $js[1]);
                $html = $js[0] ;
                if($html != '') $Cache->set($name, $html, CACHED_TIME);
        }
        return $html; 
}
function bilutv($link) {
        global $Cache;
        $name = 'play-'.md5($link);
        $data_cache = $Cache->get($name);
        if($data_cache != null){
            $html = $data_cache; 
        }else{
               $diachi = file_get_contents("http://api.phimaz.net/film/bilutv.php?k=" .$link);
                $js = explode('link_stream":[',$diachi);
                $js = explode('],', $js[1]);
                $html = $js[0] ;
                if($html != '') $Cache->set($name, $html, CACHED_TIME);
        }
        return $html;    
}
function drive($link) {
        global $Cache;
        $name = 'play-'.md5($link);
        $data_cache = $Cache->get($name);
        if($data_cache != null){
            $html = $data_cache; 
        }else{
        	if(preg_match('/(.*):\/\/drive.google.com\/file\/d\/(.*)\/view/U', $link, $fileId)
            || preg_match('/(.*):\/\/drive.google.com\/open\?id=(.+?)/U', $link, $fileId)
            || preg_match('/(.*):\/\/drive.google.com\/file\/d\/(.+?)/U', $link, $fileId)){
                $ch =  curl_init('http://player.phimmoi.club/getKeyEmbed?file=' .$fileId[2]);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
                curl_setopt($ch, CURLOPT_TIMEOUT, 3);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
                $result = curl_exec($ch);
                $html = $result ;
                  $Cache->set($name, $html, 2400);
            }

        }
        return $html;     
}
function p2pdrive($link) {
        global $Cache;
        $name = 'play-p'.md5($link);
        $data_cache = $Cache->get($name);
        if($data_cache != null){
            $html = $data_cache; 
        }else{
            if(preg_match('/(.*):\/\/drive.google.com\/file\/d\/(.*)\/view/U', $link, $fileId)
            || preg_match('/(.*):\/\/drive.google.com\/open\?id=(.+?)/U', $link, $fileId)
            || preg_match('/(.*):\/\/drive.google.com\/file\/d\/(.+?)/U', $link, $fileId)){
                $ch =  curl_init('http://88.198.146.26/getM3u8File?driveId=' .$fileId[2]);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
                curl_setopt($ch, CURLOPT_TIMEOUT, 3);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
                $result = curl_exec($ch);
                $html = $result ;
                  $Cache->set($name, $html, 2400);
            }

        }
        return $html;     
}
function vko($link) {
        global $Cache;
        $name = 'play-'.md5($link);
        $data_cache = $Cache->get($name);
        if($data_cache != null){
            $html = $data_cache; 
        }else{
               $diachi =file_get_contents("https://player.trunguit.net/get?url=" .$link);
                $js = explode('"sources":[',$diachi);
                $js = explode(']}', $js[1]);
                $html = $js[0] ;
                if($html != '') $Cache->set($name, $html, 2400);
        }
        return $html;     
}
function vk($link){
        global $Cache;
        $name = 'play-'.md5($link);
        $data_cache = $Cache->get($name);
        if($data_cache != null){
            $html = $data_cache; 
        }else{
               $diachi =file_get_contents("https://bongngo/api.php?url=" .$link);
                $html = $diachi ;
           if($html != '') $Cache->set($name, $html, 2400);
        }      
        return $html;    
}
function facebook($link){
        global $Cache;
        $name = 'play-'.md5($link);
        $data_cache = $Cache->get($name);
        if($data_cache != null){
            $html = $data_cache; 
        }else{
               $diachi =file_get_contents("http://api.phimaz.net/fb/index.php?url=" .$link);
                $js = explode('"file":"',$diachi);
                $js = explode('"', $js[1]);
                $html = urlencode($js[0]);
           if($html != '') $Cache->set($name, $html, 2400);
        }      
        return $html;    
}
function v16($link){
        global $Cache;
        $name = 'play-'.md5($link);
        $data_cache = $Cache->get($name);
        if($data_cache != null){
            $html = $data_cache; 
        }else{
                $diachi = file_get_contents($link);
                $diachi2 = str_replace("\r\n",'', $diachi);
                $js = explode('http://vip',$diachi2);
                $js = explode("'", $js[1]);
                $jsfull = 'http://vip'.$js[0] ;
                $get = file_get_contents($jsfull);
                $js2 = explode('sources = [',$get);
                $js2 = explode('];', $js2[1]);
                $html = $js2[0] ;
                if($html != '') $Cache->set($name, $html, 2400);
        }
        return $html;
}
function hdhay($link){
        global $Cache;
        $name = 'play-'.md5($link);
        $data_cache = $Cache->get($name);
        if($data_cache != null){
            $html = $data_cache; 
        }else{
                $diachi = file_get_contents($link);
                $js = explode('/playeropt?type=photo&',$diachi);
                $js = explode('"', $js[1]);
                $jsfull = 'http://hdhay.net/playeropt?type=photo&'.$js[0] ;
                $get = file_get_contents($jsfull);
                $js2 = explode('sources: [',$get);
                $js2 = explode('],', $js2[1]);
                $html = $js2[0] ;
                if($html != '') $Cache->set($name, $html, 2400);
        }
        return $html;
}
function gphoto($link){
        global $Cache;
        $name = 'play-'.md5($link);
        $data_cache = $Cache->get($name);
        if($data_cache != null){
            $html = $data_cache; 
        }else{
                $diachi1 =file_get_contents("http://api.phimaz.net/gphoto.php?url=" .$link);
                $diachi = str_replace('\/', '/', $diachi1);
                $js = explode('{"sources":[',$diachi);
                $js = explode(']}', $js[1]);
                $html = $js[0] ;
                if($html != '') $Cache->set($name, $html, 2400);
        }
        return $html; 
}
function getxvideos($link){
        global $Cache;
        $name = 'play-'.md5($link);
        $data_cache = $Cache->get($name);
        if($data_cache != null){
            $html = $data_cache; 
        }else{
                $diachi =file_get_contents($link);
                $js = explode('html5player.setVideoHLS(\'',$diachi);
                $js = explode('\');', $js[1]);
                $html = $js[0] ;
                if($html != '') $Cache->set($name, $html, 2400);
        }
        return $html; 
}
function curlx($url) {
    $ch = @curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    $head[] = "Connection: keep-alive";
    $head[] = "Keep-Alive: 300";
    $head[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
    $head[] = "Accept-Language: en-us,en;q=0.5";
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36');
    curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
    curl_setopt($ch , CURLOPT_IPRESOLVE , 'CURLOPT_IPRESOLVE_V6');
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
    $page = curl_exec($ch);
    curl_close($ch);
    return $page;
}

//xvideos
function xvideos($link, $quality){
    
    $full_content = tw_get_content_xvideos($link);
    preg_match("/fakepicture_nopoppup', (.*?)'low'\); <\/script>/is", $full_content, $data);
    preg_match_all("/'http:\/\/(.*?)'/is", $data[1], $match);
    if(stripos($match[1][1], 'xvideos.com/videos/mp4') !== false){
        $itemlarge = 'http://'.$match[1][1];
    }
    $itemmedium = 'http://'.$match[1][0];
    if($quality == 'file' && $itemmedium)
        return $itemmedium;
    if($quality == 'file' && !$itemmedium)
        return $itemlarge;
    elseif($quality == 'large.file' && $itemlarge)
        return $itemlarge;
    elseif($quality == 'large.file' && !$itemlarge)
        return $itemmedium;
    elseif($quality == 'hd.file' && $itemlarge)
        return $itemlarge;
    else
        return $itemmedium;
    
}
function get_youporn($url, $ref = 'http://youporn.com', $header = false){
        
        $ch = curl_init();
        $headers[] = "Accept-Language: en-us,en;q=0.5";
        $headers[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
        $headers[] = "Keep-Alive: 115";
        $headers[] = "Connection: keep-alive";
        $headers[] = "Content-Type: application/x-www-form-urlencoded";
        $headers[] = "X-Forwarded-For: 118.69.184.28";
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2049.0 Safari/537.36');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_REFERER, $ref);
        curl_setopt($ch, CURLOPT_COOKIE, 'cookie.txt');
        curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, str_replace(' ', '%20', $url));
        $data = curl_exec($ch);
        curl_close($ch);
        if($header){
            preg_match('/Location: http:\/\/(.*?)(\s|\n)/is', $data, $rd);
            return 'http://'.$rd[1];
        }
        else
            return $data;
}
//youporn.com
function youporn($link, $quality){

    $full_content = get_youporn($link);
   if(preg_match("/videoSrc = '(.*?)'/is", $full_content, $data)){
    return $data['1'];
}else{
        return SITE_URL.'/error.mp4';
}
}

function pornhub($link, $q){
    
    $key = explode('viewkey=', $link);
    $embed = get_youporn('http://www.pornhub.com/embed/' . $key[1]);
    preg_match("/src([\s]+): '(.*?)',/s", $embed, $stream);
    return $stream[2];
}

function redtube($data){
if(preg_match_all('#<video src="(.+?)"(.+?)>(.+?)</video>#is',$data,$url)){
return $url[1][0];
}else{
    return SITE_URL.'/error.mp4';
}
}
function beeg($link){
$source = file_get_contents($link);
if(preg_match("#'file': '(.+?)',#is",$source,$data)){
return $data[1];
}else{
        return SITE_URL.'/error.mp4';
}
}
//pornhan.com
function pornhan($link){
$source = file_get_contents($link);
if(preg_match("#cnf='(.+?)';#is",$source,$data)){
$cf = file_get_contents($data[1]);
if(preg_match("#<filehd>(.+?)</filehd>#is",$cf,$hd)){
echo $hd[1];
}else{
    preg_match("#<file>(.+?)</file>#is",$cf,$sd);
    echo $sd[1];
}
}else{
        return SITE_URL.'/error.mp4';;
}
}

function config_site($config_name) {
    $html = get_jsonconfig($config_name,'siteconfig');
    return $html;
}
function binads($config_name) {
    $html = get_jsonconfig($config_name,'ads');
    return $html;
}
function one_data($item,$table,$con) {
    $arr = MySql::dbselect("$item","$table","$con");
    $data = $arr[0][0];
    return $data;
}
function filmdata($id,$item) {
    $arr = Film_Model::get("$id","$item");
    return $arr;
}
function get_url($id,$name,$type) {
    $binname = $name;
    $url = Url::get($id,$binname,$type);
    return $url;
}
function get_url_actor($name,$type) {
    $binname = $name;
    $url = Url::get_actor($binname,$type);
    return $url;
}
function get_allpage($ttrow, $limit, $page, $url, $type = '') {
    $total = ceil($ttrow / $limit);
    $main .= '<ul class="pagination no-pading no-margin pull-right">';
    if ($total <= 1)
        return '';
    if ($page <> 1) {
        $main .= "<li><a title='Sau' href='" . $url . ($page - 1) . "/'>←</a></li>";
    }
    for ($num = 1; $num <= $total; $num++) {
        if ($num < $page - 1 || $num > $page + 4)
            continue;
        if ($num == $page)
            $main .= "<li class=\"active\"><a href='#'>$num</a></li>";
        else {
            $main .= "<li><a href=\"$url$num/\">$num</a></li>";
        }
    }
    if ($page <> $total) {
        $main .= "<li><a title='Tiếp' href='" . $url . ($page + 1) . "/'>→</a></li>";
    }
    $main .= '</ul>';
    return $main;
}
function GetTag($data,$type='tag') {
    $data = explode(',',$data);
    for($i=0;$i<count($data);$i++) {
        $name = trim($data[$i]);
            $in = mb_strtolower($name, 'UTF-8');
            $ten = str_replace(" ","-",$in);
            $url = SITE_URL."/tag/".$ten."/";
        $output .= "<a href=\"$url\" title=\"".$name."‏\" rel=\"$type\">".$name."‏</a>";
    }
    return $output;
}
function GetTag_a($data,$limit) {
    $data = explode(',',$data);
    for($i=0;$i<$limit;$i++) {
        $binname = $data[$i];
        $name = trim($binname);
            $in = mb_strtolower($name, 'UTF-8');
            $ten = str_replace(" ","-",$in);
            $url = SITE_URL."/tag/".$ten."/";
        $output .= " \n<a href=\"$url\" class=\"btn btn-dark btn-xs btn-rounded\" rel=\"follow, index\" title=\"$binname\"><i class=\"fa fa-tag\"></i> $binname</a>";
    }
    return $output;
}
function Get_List_director($list) {
    $data = explode(',',$list);
    for($i=0;$i<count($data);$i++) {
        $name = RemoveHack($data[$i]);
        if($name) {
            $arr = MySql::dbselect("info,urlmore,thumb","actor","name = '$name'");
            $image = $arr[0][2];
            $info  = $arr[0][0];
            if(!$arr) {
                /*$wiki = cURL::getWiki(trim($data[$i]));
                $image = $wiki[3];
                $urlmore = $wiki[2];
                $info = CutName($wiki[1],200);
                MySql::dbinsert('actor','name,info,urlmore,thumb',"'$name','$info','$urlmore','$image'");*/
                MySql::dbinsert('actor','name',"'$name'");
            }
            if(!$image) $image = TEMPLATE_URL.'img/profile.png';
            $in = mb_strtolower($name, 'UTF-8');
            $ten = str_replace(" ","-",$in);
            $url = SITE_URL."/tim-kiem/".$ten."/";
            $html .= "
            <a class=\"director\" href=\"$url\" title=\"$name\"><span itemprop=\"name\">$name</span></a>     
            ";
        }
    }
    return $html;
}
function Get_List_actor($list) {
    $data = explode(',',$list);
    for($i=0;$i<count($data);$i++) {
        $name = RemoveHack($data[$i]);
        if($name) {
            $arr = MySql::dbselect("info,urlmore,thumb","actor","name = '$name'");
            $image = $arr[0][2];
            $info  = $arr[0][0];
            if(!$arr) {
                $wiki = cURL::getWiki(trim($data[$i]));
                $image = $wiki[3];
                $urlmore = $wiki[2];
                $info = CutName($wiki[1],200);
                MySql::dbinsert('actor','name,info,urlmore,thumb',"'$name','$info','$urlmore','$image'");
                //MySql::dbinsert('actor','name',"'$name'");
            }

            if(!$image) $image = SITE_URL.'/bintheme/images/dienvien.png';
            $in = mb_strtolower($name, 'UTF-8');
            $ten = str_replace(" ","-",$in);
            $url = SITE_URL."/dien-vien/".$ten."/";
            $html .= "<div class=\"item\">
                                                <div class=\"item-inner\">
                                                    <a href=\"$url\" class=\"actor-ava\" style=\"background-image: url($image)\" title=\"$name\"></a>
                                                    <div class=\"actor-info\"> <a href=\"$url\" title=\"$name\"> $name</a></div>
                                                </div>
                                            </div>";
        }
    }
    return $html;
}
function Get_List_actor2($list) {
    $data = explode(',',$list);
    for($i=0;$i<count($data);$i++) {
        $name = RemoveHack($data[$i]);
        if($name) {
            $arr = MySql::dbselect("info,urlmore,thumb","actor","name = '$name'");
            $image = $arr[0][2];
            $info  = $arr[0][0];
            if(!$arr) {
                $wiki = cURL::getWiki(trim($data[$i]));
                $image = $wiki[3];
                $urlmore = $wiki[2];
                $info = CutName($wiki[1],200);
                MySql::dbinsert('actor','name,info,urlmore,thumb',"'$name','$info','$urlmore','$image'");
                //MySql::dbinsert('actor','name',"'$name'");
            }
            if(!$image) $image = SITE_URL.'/media/images/cast-image.png';
            $in = mb_strtolower($name, 'UTF-8');
            $ten = str_replace(" ","-",$in);
            $url = SITE_URL."/tim-kiem/".$ten."/";
            $html .= '<li>
<a class="actor-profile-item" href="'.$url.'" title="Diễn viên '.$name.'">
<div class="actor-image" style="background-image:url(\''.$image.'\')"></div>
<div class="actor-name"><span class="actor-name-a" >'.$name.'</span></div>
</a>
</li>';
        }
    }
    return $html;
}
function get_livetv_thumb($sql,$num,$type) {
    $livetv = MySql::dbselect('id,symbol,name,thumb','tv',"$sql order by id desc limit $num");
    if($type == '1') {
        for($i=0;$i<count($livetv);$i++) {
            $id = $livetv[$i][0];
            $symbol = $livetv[$i][1];
            $name = $livetv[$i][2];
            $thumb = $livetv[$i][3];
            $url = get_url($id,$symbol,'Live TV');
            $html .= "<li><div class=\"pageSlide\"><a href=\"$url\" title=\"$name\"><img src=\"$thumb\" alt=\"$symbol\" title=\"\"><div class=\"maskMv\"></div></a></div></li>";
        }
    }else if($type == '2') {
        for($i=0;$i<count($livetv);$i++) {
            $id = $livetv[$i][0];
            $symbol = $livetv[$i][1];
            $name = $livetv[$i][2];
            $thumb = $livetv[$i][3];
            $url = get_url($id,$symbol,'Live TV');
            $html .= "<li><a href=\"$url\" title=\"$name\"><span class=\"over_play\"></span><img src=\"$thumb\" alt=\"$name\" class=\"thumbtivi\"/></a></li>";
        }
    }else {
        for($i=0;$i<count($livetv);$i++) {
            $id = $livetv[$i][0];
            $symbol = $livetv[$i][1];
            $url = get_url($id,$symbol,'Live TV');
            $html .= "<li><a href=\"$url\" title=\"$symbol\">$symbol</a></li>";
        }
    }
    return $html;
}
function li_category() {
        global $phpFastCache;
        $link = 'site-category';
        $data_cache = $phpFastCache->get($link);
        if($data_cache != null){
            $html = $data_cache; 
        }else{  
                $html = '';
                $arr = MySql::dbselect('id,name','category','id != 0');
                for($i=0;$i<count($arr);$i++) {
                $name = $arr[$i][1];
                $url = get_url(0,$name,'Thể loại');
                $html .= "<li><a href=\"$url\">$name</a></li>";
                }
                if($html != '') $phpFastCache->set($link, $html, CACHED_TIME);
        }
        return $html; 
}
function li_country() {
        global $phpFastCache;
        $link = 'site-country';
        $data_cache = $phpFastCache->get($link);
        if($data_cache != null){
            $html = $data_cache; 
        }else{ 
                $arr = MySql::dbselect('id,name','country','id != 0');
                for($i=0;$i<count($arr);$i++) {
                $name = $arr[$i][1];
                $url = get_url(0,$name,'Quốc gia');
                $html .= "<li><a href=\"$url\">$name</a></li>";
                 }
                if($html != '') $phpFastCache->set($link, $html, CACHED_TIME);
        }
        return $html; 
}
function li_year($type) {
        global $phpFastCache;
        $link = 'site-year';
        $data_cache = $phpFastCache->get($link);
        if($data_cache != null){
            $html = $data_cache; 
        }else{ 
                for($i=0;$i<14;$i++) {
                        $name = (2018-$i);
                        $url = get_url(0,'Phim năm-'.(2018-$i),'Tổng Hợp');
                        $html .= "<li> <span class=\"icon\"></span> <a href=\"$url\">Phim $name</a> </li>";
                    }
                if($html != '') $phpFastCache->set($link, $html, CACHED_TIME);
        }
        return $html; 
}
function breadcrumb_menu($list, $num = 0) {
    $list = substr($list, 1);
    $list = substr($list, 0, -1);
    $category  = MySql::dbselect("name", "category", "id IN (" . $list . ")");
    for($i=0;$i<count($category);$i++) {
        $name = $category[$i][0];
        $url = get_url(0,$name,'Thể Loại');

        $html .= "<li itemscope itemtype=\"http://data-vocabulary.org/Breadcrumb\"><a itemprop=\"url\" href=\"$url\" title=\"$name\"><span itemprop=\"title\"> $name </span></a></li> ";

    }
    return $html;
}
function category_Watch($list, $num = 0) {
    $list = substr($list, 1);
    $list = substr($list, 0, -1);
    $category  = MySql::dbselect("name", "category", "id IN (" . $list . ")");
    for($i=0;$i<count($category);$i++) {
        $name = $category[$i][0];
        $html .= "Phim $name, ";
    }
    $html = substr($html,0,-2); 
    return $html;
}
function category_a($list, $num = 0) {
    $list = substr($list, 1);
    $list = substr($list, 0, -1);
    $category  = MySql::dbselect("name", "category", "id IN (" . $list . ")");
    for($i=0;$i<count($category);$i++) {
        $name = $category[$i][0];
        $url = get_url(0,$name,'Thể Loại');

        $html[] = "<a href=\"$url\" title=\"$name\">$name</a>";
    }
    return @implode(", ",$html);
}
function category_search($list, $num = 0) {
    $list = substr($list, 1);
    $list = substr($list, 0, -1);
    $category  = MySql::dbselect("name", "category", "id IN (" . $list . ")");
    for($i=0;$i<count($category);$i++) {
        $name = $category[$i][0];
        $url = get_url(0,$name,'Thể Loại');

        $html[] = "<a class=\"category\" href=\"$url\" title=\"Phim $name\">$name</a>";
    }
    return @implode(", ",$html);
}
function category_a_f($ido) { 
    $category  = MySql::dbselect("name,id", "category", "id != '0'");
    if(!$ido) $classo = 'active';
    $html .= "<option value=\"\">Tất cả</option>";
    for($i=0;$i<count($category);$i++) {
        $id = $category[$i][1];
        $name = $category[$i][0];
        if($id == $ido) $class[$i] = ' class="active"';
        $html .= "<option value=\"$id\">$name</option>";
    }
    return $html;
}
function country_a_f($ido) {
    global $db;
    $country  = MySql::dbselect("name,id", "country", "id != '0'");
    if(!$ido) $classo = 'active';
    $html .= "<option value=\"\">Tất cả</option>";
    for($i=0;$i<count($country);$i++) {
        $id = $country[$i][1];
        $name = $country[$i][0];
        if($id == $ido) $class[$i] = ' class="active"';
        $html .= "<option value=\"$id\">$name</option>";
    }
    return $html;
} 
function quality_a_f($qualityid) {
    if($qualityid == 'HD') $hd = 'active';
    else if($qualityid == 'SD') $sd = 'active';
    else if($qualityid == 'CAM') $cam = 'active';
    else $tatca = 'active';
    $html = "<option value=\"\">Tất cả</option>
    <option value=\"HD\">HD</option>
    <option value=\"SD\">SD</option>
    <option value=\"CAM\">CAM</option>";
    return $html;
}
function filmyear_a_f($year) {
    if(!$year) $tatca = 'active';
    $html .= "<option value=\"\">Tất cả</option>";
    for($i=0;$i<6;$i++) {
        $name = 'Năm '.(2014-$i);
        $yearid = (2014-$i);
        if((2014-$i) == $year) $class[$i] = 'active';
        $html .= "<option value=\"$yearid\"> $name</option>";
    }
    return $html;
}
function country_a($id) {
    $country = MySql::dbselect("name", "country", "id = '$id'");
    $name = $country[0][0];
    $url = get_url(0,$name,'Quốc Gia');
    $html = "<a href=\"$url\" title=\"$name\">$name</a>";
    return $html;
}
function username($id) {
    $user  = MySql::dbselect("username,fullname", "user", "id = '" . $id . "'");   
    if($user[0][1]) {
            $html = $user[0][1];
    } else {
            $html = $user[0][0];
    }
    return $html;
}
function cat_hotlist() {
    $arr = MySql::dbselect('id,title,thumb,tourl','hotmenu',"id != 0 order by id asc");
    for($i=0;$i<count($arr);$i++) {
        $name = $arr[$i][1];
        $url = $arr[$i][3];
        $thumb = $arr[$i][2];
        if($thumb !== '') $thumb = " style=\"background: url($thumb) no-repeat;\"";
        if(!$url) $url = "index.html";
        $html .= "<li><span class=\"back bxh\"$thumb></span><span class=\"cover\"></span><h3><a href=\"$url\" title=\"$name\">$name</a></h3></li>";
    }
    return $html;
}
function li_film($sql,$limit) {
    $arr = MySql::dbselect('id,title,thumb,year','film',"$sql ORDER BY id DESC LIMIT $limit");
    for($i=0;$i<count($arr);$i++) {
        $name = $arr[$i][1];
        $url = get_url($arr[$i][0],$name,'Phim');
        $thumb = $arr[$i][2];
        $year = $arr[$i][3];
        $html .= "<li><a href=\"$url\" title=\"$name\"><img src=\"$thumb\" class=\"headthumbimg\" alt=\"$name\"/><span>$name<br/>($year)</span></a></li>";
    }
    return $html;
}
function li_film_h3($sql,$limit) {
    $arr = MySql::dbselect('id,title,thumb,year,duration','film',"$sql ORDER BY id DESC LIMIT $limit");
    for($i=0;$i<count($arr);$i++) {
        $name = $arr[$i][1];
        $url = get_url($arr[$i][0],$name,'Phim');
        $thumb = $arr[$i][2];
        $year = $arr[$i][3];
        $duration = $arr[$i][4];
         $html .= '<div class="film-grid-item">
    <div class="film-thumbnail">
        <a href="'.$url.'"> <img class="lazy" alt="'.$name.'" title="'.$name.'" src="'.$thumb.'" style="display: inline-block;">
            <div class="hover-play-btn"></div>
<span class="film-label">'.$duration.'</span>
        </a></div>
    <div class="film-info"> <a href="'.$url.'" class="title">'.$name.'</a></div>
</div>';
    }
    return $html;
}

function bxh_show1($type) {
       global $phpFastCache;
        $link = 'site-'.$type;
        $data_cache = $phpFastCache->get($link);
        if($data_cache != null){
            $html = $data_cache; 
        }else{ 
                if($type == 'phimbo') $sql = "filmlb IN (1,2) AND active=1";
                else if($type == 'phimle') $sql = "filmlb = 0 && active = 1";
                $arr = MySql::dbselect('id,title,thumb,year,duration,title_en,actor,viewed,viewed_day,viewed_month,url,tinhtrang,total_votes,total_value,big_image','film',"$sql ORDER BY viewed_week DESC LIMIT 5");
                for($i=0;$i<count($arr);$i++) {
                    $id = $arr[$i][0];
                    $name = $arr[$i][1];
                    $name_en = $arr[$i][5];
                    if ($arr[$i][10]) {
                        $url = get_url($arr[$i][0],$arr[$i][10],'Phim');
                        }
                        else {
                        $url = get_url($arr[$i][0],$name,'Phim');
                         }
                   $thumb = $arr[$i][2];
                   $thumb_big = $arr[$i][14];
                    $actor = CutName($arr[$i][6],70);
                    $year = $arr[$i][3];
                    $tinhtrang = $arr[$i][11];
                    $duration = $arr[$i][4];
                    $view = $arr[$i][7];
                    if($arr[$i][12] != 0){
                       $Bstar = $arr[$i][12];
                        } else { $Bstar = '1';}
                        if($arr[$i][13] != 0){
                            $Astar = $arr[$i][13];
                        } else { $Astar = '10';}
                        $Cstar = ($Astar/$Bstar);
                        $Dstar = number_format($Cstar,0);
                        $Cstar = number_format($Cstar,1);
                    $num = $i+1;
                  if($num == 1){
                        if($thumb_big){$html ='
                                <li class="list-top-movie-item" id="list-top-movie-item-1">
                                <a class="list-top-movie-link" title="'.$name.' - '.$name_en.'" href="'.$url.'">
                                <span class="status">'.$tinhtrang.'</span>
                                <div class="list-top-movie-item-thumb" style="background-image: url(\''.$thumb_big.'\')"></div>
                                <div class="list-top-movie-item-info"><span class="list-top-movie-item-vn">'.$name.'</span><span class="list-top-movie-item-en">'.$name_en.'</span><span class="list-top-movie-item-view">Lượt xem : '.$view.'</span><span class="rate-vote rate-vote-'.$Dstar.'"></span></div>
                                </a>
                                </li>';}
                                   else {$html ='<li class="list-top-movie-item" id="list-top-movie-item-1">
                                <a class="list-top-movie-link" title="'.$name.' - '.$name_en.'" href="'.$url.'">
                                <span class="status">'.$tinhtrang.'</span>
                                <div class="list-top-movie-item-thumb" style="background-image: url(\''.urlimg($thumb).'\')"></div>
                                <div class="list-top-movie-item-info"><span class="list-top-movie-item-vn">'.$name.'</span><span class="list-top-movie-item-en">'.$name_en.'</span><span class="list-top-movie-item-view">Lượt xem : '.$view.'</span><span class="rate-vote rate-vote-'.$Dstar.'"></span></div>
                                </a>
                                </li>';}
                        } else {
                         $html .= '<li class="list-top-movie-item" id="list-top-movie-item-2">
                            <a class="list-top-movie-link" title="'.$name.' - '.$name_en.'" href="'.$url.'">
                            <span class="status">'.$tinhtrang.'</span>
                            <div class="list-top-movie-item-thumb" style="background-image: url(\''.$thumb.'\')"></div>
                            <div class="list-top-movie-item-info"><span class="list-top-movie-item-vn">'.$name.'</span><span class="list-top-movie-item-en">'.$name_en.'</span><span class="list-top-movie-item-view">Lượt xem : '.$view.'</span><span class="rate-vote rate-vote-'.$Dstar.'"></span></div>
                            </a>
                            </li>';
                }   
                   


                }
                if($html != '') $phpFastCache->set($link, $html, 3600);
        }
        return $html; 
}

function li_film_h3_2($sql,$limit) {
    $arr = MySql::dbselect('id,title,thumb,year,duration','film',"$sql AND duration != '' ORDER BY id DESC LIMIT $limit");
    for($i=0;$i<count($arr);$i++) {
        $name = $arr[$i][1];
        $url = get_url($arr[$i][0],$name,'Phim');
        $thumb = $arr[$i][2];
        $year = $arr[$i][3];
        $duration = $arr[$i][4];
        $html .= "<li><a href=\"$url\" title=\"$name\">".CutName($name,20)."</a><span>$duration</span></li>";
    }
    return $html;
}
function list_actor() {

    $arr = MySql::dbselect('info,name,urlmore,thumb','actor',"thumb != '' order by RAND() limit 2");
    for($i=0;$i<count($arr);$i++) {
        $name = $arr[$i][1];
        $thumb = $arr[$i][3];
        $url = get_url('',$name,'search');
        


        $html .= "<li class=\"profile-item\">
                                <a class=\"profile-link\" title=\"Phim của $name\" href=\"$url\">
                                    <span class=\"profile-image\" style=\"background-image: url('$thumb')\"></span>
                                    <span class=\"star-profile-name\">$name </span>
                                </a>
                                <span class=\"star-profile-summary\"></span>
                            </li>";
    }
    return $html;
}


function slider_film($sql,$limit) {
        global $phpFastCache;
        $link = 'site-slide';
        $data_cache = $phpFastCache->get($link);
        if($data_cache != null){
            $html = $data_cache; 
        }else{ 
                $arr = MySql::dbselect('tb_film.id,tb_film.title,tb_film.thumb,tb_film.year,tb_film.big_image,tb_film_other.content,tb_film.title_en,tb_film.quality,tb_film.duration,tb_film.actor,tb_film.category,tb_film.country,tb_film.viewed,tb_film.url','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"$sql ORDER BY timeupdate DESC LIMIT $limit");
                for($i=0;$i<count($arr);$i++) {
                    $id = $arr[$i][0];
                    $name = $arr[$i][1];
                    if ($arr[$i][13]) {
                        $url = get_url($arr[$i][0],$arr[$i][13],'Phim');
                        }
                        else {
                        $url = get_url($arr[$i][0],$name,'Phim');
                         }
                    $thumb = $arr[$i][2];
                    $thumb_big = $arr[$i][4];
                    $year = $arr[$i][3];
                    $content = CutName(RemoveHtml(UnHtmlChars($arr[$i][5])),200);
                    $name_en = $arr[$i][6];
                    $quality = $arr[$i][7];
                    $duration = $arr[$i][8];
                    $actor = $arr[$i][9];
                    $theloai = category_a($arr[$i][10]);
                    $quocgia = country_a($arr[$i][11]);
                    $viewed = $arr[$i][12]; 

                    $html .= '<div class="swiper-slide" style="background-image: url(\''.$thumb_big.'\');">
                        <a href="'.$url.'" class="slide-link" title="'.$name.'"></a>
                        <span class="slide-caption">
                                <h3>'.$name.'</h3>
                                <p class="name_en">'.$name_en.'</p>
                                <p class="sc-desc"><p>'.$content.'</p>
                                <div class="slide-caption-info">  
                                    <div class="block"><strong>Thời lượng:</strong> '.$duration.'</div>
                                    <div class="block"><strong>Trạng thái:</strong> '.$quality.'</div>
                                    <div class="block"><strong>Thể loại:</strong> '.$theloai.' </div>
                                </div>
                                <a href="'.$url.'" class="slide-link" title="'.$name.'">
                                    <div class="btn btn-red mt20"><i class="fa fa-play"></i> Xem phim</div>
                                </a>
                            </span>
                    </div>';

                    
                }
                if($html != '') $phpFastCache->set($link, $html, CACHED_TIME);
        }
        return $html;
}
function category_tip($list, $num = 0) {
    $list = substr($list, 1);
    $list = substr($list, 0, -1);
    $category  = MySql::dbselect("name", "category", "id IN (" . $list . ") LIMIT 1");
    for($i=0;$i<count($category);$i++) {
        $name = $category[$i][0];       
        $html .= $name;
    }   
    return $html;
}
function li_film1($type,$limit,$list='') {
    if($type == 'decu') $sql = "decu = '1'";
    else if($type == 'topphimbo') {
        $sql = "filmlb IN (2) AND active=1";
        $orderby = 'ORDER BY timeupdate DESC';
    }
    else if($type == 'phimbofull') {
        $sql = "filmlb IN (1) AND active=1";
        $orderby = 'ORDER BY timeupdate DESC';
    }
    else if($type == 'phimlemoi') {
        $sql = "filmlb = 0 && active = 1";
        $orderby = 'ORDER BY timeupdate DESC';
    }   
    else if($type == 'phimbo') {
        $sql = "filmlb IN (1,2) AND active=1";
        $orderby = 'ORDER BY timeupdate DESC';
    }
    else if($type == 'phimle') {
        $sql = "filmlb = 0 && active = 1";
        $orderby = 'ORDER BY timeupdate DESC';
    }
    else if($type == 'phimchieurap') {
        $sql = "category LIKE '%,40,%'";
        $orderby = "ORDER BY timeupdate DESC";
    }
    else if($type == 'kinh-di') {
        $sql = "category LIKE '%,21,%'";
        $orderby = "ORDER BY timeupdate DESC";
    }
    else if($type == 'phimsapchieu') {
        $sql = "category LIKE '%,42,%'";
        $orderby = "ORDER BY RAND()";
    }
    else if($type == 'category') {
        $list = substr($list,1);
        $list = substr($list,0,-1);
        $ex = explode(",",$list);
        $count = count($ex);
        if($count == 1) $sql = "(category LIKE '%,$list,%' ) OR ";
        else {
            for($x=0;$x<$count;$x++) {
                $sql .= "(category LIKE '%,".$ex[$x].",%' ) OR ";
            }
        }
        $sql = substr($sql,0,-4);
        $orderby = "AND active=1 ORDER BY RAND()";
        $type = $type.$list;
    }else if($type == 'actor') {
        $sql = "tb_film.actor LIKE '%$list%' OR tb_film.director LIKE '%$list%'";
        $orderby = "ORDER BY id DESC";
    }
    if(!$orderby) $orderby = 'ORDER BY id DESC';
    $arr = MySql::dbselect('tb_film.id,tb_film.title,tb_film.thumb,tb_film.year,tb_film.big_image,tb_film_other.content,tb_film.title_en,tb_film.duration,tb_film.quality,tb_film.thuyetminh,tb_film.filmlb,tb_film.category,tb_film.trailer,tb_film.active,tb_film.viewed,tb_film.url,tb_film.total_votes,tb_film.total_value,tb_film.lichchieu,tb_film.tinhtrang','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"$sql $orderby LIMIT $limit");
if($type == 'kinh-di') {
        global $phpFastCache;
        $link = 'site-'.$type;
        $data_cache = $phpFastCache->get($link);
        if($data_cache != null){
            $html = $data_cache; 
        }else{ 
                for($i=0;$i<count($arr);$i++) {
        $id = $arr[$i][0];
        $name = $arr[$i][1];
        $name_en = $arr[$i][6];
        $name_en_cut = CutName($arr[$i][6],20);
        $name_cut = CutName($name,30);
        if ($arr[$i][15]) {
                        $url = get_url($arr[$i][0],$arr[$i][15],'Phim');
                        }
                        else {
                        $url = get_url($arr[$i][0],$name,'Phim');
                         }
        $thumb = $arr[$i][2];
        $thumb_big = $arr[$i][4];
        $duration = $arr[$i][7];
        $quality = $arr[$i][8];
        $thuyetminh = $arr[$i][9];
        $filmlb = $arr[$i][10];
        $year = $arr[$i][3];
        $cat = $arr[$i][11];
        $view = $arr[$i][14];
        $content = CutName(RemoveHtml(UnHtmlChars($arr[$i][5])),250);
        if($quality) $quality = "$quality";
        $episode = MySql::dbselect('id,name','episode',"filmid = '$id' order by id desc limit 1");
        $epname = $episode[0][1];
        if($thuyetminh == 1){
            $phude = 'Thuyết Minh';
                        $code = '<div class="thuyetminhviet" title="Phim có thuyết minh"></div>';
        }elseif($thuyetminh == 2){
            $phude = 'Nosub';
        }elseif($thuyetminh == 3){
            $phude = 'Trailer';
        }else {
            $phude = 'Vietsub';
        }
        //if($epname && $type == 'phimbo') $epnames = " Tập $epname";
        if(empty($duration) || empty($name_en)){
            $duration = "cập nhật";
            $name_en = "cập nhật";
        }else{


        }

        if($filmlb!=0) { $epnames[$i] = "<div class=\"status\">Tập ".substr(abs((int) filter_var($epname, FILTER_SANITIZE_NUMBER_INT)),0,3)."-$phude</div>";
         } else { $epnames[$i] = "<div class=\"status\">HD-$phude</div>";}
        $html .= '<li title="'.$name.' - '.$name_en.'" class="ntipse">
                                    <div class="thumb_s">
                                        <a href="'.$url.'"><img src="'.$thumb.'" width="100" height="133px" alt="'.$name.' - '.$name_en.'" /> </a>
                                    </div>
                                    <div class="detail"> <a class="name" href="'.$url.'"><h2>'.$name.'</h2>'.$name_en.' </a> 
                           <p style="margin-top: -3px;font-size: 12px;">Lượt xem: '.$view.'</p></div>
                                </li>       ';
            } 
                if($html != '') $phpFastCache->set($link, $html, CACHED_TIME);
        }

}
else if($type == 'phimchieurap') {
       global $phpFastCache;
        $link = 'site-'.$type;
        $data_cache = $phpFastCache->get($link);
        if($data_cache != null){
            $html = $data_cache; 
        }else{ 
        for($i=0;$i<count($arr);$i++) {
        $id = $arr[$i][0];
        $name = $arr[$i][1];
        $name_en = $arr[$i][6];
        $name_en_cut = CutName($arr[$i][6],20);
        $name_cut = CutName($name,30);
                if ($arr[$i][15]) {
                        $url = get_url($arr[$i][0],$arr[$i][15],'Phim');
                        }
                        else {
                        $url = get_url($arr[$i][0],$name,'Phim');
                         }
        $thumb = $arr[$i][2];
        $thumb_big = $arr[$i][4];
        $duration = $arr[$i][7];
        $quality = $arr[$i][8];
        $thuyetminh = $arr[$i][9];
        $filmlb = $arr[$i][10];
        $year = $arr[$i][3];
        $cat = $arr[$i][11];
        $view = $arr[$i][14];
        $trangthai = $arr[$i][19];
                $num = $i+1;
        $content = CutName(RemoveHtml(UnHtmlChars($arr[$i][5])),250);
        if($filmlb!=0){
                    $types = 'phimbo';
                }
        if($quality) $quality = "$quality";
        $episode = MySql::dbselect('id,name','episode',"filmid = '$id' order by id desc limit 1");
        $epname = $episode[0][1];
        if($thuyetminh == 1){
            $phude = 'Thuyết Minh';
                        $code = '<div class="thuyetminhviet" title="Phim có thuyết minh"></div>';
        }elseif($thuyetminh == 2){
            $phude = 'Nosub';
        }elseif($thuyetminh == 3){
            $phude = 'Trailer';
        }else {
            $phude = 'Vietsub';
        }
        //if($epname && $type == 'phimbo') $epnames = " Tập $epname";
        if(empty($duration) || empty($name_en)){
            $duration = "cập nhật";
            $name_en = "cập nhật";
        }else{


        }
        if(!$trangthai){
                    if($filmlb!=0) {
                        if ($episode) {
                            {$epnames[$i] = "<span class=\"badge\">Tập ".substr(abs((int) filter_var($epname, FILTER_SANITIZE_NUMBER_INT)),0,3)."-$phude</span>";} 
                        }
                        else {
                            $epnames[$i] = "<span class=\"badge\">Trailer - $phude</span>";
                        }
                     } else { $epnames[$i] = "<span class=\"badge\">$quality-$phude</span>";}
        } else {
            $epnames[$i] = "<span class=\"badge\">$trangthai</span>";
        }

         $html .= '
                <div class="item">
                    <a class="inner" href="'.$url.'" title="'.$name.'-'.$name_en.'"> 
                        <img data-src="'.SITE_URL.'/anh-phim/205-308/bin/'.urlimg($thumb).'" alt="'.$name.'-'.$name_en.'" class="lazyload movie-thumb" /> 
                        <span class="thumb-icon"> <i class="sp-movie-icon-play"></i> </span> <span class="overlay"></span>
                            <div class="description">
                                <h3 class="text-nowrap">'.$name.'</h3>
                                <div class="meta clearfix"> <span class="pull-left"> '.$year.' </span> <span class="pull-right">'.$duration.'</span></div>
                        </div>'.$epnames[$i].'
                    </a>
                    
                </div>
        '; 
        
    } 
                if($html != '') $phpFastCache->set($link, $html, CACHED_TIME);
        }

}
else if($type == 'phimlemoi'  || $type == 'phimbofull' || $type == 'topphimbo') {
    global $phpFastCache;
        $link = 'site-'.$type;
        $data_cache = $phpFastCache->get($link);
        if($data_cache != null){
            $html = $data_cache; 
        }else{ 
        for($i=0;$i<count($arr);$i++) {
        $id = $arr[$i][0];
        $name = $arr[$i][1];
        $name_en = $arr[$i][6];
        $name_en_cut = CutName($arr[$i][6],20);
        $name_cut = CutName($name,30);
        if ($arr[$i][15]) {
        $url = get_url($arr[$i][0],$arr[$i][15],'Phim');
        } else {
        $url = get_url($arr[$i][0],$name,'Phim');
            }
        $thumb = $arr[$i][2];
        $thumb_big = $arr[$i][4];
        $duration = $arr[$i][7];
        $quality = $arr[$i][8];
        $thuyetminh = $arr[$i][9];
        $filmlb = $arr[$i][10];
        $year = $arr[$i][3];
        $cat = $arr[$i][11];
        $view = $arr[$i][14];
                $num = $i+1;
        $content = CutName(RemoveHtml(UnHtmlChars($arr[$i][5])),250);
        if($quality) $quality = "$quality";
        $episode = MySql::dbselect('id,name','episode',"filmid = '$id' order by id desc limit 1");
        $epname = $episode[0][1];
        if($thuyetminh == 1){
            $phude = 'Thuyết Minh';
                        $code = '<div class="thuyetminhviet" title="Phim có thuyết minh"></div>';
        }elseif($thuyetminh == 2){
            $phude = 'Nosub';
        }elseif($thuyetminh == 3){
            $phude = 'Trailer';
        }else {
            $phude = 'Vietsub';
        }
        //if($epname && $type == 'phimbo') $epnames = " Tập $epname";
        if(empty($duration) || empty($name_en)){
            $duration = "cập nhật";
            $name_en = "cập nhật";
        }else{


        }
        if($filmlb!=0) { $epnames[$i] = "<div class=\"status\">Tập ".substr(abs((int) filter_var($epname, FILTER_SANITIZE_NUMBER_INT)),0,3)."-$phude</div>";
         } else { $epnames[$i] = "<div class=\"status\">$quality-$phude</div>";}
         $html .= '<div class="col-xs-12 col-sm-4 col-md-3 movie-item" data-title="<strong>'.$name.'</strong>">
                        <div class="thumbnail">
                            <a class="link" href="'.$url.'" title="'.$name.' - '.$name_en.'">
                                <img class="lazy img-responsive" data-original="'.SITE_URL.'/anh-phim/205-308/bin/'.urlimg($thumb).'" src="'.SITE_URL.'/anh-phim/205-308/bin/'.urlimg($thumb).'" alt="ảnh phim '.$name.' - '.$name_en.'">
                            </a>
                            <div class="caption">
                                <a href="'.$url.'" title="'.$name.' - '.$name_en.'">
                                    <h3>'.$name.'</h3>
                                </a>
                                <p>'.$name_en.'</p>
                                                </div>
                            <a target="_self" href="'.$url.'" class="btn-overplay"></a>
                                            <div class="episode">' . $duration . '</div>
                                                        </div>
                    </div>';

                       }
                if($html != '') $phpFastCache->set($link, $html, CACHED_TIME);
        }
}
else if($type == 'phimle'  || $type == 'phimbo') {
       global $phpFastCache;
        $link = 'site-home'.$type;
        $data_cache = $phpFastCache->get($link);
        if($data_cache != null){
            $html = $data_cache; 
        }else{ 
        for($i=0;$i<count($arr);$i++) {
        $id = $arr[$i][0];
        $name = $arr[$i][1];
        $name_en = $arr[$i][6];
        $name_en_cut = CutName($arr[$i][6],20);
        $name_cut = CutName($name,30);
                if ($arr[$i][15]) {
                        $url = get_url($arr[$i][0],$arr[$i][15],'Phim');
                        }
                        else {
                        $url = get_url($arr[$i][0],$name,'Phim');
                         }
        $thumb = $arr[$i][2];
        $thumb_big = $arr[$i][4];
        $duration = $arr[$i][7];
        $quality = $arr[$i][8];
        $thuyetminh = $arr[$i][9];
        $filmlb = $arr[$i][10];
        $year = $arr[$i][3];
        $cat = $arr[$i][11];
        $view = $arr[$i][14];
        $trangthai = $arr[$i][19];
                $num = $i+1;
        $content = CutName(RemoveHtml(UnHtmlChars($arr[$i][5])),250);
        if($quality) $quality = "$quality";
        $episode = MySql::dbselect('id,name','episode',"filmid = '$id' order by id desc limit 1");
        $epname = $episode[0][1];
        if($thuyetminh == 1){
            $phude = 'Thuyết Minh';
                        $code = '<div class="thuyetminhviet" title="Phim có thuyết minh"></div>';
        }elseif($thuyetminh == 2){
            $phude = 'Nosub';
        }elseif($thuyetminh == 3){
            $phude = 'Trailer';
        }else {
            $phude = 'Vietsub';
        }
        //if($epname && $type == 'phimbo') $epnames = " Tập $epname";
        if(empty($duration) || empty($name_en)){
            $duration = "cập nhật";
            $name_en = "cập nhật";
        }else{


        }
        if(!$trangthai){
                    if($filmlb!=0) {
                        if ($episode) {
                            {$epnames[$i] = "<span class=\"badge\">Tập ".substr(abs((int) filter_var($epname, FILTER_SANITIZE_NUMBER_INT)),0,3)."-$phude</span>";} 
                        }
                        else {
                            $epnames[$i] = "<span class=\"badge\">Trailer - $phude</span>";
                        }
                     } else { $epnames[$i] = "<span class=\"badge\">$quality-$phude</span>";}
        } else {
            $epnames[$i] = "<span class=\"badge\">$trangthai</span>";
        }

         $html .= '
                <div class="item">
                    <a class="inner" href="'.$url.'" title="'.$name.'-'.$name_en.'"> 
                        <img data-src="'.SITE_URL.'/anh-phim/205-308/bin/'.urlimg($thumb).'" alt="'.$name.'-'.$name_en.'" class="lazyload movie-thumb" /> 
                        <span class="thumb-icon"> <i class="sp-movie-icon-play"></i> </span> <span class="overlay"></span>
                            <div class="description">
                                <h3 class="text-nowrap">'.$name.'</h3>
                                <div class="meta clearfix"> <span class="pull-left"> '.$year.' </span> <span class="pull-right">'.$duration.'</span></div>
                        </div>'.$epnames[$i].'
                    </a>
                    
                </div>
        ';           

                   }
                            if($html != '') $phpFastCache->set($link, $html, CACHED_TIME);
                    }

     }  
else if($type == 'phimsapchieu') {
       global $phpFastCache;
        $link = 'site-'.$type;
        $data_cache = $phpFastCache->get($link);
        if($data_cache != null){
            $html = $data_cache; 
        }else{ 
        for($i=0;$i<count($arr);$i++) {
        $id = $arr[$i][0];
        $name = $arr[$i][1];
        $name_en = $arr[$i][6];
        $name_en_cut = CutName($arr[$i][6],20);
        $name_cut = CutName($name,30);
                if ($arr[$i][15]) {
                        $url = get_url($arr[$i][0],$arr[$i][15],'Phim');
                        }
                        else {
                        $url = get_url($arr[$i][0],$name,'Phim');
                         }
        $thumb = $arr[$i][2];
        $thumb_big = $arr[$i][4];
        $duration = $arr[$i][7];
        $quality = $arr[$i][8];
        $thuyetminh = $arr[$i][9];
        $filmlb = $arr[$i][10];
        $big = $arr[$i][4];
        $year = $arr[$i][3];
        $cat = $arr[$i][11];
        $view = $arr[$i][14];
        $trangthai = $arr[$i][19];
        if ($arr[$i][17] != 0 ) {
           $lichchieu = $arr[$i][17];
         } else {
           $lichchieu = 'Lượt xem: '.$view;
                }
        if($arr[$i][15] != 0){
        $Bstar = $arr[$i][15];
        } else { $Bstar = '1';}
        if($arr[$i][16] != 0){
            $Astar = $arr[$i][16];
        } else { $Astar = '10';}
        $Cstar = ($Astar/$Bstar);
        $Dstar = number_format($Cstar,0);
        $Cstar = number_format($Cstar,1);
                $num = $i+1;
        $content = CutName(RemoveHtml(UnHtmlChars($arr[$i][5])),250);
        if($quality) $quality = "$quality";
        $episode = MySql::dbselect('id,name','episode',"filmid = '$id' order by id desc limit 1");
        $epname = $episode[0][1];
        if($thuyetminh == 1){
            $phude = 'Thuyết Minh';
                        $code = '<div class="thuyetminhviet" title="Phim có thuyết minh"></div>';
        }elseif($thuyetminh == 2){
            $phude = 'Nosub';
        }elseif($thuyetminh == 3){
            $phude = 'Trailer';
        }else {
            $phude = 'Vietsub';
        }
        //if($epname && $type == 'phimbo') $epnames = " Tập $epname";
        if(empty($duration) || empty($name_en)){
            $duration = "cập nhật";
            $name_en = "cập nhật";
        }else{


        }
        if(!$trangthai){
                    if($filmlb!=0) {
                        if ($episode) {
                            {$epnames[$i] = "<span class=\"badge\">Tập ".substr(abs((int) filter_var($epname, FILTER_SANITIZE_NUMBER_INT)),0,3)."-$phude</span>";} 
                        }
                        else {
                            $epnames[$i] = "<span class=\"badge\">Trailer - $phude</span>";
                        }
                     } else { $epnames[$i] = "<span class=\"badge\">$quality-$phude</span>";}
        } else {
            $epnames[$i] = "<span class=\"badge\">$trangthai</span>";
        }
        if ($big) {$bin = urlimg($big);}
        else { $bin = urlimg($thumb);}
        $html .='<div style="border-top: 1px dashed #CCC; margin-top: 5px; padding-top: 5px;"><a href="'.$url.'" title="'.$name.' - '.$name_en.'" target="_blank">
                 <img data-src="'.SITE_URL.'/anh-phim/278-153/bin/'.$bin.'" alt="ảnh phim '.$name.' - '.$name_en.'" height="150px" width="100%" class="lazyload img-responsive">
                 </a><div class="binname"><a href="'.$url.'">'.$name.'</a><dfn>'.$name_en.'</dfn></div>
                </div>'; 
    }
                            if($html != '') $phpFastCache->set($link, $html, 3600);
                    }
        

     }       
else {  
for($i=0;$i<count($arr);$i++) {
        $id = $arr[$i][0];
        $name = $arr[$i][1];
        $name_en = $arr[$i][6];
        $name_en_cut = CutName($arr[$i][6],20);
        $name_cut = CutName($name,30);
                if ($arr[$i][15]) {
                        $url = get_url($arr[$i][0],$arr[$i][15],'Phim');
                        }
                        else {
                        $url = get_url($arr[$i][0],$name,'Phim');
                         }
        $thumb = $arr[$i][2];
        $thumb_big = $arr[$i][4];
        $duration = $arr[$i][7];
        $quality = $arr[$i][8];
        $thuyetminh = $arr[$i][9];
        $filmlb = $arr[$i][10];
        $year = $arr[$i][3];
        $cat = $arr[$i][11];
        $content = CutName(RemoveHtml(UnHtmlChars($arr[$i][5])),250);
        if($quality) $quality = "$quality";
        $episode = MySql::dbselect('id,name','episode',"filmid = '$id' order by id desc limit 1");
        $epname = $episode[0][1];
        if($thuyetminh == 1){
            $phude = 'Thuyết Minh';
                        $code = '<div class="thuyetminhviet" title="Phim có thuyết minh"></div>';
        }elseif($thuyetminh == 2){
            $phude = 'Nosub';
        }elseif($thuyetminh == 3){
            $phude = 'Trailer';
        }else {
            $phude = 'Vietsub';
        }
        //if($epname && $type == 'phimbo') $epnames = " Tập $epname";
        if(empty($duration) || empty($name_en)){
            $duration = "cập nhật";
            $name_en = "cập nhật";
        }else{


        }
        if($filmlb!=0) {
                        if ($episode) {
                            {$epnames = "<span class=\"badge\">Tập ".substr(abs((int) filter_var($epname, FILTER_SANITIZE_NUMBER_INT)),0,3)."-$phude</span>";} 
                        }
                        else {
                            $epnames = "<span class=\"badge\">Trailer - $phude</span>";
                        }
                     } else { $epnames = "<span class=\"badge\">$quality-$phude</span>";}
        $html .= '<div id="film-$id " class="col-xlg-2 col-lg-15 col-md-3 col-sm-4 col-xs-6">
                <div class="item">
                    <a class="inner" href="'.$url.'" title="'.$name.' - '.$name_en.'"> 
                        <img data-src="'.SITE_URL.'/anh-phim/218-320/bin/'.urlimg($thumb).'" alt="'.$name.' - '.$name_en.'" class="lazyload movie-thumb" /> 
                        <span class="thumb-icon"> <i class="sp-movie-icon-play"></i> </span> <span class="overlay"></span>
                            <div class="description">
                                <h3 class="text-nowrap">'.$name.'</h3>
                                <div class="meta clearfix"> <span class="pull-left"> '.$year.' </span> <span class="pull-right">'.$duration.'</span></div>
                        </div> '.$epnames.'
                    </a>
                    
                </div>
            </div>';
    }
}

    return $html;
}

function rand2($title,$titleen,$filmid) {
    $key = VietChar($title);
    $keyen = explode(' ', $titleen);
    $words = explode(' ', $key);
    $sql = "title_search LIKE '%$words[0]%' OR title LIKE '%$words[0]%' OR title_en LIKE '%$keyen[0]% %$keyen[1]%'  AND id!='$filmid' AND active=1";
    $orderby = "ORDER BY title ASC";
    if(!$orderby) $orderby = 'ORDER BY id DESC';
    $arr = MySql::dbselect('tb_film.id,tb_film.title,tb_film.thumb,tb_film.year,tb_film.big_image,tb_film_other.content,tb_film.title_en,tb_film.duration,tb_film.quality,tb_film.thuyetminh,tb_film.filmlb,tb_film.url','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"$sql $orderby LIMIT 5");
    for($i=0;$i<count($arr);$i++) {
        $id = $arr[$i][0];
        $name = $arr[$i][1];
        $name_en = $arr[$i][6];
        $name_en_cut = CutName($arr[$i][6],20);
        $name_cut = CutName($name,30);
                if ($arr[$i][11]) {
                        $url = get_url($arr[$i][0],$arr[$i][11],'Phim');
                        }
                        else {
                        $url = get_url($arr[$i][0],$name,'Phim');
                         }
        $thumb = $arr[$i][2];
        $thumb_big = $arr[$i][4];
        $duration = $arr[$i][7];
        $quality = $arr[$i][8];
        $thuyetminh = $arr[$i][9];
        $filmlb = $arr[$i][10];
        $year = $arr[$i][3];
        $cat = $arr[$i][11];
        if($thuyetminh == 1){
            $phude = 'Thuyết Minh';
                        $code = '<div class="thuyetminhviet" title="Phim có thuyết minh"></div>';
        }elseif($thuyetminh == 2){
            $phude = 'Nosub';
        }elseif($thuyetminh == 3){
            $phude = 'Trailer';
        }else {
            $phude = 'Vietsub';
        }
        $content = CutName(RemoveHtml(UnHtmlChars($arr[$i][5])),180);
        $episode = MySql::dbselect('id,name','episode',"filmid = '$id' order by id desc limit 1");
        $epname = $episode[0][1];
        if($filmlb!=0) {$epnames = "<span class=\"film-format\">Tập ".substr(abs((int) filter_var($epname, FILTER_SANITIZE_NUMBER_INT)),0,3)." | $phude</span>"; }
        else { $epnames = "<span class=\"film-format\">$quality | $phude</span>"; } 
        if(empty($duration) || empty($name_en)){
            $duration = "cập nhật";
            $name_en = "cập nhật";
        }else{


        }
$html .= '<div class="col-xs-12 col-sm-4 col-md-3 movie-item" data-title="<strong>'.$name.'</strong>">
                        <div class="thumbnail">
                            <a class="link" href="'.$url.'" title="'.$name.' - '.$name_en.'">
                                <img class="lazy img-responsive" data-original="'.SITE_URL.'/anh-phim/205-308/bin/'.urlimg($thumb).'" src="'.SITE_URL.'/anh-phim/205-308/bin/'.urlimg($thumb).'" alt="ảnh phim '.$name.' - '.$name_en.'">
                            </a>
                            <div class="caption">
                                <a href="'.$url.'" title="'.$name.' - '.$name_en.'">
                                    <h3>'.$name.'</h3>
                                </a>
                                <p>'.$name_en.'</p>
                                                </div>
                            <a target="_self" href="'.$url.'" class="btn-overplay"></a>
                                            <div class="episode">' . $duration . '</div>
                                                        </div>
                    </div>';
    }
    return $html;
}

function decu1() {
    global $phpFastCache;
        $link = 'site-decu';
        $data_cache = $phpFastCache->get($link);
        if($data_cache != null){
            $html = $data_cache; 
        }else{ 
           $sql = "decu = '1'";
           $arr = MySql::dbselect('tb_film.id,tb_film.title,tb_film.thumb,tb_film.year,tb_film.big_image,tb_film_other.content,tb_film.title_en,tb_film.duration,tb_film.quality,tb_film.viewed,tb_film.thuyetminh,tb_film.filmlb,tb_film.url,tb_film.tinhtrang','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"$sql order by timeupdate DESC LIMIT 30");
                    for($i=0;$i<count($arr);$i++) {
                            $id = $arr[$i][0];
                            $name = $arr[$i][1];
                            $name_en = $arr[$i][6];
                            $duration = $arr[$i][7];
                            $quality = $arr[$i][8];
                            $view = $arr[$i][9];
                            if ($arr[$i][12]) {
                                            $url = get_url($arr[$i][0],$arr[$i][12],'Phim');
                                            }
                                            else {
                                            $url = get_url($arr[$i][0],$name,'Phim');
                                             }
                            $thumb = $arr[$i][2];
                            $thumb_big = $arr[$i][4];
                            $thuyetminh = $arr[$i][10];
                            $filmlb = $arr[$i][11];
                            $trangthai = $arr[$i][13];
                            $episode = MySql::dbselect('id,name','episode',"filmid = '$id' order by id desc limit 1");
                            $epname = $episode[0][1];
                            if($thuyetminh == 1){
                                $phude = 'Thuyết Minh';
                                            $code = '<div class="thuyetminhviet" title="Phim có thuyết minh"></div>';
                            }elseif($thuyetminh == 2){
                                $phude = 'Nosub';
                            }elseif($thuyetminh == 3){
                                $phude = 'Trailer';
                            }else {
                                $phude = 'Vietsub';
                            }
                            if(!$trangthai){
                                        if($filmlb!=0) {
                                            if ($episode) {
                                                {$epnames = "<span class=\"badge\">Tập ".substr(abs((int) filter_var($epname, FILTER_SANITIZE_NUMBER_INT)),0,3)."-$phude</span>";} 
                                            }
                                            else {
                                                $epnames = "<span class=\"badge\">Trailer - $phude</span>";
                                            }
                                         } else { $epnames = "<span class=\"badge\">$quality-$phude</span>";}
                            } else {
                                $epnames = "<span class=\"badge\">$trangthai</span>";
                            }
                            
                        $html .= '<div class="item">
                                        <a class="inner" href="'.$url.'" title="'.$name.'-'.$name_en.'"> 
                                            <img data-src="'.SITE_URL.'/anh-phim/205-308/bin/'.urlimg($thumb).'" alt="'.$name.'-'.$name_en.'" class="lazyload movie-thumb" /> 
                                            <span class="thumb-icon"> <i class="sp-movie-icon-play"></i> </span> <span class="overlay"></span>
                                                <div class="description">
                                                    <h3 class="text-nowrap">'.$name.'</h3>
                                                    <div class="meta clearfix"> <span class="pull-left"> '.$year.' </span> <span class="pull-right">'.$duration.'</span></div>
                                            </div>'.$epnames.'
                                        </a>
                                        
                                    </div>';     
                                    }
                            if($html != '') $phpFastCache->set($link, $html, CACHED_TIME);
                    }

    return $html;
}

function filmlb1($id,$limit) {
    if($id == 0)$sql = "filmlb = '2'";
    else $sql = "filmlb = '1'";
        $orderby = "ORDER BY RAND()";
    $arr = MySql::dbselect('tb_film.id,tb_film.title,tb_film.thumb,tb_film.year,tb_film.big_image,tb_film_other.content,tb_film.title_en,tb_film.duration,tb_film.quality,tb_film.url','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"$sql $orderby LIMIT $limit");
    for($i=0;$i<count($arr);$i++) {
        $id = $arr[$i][0];
        $name = $arr[$i][1];
        $name_en = $arr[$i][6];
        $name_en_cut = CutName($arr[$i][6],20);
        $name_cut = CutName($name,13);
        if ($arr[$i][9]) {
                        $url = get_url($arr[$i][0],$arr[$i][9],'Phim');
                        }
                        else {
                        $url = get_url($arr[$i][0],$name,'Phim');
                         }
        $thumb = $arr[$i][2];
        $thumb_big = $arr[$i][4];
        $duration = $arr[$i][7];
        $quality = $arr[$i][8];
        $year = $arr[$i][3];
        $content = CutName(RemoveHtml(UnHtmlChars($arr[$i][5])),180);
        if($quality) $quality = "<i class=\"qt\">$quality</i>";
        $episode = MySql::dbselect('id,name','episode',"filmid = '$id' order by id desc limit 1");
        $epname = $episode[0][1];
        if($epname && $type == 'phimbo') $epnames = "<i class=\"ep\">Tập $epname</i>";




        $html .= "<li class=\"box-movie first-items\">
                <a class=\"movie-link\" href=\"$url\" title=\"$name\">
                    <div class=\"thumbn\" style=\"background-image: url('$thumb');\"></div>
                    <div class=\"meta\">
                        <span class=\"name-vn link\">$name</span>
                        <br />
                        <span class=\"name-en\">$name_en_cut</span>
                    </div>
                </a>
                <div class=\"eps\">$duration</div>
                <div class=\"clear\"></div>
            </li>";
    }
    return $html;
}

function tags_rand() {
    $orderby = "ORDER BY RAND()";
    $arr = MySql::dbselect('tb_film_other.filmid,tb_film_other.keywords','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"filmid $orderby LIMIT 17");
    for($i=0;$i<count($arr);$i++) {
        $id = $arr[$i][0];
        $name = $arr[$i][1];
        $name_cut = CutName($name,17);
        $url = get_url('',$name,'search');
        
        $html .= "<a class=\"tag-link\" title=\"$name\" href=\"$url\">$name</a>";
    }
    return $html;
}




function rand1() {
    
        $sql = "active=2";
        $orderby = "ORDER BY timeupdate DESC";
    if(!$orderby) $orderby = 'ORDER BY id DESC';
    $arr = MySql::dbselect('tb_film.id,tb_film.title,tb_film.thumb,tb_film.year,tb_film.big_image,tb_film_other.content,tb_film.title_en,tb_film.duration,tb_film.quality,tb_film.thuyetminh,tb_film.filmlb,tb_film.url','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"$sql $orderby LIMIT 16");
    for($i=0;$i<count($arr);$i++) {
        $id = $arr[$i][0];
        $name = $arr[$i][1];
        $name_en = $arr[$i][6];
        $name_en_cut = CutName($arr[$i][6],20);
        $name_cut = CutName($name,30);
        if ($arr[$i][11]) {
                        $url = get_url($arr[$i][0],$arr[$i][11],'Phim');
                        }
                        else {
                        $url = get_url($arr[$i][0],$name,'Phim');
                         }
        $thumb = $arr[$i][2];
        $thumb_big = $arr[$i][4];
        $duration = $arr[$i][7];
        $quality = $arr[$i][8];
        $thuyetminh = $arr[$i][9];
        $filmlb = $arr[$i][10];
        $year = $arr[$i][3];
        if($thuyetminh == 1){
            $phude = 'Thuyết Minh';
                        $code = '<div class="thuyetminhviet" title="Phim có thuyết minh"></div>';
        }elseif($thuyetminh == 2){
            $phude = 'Nosub';
        }elseif($thuyetminh == 3){
            $phude = 'Trailer';
        }else {
            $phude = 'Vietsub';
        }
        $content = CutName(RemoveHtml(UnHtmlChars($arr[$i][5])),180);
        $episode = MySql::dbselect('id,name','episode',"filmid = '$id' order by id desc limit 1");
        $epname = $episode[0][1];
        if($filmlb!=0){
                    $type = 'phimbo';
                }
        if($epname && $type == 'phimbo') { $epnames = "<span class=\"film-format\">Tập $epname | $phude</span>"; }else{ $epnames = "<span class=\"film-format\">HD | $phude</span>"; }  
        if(empty($duration) || empty($name_en)){
            $duration = "cập nhật";
            $name_en = "cập nhật";
        }else{


        }

        $html .= '<div class="ml-item">
            <a href="'.$url.'"
               data-url="'.SITE_URL.'/ajax/movie_load_info/'.$id.'/"
               class="ml-mask jt"
               title="'.$name.'">
                
                <img data-original="'.$thumb.'" class="lazy thumb mli-thumb"
                     alt="'.$name.'">
                <span class="mli-info"><h2>'.$name.'</h2></span>
            </a>
        </div>
        ';
    }
    return $html;
}

function li_video() {
    global $phpFastCache;
        $link = 'site-video';
        $data_cache = $phpFastCache->get($link);
        if($data_cache != null){
            $html = $data_cache; 
        }else{  $arr = MySql::dbselect('id,name,url,duration,thumb,viewed','media',"id != 0 order by id desc limit 12");
                for($i=0;$i<count($arr);$i++) {
                        $name = $arr[$i][1];
                        $url = get_url($arr[$i][0],$name,'xem-video');
                        $thumb = $arr[$i][4];
                        $duration = $arr[$i][3];
                        $viewed = $arr[$i][5];
                        if(!$thumb) $thumb = TEMPLATE_URL.'images/bgcatft.jpg';
                        $name_cut = CutName($name,25);
                        $html .= '<div class="col-xlg-3 col-lg-15 col-md-3 col-sm-4 col-xs-6">
                            <div class="item video">
                            <a class="inner" href="'.$url.'">
                            <img src="'.$thumb.'" alt="'.$name.'" class="movie-thumb">
                            <span class="thumb-icon"> <i class="sp-movie-icon-play"></i> </span> 
                            <span class="overlay"></span>
                            <div class="description">
                            <h3 class="text-nowrap">'.$name.'</h3>
                            </div>
                            </a>
                            </div></div>';
                        
                        
                    }    
                if($html != '') $phpFastCache->set($link, $html, CACHED_TIME);
        }
        return $html;
}
function li_episode($sql,$limit) {
	    global $phpFastCache;
        $link = 'site-eps';
        $data_cache = $phpFastCache->get($link);
        if($data_cache != null){
            $html = $data_cache; 
        }else{
    $arr = MySql::dbselect('tb_episode.id,tb_episode.name,tb_episode.filmid,tb_film.title,tb_film.thumb,tb_film.thuyetminh,tb_film.big_image','episode JOIN tb_film ON (tb_film.id = tb_episode.filmid)',"$sql ORDER BY tb_episode.id DESC LIMIT $limit");
    for($i=0;$i<count($arr);$i++) {
        $name = $arr[$i][1];
        $filmid = $arr[$i][2];
        $title = $arr[$i][3];
        $url = get_url($arr[$i][0],$title,'Xem Phim');
        $thumb = $arr[$i][6];
        $thuyetminh = $arr[$i][5];
        if($thuyetminh == 1){
            $phude = 'Thuyết Minh';
                        $code = '<div class="thuyetminhviet" title="Phim có thuyết minh"></div>';
        }elseif($thuyetminh == 2){
            $phude = 'Nosub';
        }elseif($thuyetminh == 3){
            $phude = 'Trailer';
        }else {
            $phude = 'Vietsub';
        }
        if(!$thumb) $thumb = TEMPLATE_URL.'images/bgcatft.jpg';
        $title_cut = CutName($title,25);
         $html .= '<div class="col-xlg-3 col-lg-15 col-md-3 col-sm-4 col-xs-6">
                            <div class="item video">
                            <a class="inner" href="'.$url.'">
                            <img data-src="'.SITE_URL.'/anh-phim/205-115/bin/'.urlimg($thumb).'" alt="'.$name.'" class="lazyload movie-thumb">
                            <span class="thumb-icon"> <i class="sp-movie-icon-play"></i> </span> 
                            <span class="overlay"></span>
                            <div class="description">
                            <h3 class="text-nowrap">'.$title.' Tập '.$name.' </h3>
                            </div>
                            </a><span class="badge">Tập '.$name.'</span>
                            </div></div>';
                        }
                if($html != '') $phpFastCache->set($link, $html, 3600);
    }
    return $html;
}
function news() {
    global $phpFastCache;
        $link = 'site-newshome';
        $data_cache = $phpFastCache->get($link);
        if($data_cache != null){
            $html = $data_cache; 
        }else{ 
                $arr = MySql::dbselect('id,title,seotitle,content,thumb','news',"id != 0 order by id desc limit 10");
                for($i=0;$i<count($arr);$i++) {
                    $name = $arr[$i][1];
                            $seotitle = $arr[$i][2];
                    if($seotitle){
                        $url = SITE_URL.'/post/'.$seotitle.'/';
                    }  else {
                        $url = get_url($arr[$i][0],$name,'post');
                    }           
                    $thumb = $arr[$i][4];
                    $content = $arr[$i][3];
                    if(!$thumb) $thumb = TEMPLATE_URL.'images/bgcatft.jpg';
                    $name_cut = CutName($name,200);
                                            $num = $i+1;
                                   $html .= '          
                            <li>
                                                                    <div class="thumb">
                                                                        <a href="'.$url.'">
                            <img src="'.$thumb.'" width="90" alt="'.$name.'">
                                                                        </a>
                                                                    </div>
                                                                    <div class="detail-news">
                             <a class="title-news" href="'.$url.'"><h2>'.$name_cut.'</h2></a> </div>
                                                                </li>'; 
                                }
                if($html != '') $phpFastCache->set($link, $html, CACHED_TIME);
        }
        return $html;
}
function li_news() {
        global $phpFastCache;
        $link = 'site-news';
        $data_cache = $phpFastCache->get($link);
        if($data_cache != null){
            $html = $data_cache; 
        }else{ 
                $arr = MySql::dbselect('id,title,seotitle,content,thumb','news',"id != 0 order by id desc limit 12");
                for($i=0;$i<count($arr);$i++) {
                        $name = $arr[$i][1];
                                $seotitle = $arr[$i][2];
                                $url = SITE_URL.'/post/'.$seotitle.'/';
                        $thumb = $arr[$i][4];
                        $content = $arr[$i][3];
                        if(!$thumb) $thumb = TEMPLATE_URL.'images/bgcatft.jpg';
                        $name_cut = CutName($name,200);
                        $num = $i+1;
                        if ($num < 2) {
                            $html .= '<a class="list-item-with-thumb" href="'.$url.'" title="'.$name.'">
                                        <div class="outer" style="padding-bottom: 60%;">
                                            <div class="inner"> <img src="'.$thumb.'" class="img-responsive" alt="'.$name.'">
                                                <div class="description">
                                                    <h3 class="text-nowrap font-13">'.$name.'</h3>
                                                </div> 
                                                <span class="thumb-icon"><span class="overlay"></span>
                                            </span></div>
                                        </div>
                                      </a>';
                     } else { 
                            $html .= '<a class="list-item" href="'.$url.'" title="'.$name.'">
                                        <div class="right-top-rating rating-small">
                                        </div> <em class="number">'.$num.'</em>
                                        <h3 class="title text-nowrap">'.$name.'</h3>
                                      </a>';
                        }

                        
                        
                    }
                if($html != '') $phpFastCache->set($link, $html, CACHED_TIME);
        }
        return $html;

}
function li_tintuc() {
    $arr = MySql::dbselect('id,title,seotitle,content,thumb','news',"id != 0 ORDER BY RAND() limit 7");
    for($i=0;$i<count($arr);$i++) {
        $name = $arr[$i][1];
                $seotitle = $arr[$i][2];
        if($seotitle){
            $url = SITE_URL.'/post/'.$seotitle.'/';
        }  else {
            $url = get_url($arr[$i][0],$name,'post');
        }
        $thumb = $arr[$i][4];
        $content = $arr[$i][3];
        if(!$thumb) $thumb = TEMPLATE_URL.'images/bgcatft.jpg';
        $name_cut = CutName($name,25);
                                $contentt = CutName(RemoveHtml(UnHtmlChars($arr[$i][3])),200);
                                $num = i+1;
                                  $html .= '<article class="media row">
                                    <a href="'.$url.'" class="col-lg-5 col-md-6 col-sm-4 col-xs-6" title="'.$name.'"> 
                                    <img src="'.$thumb.'" alt="'.$name.'" class="img-responsive"> </a>
                                    <div class="media-body col-lg-7 col-md-6 col-sm-8 col-xs-6">
                                        <h2 class="media-heading"> <a href="'.$url.'" title="'.$name.'"> '.$name.'</a></h2>
                                        <div class="user-post clearfix">
                                            <div class="pull-left mr-lg"><i class="fa fa-clock-o"></i> <span>ADMIN</span></div>
                                        </div>
                                        <div class="media-post pt">'.$contentt.'</div>
                                    </div>
                                </article>';


        
        
    }
    return $html;
}
 
function topvideo() {
    $arr = MySql::dbselect('id,name,url,duration,thumb,viewed','media',"id != 0 order by viewed desc limit 6");
    for($i=0;$i<count($arr);$i++) {
        $name = $arr[$i][1];
        $url = get_url($arr[$i][0],$name,'xem-video');
        $thumb = $arr[$i][4];
 //       $thumb = urlimg($arr[$i][4]);
        $duration = $arr[$i][3];
        $viewed = $arr[$i][5];
        if(!$thumb) $thumb = TEMPLATE_URL.'images/bgcatft.jpg';
        $name_cut = CutName($name,25);
        $html .= '
                                  <li class="item">
                        <div class="thumb-wrap">
                            <a class="thumb" title="" href="'.$url.'">
                                <img alt="'.$name_cut.'" src="'.$thumb.'"/>
                                <span class="overlay"></span>
                            </a> 
                                                        <div class="meta">
                                <h3 class="H3title">
                                    <a href="'.$url.'">'.$name_cut.'</a></h3>
                                <div class="explain"><span></span></div>
                                <span class="count-view"><i></i> '.$viewed .'</span> 
                            </div>
                        </div>
                    </li> ';

//                              <img alt="'.$name_cut.'" src="'.SITE_URL.'/anh-phim/300-168/bin/'.$thumb.'"/>
        
        
    }
    return $html;
} 

function bxh_show($bin,$type) {
    global $phpFastCache;
        $link = 'site-bxh-'.$type.'-'.$bin;
        $data_cache = $phpFastCache->get($link);
        if($data_cache != null){
            $html = $data_cache; 
        }else{ 
                if($bin == 'phimbo') {
                    $sql = "filmlb IN (1,2) AND active=1";
                    }
                    else if($bin == 'phimle') {
                    $sql = "filmlb = 0 && active = 1";
                    }
                    if($type == 'day') $orderby = 'viewed_day';
                    else if($type == 'week') $orderby = 'viewed_week';
                    else if($type == 'month') $orderby = 'viewed_month';
                    else if($type == 'vote') $orderby = 'total_value';
                    $arr = MySql::dbselect('id,title,thumb,year,duration,title_en,actor,total_votes,total_value,viewed_day,viewed_week,viewed_month,big_image','film',"$sql  ORDER BY $orderby DESC LIMIT 5");
                    for($i=0;$i<count($arr);$i++) {
                        $id = $arr[$i][0];
                        $name = $arr[$i][1];
                        $name_en = $arr[$i][5];
                        $view_day = $arr[$i][9];
                        $view_week = $arr[$i][10];
                        $view_month = $arr[$i][11];
                        $url = get_url($arr[$i][0],$name,'Phim');
                        $thumb = $arr[$i][2];
                        $actor = CutName($arr[$i][6],70);
                        $year = $arr[$i][3];
                        $duration = $arr[$i][4];
                                $num = i+1;
                        if($type == 'day') {$viewed = $view_day;}
                    else if($type == 'week') {$viewed = $view_week;}
                    else if($type == 'month') {$viewed = $view_month;}

                    $html .= "<li class=\"list-group-item clearfix\">
                        <div class=\"thumbnail\">
                            <a href=\"$url\" title=\"$name - $name_en\"> <img data-src=\"".$thumb."\" class=\"lazyload\" alt=\"$name_en\"> </a>
                        </div>
                        <div class=\"meta-item\">
                            <h3 class=\"name-1\"> <a href=\"$url\" title=\"$name\">$name</a></h3>
                            <h4 class=\"name-2\">$name_en</h4>
                                                                <p>$duration</p>
                            <p> <i class=\"fa fa-video-camera\"></i> $viewed lượt xem&nbsp;&nbsp;&nbsp;&nbsp;</p>
                        </div>
                    </li>";
//<a href=\"$url\" title=\"$name - $name_en\"> <img data-src=\"".SITE_URL."/anh-phim/62-90/bin/".urlimg($thumb)."\" class=\"lazyload\" alt=\"$name_en\"> </a>
                    }
                if($html != '') $phpFastCache->set($link, $html, CACHED_TIME);
        }
        return $html;
}
function binplayer($html,$subtitle,$filmid,$epid){
    if ($subtitle != '') {
        $cc = '                  tracks: [{file: "'.$subtitle.'",
                                label: "Vietsub",
                                kind: "captions",
                                "default": true }],
                                 captions: {
                                 color: "#FFFFFF",
                                 backgroundOpacity: 70
                                  }
               ';
    } else $cc ='';
    $player = '<script type="text/javascript" src="'.SITE_URL.'/player/playerphimaz.js"></script>
        <script type="text/javascript">jwplayer.key="MBvrieqNdmVL4jV0x6LPJ0wKB/Nbz2Qq/lqm3g==";</script>';
    $player .= '<div id="player" style="width: 100%;height: 500px !important;"></div>
    <script type="text/javascript">
	function smallSources(sources) {
	var map = {};
	var newSources = [];
	for (var i = 0; i < sources.length; i++) {
	    var item = sources[i];
	    if (!map[item.label]) {
	        newSources.push(item);
	        map[item.label] = true;
	    }
	}
	newSources.sort(function (a, b) {
	    return (parseInt(a.label.replace(\'p\', \'\')) < parseInt(b.label.replace(\'p\', \'\')))
	});
	return newSources;
	}
    function removeLink(url) {
    var newSources = [];
    for (var i = 0; i < sources.length; i++) {
        var item = sources[i];
        if (item.file != url) {
            newSources.push(item);
        }
    }
    if (newSources.length == 0) {
        sources = [rootSources[0]];
        newSources = sources;
    } else {
        sources = newSources;
    }
    return newSources;
}

function reloadPlayer(newSources) {
    var playerInstance = jwplayer("player");
    var sources = smallSources(newSources);

    playerInstance.setup({
        sources: smallSources(sources),
        "playbackRateControls": true,
        tracks: tracks
    });

    playerInstance.on(\'error\', function (evt) {
        handelError();
    });
}
function handelError() {
            var file = jwplayer("player").getPlaylist()[0];
            var newSources = removeLink(file.file);
            reloadPlayer(newSources);
        }
    var reloadTimes = 0;
    var playerInstance = jwplayer("player");
    function load_biplayer() {
        playerInstance.setup({
                    sources: smallSources(['.$html.']),
                    image: "/view.png",  
                    width: "100%",
                    height: "100%",
                    aspectratio: "16:9",                 
                    autostart: false,
                            '.$cc.'

        });
      playerInstance.on("time", function(e) {
        $cookie.setItem("resumevideodata", Math.floor(e.position) + ":" + playerInstance.getDuration(), 82000, window.location.pathname)
    });
            playerInstance.on("firstFrame", function() {    
                var cookieData = $cookie.getItem("resumevideodata");
                if (cookieData) {
                    var resumeAt = cookieData.split(":")[0],
                        videoDur = cookieData.split(":")[1];
                    if (parseInt(resumeAt) < parseInt(videoDur)) {
                        (resumeAt == 0) ? resumeAt = 1: "";
                        playerInstance.seek(resumeAt);
                        fx.displayMessage("Hệ thống nhận thấy bạn đang xem dở bộ phim này. Mời bạn tiếp tục xem!")
                    } else if (cookieData && !(parseInt(resumeAt) < parseInt(videoDur))) {
                        logMessage("Video ended last time! Will skip resume behavior")
                    }
                } else {
                }
            });
            playerInstance.addButton(
              "'.SITE_URL.'/player/forward3.svg",
              "Tua tiến 10s",
              function() {
                playerInstance.seek(playerInstance.getPosition()+10);
              },
              "Tua tiến 10s"
            );
            playerInstance.addButton(
              "'.SITE_URL.'/player/backward2.svg",
              "Tua lại 10s",
              function() {
                playerInstance.seek(playerInstance.getPosition()-10);
              },
              "Tua lại 10s"
            );
        playerInstance.on("error", function (message) {
            if ((reloadTimes < 5)) {
                reloadTimes = reloadTimes + 1;
                setTimeout(function () {
                    playerInstance.remove();
                    load_biplayer();
                }, 1500);
            } else {
                handelError();
            }
        });

        playerInstance.on("setupError", function (message) {
            if ((reloadTimes < 5)) {
                reloadTimes = reloadTimes + 1;
                setTimeout(function () {
                    playerInstance.remove();
                    load_biplayer();
                }, 1500);
            } else {
                handelError();
            }
        });
        playerInstance.on("complete", function(e) {
                                                if(pautonext == true){
                                                    var $elm = $(\'.list-episode li a.active\');
                                                    if($elm.length){
                                                        var nextEpisode = $elm.closest(\'li\').next().find(\'a\').attr(\'href\');
                                                        if(typeof(nextEpisode) != \'undefined\'){
                                                            location.href = nextEpisode;
                                                        }
                                                    }
                                                }
                                            });

        playerInstance.addButton(
        "'.SITE_URL.'/assets/images/icon-download.png",
        "Nhấn vào đây để tải video",
        function() {window.open(playerInstance.getPlaylistItem()["file"] + "&title=phimaz.net", "_blank").blur();   }, "download"   );
    }

    load_biplayer();
        </script>
';
        echo $player;
}
function bingetlink($html,$thumb,$filmid,$epid) {
    $key = 'biphim_'.$epid;
    $player =  '<script type="text/javascript">
            var json = JSON.parse(\'['.$html.']\');
            var index = localStorage.getItem("'.$key.'");
            if (!index) {
                localStorage.setItem("'.$key.'", 0);
                index = 0;
            }
            var link = json[index]["file"];
            var type = json[index]["type"];
            </script>
        <script type="text/javascript" src="'.SITE_URL.'/player/playerphimaz.js"></script>
        <script type="text/javascript">jwplayer.key="MBvrieqNdmVL4jV0x6LPJ0wKB/Nbz2Qq/lqm3g==";</script> 
        <div id="mediaplayer" style="width: 100%;height: 100% !important;"></div>   
         <script type="text/javascript">
        if(type == "mp4") {
            index = parseInt(index);
            var error = index+1;
            console.log(error);
            $("#mediaplayer").html("<script type=\"text/javascript\">jwplayer(\"mediaplayer\").setup({file: \'"+link+"\',type:\'mp4\',width: \"100%\",height: \"100%\",aspectratio: \"16:9\",image: \"'.$thumb.'\",autostart: false,advertising: {client: \"vast\",admessage: \"Quảng cáo còn XX giây.\",skiptext: \"Bỏ qua quảng cáo\",skipmessage: \"Bỏ qua sau xxs\",\"skipoffset\":3,schedule: {\"myAds\":{\"offset\":\"pre\",\"tag\":\"https://phimaz.net/ads.xml?v6\"}}}});jwplayer(\"mediaplayer\").on(\'error\', function() {localStorage.setItem(\"'.$key.'\", \"" + error + "\");location.reload();});jwplayer(\"mediaplayer\").on(\"time\", function(e) {$cookie.setItem(\"resumevideodata\", Math.floor(e.position) + \":\" + jwplayer(\"mediaplayer\").getDuration(), 82000, window.location.pathname)});jwplayer(\"mediaplayer\").on(\"firstFrame\", function() {var cookieData = $cookie.getItem(\"resumevideodata\");if (cookieData) {var resumeAt = cookieData.split(\":\")[0],videoDur = cookieData.split(\":\")[1];if (parseInt(resumeAt) < parseInt(videoDur)) {(resumeAt == 0) ? resumeAt = 1:\"\";jwplayer(\"mediaplayer\").seek(resumeAt);fx.displayMessage(\"Hệ thống nhận thấy bạn đang xem dở bộ phim này BiPhim sẽ tiếp tục phát cho bạn!\")} else if (cookieData && !(parseInt(resumeAt) < parseInt(videoDur))) {logMessage(\"Video ended last time! Will skip resume behavior\")}} else {}});jwplayer(\"mediaplayer\").addButton(\"'.SITE_URL.'/player/forward3.svg\",\"Tua tiến 10s\",function() {jwplayer(\"mediaplayer\").seek(jwplayer(\"mediaplayer\").getPosition()+10);},\"Tua tiến 10s\");jwplayer(\"mediaplayer\").addButton( \"'.SITE_URL.'/player/backward2.svg\",\"Tua lại 10s\",function() {jwplayer(\"mediaplayer\").seek(jwplayer(\"mediaplayer\").getPosition()-10);},\"Tua lại 10s\");jwplayer(\"mediaplayer\").on(\"complete\", function(e) {if(pautonext == true){var $elm = $(\'.list-episode li a.active\');if($elm.length){var nextEpisode = $elm.closest(\'li\').next().find(\'a\').attr(\'href\');if(typeof(nextEpisode) != \'undefined\'){location.href = nextEpisode;}}}});jwplayer(\"mediaplayer\").addButton(\'\/assets/images/icon-download.png\',\'Tải Phim\',function(){window.open(jwplayer(\"mediaplayer\").getPlaylistItem()[\"file\"] + \"&title=phimaz.net\", \"_blank\").blur();},\"download\");<\/script>");

        } else {
            $("#mediaplayer").html(\'<iframe width="100%" height="100%" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" src="\'+link+\'"></iframe>\');
        }
        </script>';
    echo $player;
        
}
function binplaylist($html,$phim){
$player ='<script type="text/javascript" src="'.SITE_URL.'/player/jwplayer.js"></script>
<script type="text/javascript">jwplayer.key="WgfBD4YI7jhxwMUXHvOeMOqsqYYsEjW04rZalw==";</script>';
$player .='<div id="mediaplayer"></div><script type="text/javascript">
jwplayer("mediaplayer").setup({
playlist : ['.$html.'],  
width: "100%",
height: "100%",
aspectratio: "16:9",
skin: {
name: "iphimhd",
 background: "transparent",
url:"/player/skins/iphimhd.css"
},
autostart: false,
logo: { file: "/logo.png",
link: "https://phimaz.net",
position: "top-left",},});
jwplayer("mediaplayer").addButton(
"'.SITE_URL.'/assets/images/icon-download.png",
"Nhấn vào đây để tải video",
function() {    window.open(jwplayer("mediaplayer").getPlaylistItem()["file"] + "&title=phimaz.net-'.$phim.'", "_blank").blur();    }, "download"   );
        </script>

';
        echo $player;
}
function type_video(&$url) {
    $t_url     = strtolower($url);
    $ext       = explode('.', $t_url);
    $ext       = $ext[count($ext) - 1];
    $ext       = explode('?', $ext);
    $ext       = $ext[0];
    $movie_arr = array('wmv','avi','asf','mpg','mpe','mpeg','asx','m1v','mp2','mpa','ifo','vob','smi');
    $extra_swf_arr = array('www.metacafe.com','www.livevideo.com');
    for ($i = 0; $i < count($extra_swf_arr); $i++) {
        if (preg_match("#^http://" . $extra_swf_arr[$i] . "/(.*?)#s", $url)) {
            $type = 2;
            break;
        }
    }
    $is_youtube       = (preg_match("#youtube.com/([^/]+)#", $url));
    $is_youtube1      = (preg_match("#https://www.youtube.com/watch%(.*?)#s", $url));
    $is_youtube2      = (preg_match("#https://www.youtube.com/watch/v/(.*?)#s", $url));
    $is_youtube3      = (preg_match("#https://www.youtube.com/v/(.*?)#s", $url));
    $is_gdata         = (preg_match("#http://gdata.youtube.com/feeds/api/playlists/(.*?)#s", $url));
    $is_daily         = (preg_match("#dailymotion.com#", $url));
    $is_vntube        = (preg_match("#http://www.vntube.com/mov/view_video.php\?viewkey=(.*?)#s", $url));
    $is_tamtay        = (preg_match("#http://video.tamtay.vn/play/([^/]+)(.*?)#s", $url, $idvideo_tamtay));
    $is_chacha        = (preg_match("#http://chacha.vn/song/(.*?)#s", $url));
    $is_clipvn        = (preg_match("#phim.clip.vn/watch/([^/]+)/([^,]+),#", $url));
    $is_clipvn1       = (preg_match("#clip.vn/watch/(.*?)#s", $url));
    $is_clipvn2       = (preg_match('#clip.vn/w/(.*?)#s', $url));
    $is_clipvn3       = (preg_match('#clip.vn/embed/(.*?)#s', $url));
    $is_googleVideo   = (preg_match("#http://video.google.com/videoplay\?docid=(.*?)#s", $url));
    $is_myspace       = (preg_match("#http://vids.myspace.com/index.cfm\?fuseaction=vids.individual&VideoID=(.*?)#s", $url));
    $is_timnhanh      = (preg_match("#http://video.yume.vn/(.*?)#s", $url));
    $is_veoh          = (preg_match("#http://www.veoh.com/videos/(.*?)#s", $url));
    $is_veoh1         = (preg_match("#http://www.veoh.com/browse/videos/category/([^/]+)/watch/(.*?)#s", $url));
    $is_baamboo       = (preg_match("#http://video.baamboo.com/watch/([0-9]+)/video/([^/]+)/(.*?)#", $url, $idvideo_baamboo));
    $is_livevideo     = (preg_match("#http://www.livevideo.com/video/([^/]+)/(.*?)#", $url, $idvideo_live));
    $is_sevenload     = (preg_match("#sevenload.com/videos/([^/-]+)-([^/]+)#", $url, $id_sevenload));
    $is_picasa        = (preg_match('#picasaweb.google.com/(.*?)#s', $url));
    $is_blogspot      = (preg_match('#bp.blogspot.com/(.*?)#s', $url));
    $is_gcontent      = (preg_match('#googleusercontent.com/(.*?)#s', $url));
    $is_badongo       = (preg_match("#badongo.com/vid/(.*?)#s", $url));
    $id_sevenload     = (preg_match("#sevenload.com/videos/([^/-]+)-([^/]+)#", $url, $id_sevenload));
    $is_olala         = (preg_match("#http://timvui.vn/player/(.*?)#s", $url));
    $is_tvzing        = (preg_match("#tv.zing.vn/video/([^/]+)#", $url));
    $is_mediafire     = (preg_match("#http://www.mediafire.com/?(.*?)#s", $url));
    $is_cyworld       = (preg_match("#cyworld.vn/([^/]+)#", $url));
    $is_goonline      = (preg_match("#http://clips.goonline.vn/xem/(.*?)#s", $url));
    $is_novamov       = (preg_match("#http://www.novamov.com/video/(.*?)#s", $url));
    $is_zippyshare    = (preg_match("#http://www([0-9]+).zippyshare.com/v/(.*?)/file.html#s", $url));
    $is_sendspace     = (preg_match("#sendspace.com/([^/]+)#", $url));
    $is_vidxden       = (preg_match("#http://www.vidxden.com/(.*?)#s", $url));
    $is_megafun       = (preg_match("##megafun.vn/(.*?)#s", $url));
    $is_BB            = (preg_match("#http://www.videobb.com/video/(.*?)#s", $url));
    $is_Sshare        = (preg_match("#http://www.speedyshare.com/files/(.*?)#s", $url));
    $is_4share1       = (preg_match("#4shared.com/file/(.*?)#s", $url));
    $is_4share2       = (preg_match("#4shared.com/video/(.*?)#s", $url));
    $is_4share3       = (preg_match("#4shared.com/embed/(.*?)#s", $url));
    $is_2share1       = (preg_match("#2shared.com/file/(.*?)#s", $url));
    $is_2share2       = (preg_match("#2shared.com/video/(.*?)#s", $url));
    $is_2share3       = (preg_match("#2sharedid=(.*?)#s", $url));
    $is_Wootly        = (preg_match("#http://www.wootly.com/(.*?)#s", $url));
    $is_tusfiles      = (preg_match("#http://www.tusfiles.net/(.*?)#s", $url));
    $is_sharevnn      = (preg_match("#http://share.vnn.vn/dl.php/(.*?)#s", $url));
    $is_BBS           = (preg_match("#http://videobb.com/video/(.*?)#s", $url));
    $is_ovfile        = (preg_match("#http://ovfile.com/(.*?)#s", $url));
    $is_SSh           = (preg_match("#http://phim.soha.vn/watch/3/video/(.*?)#s", $url));
    $is_em4share      = (preg_match("#http://www.4shared.com/embed/(.*?)#s", $url));
    $is_viddler       = (preg_match("#http://www.viddler.com/player/(.*?)#s", $url));
    $is_SeeOn         = (preg_match("#http://video.seeon.tv/video/(.*?)#s", $url));
    $is_vidus         = (preg_match("#http://s([0-9]+).vidbux.com:([0-9]+)/d/(.*?)#s", $url));
    $is_Twitclips     = (preg_match("#http://www.twitvid.com/(.*?)#s", $url));
    $is_videozer      = (preg_match("#http://videozer.com/embed/(.*?)#s", $url));
    $is_eyvx          = (preg_match("#http://eyvx.com/(.*?)#s", $url));
    $is_banbe         = (preg_match("#banbe.net/(.*?)#s", $url));
    $is_nhaccuatui    = (preg_match("#nhaccuatui.com(.*?)#s", $url));
    $is_ggdocs        = (preg_match("#docs.google.com(.*?)#s", $url));
    $is_ggdrive       = (preg_match("#drive.google.com(.*?)#s", $url));
    $is_upfile        = (preg_match("#upfile.vn/([^/]+)#", $url));
    $is_plusgoogle    = (preg_match("#plus.google.com/([^/]+)#", $url));
    $is_vidbull       = (preg_match("#fptplay.net/([^/]+)#", $url));
    $is_telly         = (preg_match("#vivo.vn/([^/]+)#", $url));
    $is_movreel       = (preg_match("#hdonline.vn/([^/]+)#", $url));
    $is_videoweed     = (preg_match("#phim.megabox.vn/([^/]+)#", $url));
    $is_phimbathu     = (preg_match("#phimbathu.com/([^/]+)#", $url));
    $is_banhtv     = (preg_match("#banhtv.com/([^/]+)#", $url));
    $is_xuongphim     = (preg_match("#xuongphim.tv/([^/]+)#", $url));
    $is_phimnhanh     = (preg_match("#phimnhanh.com/([^/]+)#", $url));
    $is_bilutv     = (preg_match("#bilutv.com/([^/]+)#", $url));
    $is_phimmoi     = (preg_match("#phimmoi.net/([^/]+)#", $url));
    $is_animetvn     = (preg_match("#animetvn.tv/([^/]+)#", $url));
    $is_xps     = (preg_match("#xemphimso.com/([^/]+)#", $url));
    $is_hulk          = (preg_match("#hu.lk/([^/]+)#", $url));
    $is_novamov       = (preg_match("#novamov.com/([^/]+)#", $url));
    $is_bitshare      = (preg_match("#bitshare.com/([^/]+)#", $url));
    $is_jumbofiles    = (preg_match("#jumbofiles.com/([^/]+)#", $url));
    $is_glumbouploads = (preg_match("#glumbouploads.com/([^/]+)#", $url));
    $is_fshare        = (preg_match("#fshare.vn/([^/]+)#", $url));
    $is_photos        = (preg_match("#photos.google.com/([^/]+)#", $url));
    $is_openload      = (preg_match("#openload.co/(.*?)#s", $url));
    $is_hhtv     = (preg_match("#http://www.hayhaytv.vn/(.*?)#s", $url));
    $is_hdsn     = (preg_match("#http://www.hdsieunhanh.com/(.*?)#s", $url));
    $is_vivu     = (preg_match("#vuviphim.com/([^/]+)#", $url));
    $is_phim14     = (preg_match("#phim14.net/([^/]+)#", $url));
    $is_facebookst   = (preg_match("#facebook.com/plugins/video.php([^/]+)#", $url));        
    $is_facebook   = (preg_match("#facebook.com/([^/]+)#", $url));
    $is_gphoto   = (preg_match("#photos.app.goo.gl/([^/]+)#", $url));
     $is_v16   = (preg_match("#hdhay.net/([^/]+)#", $url));
     $is_lvtv16   = (preg_match("#live.vtv16.com/([^/]+)#", $url));          
     $is_vtv16   = (preg_match("#vtv18.com/([^/]+)#", $url));
     $is_dongphim  = (preg_match("#dongphim.net/([^/]+)#", $url));  
     $is_archive   = (preg_match("#archive.org/([^/]+)#", $url));    
     $is_okru   = (preg_match("#ok.ru/([^/]+)#", $url));  
     $is_tv8k   = (preg_match("#on.tivi8k.net/([^/]+)#", $url));
     $is_vko   = (preg_match("#vkool.net/([^/]+)#", $url)); 
     $is_vkcom   = (preg_match("#vk.com/([^/]+)#", $url)); 
     $is_fembed   = (preg_match("#fembed.com/([^/]+)#", $url));
     $is_very   = (preg_match("#verystream.com/([^/]+)#", $url));     


    if ($ext == 'flv' || $ext == 'mp4') $type = 1;
    elseif ($ext == 'swf' || $is_googleVideo || $is_baamboo) $type = 2;
    elseif ($is_youtube || $is_youtube1 || $is_youtube2 || $is_youtube3) $type = 4;
    elseif ($is_picasa) $type = 5;
    elseif ($is_tamtay || $is_tamtay1 || $idvideo_tamtay || $idvideo_tamtay2) $type = 7;
    elseif ($is_4share1 || $is_4share2 || $is_4share3) $type = 8;
    elseif ($ext == 'divx' || $is_sendspace || $is_olala || $is_megavideo || $is_mediafire || $is_goonline || $is_sevenload || $is_vidxden || $is_novamov || $is_BB || $is_Sshare || $is_Wootly || $is_tusfiles || $is_sharevnn || $is_BBS || $is_ovfile || $is_SSh || $is_em4share || $is_viddler || $is_vivo || $is_SeeOn || $is_vidus || $is_Twitclips || $is_videozer || $is_eyvx || $is_myspace || $is_timnhanh || $is_chacha) $type = 9;
    elseif ($is_2share1 || $is_2share2 || $is_2share3) $type = 10;
    elseif ($is_clipvn || $is_clipvn1 || $is_clipvn2 || $is_clipvn3) $type = 11;
    elseif ($is_banbe) $type = 12;
    elseif ($is_veoh || $is_veoh1) $type = 13;
    elseif ($is_megafun) $type = 14;
    elseif ($is_nhaccuatui) $type = 15;
    elseif ($is_daily)  $type = 16;
    elseif ($is_zippyshare) $type = 17;
    elseif ($is_gdata) $type = 18;
    elseif ($is_cyworld) $type = 19;
    elseif ($is_badongo) $type = 20;
    elseif ($is_ggdocs || $is_ggdrive) $type = 21;
    elseif ($is_tvzing) $type = 22;
    elseif ($is_upfile) $type = 23;
    elseif ($is_plusgoogle) $type = 24;
    elseif ($is_vidbull) $type = 25;
    elseif ($is_telly) $type = 26;
    elseif ($is_movreel) $type = 27;
    elseif ($is_videoweed) $type = 28;
    elseif ($is_hulk) $type = 29;
    elseif ($is_novamov) $type = 30;
    elseif ($is_bitshare) $type = 31;
    elseif ($is_jumbofiles) $type = 32;
    elseif ($is_glumbouploads) $type = 33;
    elseif ($is_blogspot || $is_gcontent) $type = 34;
    elseif ($is_fshare) $type = 37;
    elseif ($is_photos) $type = 38;
    elseif ($is_openload) $type = 38;
    elseif ($is_phimbathu) $type = 39;
    elseif ($is_xuongphim) $type = 40;
    elseif ($is_phimnhanh) $type = 41;
    elseif ($is_animetvn) $type = 44;
    elseif ($is_phimmoi) $type = 45;
    elseif ($is_bilutv) $type = 46;
    elseif ($is_banhtv) $type = 47;
    elseif ($is_xps) $type = 48;
    elseif ($is_hhtv) $type = 49;
    elseif ($is_hdsn) $type = 50;
    elseif ($is_vivu) $type = 51;
    elseif ($is_phim14) $type = 52;
    elseif ($is_facebookst) $type = 60;                 
    elseif ($is_facebook) $type = 53;   
    elseif ($is_gphoto) $type = 54;
    elseif ($is_v16) $type = 55;
    elseif ($is_vtv16) $type = 56;  
    elseif ($is_archive) $type = 57;
    elseif ($is_okru) $type = 58;
    elseif ($is_tv8k) $type = 59;
    elseif ($is_vko) $type = 61;
    elseif ($is_vk) $type = 62;
    elseif ($is_dongphim) $type = 63;
    elseif ($is_fembed) $type = 64;
    elseif ($is_vkcom) $type = 65; 
    elseif ($is_lvtv16) $type = 66;
    elseif ($is_very) $type = 67;        
    elseif (!$type) $type = 35;
    return $type;
}
function listtap($filmid,$filmname,$tenphim){
    $episode = MySql::dbselect('id,name,url,subtitle,userpost,active,present','episode',"filmid = '$filmid' order by id desc LIMIT 5"); 
    if ($episode){
        for($i=0;$i<count($episode);$i++) {
        $epid       =   $episode[$i][0];
        $epname     =   substr(abs((int) filter_var($episode[$i][1], FILTER_SANITIZE_NUMBER_INT)),0,3);
        $fulllink = $filmname.' tap '.$epname;
        $playLink   =   get_url($epid,$fulllink,'Xem Phim');
        $sv = '<li><a id="ep-'.$epid.'" data-id="'.$epid.'"  href="'.$playLink.'" title="Xem phim '.$tenphim.' tập '.$epname.'" >'.$tenphim.' tập '.$epname.'</a></li>';
        echo $sv;
        }
    
    }

}
function list_episode($filmid,$filmname,$epid2) {
    $episode = MySql::dbselect('tb_episode.id,tb_episode.name,tb_episode.filmid,tb_episode.url,tb_episode.subtitle,tb_film.filmlb,tb_episode.present,tb_film.url','episode JOIN tb_film ON (tb_episode.filmid = tb_film.id)',"filmid = '$filmid' AND tb_episode.active=1 ORDER BY id ASC");
    for($i=0;$i<count($episode);$i++) {
        $epid       =   $episode[$i][0];
        $epname     =   $episode[$i][1];
        if($episode[$i][5] != 0) {
            $tenep = ' tap '.substr(abs((int) filter_var($epname, FILTER_SANITIZE_NUMBER_INT)),0,3);
        } else {
            $tenep = '-'.$epname ;
        }
        if (!$episode[$i][7]) {
         $fulllink = $filmname.$tenep;
         $playLink   =   get_url($epid,$fulllink,'Xem Phim');
         }else {
         $fulllink = $episode[$i][7].$tenep;    
         $playLink   =   get_url($epid,$fulllink,'Xem Phim');                           
        }                         

        $episode_type = type_video($episode[$i][3]);
        if ($episode[$i][1]==0) {$lebo="";$epname1=$epname;} else {$lebo=" itemprop=\"episode\" itemscope itemtype=\"http://schema.org/TVEpisode\"";$epname1="".$epname."";}
        if($episode[$i][6]==2){
            $episode_type = 40;
            if($epid2 == $epid){
                $sv[$episode_type] .= '<a id="ep-'.$epid.'" data-id="'.$epid.'"  href="'.$playLink.'" title="Xem phim '.$filmname.' tập '.$epname.'" class="btn btn-rounded btn-deep-orange">'.$epname1.'</a>';
            }else{
                $sv[$episode_type] .= '<a id="ep-'.$epid.'" data-id="'.$epid.'"  href="'.$playLink.'" title="Xem phim '.$filmname.' tập '.$epname.'" class="btn btn-dark btn-rounded">'.$epname1.'</a>';
            }  
        }elseif($episode[$i][6]==3){
            $episode_type = 41;
            if($epid2 == $epid){
                $sv[$episode_type] .= '<a id="ep-'.$epid.'" data-id="'.$epid.'"  href="'.$playLink.'" title="Xem phim '.$filmname.' tập '.$epname.'" class="btn btn-rounded btn-deep-orange">'.$epname1.'</a>';
            }else{
                $sv[$episode_type] .= '<a id="ep-'.$epid.'" data-id="'.$epid.'"  href="'.$playLink.'" title="Xem phim '.$filmname.' tập '.$epname.'" class="btn btn-dark btn-rounded">'.$epname1.'</a>';
            }
        }elseif($episode[$i][6]==1){
            $episode_type = 42;
            if($epid2 == $epid){
                $sv[$episode_type] .= '<a id="ep-'.$epid.'" data-id="'.$epid.'"  href="'.$playLink.'" title="Xem phim '.$filmname.' tập '.$epname.'" class="btn btn-rounded btn-deep-orange">'.$epname1.'</a>';
            }else{
                $sv[$episode_type] .= '<a id="ep-'.$epid.'" data-id="'.$epid.'"  href="'.$playLink.'" title="Xem phim '.$filmname.' tập '.$epname.'" class="btn btn-dark btn-rounded">'.$epname1.'</a>';
            }
        }elseif($episode[$i][6]==4){
            $episode_type = 62;
            if($epid2 == $epid){
                $sv[$episode_type] .= '<a id="ep-'.$epid.'" data-id="'.$epid.'"  href="'.$playLink.'" title="Xem phim '.$filmname.' tập '.$epname.'" class="btn btn-rounded btn-deep-orange">'.$epname1.'</a></li>';
            }else{
                $sv[$episode_type] .= '<a id="ep-'.$epid.'" data-id="'.$epid.'"  href="'.$playLink.'" title="Xem phim '.$filmname.' tập '.$epname.'" class="btn btn-dark btn-rounded">'.$epname1.'</a>';
            } 
        }else{
            if($epid2 == $epid){
                $sv[$episode_type] .= '<a id="ep-'.$epid.'" data-id="'.$epid.'"  href="'.$playLink.'" title="Xem phim '.$filmname.' tập '.$epname.'" class="btn btn-rounded btn-deep-orange">'.$epname1.'</a></li>';
            }else{
                $sv[$episode_type] .= '<a id="ep-'.$epid.'" data-id="'.$epid.'"  href="'.$playLink.'" title="Xem phim '.$filmname.' tập '.$epname.'"" class="btn btn-dark btn-rounded">'.$epname1.'</a>';
            } 
        }
    }

        if($sv[35]) $total_server .= "
<div id=\"server-35\" class=\"server-name\"> <i class=\"sp-movie-icon-camera\"></i> Mời Chọn Tập</div> 
<div class=\"list-episodes\"> 
<div class=\"episodes mCustomScrollbar _mCS_2 mCS_no_scrollbar\">
<div id=\"mCSB_2\" class=\"mCustomScrollBox mCS-light-thin mCSB_vertical mCSB_inside\">
<div id=\"mCSB_2_container\" class=\"mCSB_container mCS_y_hidden mCS_no_scrollbar_y\">
".$sv[35]."
</div></div></div></div>";                             
if($sv[38]) $total_server .= "<div id=\"server-37\" class=\"le-server\"><div class=\"les-title\"><i class=\"fa fa-server mr5\"></i><strong>PV.I.P:</strong></div><div class=\"les-content\">".$sv[38]."</div><div class=\"clearfix\"></div></div>";
    if($sv[5]) $total_server .= "
<div id=\"server-5\" class=\"server-name\"> <i class=\"sp-movie-icon-camera\"></i> SV.I.P</div>
<div class=\"list-episodes\"> 
<div class=\"episodes mCustomScrollbar _mCS_2 mCS_no_scrollbar\">
<div id=\"mCSB_2\" class=\"mCustomScrollBox mCS-light-thin mCSB_vertical mCSB_inside\">
<div id=\"mCSB_2_container\" class=\"mCSB_container mCS_y_hidden mCS_no_scrollbar_y\">
".$sv[5]."
</div></div></div></div>";
    if($sv[21]) $total_server .= "
<div id=\"server-5\" class=\"server-name\"> <i class=\"sp-movie-icon-camera\"></i> SEVER VIP</div>
<div class=\"list-episodes\"> 
<div class=\"episodes mCustomScrollbar _mCS_2 mCS_no_scrollbar\">
<div id=\"mCSB_2\" class=\"mCustomScrollBox mCS-light-thin mCSB_vertical mCSB_inside\">
<div id=\"mCSB_2_container\" class=\"mCSB_container mCS_y_hidden mCS_no_scrollbar_y\">
".$sv[21]."
</div></div></div></div>";
    if($sv[27]) $total_server .= "
<div id=\"server-27\" class=\"server-name\"> <i class=\"sp-movie-icon-camera\"></i> HDVIP</div>
<div class=\"list-episodes\"> 
<div class=\"episodes mCustomScrollbar _mCS_2 mCS_no_scrollbar\">
<div id=\"mCSB_2\" class=\"mCustomScrollBox mCS-light-thin mCSB_vertical mCSB_inside\">
<div id=\"mCSB_2_container\" class=\"mCSB_container mCS_y_hidden mCS_no_scrollbar_y\">
".$sv[27]."
</div></div></div></div>";
    if($sv[34]) $total_server .= "
<div id=\"server-34\" class=\"server-name\"> <i class=\"sp-movie-icon-camera\"></i> SV.I.P 2</div>
<div class=\"list-episodes\"> 
<div class=\"episodes mCustomScrollbar _mCS_2 mCS_no_scrollbar\">
<div id=\"mCSB_2\" class=\"mCustomScrollBox mCS-light-thin mCSB_vertical mCSB_inside\">
<div id=\"mCSB_2_container\" class=\"mCSB_container mCS_y_hidden mCS_no_scrollbar_y\">
".$sv[34]."
</div></div></div></div>";
    if($sv[38]) $total_server .= "
<div id=\"server-38\" class=\"server-name\"> <i class=\"sp-movie-icon-camera\"></i> PV.I.P</div>
<div class=\"list-episodes\"> 
<div class=\"episodes mCustomScrollbar _mCS_2 mCS_no_scrollbar\">
<div id=\"mCSB_2\" class=\"mCustomScrollBox mCS-light-thin mCSB_vertical mCSB_inside\">
<div id=\"mCSB_2_container\" class=\"mCSB_container mCS_y_hidden mCS_no_scrollbar_y\">
".$sv[38]."
</div></div></div></div>";
    if($sv[39]) $total_server .= "
<div id=\"server-39\" class=\"server-name\"> <i class=\"sp-movie-icon-camera\"></i> VIP XLC</div>
<div class=\"list-episodes\"> 
<div class=\"episodes mCustomScrollbar _mCS_2 mCS_no_scrollbar\">
<div id=\"mCSB_2\" class=\"mCustomScrollBox mCS-light-thin mCSB_vertical mCSB_inside\">
<div id=\"mCSB_2_container\" class=\"mCSB_container mCS_y_hidden mCS_no_scrollbar_y\">
".$sv[39]."
</div></div></div></div>";
    if($sv[40]) $total_server .= "
<div id=\"server-40\" class=\"server-name\"> <i class=\"sp-movie-icon-camera\"></i> VIP VIETSUB</div>
<div class=\"list-episodes\"> 
<div class=\"episodes mCustomScrollbar _mCS_2 mCS_no_scrollbar\">
<div id=\"mCSB_2\" class=\"mCustomScrollBox mCS-light-thin mCSB_vertical mCSB_inside\">
<div id=\"mCSB_2_container\" class=\"mCSB_container mCS_y_hidden mCS_no_scrollbar_y\">
".$sv[40]."
</div></div></div></div>";
    if($sv[46]) $total_server .= "
<div id=\"server-46\" class=\"server-name\"> <i class=\"sp-movie-icon-camera\"></i> VIP XLC</div>
<div class=\"list-episodes\"> 
<div class=\"episodes mCustomScrollbar _mCS_2 mCS_no_scrollbar\">
<div id=\"mCSB_2\" class=\"mCustomScrollBox mCS-light-thin mCSB_vertical mCSB_inside\">
<div id=\"mCSB_2_container\" class=\"mCSB_container mCS_y_hidden mCS_no_scrollbar_y\">
".$sv[46]."
</div></div></div></div>";
    if($sv[41]) $total_server .= "
<div id=\"server-41\" class=\"server-name\"> <i class=\"sp-movie-icon-camera\"></i> SEVER NHANH</div>
<div class=\"list-episodes\"> 
<div class=\"episodes mCustomScrollbar _mCS_2 mCS_no_scrollbar\">
<div id=\"mCSB_2\" class=\"mCustomScrollBox mCS-light-thin mCSB_vertical mCSB_inside\">
<div id=\"mCSB_2_container\" class=\"mCSB_container mCS_y_hidden mCS_no_scrollbar_y\">
".$sv[41]."
</div></div></div></div>";
    if($sv[44]) $total_server .= "
<div id=\"server-44\" class=\"server-name\"> <i class=\"sp-movie-icon-camera\"></i> VIP ANIME</div>
<div class=\"list-episodes\"> 
<div class=\"episodes mCustomScrollbar _mCS_2 mCS_no_scrollbar\">
<div id=\"mCSB_2\" class=\"mCustomScrollBox mCS-light-thin mCSB_vertical mCSB_inside\">
<div id=\"mCSB_2_container\" class=\"mCSB_container mCS_y_hidden mCS_no_scrollbar_y\">
".$sv[44]."
</div></div></div></div>";
    if($sv[45]) $total_server .= "
<div id=\"server-45\" class=\"server-name\"> <i class=\"sp-movie-icon-camera\"></i> VIP PM</div>
<div class=\"list-episodes\"> 
<div class=\"episodes mCustomScrollbar _mCS_2 mCS_no_scrollbar\">
<div id=\"mCSB_2\" class=\"mCustomScrollBox mCS-light-thin mCSB_vertical mCSB_inside\">
<div id=\"mCSB_2_container\" class=\"mCSB_container mCS_y_hidden mCS_no_scrollbar_y\">
".$sv[45]."
</div></div></div></div>";
    if($sv[47]) $total_server .= "
<div id=\"server-47\" class=\"server-name\"> <i class=\"sp-movie-icon-camera\"></i> VIP XLC</div>
<div class=\"list-episodes\"> 
<div class=\"episodes mCustomScrollbar _mCS_2 mCS_no_scrollbar\">
<div id=\"mCSB_2\" class=\"mCustomScrollBox mCS-light-thin mCSB_vertical mCSB_inside\">
<div id=\"mCSB_2_container\" class=\"mCSB_container mCS_y_hidden mCS_no_scrollbar_y\">
".$sv[47]."
</div></div></div></div>";
    if($sv[48]) $total_server .= "
<div id=\"server-48\" class=\"server-name\"> <i class=\"sp-movie-icon-camera\"></i> VIP XLC</div>
<div class=\"list-episodes\"> 
<div class=\"episodes mCustomScrollbar _mCS_2 mCS_no_scrollbar\">
<div id=\"mCSB_2\" class=\"mCustomScrollBox mCS-light-thin mCSB_vertical mCSB_inside\">
<div id=\"mCSB_2_container\" class=\"mCSB_container mCS_y_hidden mCS_no_scrollbar_y\">
".$sv[48]."
</div></div></div></div>"; 
    if($sv[49]) $total_server .= "
<div id=\"server-49\" class=\"server-name\"> <i class=\"sp-movie-icon-camera\"></i> VIP XLC</div>
<div class=\"list-episodes\"> 
<div class=\"episodes mCustomScrollbar _mCS_2 mCS_no_scrollbar\">
<div id=\"mCSB_2\" class=\"mCustomScrollBox mCS-light-thin mCSB_vertical mCSB_inside\">
<div id=\"mCSB_2_container\" class=\"mCSB_container mCS_y_hidden mCS_no_scrollbar_y\">
".$sv[49]."
</div></div></div></div>";
    if($sv[50]) $total_server .= "
<div id=\"server-50\" class=\"server-name\"> <i class=\"sp-movie-icon-camera\"></i> VIP XLC</div>
<div class=\"list-episodes\"> 
<div class=\"episodes mCustomScrollbar _mCS_2 mCS_no_scrollbar\">
<div id=\"mCSB_2\" class=\"mCustomScrollBox mCS-light-thin mCSB_vertical mCSB_inside\">
<div id=\"mCSB_2_container\" class=\"mCSB_container mCS_y_hidden mCS_no_scrollbar_y\">
".$sv[50]."
</div></div></div></div>";
    if($sv[51]) $total_server .= "
<div id=\"server-51\" class=\"server-name\"> <i class=\"sp-movie-icon-camera\"></i> VIP XLC</div>
<div class=\"list-episodes\"> 
<div class=\"episodes mCustomScrollbar _mCS_2 mCS_no_scrollbar\">
<div id=\"mCSB_2\" class=\"mCustomScrollBox mCS-light-thin mCSB_vertical mCSB_inside\">
<div id=\"mCSB_2_container\" class=\"mCSB_container mCS_y_hidden mCS_no_scrollbar_y\">
".$sv[51]."
</div></div></div></div>";
    if($sv[52]) $total_server .= "
<div id=\"server-52\" class=\"server-name\"> <i class=\"sp-movie-icon-camera\"></i> VIP XLC</div>
<div class=\"list-episodes\"> 
<div class=\"episodes mCustomScrollbar _mCS_2 mCS_no_scrollbar\">
<div id=\"mCSB_2\" class=\"mCustomScrollBox mCS-light-thin mCSB_vertical mCSB_inside\">
<div id=\"mCSB_2_container\" class=\"mCSB_container mCS_y_hidden mCS_no_scrollbar_y\">
".$sv[52]."
</div></div></div></div>";

if($sv[42]) $total_server .= "<div id=\"server-42\" class=\"server-name\"> <i class=\"sp-movie-icon-camera\"></i> Thuyết Minh: </div>".$sv[42]."";      
    if($sv[53]) $total_server .= '<div class="col-xs-12 col-sm-12 col-md-12 movie-player-control no-padding2 text-center">'.$sv[53].'</div> ';  
    if($sv[54]) $total_server .= '<div class="col-xs-12 col-sm-12 col-md-12 movie-player-control no-padding2 text-center">'.$sv[54].'</div> ';   
    if($sv[55]) $total_server .= '<div class="col-xs-12 col-sm-12 col-md-12 movie-player-control no-padding2 text-center">'.$sv[55].'</div> ';    
    if($sv[56]) $total_server .= '<div class="col-xs-12 col-sm-12 col-md-12 movie-player-control no-padding2 text-center">'.$sv[56].'</div> '; 
    if($sv[57]) $total_server .= '<div class="col-xs-12 col-sm-12 col-md-12 movie-player-control no-padding2 text-center">'.$sv[57].'</div> '; 
    if($sv[58]) $total_server .= '<div class="col-xs-12 col-sm-12 col-md-12 movie-player-control no-padding2 text-center">'.$sv[58].'</div> ';  
    if($sv[60]) $total_server .= '<div class="col-xs-12 col-sm-12 col-md-12 movie-player-control no-padding2 text-center">'.$sv[60].'</div> ';    
    if($sv[61]) $total_server .= '<div class="col-xs-12 col-sm-12 col-md-12 movie-player-control no-padding2 text-center">'.$sv[61].'</div> '; 
    if($sv[40]) $total_server .= '<div class="col-xs-12 col-sm-12 col-md-12 movie-player-control no-padding2 text-center">'.$sv[40].'</div> ';   
    if($sv[62]) $total_server .= '<div class="col-xs-12 col-sm-12 col-md-12 movie-player-control no-padding2 text-center">'.$sv[62].'</div> ';                                                           
    return $total_server;
}


function id_episode($filmid) {
    $episode = MySql::dbselect('tb_episode.id','episode JOIN tb_film ON (tb_episode.filmid = tb_film.id)',"filmid = '$filmid' ORDER BY id ASC LIMIT 5");
    for($i=0;$i<count($episode);$i++) {
        $epid       =   $episode[$i][0];
        
return $epid;
}
        }

function list_episode_slider($filmid,$filmname,$id) {
    $episode = MySql::dbselect('id,name,filmid,url,subtitle,thumb','episode',"filmid = '$filmid' ORDER BY id ASC LIMIT 1");
    if(count($episode) > 1) {
        $total_server .= '<div class="watch-list"><div class="stream-line"><div class="scroll_list"><ul class="stream-items">';
        for($i=0;$i<count($episode);$i++) {
            $epid       =   $episode[$i][0];
            $epname     =   $episode[$i][1];
            $thumb      =   TEMPLATE_URL.'images/bgepisode.jpg';
            $playLink   =   get_url($epid,$filmname,'Xem Phim');
            $episode_type = type_video($episode[$i][3]);
            if($id == $epid) $class[$i] = ' class="current"';
            $sv[$episode_type] .= "
            <li".$class[$i]." id=\"ep_$epid\">
                <a id=\"$epid\" href=\"$playLink\" title=\"Xem phim $filmname tập $epname\">
                    <span class=\"video\"></span><span class=\"name\">Tập $epname</span>
                    <img rel=\"nofollow\" title=\"Tập $epname\" id=\"img_$epname\" src=\"$thumb\"/>
                </a>
            </li>";
        }
        $epurl = one_data('url','episode',"id = '$id'");
        $eptype = type_video($epurl);
        if($sv[$eptype]) $total_server .= $sv[$eptype];
        $total_server .= '</ul></div><div class="wrap_prev_block"><a href="javascript:void(0)" class="stream-prev prev_block"></a></div><div class="wrap_next_block"><a href="javascript:void(0)" class="stream-next next_block"></a></div></div></div>';
    }
    return $total_server;
}
function get_video($sql,$limit,$type='') {
    $arr = MySql::dbselect('id,name,url,duration,thumb,viewed','media',"$sql order by id desc limit $limit");
    if($type == 'rand') {
        for($i=0;$i<count($arr);$i++) {
            $name = $arr[$i][1];
            $thumb = $arr[$i][4];
            $mediaid = $arr[$i][0];
            $duration = $arr[$i][3];
            $viewed = $arr[$i][5];
            $url = get_url($mediaid,$name,'Xem Video');
            $html .= '<div class="ml-item">
            <a href="'.$url.'"             
               class="ml-mask jt"
               title="'.$name.'">
                
                <img data-original="'.$thumb.'" class="lazy thumb mli-thumb"
                     alt="'.$name.'">
                <span class="mli-info"><h2>'.$name.'</h2></span>
            </a>
        </div>
        ';
         
        }
    }else {
        for($i=0;$i<count($arr);$i++) {
            $name = $arr[$i][1];
            $thumb = $arr[$i][4];
            $mediaid = $arr[$i][0];
            $duration = $arr[$i][3];
            $viewed = $arr[$i][5];
            $url = get_url($mediaid,$name,'Xem Video');
            $html .= "
            <li style=\"float:left;height:400px\">
            <div class=\"hvideo clearfix\">
                <div class=\"video\">
                    <img src=\"$thumb\" title=\"$name\" alt=\"$name\"/><a href=\"$url\"><span class=\"vdicon\"></span></a>
                </div>
                <div class=\"info\">
                    <h1>$name</h1>
                    <span class=\"content\"><strong>Thời lượng</strong>: $duration</span>
                    <span class=\"content\"><strong>Lượt xem</strong>: $viewed</span>
                </div>
            </div>
            </li>
            ";
        }
    }
    return $html;
}
function server_nxt($url){
    $sr_type = str_replace('lh3.googleusercontent.com','3.blogspot.com', $sr_type);
    $sr_type=type_video($url);
    if($sr_type==1){
        $type=0;
    }else if($sr_type==2){
        $type='video.google.com';
    }else if($sr_type==4){
        $type='youtube.com';
    }else if($sr_type==5){
        $type='picasaweb.google.com';
    }else if($sr_type==6){
        $type='movshare.net';
    }else if($sr_type==7){
        $type='tamtay.vn';
    }else if($sr_type==8){
        $type='4shared.com';
    }else if($sr_type==9){
        $type='';
    }else if($sr_type==10){
        $type='2shared.com';
    }else if($sr_type==11){
        $type='clip.vn';
    }else if($sr_type==12){
        $type='banbe.net';
    }else if($sr_type==13){
        $type='veoh.com';
    }else if($sr_type==14){
        $type='megafun.vn';
    }else if($sr_type==15){
        $type='nhaccuatui.com';
    }else if($sr_type==16){
        $type='dailymotion.com';
    }else if($sr_type==17){
        $type='zippyshare.com';
    }else if($sr_type==18){
        $type='gdata.youtube.com';
    }else if($sr_type==19){
        $type='cyworld.vn';
    }else if($sr_type==20){
        $type='badongo.com';
    }else if($sr_type==21){
        $type='docs.google.com';
    }else if($sr_type==21){
        $type='drive.google.com';
    }else if($sr_type==22){
        $type='zing.vn';
    }else if($sr_type==23){
        $type='upfile.vn';
    }else if($sr_type==24){
        $type='plus.google.com';
    }else if($sr_type==25){
        $type='fptplay.net';
    }else if($sr_type==26){
        $type='vivo.vn';
    }else if($sr_type==27){
        $type='hdonline.vn';
    }else if($sr_type==28){
        $type='phim.megabox.vn';
    }else if($sr_type==29){
        $type='hu.lk';
    }else if($sr_type==30){
        $type='novamov.com';
    }else if($sr_type==31){
        $type='bitshare.com';
    }else if($sr_type==32){
        $type='jumbofiles.com';
    }else if($sr_type==33){
        $type='glumbouploads.com';
    }else if($sr_type==34){
        $type='blogspot.com';
    }else if($sr_type==39){
        $type='phimbathu.com';
    }else if($sr_type==40){
        $type='xuongphim.tv';
    }else if($sr_type==41){
        $type='phimnhanh.com';
    }else if($sr_type==44){
        $type='animetvn.com';
    }else if($sr_type==45){
        $type='phimmoi.net';
    }else{
        $type=0;
    }
    return $type;
    
}
function youtubecc($string) {
$string = str_replace("https://www.youtube.com/watch?v=","https://www.youtube.com/embed/",$string);
$string = str_replace("http://www.youtube.com/watch?v=","http://www.youtube.com/embed/",$string);
return $string;
}
function player($epid,$type='') {
    if($type != 'video') {
                $episode = MySql::dbselect('id,name,filmid,url,subtitle,thumb,datetime_post,default_subtitle_id','episode',"id = '$epid'");
        $url1 = $episode[0][3];
        $subtitles_db = MySql::dbselect('subtitle_lang,subtitle_url,id','subtitle',"episode_id = $epid");
        $subtitle1 = $subtitles_db[0][1]; 
        $subtitle = str_replace("https://phimvip/","", $subtitle1);
        $nextid = one_data('id','episode',"id > '$epid' AND filmid = '$filmid' AND url LIKE '%".$link_nxt_type."%'");
    } else {
        $url1 = $epid;
    }
        $filmid = $episode[0][2];
        $tapid = $episode[0][0];
        $film = MySql::dbselect("tb_film.title,tb_film.title_en,tb_film.category,tb_film.release_time,tb_film.timeupdate,tb_film.thumb,tb_film.country,tb_film.director,tb_film.actor,tb_film.year,tb_film.duration,tb_film.viewed,tb_film_other.content,tb_film_other.keywords,tb_film.total_votes,tb_film.total_value,tb_film.trailer,tb_film.big_image,tb_film.quality,tb_film.filmlb,tb_film.link_down,tb_film.userpost,tb_film.active,tb_film.title_search",'film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"id = '$filmid'");
        $big_thumb = $film[0][17];
        $phim = $film[0][0];
        if ($big_thumb) {
            $thumb = $big_thumb ;
        } else $thumb = '/view.png';
    $jwplayer = '<script type="text/javascript" src="'.SITE_URL.'/player/jwplayer.js"></script>
         <script type="text/javascript">jwplayer.key="WgfBD4YI7jhxwMUXHvOeMOqsqYYsEjW04rZalw==";</script>';
    
    $type_video = type_video($url1);
        if(in_array($type_video, array('16'))) {
        $player .= '<iframe frameborder="0" width="100%" height="100%"" src="'.$url1.'" allowfullscreen></iframe>';
    }
    elseif(in_array($type_video, array('25'))) {
        $player .= '<iframe frameborder="0" width="100%" height="100%"" src="/player.php?url='.fptlink($url1).'" allowfullscreen></iframe>';
    }
   elseif(in_array($type_video, array('66'))) {
        $player .=  '<div id="mediaplayer" style="width: 100%;height: 650px !important;"></div><script>
$(document).ready(function () {     
jQuery("#mediaplayer").html("<iframe frameborder=\"0\" width=\"100%\" height=\"100%\" src=\"'.$url1.'\" scrolling=\"no\" frameborder=\"0\" allowTransparency=\"true\" allowFullScreen=\"true\"></iframe>");
})
</script>';
    }     
    elseif(in_array($type_video, array('60'))) {
        $player .=  '<div id="media-player"></div><script>
$(document).ready(function () {     
jQuery("#media-player").html("<iframe frameborder=\"0\" width=\"100%\" height=\"400px\" src=\"'.$url1.'\" scrolling=\"no\" frameborder=\"0\" allowTransparency=\"true\" allowFullScreen=\"true\"></iframe>");
})
</script>';
    }   
    elseif(in_array($type_video, array('64'))) {
                $player .=  '<div id="mediaplayer" style="width: 100%;height: 650px !important;"></div><script>
$(document).ready(function () {     
jQuery("#media-player").html("<iframe frameborder=\"0\" width=\"100%\" height=\"100%\" src=\"'.$url1.'\" scrolling=\"no\" frameborder=\"0\" allowTransparency=\"true\" allowFullScreen=\"true\"></iframe>");
})
</script>';
    }        
    elseif(in_array($type_video, array('26'))) {
        $player .= '<iframe frameborder="0" width="100%" height="100%" src="/player.php?url='.$url1.'" allowfullscreen></iframe>';
    }
    elseif(in_array($type_video, array('59'))) {
        $player .= '<iframe frameborder="0" width="100%" height="100%"" src="'.$url1.'" allowfullscreen></iframe>';
    }
    elseif(in_array($type_video, array('28'))) {
        $player .= '<iframe frameborder="0" width="100%" height="100%"" src="/player.php?url='.$url1.'" allowfullscreen></iframe>';
    }
    elseif(in_array($type_video, array('27'))) {
        echo binplayer(hdo($url1),$subtitle);
    }
    elseif(in_array($type_video, array('39'))) {
         echo bingetlink(phimbathu($url1),$thumb,$filmid,$tapid);
    }
    elseif(in_array($type_video, array('53'))) {
        $player .= '<iframe frameborder="0" width="100%" height="100%" src="https://apps-362535134513265.apps.fbsbx.com/instant-bundle/2237964366278359/2902510703108143/index.html?url='.facebook($url1).'" allowfullscreen></iframe>';
    } 
    elseif(in_array($type_video, array('54'))) {
        echo binplayer(gphoto($url1),$subtitle,$filmid,$tapid);
    }
    elseif(in_array($type_video, array('61'))) {
        echo binplayer(vko($url1),$subtitle,$filmid,$tapid);
    }
        elseif(in_array($type_video, array('62'))) {
        echo binplayer(vk($url1),$subtitle,$filmid,$tapid);
    }
   elseif(in_array($type_video, array('65'))) {
        $player .=  '<div id="mediaplayer" style="width: 100%;height: 650px !important;"></div><script>
$(document).ready(function () {     
jQuery("#mediaplayer").html("<iframe frameborder=\"0\" width=\"100%\" height=\"100%\" src=\"https://bongngo.net/api.php?url='.encrypt_decrypt('encrypt', $url1).'\" scrolling=\"no\" frameborder=\"0\" allowTransparency=\"true\" allowFullScreen=\"true\"></iframe>");
})
</script>';
    }       
    elseif(in_array($type_video, array('55'))) {
        echo binplayer(hdhay($url1),$subtitle,$filmid,$tapid);
    }
    elseif(in_array($type_video, array('56'))) {
        echo binplayer(v16($url1),$subtitle,$filmid,$tapid);
    }   
    elseif(in_array($type_video, array('21'))) {
        if (!$subtitle) {
            $player .= '<div id="player" style="width: 100%"></div><script>
$(document).ready(function () {     
jQuery("#player").html("<iframe frameborder=\"0\" width=\"100%\" height=\"100%\" src=\"https://player.phimmoi.club/public/index.html?key='.drive($url1).'\" scrolling=\"no\" frameborder=\"0\" allowTransparency=\"true\" allowFullScreen=\"true\"></iframe>");
})
</script>';
} else {
            $player .= '<script type="text/javascript" src="'.SITE_URL.'/player/v/8.8.2/jwplayer.js?v=9"></script>
        <script type="text/javascript">jwplayer.key="ITWMv7t88JGzI0xPwW8I0+LveiXX9SWbfdmt0ArUSyc=";</script>
    <div id="mediaplayer" style="width: 100%;height: 100% !important;"></div>
    <script type="text/javascript">
    var reloadTimes = 0;
    var playerInstance = jwplayer("mediaplayer");
    function load_biplayer() {
        playerInstance.setup({
                    sources: [{file:"https://p2pdriver.phimmoi.club/hls/'.p2pdrive($url1).'/'.p2pdrive($url1).'.playlist.m3u8","type":"hls","default": "true"}],
                    width: "100%",
                    height: "100%",
                    skin: {
	                name: "tube",
	                active: "#0f948d",
	                inactive: "#0f948d",
		            },
		            androidhls: true,
                    aspectratio: "16:9",                
                            autostart: true,
                            tracks: [{file: "'.$subtitle1.'",
                                label: "Vietsub",
                                kind: "captions",
                                default: true }],
                                 captions: {
                                 color: "#FFFFFF",
                                 backgroundOpacity: 70
                                  }

        });
            playerInstance.addButton(
              "'.SITE_URL.'/player/forward.svg",
              "Tua tiến 10s",
              function() {
                playerInstance.seek(playerInstance.getPosition()+10);
              },
              "Tua tiến 10s"
            );
            playerInstance.addButton(
              "'.SITE_URL.'/player/backward.svg",
              "Tua lại 10s",
              function() {
                playerInstance.seek(playerInstance.getPosition()-10);
              },
              "Tua lại 10s"
            );
        playerInstance.on("error", function (message) {
            if ((reloadTimes < 5)) {
                reloadTimes = reloadTimes + 1;
                setTimeout(function () {
                    playerInstance.remove();
                    load_biplayer();
                }, 1500);
            } else {
                var element=document.getElementById(\'mediaplayer\');
                element.innerHTML=\'<img src="https://i.imgur.com/J9OoJl1.jpg" style="width:100%;height:100%;" />\'
            }
        });

        playerInstance.on("setupError", function (message) {
            if ((reloadTimes < 5)) {
                reloadTimes = reloadTimes + 1;
                setTimeout(function () {
                    playerInstance.remove();
                    load_biplayer();
                }, 1500);
            } else {
                var element=document.getElementById(\'mediaplayer\');
                element.innerHTML=\'<img src="https://i.imgur.com/J9OoJl1.jpg" style="width:100%;height:100%;" />\'
            }
        });
        playerInstance.on("complete", function(e) {
                                                if(pautonext == true){
                                                    var $elm = $(\'.list-episode li a.active\');
                                                    if($elm.length){
                                                        var nextEpisode = $elm.closest(\'li\').next().find(\'a\').attr(\'href\');
                                                        if(typeof(nextEpisode) != \'undefined\'){
                                                            location.href = nextEpisode;
                                                        }
                                                    }
                                                }
                                            });

    }

    load_biplayer();
        </script>';
}

    }
    elseif(in_array($type_video, array('67'))) {
        $player .= '<div id="player" style="width: 100%"></div><script>
$(document).ready(function () {     
jQuery("#player").html("<iframe frameborder=\"0\" width=\"100%\" height=\"100%\" src=\"'.$url1.'\" scrolling=\"no\" frameborder=\"0\" allowTransparency=\"true\" allowFullScreen=\"true\"></iframe>");
})
</script>';
    }    
    elseif(in_array($type_video, array('41'))) {
        echo binplayer(nhanh($url1),$subtitle);
    }
    elseif(in_array($type_video, array('44'))) {
        echo binplayer(animetvn($url1),$subtitle);
    }
    elseif(in_array($type_video, array('46'))) {
        echo bingetlink(bilutv($url1),$thumb,$filmid,$tapid);
    }
    elseif(in_array($type_video, array('4'))) {
    $player .= '<script type="text/javascript" src="'.SITE_URL.'/player/jwplayeryt.js"></script>
    <div id="mediaplayer" style="width: 100%;height: 100% !important;"></div>
    <script type="text/javascript">
    var playerInstance = jwplayer("mediaplayer");
    playerInstance.setup({file: "'.$url1.'",type:"mp4",
                    image: "/view.png",  
                    width: "100%",
                    height: "100%",
                    aspectratio: "16:9",
                    primary: "html5",
                    autostart: true});
    playerInstance.on("play",function(){document.getElementsByClassName("jw-menu")[0].childNodes[1].innerHTML = "Auto";document.getElementsByClassName("jw-menu")[0].childNodes[3].innerHTML = "144p";document.getElementsByClassName("jw-menu")[0].childNodes[5].innerHTML = "240p";document.getElementsByClassName("jw-menu")[0].childNodes[7].innerHTML = "360p";document.getElementsByClassName("jw-menu")[0].childNodes[9].innerHTML = "480p";document.getElementsByClassName("jw-menu")[0].childNodes[11].innerHTML = "720p";document.getElementsByClassName("jw-menu")[0].childNodes[13].innerHTML = "1080p";document.getElementsByClassName("jw-menu")[0].childNodes[15].innerHTML = "1440p 2K";document.getElementsByClassName("jw-menu")[0].childNodes[17].innerHTML = "2160p 4K";});
    playerInstance.setVolume(100);
        </script>';
    } elseif(in_array($type_video, array('34'))) {
        $url2 = str_replace('=m18','=m59', $url1);
        $url3 = str_replace('=m18','=m22', $url1);
$player .= '<script type="text/javascript" src="'.SITE_URL.'/player/playerphimaz.js"></script>
        <script type="text/javascript">jwplayer.key="MBvrieqNdmVL4jV0x6LPJ0wKB/Nbz2Qq/lqm3g==";</script>
    <div id="mediaplayer" style="width: 100%;height: 100% !important;"></div>
    <script type="text/javascript">
    var reloadTimes = 0;
    var playerInstance = jwplayer("mediaplayer");
    function load_biplayer() {
        playerInstance.setup({
                    sources: [{file:"'.$url1.'",label:"360p","type":"mp4","default": "true"},{file:"'.$url3.'",label:"720p","type":"mp4"}],
                    image: "/view.png",  
                    width: "100%",
                    height: "100%",
                    aspectratio: "16:9",                
                            autostart: false,
                            '.$subtitle.'

        });
      playerInstance.on("time", function(e) {
        $cookie.setItem("resumevideodata", Math.floor(e.position) + ":" + playerInstance.getDuration(), 82000, window.location.pathname)
    });
            playerInstance.on("firstFrame", function() {    
                var cookieData = $cookie.getItem("resumevideodata");
                if (cookieData) {
                    var resumeAt = cookieData.split(":")[0],
                        videoDur = cookieData.split(":")[1];
                    if (parseInt(resumeAt) < parseInt(videoDur)) {
                        (resumeAt == 0) ? resumeAt = 1: "";
                        playerInstance.seek(resumeAt);
                        fx.displayMessage("Hệ thống nhận thấy bạn đang xem dở bộ phim này. Mời bạn tiếp tục xem!")
                    } else if (cookieData && !(parseInt(resumeAt) < parseInt(videoDur))) {
                        logMessage("Video ended last time! Will skip resume behavior")
                    }
                } else {
                }
            });
            playerInstance.addButton(
              "'.SITE_URL.'/player/forward3.svg",
              "Tua tiến 10s",
              function() {
                playerInstance.seek(playerInstance.getPosition()+10);
              },
              "Tua tiến 10s"
            );
            playerInstance.addButton(
              "'.SITE_URL.'/player/backward2.svg",
              "Tua lại 10s",
              function() {
                playerInstance.seek(playerInstance.getPosition()-10);
              },
              "Tua lại 10s"
            );
        playerInstance.on("error", function (message) {
            if ((reloadTimes < 5)) {
                reloadTimes = reloadTimes + 1;
                setTimeout(function () {
                    playerInstance.remove();
                    load_biplayer();
                }, 1500);
            } else {
                var element=document.getElementById(\'mediaplayer\');
                element.innerHTML=\'<img src="https://i.imgur.com/J9OoJl1.jpg" style="width:100%;height:100%;" />\'
            }
        });

        playerInstance.on("setupError", function (message) {
            if ((reloadTimes < 5)) {
                reloadTimes = reloadTimes + 1;
                setTimeout(function () {
                    playerInstance.remove();
                    load_biplayer();
                }, 1500);
            } else {
                var element=document.getElementById(\'mediaplayer\');
                element.innerHTML=\'<img src="https://i.imgur.com/J9OoJl1.jpg" style="width:100%;height:100%;" />\'
            }
        });
        playerInstance.on("complete", function(e) {
                                                if(pautonext == true){
                                                    var $elm = $(\'.list-episode li a.active\');
                                                    if($elm.length){
                                                        var nextEpisode = $elm.closest(\'li\').next().find(\'a\').attr(\'href\');
                                                        if(typeof(nextEpisode) != \'undefined\'){
                                                            location.href = nextEpisode;
                                                        }
                                                    }
                                                }
                                            });

        playerInstance.addButton(
        "'.SITE_URL.'/assets/images/icon-download.png",
        "Nhấn vào đây để tải video",
        function() {window.open(playerInstance.getPlaylistItem()["file"] + "&title=phimaz.net", "_blank").blur();   }, "download"   );
    }

    load_biplayer();
        </script>';
    }
    elseif(strpos($url1 , 'iframe') !== false){
        echo UnHtmlChars($url1);
    }
    else if (strpos($url1,'openload.co') !== false){
        $data = explode('/', $url1);
        $link = explode('/', $data[4]);
        $openload = $link[0];
        $player .= '<iframe allowfullscreen="true" width="100%" height="100%" frameborder="0" src="https://openload.co/embed/'.$openload.'/" scrolling="no"></iframe>'; 
    }
    elseif(strpos($url1 , 'animef.net') !== false){
        $player .= '<iframe frameborder="0" width="100%" height="100%"" src="'.$url1.'" allowfullscreen></iframe>'; 
    }
    elseif(in_array($type_video, array('58'))){
        $player .= '<iframe frameborder="0" src="'.$url1.'" style="position: absolute;top: 0;bottom: 0;left: 0;width: 100%;height: 100%;border: 0;"allowfullscreen></iframe>'; 
    }   
    else {
        $info = parse_url($url1);
$info['host'] = str_replace('www.', '', $info['host']);
if($info['host'] == 'youporn.com'){
    $link = youporn($url1, 'large.file');
}
elseif($info['host'] == 'pornhub.com'){
    $link = pornhub($url1, 'large.file');
}
elseif($info['host'] == 'porn.com'){
    $link = porn($url1, 'large.file');
}
elseif($info['host'] == 'xvideos.com'){
    $link = getxvideos($url1);
}
elseif($info['host'] == 'redtube.com'){
    $link = redtube(get($url1));
}
elseif($info['host'] == 'spankwire.com'){
    $link = spankwire(get($url1));
}
elseif($info['host'] == 'phim.clip.vn'){
    $link = clipvn($url1);
}
elseif($info['host'] == 'beeg.com'){
    $link = beeg($url1);
}
elseif($info['host'] == 'pornhan.com'){
    $link = pornhan($url1);
}

else{
    
    $link = $url1;
}
if($subtitle) $subtitle = 'tracks: [{file: "'.$subtitle.'",
                            label: "Vie",
                            kind: "captions",
                            "default": true }],
                            captions: {
                                    color: "#FFFFFF",
                                    backgroundOpacity: 70
        }';
$player .= '<script type="text/javascript" src="'.SITE_URL.'/player/playerphimaz.js"></script>
        <script type="text/javascript">jwplayer.key="MBvrieqNdmVL4jV0x6LPJ0wKB/Nbz2Qq/lqm3g==";</script>
    <div id="mediaplayer" style="width: 100%;height: 100% !important;"></div>
    <script type="text/javascript">
    var reloadTimes = 0;
    var playerInstance = jwplayer("mediaplayer");
    function load_biplayer() {
        playerInstance.setup({
                    sources: [{label: "720p", file: "' . $link . '", type:"mp4"}],
                    image: "/view.png",  
                    width: "100%",
                    height: "100%",
                    aspectratio: "16:9",                
                            autostart: false,
                            '.$subtitle.'

        });
      playerInstance.on("time", function(e) {
        $cookie.setItem("resumevideodata", Math.floor(e.position) + ":" + playerInstance.getDuration(), 82000, window.location.pathname)
    });
            playerInstance.on("firstFrame", function() {    
                var cookieData = $cookie.getItem("resumevideodata");
                if (cookieData) {
                    var resumeAt = cookieData.split(":")[0],
                        videoDur = cookieData.split(":")[1];
                    if (parseInt(resumeAt) < parseInt(videoDur)) {
                        (resumeAt == 0) ? resumeAt = 1: "";
                        playerInstance.seek(resumeAt);
                        fx.displayMessage("Hệ thống nhận thấy bạn đang xem dở bộ phim này. Mời bạn tiếp tục xem!")
                    } else if (cookieData && !(parseInt(resumeAt) < parseInt(videoDur))) {
                        logMessage("Video ended last time! Will skip resume behavior")
                    }
                } else {
                }
            });
            playerInstance.addButton(
              "'.SITE_URL.'/player/forward3.svg",
              "Tua tiến 10s",
              function() {
                playerInstance.seek(playerInstance.getPosition()+10);
              },
              "Tua tiến 10s"
            );
            playerInstance.addButton(
              "'.SITE_URL.'/player/backward2.svg",
              "Tua lại 10s",
              function() {
                playerInstance.seek(playerInstance.getPosition()-10);
              },
              "Tua lại 10s"
            );
        playerInstance.on("error", function (message) {
            if ((reloadTimes < 5)) {
                reloadTimes = reloadTimes + 1;
                setTimeout(function () {
                    playerInstance.remove();
                    load_biplayer();
                }, 1500);
            } else {
                var element=document.getElementById(\'mediaplayer\');
                element.innerHTML=\'<img src="https://i.imgur.com/J9OoJl1.jpg" style="width:100%;height:100%;" />\'
            }
        });

        playerInstance.on("setupError", function (message) {
            if ((reloadTimes < 5)) {
                reloadTimes = reloadTimes + 1;
                setTimeout(function () {
                    playerInstance.remove();
                    load_biplayer();
                }, 1500);
            } else {
                var element=document.getElementById(\'mediaplayer\');
                element.innerHTML=\'<img src="https://i.imgur.com/J9OoJl1.jpg" style="width:100%;height:100%;" />\'
            }
        });
        playerInstance.on("complete", function(e) {
                                                if(pautonext == true){
                                                    var $elm = $(\'.list-episode li a.active\');
                                                    if($elm.length){
                                                        var nextEpisode = $elm.closest(\'li\').next().find(\'a\').attr(\'href\');
                                                        if(typeof(nextEpisode) != \'undefined\'){
                                                            location.href = nextEpisode;
                                                        }
                                                    }
                                                }
                                            });

        playerInstance.addButton(
        "'.SITE_URL.'/assets/images/icon-download.png",
        "Nhấn vào đây để tải video",
        function() {window.open(playerInstance.getPlaylistItem()["file"] + "&title=phimaz.net", "_blank").blur();   }, "download"   );
    }

    load_biplayer();
        </script>';

            }
    echo $player;
}
function category_ad($list, $num = 0) {
    $list = substr($list, 1);
    $list = substr($list, 0, -1);
    $category  = MySql::dbselect("en_category", "category", "id IN (" . $list . ")");
    for($i=0;$i<count($category);$i++) {
        $name = $category[$i][0];
        if($i == count($category)-1) {$html .= "$name";} else {$html .= "$name,";}
    }
    return $html;
}

function country_ad($id) {
    $country = MySql::dbselect("en_country", "country", "id = '$id'");
    $html = $country[0][0];
    return $html;
}
function li_filmMEM($limit,$list='',$type) {
    $list = substr($list,1);
    $list = substr($list,0,-1);
    $list = str_replace('||',',',$list);
    $sql = "id IN ($list)";
    $arr = MySql::dbselect('tb_film.id,tb_film.title,tb_film.thumb,tb_film.year,tb_film.big_image,tb_film_other.content,tb_film.title_en,tb_film.duration,tb_film.quality','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"$sql LIMIT $limit");
    if($arr) {
    for($i=0;$i<count($arr);$i++) {
        $id = $arr[$i][0];
        $name = $arr[$i][1];
        $name_en = CutName($arr[$i][6],20);
        $url = get_url($arr[$i][0],$name,'Phim');
        $thumb = $arr[$i][2];
        $bg_thumb = TEMPLATE_URL.'images/grey.jpg';
        $thumb_big = $arr[$i][4];
        $duration = $arr[$i][7];
        $quality = $arr[$i][8];
        $year = $arr[$i][3];
        $content = CutName(RemoveHtml(UnHtmlChars($arr[$i][5])),200);
        $html .= '<div class="block-base movie">
                                <a href="'.$url.'" class="poster ntips tooltipstered">
                                    <img class="thumb lazy" src="'.$thumb.'" alt="'.$name.'-'.$name_en.'" width="180px" height="256px" style="display: inline;">
                                    <span class="tag  bitrate0 "></span>
                                    <span class="rating"><span class="rate">0</span></span>


                                                                    </a>

                                <div class="clear"></div>
                                <a href="'.$url.'" class="film-name">
                                    <h2>'.$name_en.'</h2> '.$name.'</a>
                            </div>';
    }
}  else $html = '<h3 style="margin-left: 10px">Chưa có bộ phim nào !</h3>';
    return $html;
}
?>
