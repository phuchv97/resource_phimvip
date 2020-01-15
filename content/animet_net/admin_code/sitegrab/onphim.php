<?php 
function _decode_onphim($str) {
    if (strpos($str, 'picasaweb.google.com')) {
        $arr = explode('/', $str);
        $txt = str_replace("_yT","T",$arr[5]);
	$txt = str_replace("d!_","d",$txt);
	$txt = str_replace("bzm!","z",$txt);
	$txt = str_replace("Ah_G","==",$txt);
	$arr[5] = base64_decode($txt);
        $str = implode("/", $arr);
    }
    return $str;
}
#mod grab phim từ onphim. code by văn toàn
$html = $dom->get_source($page);
$title = RemoveHtml(explode_by('<title>',' | ',$html));
$director = RemoveHtml(explode_by('<b>Đạo diễn :</b></td>','</tr>',$html));
$actor = RemoveHtml(explode_by('<b>Diễn viên :</b></td>','</tr>',$html));
$year = RemoveHtml(explode_by('<b>Sản xuất :</b></td>','</tr>',$html));
$thumb = RemoveHtml(explode_by('<tr><td><img src="','"',$html));
$content = explode_by('<tr><td><b>Nội dung :</b></td>','</tr>',$html);

## tập phim
$_playlink = explode('<a class="cl_part_1" href="',$html);
$total_playlink = count($_playlink)-1;
if($_GET['begin']) $begin = $_GET['begin'];
else $begin = 1;
if($_GET['end']) $total_playlink = $_GET['end'];
for($i=1;$i<=$total_playlink;$i++) {
	$_htmllinkplay = explode('">',$_playlink[$i]);
	$name[$i] = RemoveHtml(explode_by('.html"><b>','</b>',$_playlink[$i]));
	$_htmllinkplay = RemoveHtml($_htmllinkplay[0]);
	$_htmllinkplay = $dom->get_source($_htmllinkplay);
	$Linkembed = explode_by('&proxy.link=','&',$_htmllinkplay);
	$_Linkembed[$i] = _decode_onphim($Linkembed);
	$_Caption[$i] = explode_by('&captions.file=','&',$_htmllinkplay);
}
?>