<?php
$html = xem_web($page);
$title = RemoveHtml(explode_by('<span class="title" itemprop="name">','</span>',$html));
$title_en = RemoveHtml(explode_by('<span class="real-name">','(', $html));
$director = RemoveHtml(explode_by('<dt>Đạo diễn:</dt>','</dd>',$html));
$actor = RemoveHtml(explode_by('<dt>Diễn viên:</dt>','</dd>',$html));
$year = RemoveHtml(explode_by('<dt>Năm sản xuất:</dt>','</dd>',$html));
$release_time = RemoveHtml(explode_by('<dt>Năm sản xuất:</dt>','</dd>',$html));
$duration = RemoveHtml(explode_by('<dt>Thời lượng:</dt>','</dd>',$html));
$contentt  = trim(RemoveHtml(explode_by('<div class="tab">','</div>',$html)));
$content = str_replace(array('Motphim.net', 'MotPhim'),'Xemlaco.tv',$contentt);
$thumb = RemoveHtml(explode_by('itemprop="thumbnailUrl" src="','"',$html));
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
		if ($list_category[$i] == "Phiêu Lưu - Hành Động") $list_category[$i] = 1;
		elseif ($list_category[$i] == "Phiêu Lưu - Hành Động") $list_category[$i] = 10;
		elseif ($list_category[$i] == "Kinh Dị - Ma") $list_category[$i] = 21;
		elseif ($list_category[$i] == "Khoa Học - Viễn Tưởng") $list_category[$i] = 7;
		elseif ($list_category[$i] == "Võ Thuật - Kiếm Hiệp") $list_category[$i] = 2;
		elseif ($list_category[$i] == "Hài Hước") $list_category[$i] = 6;
		elseif ($list_category[$i] == "Tâm Lý - Tình Cảm") $list_category[$i] = 13;
		elseif ($list_category[$i] == "Tâm Lý - Tình Cảm") $list_category[$i] = 3;
		elseif ($list_category[$i] == "Hoạt Hình") $list_category[$i] = 4;
		elseif ($list_category[$i] == "Anime") $list_category[$i] = 41;
		elseif ($list_category[$i] == "Hình Sự - Chiến Tranh") $list_category[$i] = 22;
		elseif ($list_category[$i] == "Cổ Trang - Thần Thoại") $list_category[$i] = 30;
		elseif ($list_category[$i] == "Cổ Trang - Thần Thoại") $list_category[$i] = 8;
		elseif ($list_category[$i] == "Hình Sự - Chiến Tranh") $list_category[$i] = 19;
		elseif ($list_category[$i] == "Tài Liệu - Khám Phá") $list_category[$i] = 18;
		elseif ($list_category[$i] == "Thể Thao - Âm Nhạc") $list_category[$i] = 24;
		elseif ($list_category[$i] == "TV Show") $list_category[$i] = 31;
		elseif ($list_category[$i] == "Phim Chiếu Rạp") $list_category[$i] = 40;
		elseif ($list_category[$i] == "Movie Trailers") $list_category[$i] = 42;




			else $list_category[$i] = '';
		$thtml .= ','.$list_category[$i];
	}
	$category = $thtml;
## tập phim
$linkplay = explode_by('<a class="btn-see btn btn-info adspruce-streamlink" href="','"',$html);
$linkb_phim = 'https://phimbathu.com'.$linkplay;
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
					              $get = curlGet('http://apidrive.net/film/phimbathu.php?k='.$_htmllinkplay[0]); 
                        $remove = str_replace('\/','/',$get);
                        preg_match_all('#"link_mp4":"https://drive.(.+?)/preview","quality":"(.+?)"#',$remove,$data);
                        $link1 = 'https://drive.'.$data[1][1].'/view';
                        if($data[1][1]) {$linktap = $link1;} else {
                        preg_match_all('#"link_mp4":"(.+?)","quality":"(.+?)"#',$remove,$datao);
                        $linktap = $datao[1][0]; 
                $getid = explode('driveid=',$linktap );
                $getid3 = explode('&' , $getid[1]);
                $id = 'https://drive.google.com/file/d/'.$getid3[0];
                        }
	$_Linkembed[$i] =  $id ; } else {
										    $get = curlGet('http://apidrive.net/film/phimbathu.php?k='.$linkb_phim); 
                        $remove = str_replace('\/','/',$get);
                        preg_match_all('#"link_mp4":"https://drive.(.+?)/preview","quality":"(.+?)"#',$remove,$data);
                        $link1 = 'https://drive.'.$data[1][1].'/view';
                        if($data[1][1]) {$linktap = $link1;} else {
                        preg_match_all('#"link_mp4":"(.+?)","quality":"(.+?)"#',$remove,$datao);
                        $linktap = $datao[1][0]; 
                $getid = explode('driveid=',$linktap );
                $getid3 = explode('&' , $getid[1]);
                $id = 'https://drive.google.com/file/d/'.$getid3[0];
                        }
					$_Linkembed[$i] =  $id ;
         $name[$i] = 'Full';
}
}
?>