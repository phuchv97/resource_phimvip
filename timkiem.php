<?php
define('RK_MEDIA',true);
require('init.php');
include View::TemplateView('functions');
$q	 	= 	$_REQUEST['key'];
$qT		=	str_replace(" ","-",$q);
$key = htmlchars(urldecode(injection(mb_strtolower($q, 'UTF-8'))));
$key2 = htmlchars(urldecode(injection(mb_strtolower($qT, 'UTF-8'))));
$film = MySql::dbselect('tb_film.id,tb_film.title,tb_film.title_en,tb_film.thumb,tb_film.category,tb_film.url','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"(tb_film.title like '%$key%' OR tb_film.title_en like '%$key%' OR tb_film_other.searchs like '%$key%' OR tb_film_other.keywords like '%$key%' OR tb_film.actor like '%$key%' OR tb_film.director like '%$key%' OR tb_film.title_search like '%$key%' OR strcmp(soundex(title_search), soundex('$key')) = 0) ORDER BY tb_film.viewed DESC LIMIT 8");
if($key){
if($film) {
	echo '<div class="tab-content videos fnRTContent">
<div class="card-wrap">
<div class="row">';
	for($i=0;$i<count($film);$i++) {
						$id = $film[$i][0];
						$name = $film[$i][1];
						$name_en = $film[$i][2];
						$thumb = $film[$i][3];
						$cat = $film[$i][4];
						if (!$film[$i][5]) {
						$url = Url::get($film[$i][0],$name,'Phim');
                        }
                        else {
						$url = Url::get($id,$film[$i][5],'Phim');
                           }
		echo '<div class="col-lg-12 col-sm-12" style="">
<div class="card" style="margin-bottom: 0px;" onclick="window.location.href=\'$url\'">
<aside class="card-side card-side-img" style="margin-bottom: 5px;">
<a href="'.$url.'" title="Xem phim">
<img alt="alt text" src="'.$film[$i][3].'" style="max-width:100%;width: 45px;">
</a>
</aside>
<div class="card-main">
<div class="card-inner">
<p class="card-heading">
<a href="'.$url.'" title="Xem phim">'.$film[$i][1].'</a>
<em class="subtitle">'.$film[$i][2].'</em>
</p>
</div>
</div>
</div>
</div>';
	}
			echo '</div>
</div>
</div>'; 
}
} else { echo'hihi';}
exit();
?>


