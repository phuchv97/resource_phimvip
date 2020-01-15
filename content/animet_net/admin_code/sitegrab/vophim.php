<?php
$html = curlGet($page);
$title = RemoveHtml(explode_by('<span class="title-1">','</span>',$html));
$title_en = RemoveHtml(explode_by('<span class="title-2">','</span>', $html));
$director = RemoveHtml(explode_by('<li class="list-info-group-item">Đạo diễn :','</li>',$html));
$actor = RemoveHtml(explode_by('<li class="list-info-group-item last-item">Diễn viên :','</li>',$html));
$year = RemoveHtml(explode_by('<span class="title-year">(',')', $html));
$release_time = $year;
$duration = RemoveHtml(explode_by('<li class="list-info-group-item">Thời lượng :','</li>',$html));
$contentt  = trim(RemoveHtml(explode_by('<div class="item-content">','</div>',$html)));
$content = str_replace(array('vophim.com', 'Vophim.com'),'biphim.net',$contentt);
$thumb = RemoveHtml(explode_by('<img class="movie-thumb" src="','"',$html));
$big_image = RemoveHtml(explode_by('<li data-thumb="','"',$html));
	$quocgia = explode('<li class="list-info-group-item">Quốc gia :', $html);
	$quocgia = explode('</li>', $quocgia[1]);
	$quocgia = trim(RemoveHtml($quocgia[0]));
if ($quocgia == "Phim Mỹ") $countryid = 5;
elseif ($quocgia == "Phim Anh") $countryid = 5;
elseif ($quocgia == "Phim Pháp") $countryid = 5;
elseif ($quocgia == "Phim Nhật Bản") $countryid = 4;
elseif ($quocgia == "Phim Hàn Quốc") $countryid = 3;
elseif ($quocgia == "Phim Hồng Kông") $countryid = 9;
elseif ($quocgia == "Phim Việt Nam") $countryid = 1;
elseif ($quocgia == "Phim Trung Quốc") $countryid = 2;
elseif ($quocgia == "Phim Ấn Độ") $countryid = 10;
elseif ($quocgia == "Phim Thái Lan") $countryid = 6;
elseif ($quocgia == "Khác") $countryid = 8;
	$country = $countryid;
	$info_theloai = explode('<li class="list-info-group-item">Thể loại :', $html);
	$info_theloai = explode('</li>', $info_theloai[1]);
	$theloai = RemoveHtml($info_theloai[0]); // Phim Hành Động, Phim Hình Sự
	$list_category 	= explode(',',$theloai);
	for($i=0;$i<count($list_category);$i++) {
		//$list_category[$i] = ','.$list_category[$i];
		$list_category[$i] = trim(str_replace(",", "", $list_category[$i]));
		if ($list_category[$i] == "Phim hành động") $list_category[$i] = 1;
		elseif ($list_category[$i] == "Phim phiêu lưu") $list_category[$i] = 10;
		elseif ($list_category[$i] == "Phim kinh dị") $list_category[$i] = 21;
		elseif ($list_category[$i] == "Phim viễn tưởng") $list_category[$i] = 7;
		elseif ($list_category[$i] == "Phim võ thuật") $list_category[$i] = 2;
		elseif ($list_category[$i] == "Phim hài hước") $list_category[$i] = 6;
		elseif ($list_category[$i] == "Phim tâm lý") $list_category[$i] = 13;
		elseif ($list_category[$i] == "Phim tâm lý") $list_category[$i] = 3;
		elseif ($list_category[$i] == "Phim hoạt hình") $list_category[$i] = 4;
		elseif ($list_category[$i] == "Anime") $list_category[$i] = 41;
		elseif ($list_category[$i] == "Phim chiến tranh") $list_category[$i] = 22;
		elseif ($list_category[$i] == "Phim thần thoại") $list_category[$i] = 30;
		elseif ($list_category[$i] == "Phim cổ trang") $list_category[$i] = 8;
		elseif ($list_category[$i] == "Phim hình sự") $list_category[$i] = 19;
		elseif ($list_category[$i] == "Phim khoa học tài liệu") $list_category[$i] = 18;
		elseif ($list_category[$i] == "Phim âm nhạc") $list_category[$i] = 24;
		elseif ($list_category[$i] == "Phim TV Show") $list_category[$i] = 31;
		elseif ($list_category[$i] == "Phim chiếu rạp") $list_category[$i] = 40;
		elseif ($list_category[$i] == "Phim 18+") $list_category[$i] = 44;




			else $list_category[$i] = '';
		$thtml .= ','.$list_category[$i];
	}
	$category = $thtml;
## tập phim
?>