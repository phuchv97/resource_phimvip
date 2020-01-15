<?php
$html = xem_web($page);
$title = RemoveHtml(explode_by('<h1 class="name" itemprop="name">','</h1>',$html));
$title_en = RemoveHtml(explode_by('<h2 class="real-name">','(', $html));
$director = RemoveHtml(explode_by('<label>Đạo diễn:</label>','</li>',$html));
$actor = RemoveHtml(explode_by('<label>Diễn viên:</label>','</li>',$html));
$year = RemoveHtml(explode_by('label>Năm xuất bản:</label>','</li>',$html));
$release_time = $year;
$tinhtrang = RemoveHtml(explode_by('<label>Đang phát:</label>','</li>',$html));
$duration = RemoveHtml(explode_by('<label>Thời lượng:</label>','</li>',$html));
$contentt  = trim(RemoveHtml(explode_by('<div class="film-content">','</div>',$html)));
$content = str_replace(array('Bilutv.net', 'Bilutv'),'Phim6v.com',$contentt);
$thumb = RemoveHtml(explode_by('og:image" content="','"',$html));
	$quocgia = explode('<label>Quốc gia:</label>', $html);
	$quocgia = explode('</li>', $quocgia[1]);
	$quocgia = trim(RemoveHtml($quocgia[0]));
if ($quocgia == "Âu - Mỹ") $countryid = 5;
elseif ($quocgia == "Pháp") $countryid = 5;
elseif ($quocgia == "Nhật Bản") $countryid = 4;
elseif ($quocgia == "Hàn Quốc") $countryid = 3;
elseif ($quocgia == "Hồng Kông") $countryid = 9;
elseif ($quocgia == "Việt Nam") $countryid = 1;
elseif ($quocgia == "Trung Quốc") $countryid = 2;
elseif ($quocgia == "Ấn Độ") $countryid = 10;
elseif ($quocgia == "Thái Lan") $countryid = 6;
elseif ($quocgia == "Quốc gia khác") $countryid = 8;
	$country = $countryid;
	$info_theloai = explode('<label>Thể loại:</label>', $html);
	$info_theloai = explode('</li>', $info_theloai[1]);
	$theloai = RemoveHtml($info_theloai[0]); // Phim Hành Động, Phim Hình Sự
	$list_category 	= explode(',',$theloai);
	for($i=0;$i<count($list_category);$i++) {
		//$list_category[$i] = ','.$list_category[$i];
		$list_category[$i] = trim(str_replace(",", "", $list_category[$i]));
		if ($list_category[$i] == "Hành Động") $list_category[$i] = 1;
		elseif ($list_category[$i] == "Phiêu Lưu") $list_category[$i] = 10;
		elseif ($list_category[$i] == "Kinh Dị - Ma") $list_category[$i] = 21;
		elseif ($list_category[$i] == "Viễn Tưởng") $list_category[$i] = 7;
		elseif ($list_category[$i] == "Võ Thuật - Kiếm Hiệp") $list_category[$i] = 2;
		elseif ($list_category[$i] == "Hài Hước") $list_category[$i] = 6;
		elseif ($list_category[$i] == "Tâm Lý - Tình Cảm") $list_category[$i] = 13;
		elseif ($list_category[$i] == "Tâm Lý - Tình Cảm") $list_category[$i] = 3;
		elseif ($list_category[$i] == "Hoạt Hình") $list_category[$i] = 4;
		elseif ($list_category[$i] == "Anime") $list_category[$i] = 41;
		elseif ($list_category[$i] == "Chiến Tranh<") $list_category[$i] = 22;
		elseif ($list_category[$i] == "Cổ Trang") $list_category[$i] = 30;
		elseif ($list_category[$i] == "Cổ Trang") $list_category[$i] = 8;
		elseif ($list_category[$i] == "Hình Sự") $list_category[$i] = 19;
		elseif ($list_category[$i] == "Tài Liệu") $list_category[$i] = 18;
		elseif ($list_category[$i] == "Âm Nhạc") $list_category[$i] = 24;
		elseif ($list_category[$i] == "TV Show") $list_category[$i] = 31;
		elseif ($list_category[$i] == "Chiếu Rạp") $list_category[$i] = 40;
		elseif ($list_category[$i] == "Trailer") $list_category[$i] = 42;




			else $list_category[$i] = '';
		$thtml .= ','.$list_category[$i];
	}
	$category = $thtml;
## tập phim
$linkplay = explode_by('<a class="btn-see btn btn-danger" href="','"',$html);
$linkb_phim = 'http://bilutv.net'.$linkplay;
$htmllinkplay = xem_web($linkb_phim);
$htmllinkplay = explode_by('<ul class="list-episode" id="list_episodes">','</ul>',$htmllinkplay);
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

	$linkxem =  'http://bilutv.net'.$_htmllinkplay[0]; 
	$getfile = file_get_contents('http://api.phimaz.net/getlink/bilutv.php?k='.$linkxem);
	$linkdrive = explode_by('file":"', '"',$getfile);
	$_Linkembed[$i] = str_replace('\/', '/', $linkdrive);

    }

	else {
         $getfile = file_get_contents('http://api.phimaz.net/getlink/bilutv.php?k='.$linkb_phim);
	     $linkdrive = explode_by('file":"', '"',$getfile);
         $_Linkembed[$i] =  str_replace('\/', '/', $linkdrive);
         $name[$i] = 'Full';
}
}
?>