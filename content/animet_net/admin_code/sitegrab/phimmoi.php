<?php
	function cURL($url, $postArray = array(), $setopt = array())
	{
		$opts = array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_FOLLOWLOCATION => false,
			CURLOPT_COOKIEFILE => $cookie,
			CURLOPT_COOKIEJAR => $cookie,
			CURLOPT_AUTOREFERER => true,
			CURLOPT_HEADER => false,
			CURLOPT_FRESH_CONNECT => true,
			CURLOPT_USERAGENT => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.52 Safari/537.36',
			CURLOPT_REFERER => $url
		);
		if(count($postArray) > 0 && $postArray != false){
			$postFields = array(
				'POST' => true, 
				'POSTFIELDS' => http_build_query($postArray),
				'REFERER' => $url
			);
			$setopt = array_merge($setopt, $postFields);
		}
		foreach($setopt as $key => $value){
			$opts[constant('CURLOPT_'.strtoupper($key))] = $value;
		}
		
		$s = curl_init();
		curl_setopt_array($s, $opts);
		$data = curl_exec($s);
		curl_close($s);
		@unlink($cookie);
		return $data;
	}
$html = cURL($page);
$title = RemoveHtml(explode_by('<span class="title-1">','</span>',$html));
$title_en = RemoveHtml(explode_by('<span class="title-2">','</span>', $html));
$director = RemoveHtml(explode_by('<dd class="movie-dd dd-director">','</dd>',$html));
$actor = RemoveHtml(explode_by('<span class="actor-name-a">','</span>',$html));
$year = RemoveHtml(explode_by('<dt class="movie-dt">Năm:</dt>','</dd>',$html));
$release_time = RemoveHtml(explode_by('<dt class="movie-dt">Năm:</dt>','</dd>',$html));
$duration = RemoveHtml(explode_by('<dt class="movie-dt">Thời lượng:</dt>','</dd>',$html));
$content  = trim(RemoveHtml(explode_by('"true"></div>','</div>',$html)));
$thumb = RemoveHtml(explode_by('"thumbnailUrl" src="','"',$html));
$big_image = RemoveHtml(explode_by("filmInfo.previewUrl='","'",$html));
$trailer = RemoveHtml(explode_by("filmInfo.trailerUrl='","'",$html));
	$quocgia = explode('<dt class="movie-dt">Quốc gia:</dt>', $html);
	$quocgia = explode(',', $quocgia[1]);
	$quocgia = trim(RemoveHtml($quocgia[0]));
                $quocgia =  trim(str_replace(",", "", $quocgia ));
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
	$info_theloai = explode('<dt class="movie-dt">Thể loại:</dt>', $html);
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
		elseif ($list_category[$i] == "Trailer phim mới") $list_category[$i] = 42;




			else $list_category[$i] = '';
		$thtml .= ','.$list_category[$i];
	}
	$category = $thtml;
## tập phim
preg_match('/<a id="btn-film-watch" class="btn btn-red" title="(.*)" href="(.*)">Xem phim<\/a>/', $html1, $ep);
$htmllinkplay = xem_web('http://www.phimmoi.net/'.$ep[2]);
$linkb_phim = 'http://www.phimmoi.net/'.$ep[2];
$htmllinkplay = explode_by('<div class="list-server">','</div><div class="block-tags">',$htmllinkplay);
$_playlink = explode('href="',$htmllinkplay);
$total_playlink = count($_playlink)-1;
if ($total_playlink>1){$filmlb=2;};
if($_GET['begin']) $begin = $_GET['begin'];
else $begin = 1;
if($_GET['end']) $total_playlink = $_GET['end'];
for($i=$begin;$i<=$total_playlink;$i++) {
	$name[$i] = RemoveHtml(explode_by('">','</a>',$_playlink[$i]));
                $_htmllinkplay  = explode('phim/',$_playlink[$i]);
	$_htmllinkplay = explode('"',$_htmllinkplay[1]);
                $_htmllinkplay = 'http://www.phimmoi.net/phim/'.$_htmllinkplay[0];
                if($htmllinkplay){
	$_Linkembed[$i] = $_htmllinkplay;
                  } else { 
                 $_Linkembed[$i] = $linkb_phim;
                 $name[$i] = 'Full';
         }
}
?>