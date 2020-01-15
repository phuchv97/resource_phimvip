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
echo "<div class=\"section-results-auto\"><ul><li><a class=\"search-for zme-autocomplete-activeItem\" href=\"search/".$key2."/\">Tìm thêm với từ \"$q\"</a></li></ul></div>\n";
if($film) {
	echo '<div class="section-results-auto"><ul>';
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
						$url = Url::get($film[$i][5],$name,'Phim');
                           }
		echo "
		<li><a href=\"$url\" class=\"thumb\"><img src=\"/iphd.php?src=".$film[$i][3]."&w=55&h=55\" /></a>
		<div class=\"contentsearch\"><h3 class=\"title\"><a href=\"$url\">".$film[$i][1]."</a></h3>
		<p class=\"subName\"><a href=\"$url\">".$film[$i][2]."</a></p>
		</div></li>
";
	}
			echo '</ul></div>';
}
} else { echo'hihi';}
exit();
?>
