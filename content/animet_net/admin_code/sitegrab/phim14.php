<?php 
function curl_useragert_mobile($url) {
	$ch = curl_init($url);
	//curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (iPhone; U; CPU like Mac OS X; en) AppleWebKit/420.1 (KHTML, like Gecko) Version/3.0 Mobile/3B48b Safari/419.3'); // giả lập thông tin iphone
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 10.0; Windows Phone 8.0; Trident/6.0; IEMobile/10.0; ARM; Touch; NOKIA; Lumia 920)'); // giả lập Windows Phone
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}
#mod grab phim từ topdau. code by văn toàn
$html = $dom->get_source($page);
$title = RemoveHtml(explode_by('<div class="alt2">Tên phim: <font color="white">',' - ',$html));
$title_en = RemoveHtml(explode_by('(',') |)',$html));
$thumb = RemoveHtml(explode_by('<div class="thumbnail"><img src="','"',$html));
$director = RemoveHtml(explode_by('<div class="alt1">Đạo diễn:','</div>',$html));
$actor = RemoveHtml(explode_by('<div class="alt2">Diễn viên:','</div>',$html));
$year = RemoveHtml(explode_by('<div class="alt2">Năm phát hành:','</div>',$html));
$duration = RemoveHtml(explode_by('<div class="alt1">Thời lượng:','</div>',$html));
$content  = RemoveHtml(explode_by('<div class="message">','</div>',$html));
## tập phim
$linkplay = explode_by('<a class="watch_button now" href="','"',$html);
$htmllinkplay = $dom->get_source($linkplay);
$htmllinkplay = explode_by('<ul id="server_list">','<!--/.block--> ',$htmllinkplay);
$_playlink = explode('<a ',$htmllinkplay);
$total_playlink = count($_playlink)-1;
if($_GET['begin']) $begin = $_GET['begin'];
else $begin = 1;
if($_GET['end']) $total_playlink = $_GET['end'];
for($i=$begin;$i<=$total_playlink;$i++) {
	$name[$i] = RemoveHtml(explode_by('">','</a>',$_playlink[$i]));
	$_htmllinkplay = RemoveHtml(explode_by('href="','"',$_playlink[$i]));;
	$_htmllinkplay = curl_useragert_mobile(str_replace("http://phim14","http://m.phim14",$_htmllinkplay));
	$Linkembed = base64_decode(explode_by('vantoan|||','.mp4',$_htmllinkplay));
	if(!$Linkembed) $Linkembed = explode_by('<iframe src="','"',$_htmllinkplay);
	if(!$Linkembed) {
		$Linkembed = explode_by('<iframe id="player"','</iframe>',$_htmllinkplay);
		$Linkembed = explode_by('src="','"',$Linkembed);
	}
	$_Linkembed[$i] = $Linkembed;
	$_Caption[$i] = explode_by('&captions.file=','&',$_htmllinkplay);
}
?>