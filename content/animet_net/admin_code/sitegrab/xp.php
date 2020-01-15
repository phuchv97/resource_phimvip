<?php
$html = xem_web($page);
$title = RemoveHtml(explode_by('<h1 itemprop="title" title ="Xem phim ','">',$html));
$title_en = RemoveHtml(explode_by('<li>Tên Tiếng Anh:','</li>', $html));
$director = RemoveHtml(explode_by('<li>Đạo diễn:','</li>',$html));
$actor = RemoveHtml(explode_by('<h3 class="tn-texth3">Diễn viên trong phim:</h3>','</div>',$html));
$year = RemoveHtml(explode_by(' (',')<',$html));
$release_time = RemoveHtml(explode_by(' (',')<',$html));
$duration = RemoveHtml(explode_by('<li>Thời lượng: ','</li>',$html));
$content  = trim(RemoveHtml(explode_by('<div class="tn-contentmt">','</div>',$html)));
$thumb = RemoveHtml(explode_by('<p><img src="','" title="',$html));
	$quocgia = explode('<li>Quốc gia:', $html);
	$quocgia = explode('</li>', $quocgia[1]);
	$quocgia = trim(RemoveHtml($quocgia[0]));
if ($quocgia == "Phim Mỹ") $countryid = 5;
if ($quocgia == "Phim Anh") $countryid = 5;
if ($quocgia == "Phim Châu Âu") $countryid = 5;
elseif ($quocgia == "Phim Nhật Bản") $countryid = 4;
elseif ($quocgia == "Phim Hàn Quốc") $countryid = 3;
elseif ($quocgia == "Phim Hồng Kông") $countryid = 9;
elseif ($quocgia == "Phim Việt Nam") $countryid = 1;
elseif ($quocgia == "Phim Trung Quốc") $countryid = 2;
elseif ($quocgia == "Phim Ấn Độ") $countryid = 10;
elseif ($quocgia == "Phim Thái Lan") $countryid = 6;
elseif ($quocgia == "Phim Đài Loan") $countryid = 8;
	$country = $countryid;
	$info_theloai = explode('<li>Thể loại:', $html);
	$info_theloai = explode('</li>', $info_theloai[1]);
	$theloai = RemoveHtml($info_theloai[0]); // Phim Hành Động, Phim Hình Sự
	$list_category 	= explode(',',$theloai);
	for($i=0;$i<count($list_category);$i++) {
		//$list_category[$i] = ','.$list_category[$i];
		$list_category[$i] = trim(str_replace(",", "", $list_category[$i]));
		if ($list_category[$i] == "Hành Động") $list_category[$i] = 1;
		elseif ($list_category[$i] == "Phiêu Lưu") $list_category[$i] = 10;
		elseif ($list_category[$i] == "Kinh Dị") $list_category[$i] = 21;
		elseif ($list_category[$i] == "Viễn Tưởng") $list_category[$i] = 7;
		elseif ($list_category[$i] == "Hài Hước") $list_category[$i] = 6;
		elseif ($list_category[$i] == "Tâm Lý Tình Cảm") $list_category[$i] = 13;
		elseif ($list_category[$i] == "Tâm Lý Tình Cảm") $list_category[$i] = 3;
		elseif ($list_category[$i] == "Hoạt Hình") $list_category[$i] = 4;
		elseif ($list_category[$i] == "Chiến Tranh") $list_category[$i] = 22;
		elseif ($list_category[$i] == "Thần Thoại") $list_category[$i] = 30;
		elseif ($list_category[$i] == "Cổ Trang") $list_category[$i] = 8;
		elseif ($list_category[$i] == "Hình Sự") $list_category[$i] = 19;
		elseif ($list_category[$i] == "Khoa Học") $list_category[$i] = 18;
		elseif ($list_category[$i] == "Âm Nhạc") $list_category[$i] = 24;
		elseif ($list_category[$i] == "TV - Show") $list_category[$i] = 31;
		elseif ($list_category[$i] == "Chiếu Rạp") $list_category[$i] = 40;




			else $list_category[$i] = '';
		$thtml .= ','.$list_category[$i];
	}
	$category = $thtml;
## tập phim
$_playlink = explode('style="margin-bottom: 5px; min-width: 42px;" href="/phim',$html);
$total_playlink = count($_playlink)-1;
if($_GET['begin']) $begin = $_GET['begin'];
else $begin = 1;
if($_GET['end']) $total_playlink = $_GET['end'];
for($i=$begin;$i<=$total_playlink;$i++) {
	$name[$i] = RemoveHtml(explode_by('">','</a>',$_playlink[$i]));
	$_htmllinkplay = explode('"',$_playlink[$i]);
        if($_htmllinkplay[0]){
	$_Linkembed[$i] = 'http://xuongphim.tv/phim'.$_htmllinkplay[0]; } else {$_Linkembed[$i] = $linkb_phim;
         $name[$i] = 'Full';
}
}
?>