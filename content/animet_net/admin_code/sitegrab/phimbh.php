<?php
$html = curlGet($page);
$title = RemoveHtml(explode_by('itemprop="name">','</p>',$html));
$title_en1 = RemoveHtml(explode_by('<p class="real-name"','</p>', $html));
$title_en = explode_by('>','(', $title_en1);
$director = RemoveHtml(explode_by('<dt>Đạo diễn:</dt>','</dd>',$html));
$actor = RemoveHtml(explode_by('<dt>Diễn viên:</dt>','</dd>',$html));
$year = explode_by('(',')', $title_en1);
$release_time = RemoveHtml(explode_by('<dt>Ngày xuất bản:</dt>','</dd>',$html));
$duration = RemoveHtml(explode_by('<dt>Thời lượng:</dt>','</dd>',$html));
$contentt  = trim(RemoveHtml(explode_by('<div class="tab">','</div>',$html)));
$content = str_replace(array('Phimbathu.com', 'PhimBatHu'),'Iphimhd.com',$contentt);
$thumb = RemoveHtml(explode_by('og:image" content="','"',$html));
	$quocgia = explode('<dt>Quốc gia:</dt>', $html);
	$quocgia = explode('</dd>', $quocgia[1]);
	$quocgia = trim(RemoveHtml($quocgia[0]));
if ($quocgia == "Mỹ") $countryid = 5;
elseif ($quocgia == "Anh") $countryid = 5;
elseif ($quocgia == "Pháp") $countryid = 5;
elseif ($quocgia == "Nhật Bản") $countryid = 4;
elseif ($quocgia == "Hàn Quốc") $countryid = 3;
elseif ($quocgia == "Hồng Kông") $countryid = 9;
elseif ($quocgia == "Việt Nam") $countryid = 1;
elseif ($quocgia == "Trung Quốc") $countryid = 2;
elseif ($quocgia == "Ấn Độ") $countryid = 10;
elseif ($quocgia == "Thái Lan") $countryid = 6;
elseif ($quocgia == "Khác") $countryid = 8;
	$country = $countryid;
	$info_theloai = explode('<dt>Thể loại:</dt>', $html);
	$info_theloai = explode('</dd>', $info_theloai[1]);
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
		elseif ($list_category[$i] == "Movie Trailers") $list_category[$i] = 42;




			else $list_category[$i] = '';
		$thtml .= ','.$list_category[$i];
	}
	$category = $thtml;
## tập phim
$linkplay = explode_by('<a class="btn-see btn btn-info adspruce-streamlink" href="','"',$html);
$linkb_phim = 'http://phimbathu.com'.$linkplay;
$htmllinkplay = curlGet($linkb_phim);
$htmllinkplay = explode_by('<div class="list-episode" id="list_episodes">',' </div>',$htmllinkplay);
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

	$_Linkembed[$i] =  $_htmllinkplay[0] ; 

    } 

	else {

	 $_Linkembed[$i] =  $linkb_phim ;
         $name[$i] = 'Full';
}
}
?>