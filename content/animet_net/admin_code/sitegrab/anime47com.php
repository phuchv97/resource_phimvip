<?php 
#mod grab phim từ olaphim. code by văn toàn
$html = $dom->get_source($page);
$title = RemoveHtml(explode_by('<h1>',' - ',$html));
$thumb = RemoveHtml(explode_by('<link rel="image_src" href="','"',$html));
$content = explode_by('><strong>Nội dung:</strong></p>','<div class="clear"></div>',$html);

## tập phim
$linkplay = explode_by('class="w_now"><a href="','"',$html);
$linkplay = str_replace('/./','/',$linkplay);
$htmllinkplay = $dom->get_source($linkplay);
$htmllinkplay = explode_by('<div id="servers" class="serverlist">','</table>',$htmllinkplay);
$_playlink = explode('<li><a title="',$htmllinkplay);
$total_playlink = count($_playlink)-1;
if($_GET['begin']) $begin = $_GET['begin'];
else $begin = 1;
if($_GET['end']) $total_playlink = $_GET['end'];
for($i=1;$i<=$total_playlink;$i++) {
	$_htmllinkplay = explode('href="',$_playlink[$i]);
	$name[$i] = RemoveHtml(explode_by('">','</a>',$_htmllinkplay[1]));
	$_htmllinkplay = explode('">',$_htmllinkplay[1]);
	$_htmllinkplay = RemoveHtml($_htmllinkplay[0]);
	$_htmllinkplay = $dom->get_source($_htmllinkplay);
	$Linkembed = explode_by('"proxy.link": "','",',$_htmllinkplay);
	$arrayPost = array('url' => $Linkembed);
	$_post = http_build_query($arrayPost);
	$sourceLinkembed = $dom->get_source('http://anime47.com/player/plugins/plugins_player.php', $_post);
	if ($sourceLinkembed) $Linkembed = 'https://picasaweb.google.com/lh/photo/' . explode_by('gupi=',"',",$sourceLinkembed);
	$_Linkembed[$i] = $Linkembed;
}
?>