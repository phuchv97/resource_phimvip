<?php
$html = xem_web($page);
$title = RemoveHtml(explode_by('html5player.setVideoTitle(\'','\');',$html));
$title_en = $title;
$director = 'NA';
$year = '2019';
$actor = 'NA';
$duration1 = RemoveHtml(explode_by('<span class="duration">','min',$html));
$duration = $duration1.' phút';
$tinhtrang = 'HD Phê Nosub';
$big_image = RemoveHtml(explode_by('html5player.setThumbUrl(\'','\');',$html));
$thumb = RemoveHtml(explode_by('html5player.setThumbUrl169(\'','\');',$html));
	$country = 3;
	$category = 44;
## tập phim
$total_playlink = 1;
if ($total_playlink>1){$filmlb=2;};
if($_GET['begin']) $begin = $_GET['begin'];
else $begin = 1;
if($_GET['end']) $total_playlink = $_GET['end'];
for($i=$begin;$i<=$total_playlink;$i++) {
         $_Linkembed[$i] =  $page;
         $name[$i] = 'Full';
}

?>