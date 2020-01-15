<?php
$html = xem_web($page);
$title = RemoveHtml(explode_by('<h1 style="font-size: 14px;margin: 0px;display: inline;"><strong>','</strong>',$html));
$title_en = RemoveHtml(explode_by('<h2 style="font-size: 14px;margin: 0px;display: inline;"><strong>','</strong>', $html));
$director = RemoveHtml(explode_by('Đạo diễn:','</li>',$html));
$actor = RemoveHtml(explode_by('<ul class="group-filminfo-ul clearfix">','</ul>',$html));
$year = RemoveHtml(explode_by('Năm sản xuất:','</li>',$html));
$release_time = RemoveHtml(explode_by('Năm sản xuất:','</li>',$html));
$duration = RemoveHtml(explode_by('Thời lượng:','</li>',$html));
$content  = trim(RemoveHtml(explode_by('<div class="tn-contentmt maxheightline-6" itemprop="description">','</div>',$html)));
$thumb = RemoveHtml(explode_by('<img itemprop="image" src="','"',$html));
$big_image = RemoveHtml(explode_by('<meta property="og:image" content="','"',$html));
$trailer = RemoveHtml(explode_by('http://api.hdonline.vn/iframeplay.php?file=','"',$html));
	$quocgia = explode('Quốc gia:', $html);
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
	$info_theloai = explode('Thể loại:', $html);
	$info_theloai = explode('</li>', $info_theloai[1]);
	$theloai = RemoveHtml($info_theloai[0]); // Phim Hành Động, Phim Hình Sự
	$list_category 	= explode(',',$theloai);
	for($i=0;$i<count($list_category);$i++) {
		//$list_category[$i] = ','.$list_category[$i];
		$list_category[$i] = trim(str_replace(",", "", $list_category[$i]));
		if ($list_category[$i] == "Phim Hành Động") $list_category[$i] = 1;
		elseif ($list_category[$i] == "Phim Phiêu Lưu") $list_category[$i] = 10;
		elseif ($list_category[$i] == "Phim Kinh Dị") $list_category[$i] = 21;
		elseif ($list_category[$i] == "Phim Viễn Tưởng") $list_category[$i] = 7;
		elseif ($list_category[$i] == "Phim Hài Hước") $list_category[$i] = 6;
		elseif ($list_category[$i] == "Phim Tâm Lý") $list_category[$i] = 13;
		elseif ($list_category[$i] == "Phim Tình Cảm") $list_category[$i] = 3;
		elseif ($list_category[$i] == "Phim Hoạt Hình") $list_category[$i] = 4;
		elseif ($list_category[$i] == "Phim Chiến Tranh") $list_category[$i] = 22;
		elseif ($list_category[$i] == "Phim Thần Thoại") $list_category[$i] = 30;
		elseif ($list_category[$i] == "Phim Cổ Trang") $list_category[$i] = 8;
		elseif ($list_category[$i] == "Phim Hình Sự") $list_category[$i] = 19;
		elseif ($list_category[$i] == "Phim Khoa Học") $list_category[$i] = 18;
		elseif ($list_category[$i] == "Phim Âm Nhạc") $list_category[$i] = 24;
		elseif ($list_category[$i] == "Phim TV-Show") $list_category[$i] = 31;
		elseif ($list_category[$i] == "Phim Chiếu Rạp") $list_category[$i] = 40;




			else $list_category[$i] = '';
		$thtml .= ','.$list_category[$i];
	}
	$category = $thtml;
?>