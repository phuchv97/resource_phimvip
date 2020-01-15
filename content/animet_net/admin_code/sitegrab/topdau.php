<?php 
function decode_gkplugins($link, $secretKey = '') {
    $gkdecode = new Decode();
    return $gkdecode->decrypt($link, $secretKey);
}
#mod grab phim từ topdau. code by văn toàn
$html = $dom->get_source($page);
$title = RemoveHtml(explode_by('<title>phim ',' | ',$html));
$title_en = RemoveHtml(explode_by(' | ',' 20',$html));
$thumb = RemoveHtml(explode_by('<div><img src="','"',$html));
$director = RemoveHtml(explode_by('<p> Đạo diễn:','</p>',$html));
$actor = RemoveHtml(explode_by('<p> Diễn viên:','</p>',$html));
$year = RemoveHtml(explode_by('<p> Năm phát hành:','</p>',$html));
$duration = RemoveHtml(explode_by('<p> Thời lượng:','</p>',$html));
$trailer = RemoveHtml(explode_by('player.swf?file=','&image',$html));
$content  = RemoveHtml(explode_by('<span>Nội Dung :</span></p>','<br><p class="title">',$html));
## tập phim
$linkplay = explode_by('<p class="w_now"> <a href="','"',$html);
$htmllinkplay = $dom->get_source($linkplay);
$htmllinkplay = explode_by('<div class="list_episodes content">','<!-- END TOTAL EPISODE -->',$htmllinkplay);
$_playlink = explode('<a id="epid_',$htmllinkplay);
$total_playlink = count($_playlink)-1;
if($_GET['begin']) $begin = $_GET['begin'];
else $begin = 1;
if($_GET['end']) $total_playlink = $_GET['end'];
for($i=$begin;$i<=$total_playlink;$i++) {
	$name[$i] = RemoveHtml(explode_by('<b>','</b>',$_playlink[$i]));
	$_htmllinkplay = RemoveHtml(explode_by('href="','"',$_playlink[$i]));;
	$_htmllinkplay = curlGet($_htmllinkplay);
	$Linkembed = explode_by('("td*','","',$_htmllinkplay);
	$_Linkembed[$i] = decode_gkplugins($Linkembed,'KrfkAXQFDJidBFQPEwoa');
	$_Caption[$i] = explode_by('&captions.file=','&',$_htmllinkplay);
}
?>