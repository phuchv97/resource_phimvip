<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
// Các chức năng liên quan tới curl
class cURL {
    public static function getWiki($name) {
		$name = VietChar($name);
		$name = str_replace(' ','_',$name);
		$url = "http://vi.wikipedia.org/w/api.php?action=opensearch&search=".urlencode($name)."&format=xml&prop=images&limit=1";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPGET, TRUE);
		curl_setopt($ch, CURLOPT_POST, FALSE);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_NOBODY, FALSE);
		curl_setopt($ch, CURLOPT_VERBOSE, FALSE);
		curl_setopt($ch, CURLOPT_REFERER, "");
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 4);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; he; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8");
		$page = curl_exec($ch);
		$xml = simplexml_load_string($page);
		$Text = (string)$xml->Section->Item->Text;
		$Description = (string)$xml->Section->Item->Description;
		$URL = (string)$xml->Section->Item->Url;
		$Image = (string)$xml->Section->Item->Image[0]['source'];
		$r = array('/20px','/21px','/22px','/23px','/24px','/25px','/26px','/27px','/28px','/29px','/30px','/31px','/32px','/33px','/34px','/35px','/36px','/37px','/38px','/39px','/40px','/41px','/42px','/43px','/44px','/45px','/46px','/47px','/48px','/49px','/50px');
		$Image = str_replace($r,'/300px',$Image);
		$return = array($Text, $Description, $URL, $Image);
		if($Description) {
			return $return;
		} else {
			return "";
		}
	}
	public static function getYoutube($url) {
		parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
		$video_id = $my_array_of_vars['v']; 
		$url = 'https://www.googleapis.com/youtube/v3/videos?id='.$video_id.'&key=AIzaSyBBiTQxeXNe7lJzy0Dp6o_iC1Y0_WH0lug&part=snippet%2CcontentDetails%2Cstatistics'; 
		$obj = json_decode(file_get_contents($url));
		$title = $obj->items[0]->snippet->title;
        $vid_duration = $obj->items[0]->contentDetails->duration;
        preg_match_all('/(\d+)/',$vid_duration,$parts);
	    // Put in zeros if we have less than 3 numbers.
	    if (count($parts[0]) == 1) {
	        array_unshift($parts[0], "0", "0");
	    } elseif (count($parts[0]) == 2) {
	        array_unshift($parts[0], "0");
	    }

	    $sec_init = $parts[0][2];
	    $seconds = $sec_init%60;
	    $seconds_overflow = floor($sec_init/60);

	    $min_init = $parts[0][1] + $seconds_overflow;
	    $minutes = ($min_init)%60;
	    $minutes_overflow = floor(($min_init)/60);

	    $hours = $parts[0][0] + $minutes_overflow;
	    if($hours != 0)
	        $duration = $hours.' giờ '.$minutes.' phút '.$seconds.' giây';
	    else
	        $duration = $minutes.' phút '.$seconds.' giây';
	    
		$thumb = "https://i.ytimg.com/vi/$video_id/hqdefault.jpg"; 
		return array($title,$duration,$thumb);
	}
}