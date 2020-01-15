<?php 
function unZend($str){
	$str = base64_decode(base64_decode($str));
	return $str;
}
function Decode($link){		
	$gkdecode = new Decode();
	$secretKey = 'kD2KSnAPkOFkjgjguc8D';
	if (substr_count($link,'picasaweb.google.com')!==false)	{
		$link = explode('picasaweb.google.com/',$link);
		$link = unZend($link[1]);
		$link = trim($gkdecode->decrypt($link,$secretKey));
	}	
	return $link;
}
#mod grab phim từ olaphim. code by văn toàn
$html = curlGet($page);
$title = RemoveHtml(explode_by('<strong>Tên phim:</strong> ','</li>',$html));
$title_en = RemoveHtml(explode_by('<strong>English:</strong> ','</li>',$html));
$director = RemoveHtml(explode_by('<strong>Đạo diễn:</strong> ',', </li>',$html));
$actor = RemoveHtml(explode_by('<strong>Diễn viên:</strong> ',', </li>',$html));
$year = RemoveHtml(explode_by('<strong>Năm sản xuất:</strong> ','</li>',$html));
$thumb = RemoveHtml(explode_by('id="opa"> <a href=\'',"'",$html));
$trailer = RemoveHtml(explode_by('proxy.swf&proxy.link=','&',$html));
$content = explode_by('<br class="clear"/>','<div class="boxl_m clear"',$html);

## tập phim
$linkplay = explode_by('btn-group playbt" style="margin-top: -20px;"><a href="','"',$html);
$htmllinkplay = curlGet($linkplay);
$htmllinkplay = explode_by('h5>Lựa chọn server phim</h5>','<div class="boxl_m">',$htmllinkplay);
$_playlink = explode('<a href="',$htmllinkplay);
$total_playlink = count($_playlink)-1;
if($_GET['begin']) $begin = $_GET['begin'];
else $begin = 1;
if($_GET['end']) $total_playlink = $_GET['end'];
for($i=1;$i<=$total_playlink;$i++) {
	$_htmllinkplay = explode('" class="',$_playlink[$i]);
	$name[$i] = RemoveHtml(explode_by('">','</a>',$_htmllinkplay[1]));
	$_htmllinkplay = RemoveHtml($_htmllinkplay[0]);
	$_htmllinkplay = curlGet($_htmllinkplay);
	$Linkembed = explode_by('&proxy.link=','&',$_htmllinkplay);
	$_Linkembed[$i] = Decode($Linkembed);
	$_Caption[$i] = explode_by('&captions.file=','&',$_htmllinkplay);
}
?>