<?php
$html = curlGet($page);
$title = RemoveHtml(explode_by('<h1 class="h2 font-bold text-white text-ellipsis">','</h1>',$html));
$title_en = RemoveHtml(explode_by('<p class="text-muted m-b-none">','</p>', $html));
$director = RemoveHtml(explode_by('Đạo diễn:','</p>',$html));
$actor = RemoveHtml(explode_by('<dt>Diễn viên:</dt>','</dd>',$html));
$year = RemoveHtml(explode_by('Khởi chiếu:','tại',$html));
$release_time = $year;
$duration = RemoveHtml(explode_by('title="Thời lượng">','</a>',$html));
$contentt  = trim(RemoveHtml(explode_by('<div class="synopsis m-t m-b-xs">','</div>',$html)));
$content = str_replace(array('moveek.com', 'moveek'),'biphim.net',$contentt);
$thumb = RemoveHtml(explode_by('og:image\' content="','"',$html));
	$quocgia = explode('<dt>Quốc gia:</dt>', $html);
	$quocgia = explode('</dd>', $quocgia[1]);
	$quocgia = trim(RemoveHtml($quocgia[0]));
if ($quocgia == "Âu Mỹ") $countryid = 5;
elseif ($quocgia == "Pháp") $countryid = 5;
elseif ($quocgia == "Nhật Bản") $countryid = 4;
elseif ($quocgia == "Hàn Quốc") $countryid = 3;
elseif ($quocgia == "Hồng Kông") $countryid = 9;
elseif ($quocgia == "Việt Nam") $countryid = 1;
elseif ($quocgia == "Trung Quốc") $countryid = 2;
elseif ($quocgia == "Ấn Độ") $countryid = 10;
elseif ($quocgia == "Thái Lan") $countryid = 6;
elseif ($quocgia == "Quốc gia hác") $countryid = 8;
	$country = $countryid;
	$info_theloai = explode('<dt>Thể loại:</dt>', $html);
	$info_theloai = explode('</dd>', $info_theloai[1]);
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

?>