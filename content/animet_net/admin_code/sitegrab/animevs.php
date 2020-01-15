<?php
$html = xem_web($page);
$title = RemoveHtml(explode_by('<h2 class="name-vi">','</h2>',$html));
$title_en = RemoveHtml(explode_by('<h3 class="name-eng">','</h3>', $html));
$director = RemoveHtml(explode_by('Nhà sản xuất: </span>','</li>',$html));
$actor = RemoveHtml(explode_by('Fansub: </span>','</li>',$html));
$year = RemoveHtml(explode_by('Năm phát sóng: </span>','</li>',$html));
$release_time = $year;
$duration = RemoveHtml(explode_by('Số tập: </span>','</li>',$html));
$content  = trim(RemoveHtml(explode_by('<div class="content">','</div>',$html)));
$thumb = RemoveHtml(explode_by('og:image" content="','"',$html));
$anhto = explode_by('<img class="big_img"','<div class="small_img">',$html);
$anhto2 = explode('src="',$anhto);
$anhto2 = explode('"',$anhto2[1]);
$big_image = $anhto2[0];
$country = 4;
$category = '41,4';
## tập phim
$linkplay = explode_by('play-now" href="','"',$html);
$linkb_phim = $linkplay;
$htmllinkplay = xem_web($linkb_phim);
$htmllinkplay = explode_by('<div class="eplist" id="_listep"><ul class="listep" id="sv_0">','</li>',$htmllinkplay);
$_playlink = explode('href="',$htmllinkplay);
$total_playlink = count($_playlink)-1;
if ($total_playlink>1){$filmlb=2;};
if($_GET['begin']) $begin = $_GET['begin'];
else $begin = 1;
if($_GET['end']) $total_playlink = $_GET['end'];
for($i=$begin;$i<=$total_playlink;$i++) {
	$name[$i] = RemoveHtml(explode_by('">','</a>',$_playlink[$i]));
	$_htmllinkplay = explode('"',$_playlink[$i]);
        if($_htmllinkplay[0]){
	$_Linkembed[$i] = $_htmllinkplay[0]; } else {$_Linkembed[$i] = $linkb_phim;
         $name[$i] = 'Full';
}
}
?>