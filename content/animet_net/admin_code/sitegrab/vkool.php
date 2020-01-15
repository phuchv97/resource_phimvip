<?php 
include '_kenc.php';
function vDecode($link) {
    if (strpos($link, 'picasaweb.google.com/lh/photo')) {
        $link = explode('picasaweb.google.com/lh/photo/', $link);
        if (fek_check($link[1])) {
            $link = 'https://picasaweb.google.com/lh/photo/' . fek_decrypt($link[1], fek_check($link[1]));
        }
    } else
        $link = $link;
    return $link;
}
function decode_gkplugins($link, $secretKey = '') {
    $gkdecode = new Decode();
    return $gkdecode->decrypt($link, $secretKey);
}
#mod grab phim từ onphim. code by văn toàn
$html = $dom->get_source($page);
$title = RemoveHtml(explode_by('><h1 class="h_header">','(',$html));
$title_en = RemoveHtml(explode_by('<br /><span class="title-extra">','</span>',$html));
$director = RemoveHtml(explode_by('<p>Đạo diễn:','</p>',$html));
$actor = RemoveHtml(explode_by('<p>Diễn viên:','</p>',$html));
$year = RemoveHtml(explode_by('<p>Năm phát hành:','</p>',$html));
$thumb = RemoveHtml(explode_by('<div class="left"><img src="','"',$html));
$thumb = str_replace('movie.vkool.net/images/poster/', '', $thumb);
$duration = RemoveHtml(explode_by('<p>Thời lượng:','</p>',$html));
$content = explode_by('<div class="desc entry content">','</div>',$html);
$content = preg_replace('#<a.*?>.*?</a>#i', '', $content);
$content = str_replace(array('movie.vkool.net/images/screens/',' - Vkool.Net'), '', $content);
$trailer = RemoveHtml(explode_by('<param name="movie" value="','"',$html));
$trailer = 'http://www.youtube.com/watch?v='.VideoYoutubeID($trailer);

## tập phim
$linkplay = explode_by('<p class="w_now"><a href="','"',$html);
$htmllinkplay = $htmllinkplay_other = $dom->get_source($linkplay);
$htmllinkplay = explode_by('<div class="block list_films" id="share_3">','<div style="display:none;"',$htmllinkplay);
$_playlink = explode('<a href="watch/',$htmllinkplay);
$total_playlink = count($_playlink);
if($_GET['begin']) $begin = $_GET['begin'];
else $begin = 1;
if($_GET['end']) $total_playlink = $_GET['end'];
for($i=1;$i<=$total_playlink;$i++) {
	$num = ($i+1);
	$_htmllinkplay = explode('">',$_playlink[$i]);
	$name[$num] = RemoveHtml(explode_by('<b>','</b>',$_playlink[$i]));
	$name[1] = RemoveHtml(explode_by('<font class="episode_bg_2">&nbsp;','&nbsp;',$htmllinkplay));
	$_htmllinkplay = RemoveHtml('http://movie.vkool.net/watch/'.$_htmllinkplay[0]);
	$_htmllinkplay = $dom->get_source($_htmllinkplay);
	$Linkembed = explode_by('vkool|||','&',$_htmllinkplay);
	$_Linkembed[$num] = vDecode(trim(decode_gkplugins($Linkembed, 'QJId5GzYf3Q17Hu!MyeP')));
	$_Linkembed[1] = explode_by('vkool|||','&',$htmllinkplay_other);
	$_Linkembed[1] = vDecode(trim(decode_gkplugins($_Linkembed[1], 'QJId5GzYf3Q17Hu!MyeP')));
	$_Caption[$num] = explode_by('&captions.file=','&',$_htmllinkplay);
}
?>