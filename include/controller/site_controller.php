<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
class Site_Controller {
	public static function display($params) {
		$cururl = Url::curRequestURL();
		# Cache actor và phim
		//Film_Model::CacheActorSeatch();
		# Reset lượt xem
		Film_Model::ResetViewed();
		# Get info url
		$geturl = explode('/',$cururl);
		$mode = $geturl[1];
		// Phim và xem phim
		if(in_array($mode,array('phim','xem-phim'))) {
			$id = $geturl[2];
			$id = explode('-',$id);
			$id = $id[0];
			if($mode == 'phim') {
				$arr = MySql::dbselect('tb_film.id,tb_film.title,tb_film.thumb,tb_film.year,tb_film.big_image,tb_film_other.content,tb_film.title_en,tb_film_other.keywords,tb_film.director,tb_film.actor,tb_film.seotitle,tb_film.url301,tb_film.seodescription','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"id = '$id'");
				if ($arr[0][10]) {
                                                               $site_title = $arr[0][10] ;} 
                                                               else {
                                                               $site_title = 'Xem Phim '.$arr[0][1].' '.$arr[0][3].' | '.$arr[0][6].' full HD Vietsub';
                                                                 }                                             
				if($arr[0][12]){
					$site_description = $arr[0][12];
				}else{
					$site_description = str_replace('"', '',CutName(RemoveHtml(UnHtmlChars($arr[0][5])),200));
				}
				$site_keywords = FixTags($arr[0][7]);
				$filmid = intval($arr[0][0]);
				$meta_de = str_replace('"', '',CutName(RemoveHtml(UnHtmlChars($arr[0][5])),200));
				$epwatch = MySql::dbselect('id,name','episode',"filmid = '$filmid' AND active=1 order by id asc limit 1");
				$epname = $epwatch[0][1];
				$epwatch = $epwatch[0][0];
			}else if($mode == 'xem-phim') {
				$epid = MySql::dbselect('id,name,filmid,url,subtitle','episode',"id = '$id' AND active=1");
				$epwatch = intval($epid[0][0]);
				$epname = $epid[0][1];
				$filmid = intval($epid[0][2]);
				//MySql::dbupdate('film',"viewed = viewed+1, viewed_day = viewed_day+1, viewed_week = viewed_week+1, viewed_month = viewed_month+1","id = '$filmid'");
				$arr = MySql::dbselect('tb_film.id,tb_film.title,tb_film.thumb,tb_film.year,tb_film.big_image,tb_film_other.content,tb_film.title_en,tb_film_other.keywords,tb_film.filmlb','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"id = '$filmid'");
				if($arr[0][8]!=0){ $tentap = 'Tập '. substr(abs((int) filter_var($epname, FILTER_SANITIZE_NUMBER_INT)),0,3); } else {
					$tentap = 'Full HD';
				}
				if ($arr[0][10]) {
					$site_title = $arr[0][10] ;}
				else{
					$site_title = 'Xem Phim '.$arr[0][1].' '.$tentap.' - Phim '.$arr[0][6].' '.$tentap.' Vietsub Thuyết Minh';
				}
				
				$site_description = 'Xem Phim '.$arr[0][1].' '.$tentap.' | '.$arr[0][6].'  tập '.$epid[0][1].'. Phim '.$arr[0][1].' '.$tentap.' HD chất lượng cao.';
				$site_keywords = FixTags('Xem Phim '.$arr[0][1].' Tập '.$epid[0][1].', '.$arr[0][1].' Tập '.$epid[0][1].', '.$arr[0][6].' Ep '.$epid[0][1].', '.$arr[0][7]);
			}
			if(!$arr) header('Location: '.SITE_URL);
				if ($arr[0][11]) {
                $other_meta = '<meta http-equiv="refresh" content="0;url='.$arr[0][11].'">'; 
                 } 
                if ($arr[0][4]) {
					$other_meta .= '<meta property="og:image" content="'.$arr[0][4].'">';
				}
				else {
                    $other_meta .= '<meta property="og:image" content="'.$arr[0][2].'">';
                 }			
			$other_meta2 = '<link href="'.SITE_URL.$cururl.'" rel="canonical">';
			include View::TemplateView('film');
        }else if($mode == 'dien-vien') {
			$id = RemoveHack(str_replace('-',' ',urldecode($geturl[2])));
			
			$arr = MySql::dbselect("name,thumb,ngheNghiep,ngaySinh,quocGia,chieuCao,canNang,ngonNgu,soThich,gioiThieu,site_description,site_title","actor","name like '%$id%' order by id DESC limit 1");
			if ($arr[0][11] != "")  {
														   $site_title = $arr[0][11] ;} 
														   else {
														   $site_title = 'Thông tin chi tiết về diễn viên '.$id;
															 }                                             
			if($arr[0][12]){
				$site_description = $arr[0][10];
			}else{
				$site_description = str_replace('"', '',CutName(RemoveHtml(UnHtmlChars($arr[0][9])),200));
			}
			$site_keywords = FixTags($arr[0][0]);
			$meta_de = str_replace('"', '',CutName(RemoveHtml(UnHtmlChars($arr[0][10])),200));
			// $epwatch = MySql::dbselect('id,name','episode',"filmid = '$nameActor' order by id asc limit 1");
			// $epname = $epwatch[0][1];
			// $epwatch = $epwatch[0][0];
		
		if(!$arr) header('Location: '.SITE_URL.'/tim-kiem/'.$id);
			if ($arr[0][1]) {
				$other_meta .= '<meta property="og:image" content="'.$arr[0][2].'">';
			 }			
		$other_meta2 = '<link href="'.SITE_URL.$cururl.'" rel="canonical">';
		include View::TemplateView('actor');
	}
	else if($mode == 'tim-kiem-dien-vien') {
		$id = RemoveHack(str_replace('-',' ',urldecode($geturl[2])));
		$name = $id;
		$in = mb_strtolower($id, 'UTF-8');
		$ten = str_replace(" ","-",$in);
		$url_page = SITE_URL."/".$geturl[1]."/".$ten."";
		$site_title = head_site($name,'search_title');
		$site_description = head_site($name,'search_description');
		$site_keywords = head_site($name,'search_keywords');
		$sql = "(tb_film.actor like '%$id%' OR tb_film.director like '%$id%') AND active=1";
		include View::TemplateView('list');
	}
		// Trang danh sách
		else if(in_array($mode,array('tong-hop','the-loai','quoc-gia','tim-kiem','tag'))) {
			
			if($mode == 'the-loai') {
				$id = RemoveHack($geturl[2]);
				$arr = MySql::dbselect('id,name,seotitle','category',"name_seo = '$id'");
				$id = $arr[0][0];
				$catid = $id;
				$name = $arr[0][1];
				$seo = $arr[0][2];
				$url_page = Url::get(0,$name,'Thể loại');
                 if ($seo) {
                 $site_title = $seo;
                    } 
                 else {
				 $site_title = head_site($name,'category_title');
                                                                 }
				$site_title = head_site($name,'category_title');
				$site_description = head_site($name,'category_description');
				$site_keywords = head_site($name,'category_keywords');
				$sql = "tb_film.category like '%,$id,%' AND active=1";
			}else if($mode == 'quoc-gia') {
				$id = RemoveHack($geturl[2]);
				$arr = MySql::dbselect('id,name,seotitle','country',"name_seo = '$id'");
				$id = $arr[0][0];
				$couid = $id;
				$name = $arr[0][1];
				$seo = $arr[0][2];
				$url_page = Url::get(0,$name,'Quốc gia');
                                                                if ($seo) {
                                                                $site_title = $seo;
                                                                 } 
                                                               else {
				$site_title = head_site($name,'country_title');
                                                                }
				$site_description = head_site($name,'country_description');
				$site_keywords = head_site($name,'country_keywords');
				$sql = "tb_film.country = '$id' AND active=1";
			}else if(in_array($mode,array('tim-kiem','tag'))) {
				$id = RemoveHack(str_replace('-',' ',urldecode($geturl[2])));
				$keyActor = $id;
				$utf8 = array(
					'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
					'd'=>'đ|Đ',
					'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
					'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
					'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
					'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
					'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',);
						foreach($utf8 as $ascii=>$uni) $id = preg_replace("/($uni)/i",$ascii,$id);
				$name = $id;
				$in = mb_strtolower($id, 'UTF-8');
			    $ten = str_replace(" ","-",$in);
				$url_page = SITE_URL."/".$geturl[1]."/".$ten."";
				$site_title = head_site($name,'search_title');
				$site_description = head_site($name,'search_description');
				$site_keywords = head_site($name,'search_keywords');
				$sql = "(tb_film.title like '%$id%' OR tb_film.title_en like '%$id%' OR tb_film_other.searchs like '%$id%' OR tb_film_other.keywords like '%$id%' OR tb_film.actor like '%$keyActor%' OR tb_film.director like '%$keyActor%' OR tb_film.title_search like '%$id%' OR strcmp(soundex(title_search), soundex('$id')) = 0) AND active=1";
			}else if($mode == 'tong-hop') {
				$id = $geturl[2];
				if($id == 'phim-moi') {
					$name = 'Phim Mới';
					$url_page = Url::get(0,$name,'Tổng Hợp');
					$sql = "id != '0' AND active=1";
					$byorder = 'id';
					$site_title = "Danh sách Phim mới nhất năm 2019, danh sách phim mới hd hay nhiều thể loại";
					$site_description = "Danh sách phim mới hd được cập nhập liên tục, xem thỏa thích và không giới hạn, phim mới hay 2019.";
					$site_keywords = "Phim mới 2019, phim mới hay, phim mới tuyển chọn";
				}
				else if($id == 'phim-le') {
					$filmlb = $id;
					$name = 'Phim Lẻ';
					$url_page = Url::get(0,$name,'Tổng Hợp');
					$sql = "filmlb = '0' AND active=1";
					$site_title = "Phim lẻ Hay - Tổng Hợp Phim Lẻ mới nhất - phim lẻ vietsub - phim lẻ thuyết minh mới nhất";
					$site_description = "Danh sách phim lẻ hay nhiều thể loại, cập nhập liên tục tuyển chọn phim lẻ mới và hấp dẫn nhất.";
					$site_keywords = "Phim lẻ hay, phim lẻ tuyển chọn, phim lẻ 2019, phim lẻ mới";
				}
				else if($id == 'phim-hot') {
					$filmlb = $id;
					$name = 'Phim Hot';
					$url_page = Url::get(0,$name,'Tổng Hợp');
					$sql = "viewed > 0 AND active=1";
					$byorder = 'viewed';
					$site_title = "Tổng Hợp Phim hot nhất, phim hot thuyết minh, phim hot vietsub tuyển chọn mới nhất";
					$site_description = "Tổng Hợp Phim hot nhất, phim hot hay nhiều thể loại, cập nhập liên tục tuyển chọn phim hot và hấp dẫn nhất.";
					$site_keywords = "Phim hot nhất hay, xem nhiều nhất tuyển chọn, xem nhiều nhất 2019, xem nhiều nhất mới";
				}
				else if($id == 'phim-bo') {
					$filmlb = $id;
					$name = 'Phim Bộ';
					$url_page = Url::get(0,$name,'Tổng Hợp');
					$sql = "filmlb IN (1,2) AND active=1";
					$site_title = "Phim Bộ Hay Tổng Hợp Phim Bộ Mới chất lượng hd tuyển chọn, phim bộ hot nhất";
					$site_description = "Tổng Hợp Phim bộ hay, liên tục cập nhập và tuyển chọn phim bộ mới và hấp dẫn nhất.";
					$site_keywords = "Phim bộ hay, phim bộ tuyển chọn, phim bộ mới, phim bộ 2019";
				}
				else if(preg_match("#phim-nam-([0-9]+)#", $id, $yearurl)) {
					$getyear = $yearurl[1];
					$name = 'Năm '.$getyear;
					$url_page = Url::get(0,'Phim '.$name,'Tổng Hợp');
					$sql = "year = '$getyear' AND active=1";
					$site_title = "Phim $name mới nhất, Phim $name hay, Phim $name hot nhất";
					$site_description = "Danh sách phim $name mới nhất, phim $name hay chọn lọc, phim $name.";
					$site_keywords = "Phim $name, xem phim $name, phim hot $name, download phim $getyear";
				}
			}
			include View::TemplateView('list');
		}
		else if($mode == 'ajax') {
			$id = $geturl[2];
			$filmid = $geturl[3];
				if($id == 'movie_load_info') {				
				echo Film_Model::Tooltip($filmid);
				}
				else if($id == 'movie_rate_info') {
				echo Film_Model::LoadVotes($filmid);
				}
				else if($id == 'movie_update_view') {
					header("Content-type: application/json");
					$filmid = $_POST['id'];
					MySql::dbupdate('film',"viewed = viewed+1, viewed_day = viewed_day+1, viewed_week = viewed_week+1, viewed_month = viewed_month+1","id = '$filmid'");
				}
				else if($id == 'user_rating') {
					header("Content-type: application/json");
					$star = $_POST['score'];
					$filmid = $_POST['film'];
					echo Film_Model::Votes($filmid,$star);
				}
				else if($id == 'error') {
					$filmid = $_POST['film_id'];
					$epid = $_POST['episode_id'];
					echo Film_Model::Fav_Error($filmid,$epid);
				}
				else if($id == 'user_load_notify') {
					header("Content-type: application/json");
					$userid = $_SESSION["RK_Userid"];
					$arr = MySql::dbselect('nt_content,timeupdate','notice JOIN tb_user ON (tb_user.id = tb_notice.userid)',"userid='".$userid."' AND n_read=0 LIMIT 10");
					$total_mes = count($arr);
					if($total_mes){
						for($i=0;$i<count($arr);$i++) {
							$html .= '<li class="list"><a href="'.SITE_URL.'/user/notify" title="">'.$arr[$i][0].'</a></li>';
						}
					}else{
						$html .= '<li class="more"><a href="#" title="">Bạn không có thông báo nào.</a></li>';
					}
					$jsons = array('status'=>1,'message'=>'Success','notify_unread'=>$total_mes,'html'=>$html);
					echo json_encode($jsons);
				}
				else if($id == 'user_favorite') {
					header("Content-type: application/json");
					$filmid = $_POST['movie_id'];
					echo Film_Model::Fav_Playlist($filmid);
				}
				else if($id == 'suggest_search') {
					if($_POST['keysearch']){
					include View::TemplateView('functions');
					$q= $_POST['keysearch'];
					$id = htmlchars(urldecode(injection(mb_strtolower(utf8convert($q), 'UTF-8'))));
					$keyAccented = htmlchars(urldecode(injection(mb_strtolower($q, 'UTF-8'))));	
					$key =	str_replace(" ","-",injection(mb_strtolower(utf8convert($q), 'UTF-8')));				
					$arr = MySql::dbselect('tb_film.id,tb_film.title,tb_film.title_en,tb_film.thumb,tb_film.category,tb_film.year','film LEFT JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"(tb_film.title like '%$id%' OR tb_film.title_en like '%$id%' OR tb_film_other.searchs like '%$id%' OR tb_film_other.keywords like '%$id%' OR tb_film.actor like '%$keyAccented%' OR tb_film.director like '%$id%' OR tb_film.title_search like '%$id%' OR strcmp(soundex(title_search), soundex('$id')) = 0) AND active=1 LIMIT 8 ");
					$html .= '<div class="autocomplete-suggestion">Kết quả tìm kiếm cho từ khóa: <span>"'.$id.'"</span></div>';
					for($i=0;$i<count($arr);$i++) {
						$name = $arr[$i][1];
						$name_en = $arr[$i][2];
						$thumb = $arr[$i][3];
						$cat = $arr[$i][4];
						$year = $arr[$i][5];
						$url = Url::get($arr[$i][0],$name,'Phim');
						$html .= '<div class="autocomplete-suggestion">
<a class="clearfix" href="'.$url.'">
<div class="thumbnail"><img src="'.$thumb.'" ></div>
<div class="meta-item">
<div class="name-1">'.$name.'</div>
<h4 class="name-2">'.$name_en.' </h4>
</div>
</a>
</div>';
											}
					$html .= '<div class="autocomplete-suggestion"><a href="/tim-kiem/'.$key.'/" class="search-all">Tìm tất cả kết quả với từ '.$id.' </a></div>';
					echo $html;

					}
					
				}
				else if($id == 'load_login_status') { 
				header("Content-type: application/json");
				if($_SESSION["RK_Userid"]!=""){
					echo '{"status":1,"message":"Success","content":"  
<div class=\"dropdown pull-right ng-scope\" ng-if=\"authenticatedUser != null\">\n
				<a href=\"#\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" class=\"avata\">\n
					<img src=\"/assets/images/noimages.png\" height=\"32\" width=\"32\">\n 
				<\/a>
				<ul class=\"dropdown-menu top-caret\">\n
					
					<li><a href=\"'.SITE_URL.'\/user\/profile\"><i class=\"fa fa-user\"><\/i> Thông tin tài khoản<\/a><\/li>\n
					<li><a href=\"'.SITE_URL.'\/user\/movies\/favorite\">\n
                                         <i class=\"fa fa-film\"><\/i> Phim của bạn<\/a><\/li>\n
					<li><a href=\"'.SITE_URL.'\/user\/update\"><i class=\"fa fa-pencil\"><\/i> Đổi mật khẩu<\/a><\/li>\n
					<li><a href=\"'.SITE_URL.'\/logout\"><i class=\"fa fa-sign-out\"><\/i> Thoát<\/a><\/li>\n
				<\/ul>\n 
			<\/div>\n","is_login":1}';
				
				
				}else{
					echo '{"status":1,"message":"Success","content":"   
                        <a href=\"dang-nhap\" rel=\"nofollow\" class=\"btn btn-success btn-login\"\"> \n
                        <i class=\"sp-movie-icon-user\"><\/i> <span> Đăng nhập<\/span><\/a>\n","is_login":0}';
				}
				
				}
				else if($id == 'user_login') {
				header("Content-type: application/json");
				echo LoginAuth::loginUser($_POST['username'],$_POST['password']);
				}
				else if($id == 'user_register') {
				header("Content-type: application/json");
				echo LoginAuth::addUser($_POST['username'],$_POST['password'],$_POST['confirm_password'],$_POST['email']);
				}
				elseif($id == 'get_content_box'){
					$action = $_POST['key'];
					if($action == 'topview-today'){
						$sql = 'viewed_day!=0';
						$order = 'ORDER BY viewed_day DESC';
					}elseif($action == 'topview'){
						$sql = 'viewed!=0';
						$order = 'ORDER BY viewed DESC';
					}elseif($action == 'topview-week'){
						$sql = 'viewed_week!=0';
						$order = 'ORDER BY viewed_week DESC';
					}elseif($action == 'topview-month'){
						$sql = 'viewed_month!=0';
						$order = 'ORDER BY viewed_month DESC';
					}elseif($action == 'home-page-ple-1'){
						$sql = "tb_film.category like '%,1,%' AND tb_film.filmlb=0";
						$order = 'ORDER BY timeupdate DESC';
					}elseif($action == 'home-page-ple-2'){
						$sql = "tb_film.category like '%,4,%' AND tb_film.filmlb=0";
						$order = 'ORDER BY timeupdate DESC';
					}elseif($action == 'home-page-ple-3'){
						$sql = "tb_film.category like '%,6,%'";
						$order = 'ORDER BY timeupdate DESC';
					}elseif($action == 'home-page-ple-4'){
						$sql = "tb_film.category like '%,21,%'";
						$order = 'ORDER BY timeupdate DESC';
					}elseif($action == 'home-page-ple'){
						$sql = "filmlb = 0 && active = 1";
						$order = 'ORDER BY timeupdate DESC';
					}elseif($action == 'home-page-pbo-1'){
						$sql = "tb_film.country = '3' AND filmlb!=0";
						$order = 'ORDER BY timeupdate DESC';
					}elseif($action == 'home-page-pbo-3'){
						$sql = "tb_film.country = '5' AND filmlb!=0";
						$order = 'ORDER BY timeupdate DESC';
					}elseif($action == 'phim-bo'){
						$sql = "filmlb IN (1,2) AND active=1";
						$order = 'ORDER BY timeupdate DESC';
					}elseif($action == 'home-page-pbo-2'){
						$sql = "tb_film.country = '2' AND filmlb!=0";
						$order = 'ORDER BY timeupdate DESC';
					}elseif($action == 'gs-han-quoc'){
						$sql = "tb_film.category like '%,31,%' AND tb_film.country = '3'";
						$order = 'ORDER BY timeupdate DESC';
					}elseif($action == 'gs-trung-quoc'){
						$sql = "tb_film.category like '%,31,%' AND tb_film.country = '2'";
						$order = 'ORDER BY timeupdate DESC';
					}elseif($action == 'gs-viet-nam'){
						$sql = "tb_film.category like '%,31,%' AND tb_film.country = '1'";
						$order = 'ORDER BY timeupdate DESC';
					}elseif($action == 'gs-au-my'){
						$sql = "tb_film.category like '%,31,%' AND tb_film.country = '5'";
						$order = 'ORDER BY timeupdate DESC';
					}
					$arr = MySql::dbselect('tb_film.id,tb_film.title,tb_film.thumb,tb_film.year,tb_film.big_image,tb_film_other.content,tb_film.title_en,tb_film.duration,tb_film.quality,tb_film.thuyetminh,tb_film.filmlb,tb_film.category,tb_film.trailer,tb_film.viewed,tb_film.tinhtrang','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"$sql AND active=1 $order LIMIT 24");
					$html = '<div id="'.$action.'" class="block-items row fix-row">';
						for($i=0;$i<count($arr);$i++) {
							$id = $arr[$i][0];
							$name = $arr[$i][1];
							$name_en = $arr[$i][6];
							$name_en_cut = CutName($arr[$i][6],20);
							$name_cut = CutName($name,30);
							$url = Url::get($arr[$i][0],$name,'Phim');
							$thumb = $arr[$i][2];
							$thumb_big = $arr[$i][4];
							$duration = $arr[$i][7];
							$quality = $arr[$i][8];
							$thuyetminh = $arr[$i][9];
							$filmlb = $arr[$i][10];
							$year = $arr[$i][3];
							$cat = $arr[$i][11];
                            $view = $arr[$i][13];
                            $trangthai = $arr[$i][14];
                            $num = $i+1;
							$content = CutName(RemoveHtml(UnHtmlChars($arr[$i][5])),250);
							if($filmlb!=0){
								$types = 'phimbo';
							}
							if($quality) $quality = "$quality";
							$episode = MySql::dbselect('id,name','episode',"filmid = '$id' order by id desc limit 1");
							$epname = $episode[0][1];
							if($thuyetminh == 1){
								$phude = 'Thuyết Minh';
							}else{
								$phude = 'Vietsub';
							}
							//if($epname && $type == 'phimbo') $epnames = " Tập $epname";
							if(empty($duration) || empty($name_en)){
								$duration = "cập nhật";
								$name_en = "cập nhật";
							}else{


							}
							if(!$trangthai){
			                    if($filmlb!=0) {
						                        if ($episode) {
						                            {$epnames[$i] = "<span class=\"badge\">Tập ".substr(abs((int) filter_var($epname, FILTER_SANITIZE_NUMBER_INT)),0,3)."-$phude</span>";} 
						                        }
						                        else {
						                            $epnames[$i] = "<span class=\"badge\">Trailer - $phude</span>";
						                        }
						                     } else { $epnames[$i] = "<span class=\"badge\">$quality-$phude</span>";}
						        } else {
						            $epnames[$i] = "<span class=\"badge\">$trangthai</span>";
						        }	
							$html .= '<div class="item">
						                    <a class="inner" href="'.$url.'" title="'.$name.'-'.$name_en.'"> 
						                        <img src="'.$thumb.'" alt="'.$name.'-'.$name_en.'" class="movie-thumb" /> 
						                        <span class="thumb-icon"> <i class="sp-movie-icon-play"></i> </span> <span class="overlay"></span>
						                            <div class="description">
						                                <h3 class="text-nowrap">'.$name.'</h3>
						                                <div class="meta clearfix"> <span class="pull-left"> '.$year.' </span> <span class="pull-right">'.$duration.'</span></div>
						                        </div>
						                    </a>'.$epnames[$i].'
						                    
										</div>';       
								// 	$html .= '<div class="item">
								// 	<a class="inner" href="'.$url.'" title="'.$name.'-'.$name_en.'"> 
								// 		<img src="'.SITE_URL.'/anh-phim/300-450/bin/'.urlimg($thumb).'" alt="'.$name.'-'.$name_en.'" class="movie-thumb" /> 
								// 		<span class="thumb-icon"> <i class="sp-movie-icon-play"></i> </span> <span class="overlay"></span>
								// 			<div class="description">
								// 				<h3 class="text-nowrap">'.$name.'</h3>
								// 				<div class="meta clearfix"> <span class="pull-left"> '.$year.' </span> <span class="pull-right">'.$duration.'</span></div>
								// 		</div>
								// 	</a>'.$epnames[$i].'
									
								// </div>';    

						}
						$html .='</div>';
						$json = array('status'=>1,'message'=>'Success','content'=>$html,'type'=>$action);
						echo $html;					
				}
				elseif($id == 'ajax_view'){
					header("Content-type: application/json");
					$action = $geturl[3];
					if($action == 'ple-today'){
						$sql = 'viewed_day!=0 AND  tb_film.filmlb=0';
						$order = 'ORDER BY viewed_day DESC';
                                                                                                $type = '1';
					}elseif($action == 'ple-topview'){
						$sql = 'viewed!=0 AND tb_film.filmlb=0';
						$order = 'ORDER BY viewed DESC';
                                                                                                $type = '2';
					}elseif($action == 'ple-week'){
						$sql = 'viewed_week!=0 AND tb_film.filmlb=0';
						$order = 'ORDER BY viewed_week DESC';
                                                                                                $type = '3';
					}elseif($action == 'ple-month'){
						$sql = 'viewed_month!=0 AND tb_film.filmlb=0';
						$order = 'ORDER BY viewed_month DESC';
                                                                                                $type = '4';
					}
					if($action == 'pbo-today'){
						$sql = 'viewed_day!=0 AND  tb_film.filmlb!=0';
						$order = 'ORDER BY viewed_day DESC';
                                                                                                $type = '1';
					}elseif($action == 'pbo-topview'){
						$sql = 'viewed!=0 AND  tb_film.filmlb!=0';
						$order = 'ORDER BY viewed DESC';
                                                                                                $type = '2';
					}elseif($action == 'pbo-week'){
						$sql = 'viewed_week!=0 AND  tb_film.filmlb!=0';
						$order = 'ORDER BY viewed_week DESC';
                                                                                                $type = '3';
					}elseif($action == 'pbo-month'){
						$sql = 'viewed_month!=0 AND tb_film.filmlb!=0';
						$order = 'ORDER BY viewed_month DESC';
                                                                                                $type = '4';
					}
					$arr = MySql::dbselect('tb_film.id,tb_film.title,tb_film.thumb,tb_film.year,tb_film.big_image,tb_film_other.content,tb_film.title_en,tb_film.duration,tb_film.quality,tb_film.thuyetminh,tb_film.filmlb,tb_film.category,tb_film.trailer,tb_film.viewed,tb_film.viewed_day,tb_film.viewed_week,tb_film.viewed_month','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"$sql AND active=1 $order LIMIT 10");
						for($i=0;$i<count($arr);$i++) {
							$id = $arr[$i][0];
							$name = $arr[$i][1];
							$name_en = $arr[$i][6];
							$name_en_cut = CutName($arr[$i][6],20);
							$name_cut = CutName($name,30);
							$url = Url::get($arr[$i][0],$name,'Phim');
							$thumb = $arr[$i][2];
							$thumb_big = $arr[$i][4];
							$duration = $arr[$i][7];
							$quality = $arr[$i][8];
							$thuyetminh = $arr[$i][9];
							$filmlb = $arr[$i][10];
							$year = $arr[$i][3];
							$cat = $arr[$i][11];
                                                                                                                $view = $arr[$i][13];
                                                                                                               if($type == '1') {$viewed = $arr[$i][14];}
	                                                                                               else if($type == '2') {$viewed = $arr[$i][13];}
	                                                                                               else if($type == '3') {$viewed = $arr[$i][15];}
	                                                                                               else if($type == '4') {$viewed = $arr[$i][16];}
                                                                                                              if ($thumb_big ) {$bin = $thumb_big ;}
                                                                                                               else { $bin = $thumb;}
							$content = CutName(RemoveHtml(UnHtmlChars($arr[$i][5])),250);
							if($filmlb!=0){
								$types = 'phimbo';
							}
							if($quality) $quality = "$quality";
							$episode = MySql::dbselect('id,name','episode',"filmid = '$id' order by id desc limit 1");
							$epname = $episode[0][1];
							if($thuyetminh == 1){
								$phude = 'Thuyết Minh';
							}else{
								$phude = 'Vietsub';
							}
							//if($epname && $type == 'phimbo') $epnames = " Tập $epname";
							if(empty($duration) || empty($name_en)){
								$duration = "cập nhật";
								$name_en = "cập nhật";
							}else{


							}
							if($epname && $arr[$i][10] != '0') { $epnames[$i] = "<span class=\"esp\"><i>Tập ".substr(abs((int) filter_var($epname, FILTER_SANITIZE_NUMBER_INT)),0,3)."</i>-$phude</span>";
							}	
							$html .= '                                  <li class="item">
                        <div class="thumb-wrap">
                            <a class="thumb" title="" href="'.$url.'">
                                <img alt="'.$name.' - '.$name_en.'" src="'.SITE_URL.'/iphd.php?src='.$bin.'&h=165&w=300"/>
                                <span class="overlay"></span>
                            </a> 
                                                        <div class="meta">
                                <h3 class="H3title">
                                    <a href="'.$url.'">'.$name.'</a></h3>
                                <div class="explain"><span>'.$name_en.'</span></div>
                                <span class="count-view"><i></i>'.$viewed.'</span> 
                            </div>
                        </div>
                    </li>';
						}
						$json = array('status'=>1,'message'=>'Success','content'=>$html,'type'=>$action);
						echo json_encode($json);					
				}
				elseif($id == 'get_filter_box'){
					
					if($_REQUEST['cat']!=""){
						$cat = RemoveHack($_REQUEST['cat']);
						$sql .= "AND tb_film.category LIKE '%,$cat,%'";						
					}
					if($_REQUEST['country']!=""){
						$country = RemoveHack($_REQUEST['country']);
						$sql .= "AND tb_film.country = '$country'";						
					}
					if($_REQUEST['year']!=""){
						$year = RemoveHack($_REQUEST['year']);
						$sql .= "AND tb_film.year = '$year'";						
					}
					if($_REQUEST['quality']!=""){
						$qualityid = RemoveHack($_REQUEST['quality']);
						$sql .= " AND quality = '$qualityid'";						
					}
					if($_REQUEST['type']!=""){
						$gettype = RemoveHack($_REQUEST['type']);
						$sql .= " AND thuyetminh = '$gettype'";						
					}
					if($_REQUEST['byorder']!=""){
						$byorder = RemoveHack($_REQUEST['byorder']);
						if($byorder == 'timeupdate') $byorder = 'timeupdate';
				        else if($byorder == 'year') $byorder = 'year';
				        else if($byorder == 'title') $byorder = 'title';
				        else if($byorder == 'viewed') $byorder = 'viewed';
				        else $byorder = 'timeupdate';						
					}
					if($_REQUEST['filmlb']=="0"){						
						$sql .= "AND filmlb=0";						
					}
					if($_REQUEST['filmlb']=="1"){
						$sql .= "AND filmlb!=0";						
					}
					if($_REQUEST['hinhthuc']=="phim-le"){
						$sql .= "AND filmlb=0";	
					}
					if($_REQUEST['hinhthuc']=="phim-bo"){
						$sql .= "AND filmlb IN (1,2)";	
					}
					$page       =   RemoveHack($_REQUEST['page']);
					$num        =   '24';
					$num        =   intval($num);
					$page       =   intval($page);
					if (!$page)     $page = 1;
					$limit      =   ($page-1)*$num;
					if($limit<0)    $limit=0;
					$order = 'ORDER BY '.$byorder.' DESC';
                    if(!$byorder) $order = 'ORDER BY timeupdate DESC';
					$arr = MySql::dbselect('tb_film.id,tb_film.title,tb_film.thumb,tb_film.year,tb_film.big_image,tb_film_other.content,tb_film.title_en,tb_film.duration,tb_film.quality,tb_film.thuyetminh,tb_film.filmlb,tb_film.category,tb_film.trailer','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"1>0 $sql AND active=1 $order LIMIT $limit,$num");
					$total = MySql::dbselect('tb_film.id','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"active=1 $sql");
					$allpage_site = get_ajaxpage(count($total),$num,$page,'javascript:loc(');
					$html = '
                <div class="block-heading">
                    <h1 class="block-title"> <img class="ico" src="bintheme/images/movie.png">Danh Sách Phim Đã Lọc</h1></div> 
                <div class="block-content">
                    <div class="block-items row fix-row">';
						for($i=0;$i<count($arr);$i++) {
							$id = $arr[$i][0];
							$name = $arr[$i][1];
							$name_en = $arr[$i][6];
							$name_en_cut = CutName($arr[$i][6],20);
							$name_cut = CutName($name,30);
							$url = Url::get($arr[$i][0],$name,'Phim');
							$thumb = $arr[$i][2];
							$thumb_big = $arr[$i][4];
							$duration = $arr[$i][7];
							$quality = $arr[$i][8];
							$thuyetminh = $arr[$i][9];
							$filmlb = $arr[$i][10];
							$year = $arr[$i][3];
							$cat = $arr[$i][11];
							$content = CutName(RemoveHtml(UnHtmlChars($arr[$i][5])),250);
							if($filmlb!=0){
										$types = 'phimbo';
									}
							if($quality) $quality = "$quality";
							$episode = MySql::dbselect('id,name','episode',"filmid = '$id' order by id desc limit 1");
							$epname = $episode[0][1];
							if($thuyetminh == 1){
		                    $phude = 'Thuyết Minh';
		                    }elseif($thuyetminh == 2){
		                        $phude = 'Nosub';
		                    }elseif($thuyetminh == 3){
		                        $phude = 'Trailer';
		                    }else {
		                        $phude = 'Vietsub';
		                    }
							//if($epname && $type == 'phimbo') $epnames = " Tập $epname";
							if(empty($duration) || empty($name_en)){
								$duration = "cập nhật";
								$name_en = "cập nhật";
							}else{


							}
							if($epname && $types == 'phimbo') { $epnames = "<span class=\"badge\">Tập ". substr(abs((int) filter_var($epname, FILTER_SANITIZE_NUMBER_INT)),0,3)."-$phude</span>";
							} else {$epnames = "<span class=\"badge\">HD-$phude</span>";}	
							$html .= '<div id="film-'.$filmid.'" class="col-xlg-2 col-lg-15 col-md-3 col-sm-4 col-xs-6">
                <div class="item">
                    <a class="inner" href="'.$url.'" title="'.$name.' - '.$name_en.'"> 
                        <img src="'.$thumb.'" alt="'.$name.' - '.$name_en.'" class="movie-thumb" /> 
                        <span class="thumb-icon"> <i class="sp-movie-icon-play"></i> </span> <span class="overlay"></span>
                            <div class="description">
                                <h3 class="text-nowrap">'.$name.' </h3>
                                <div class="meta clearfix"> <span class="pull-left"> '.$year.' </span> <span class="pull-right">'.$duration.'</span></div>
                        </div> '.$epnames.'
                    </a>
                    
                </div>
			</div>';
					// $html .= '<div id="film-'.$filmid.'" class="col-xlg-2 col-lg-15 col-md-3 col-sm-4 col-xs-6">
					//     <div class="item">
					//         <a class="inner" href="'.$url.'" title="'.$name.' - '.$name_en.'"> 
					//             <img src="'.SITE_URL.'/anh-phim/218-320/bin/'.urlimg($thumb).'" alt="'.$name.' - '.$name_en.'" class="movie-thumb" /> 
					//             <span class="thumb-icon"> <i class="sp-movie-icon-play"></i> </span> <span class="overlay"></span>
					//                 <div class="description">
					//                     <h3 class="text-nowrap">'.$name.' </h3>
					//                     <div class="meta clearfix"> <span class="pull-left"> '.$year.' </span> <span class="pull-right">'.$duration.'</span></div>
					//             </div> '.$epnames.'
					//         </a>
							
					//     </div>
					// </div>';
						}
						$html .= '</div>
                    <div class="text-center">
                        <ul class=\'pagination\'>
'.$allpage_site.'
</ul>                    </div>
                </div>';
					echo $html;					
				}
		}
		// Trang thành viên
		else if($mode == 'user') {
			$userid = $geturl[2];
			$userid = explode('-',$userid);
			$userid = intval($userid[0]);
			if($geturl[2] == 'profile') {
				$site_title = 'Thông tin thành Viên';
			} else if($geturl[2] == 'update') {
				$site_title = 'Cập nhật thông tin';
				if($_SERVER['REQUEST_METHOD']=='POST'){		
					header("Content-type: application/json");
					echo LoginAuth::Edituser($_POST['fullname'],$_POST['facebook'],$_POST['old_password'],$_POST['new_password']);
					exit;
				}
			} else if($geturl[2] == 'billing') {
				$site_title = 'Cập nhật thông tin thanh toán';
				if($_SERVER['REQUEST_METHOD']=='POST'){		
					header("Content-type: application/json");
					echo LoginAuth::UpdateBilling($_POST['bank'],$_POST['fullname'],$_POST['bankid'],$_POST['diachi'],$_POST['phone'],$_POST['bank_brand']);
					exit;
				}
			} else if($geturl[2] == 'payment') {
				$site_title = 'Yêu cầu thanh toán';
				if($_SERVER['REQUEST_METHOD']=='POST'){		
					header("Content-type: application/json");
					echo LoginAuth::Payment($_POST['amount'],$_POST['payment']);
					exit;
				}
			}  else {
				$site_title = 'Thông tin thành Viên';
			}
			$site_description = Config_Model::ConfigName('site_description');
			$site_keywords = Config_Model::ConfigName('site_keywords');
			//if(IS_LOGIN && !$userid) header('Location: '.SITE_URL);
			include View::TemplateView('member');
		}
		else if($mode == 'logout') {
			echo LoginAuth::logoutUser();
		}
		// Bảng xếp hạng
		else if($mode == 'bang-xep-hang') {
			$site_title = 'Top phim hay chất lượng HD xem miễn phí và nhanh nhất';
			$site_description = "Phim hay tuyển chọn chất lượng cao, xem miễn phi không giới hạn, phim mới năm 2019";
			$site_keywords = Config_Model::ConfigName('site_keywords');
			include View::TemplateView('rank');
		}
		// Video và xem video
		else if($mode == 'video' || $mode == 'xem-video') {
			$id = $geturl[2];
			$id = explode('-',$id);
			$id = intval($id[0]);
			if(!$id) {
				$site_title = 'Tổng hợp clip vui cười, video hài hước nhất năm 2019';
				$site_description = "Tuyển chọn mới nhất Video vui cười, Clip hài hay nhất, xem Video hài cười, Clip vui độc quyền HOT 2019";
				$site_keywords = "video vui, clip cười, video hài hước, video vui cười";
				include View::TemplateView('listvideo');
			}else {
				$arr = MySql::dbselect('name,url,duration,thumb','media',"id = '$id'");
				if($arr) MySql::dbupdate('media',"viewed = viewed+1","id = '$id'");
				$name = $arr[0][0];
				$url = $arr[0][1];
				$duration = $arr[0][2];
				$thumb = $arr[0][3];
				$site_title = "$name";
				$site_description = Config_Model::ConfigName('site_description');
				$site_keywords = Config_Model::ConfigName('site_keywords');
				$urlvideo = SITE_URL.$cururl;
				$other_meta = '<meta property="og:image" content="'.$thumb.'">';
				$other_meta2 = '<link href="'.$urlvideo.'" rel="canonical">';
				include View::TemplateView('video');
			}
		}
		// Bài viết
		else if($mode == 'post') {
			$seotitle = $geturl[2];
			$arr = MySql::dbselect('id,title,content,thumb,timeupdate','news',"seotitle = '$seotitle'");
			$id = $arr[0][0];
			$title = $arr[0][1];
			$content = $arr[0][2];
		    $thumb = $arr[0][3];
		    $time = smartDate($arr[0][4],'H:i d/m/Y');
			$site_title = "$title";
		    $url = Url::get(0,$seotitle,'post');
			$site_description = Config_Model::ConfigName('site_description');
			$site_keywords = Config_Model::ConfigName('site_keywords');
		    $other_meta = '<meta property="og:image" content="'.$thumb.'">';
			include View::TemplateView('post');
		}
		else if($mode == 'tin-tuc') {
			$site_title = 'Tổng hợp tin tức phim mới nhất hay nhất cho bạn đọc';
			$site_description = "Tổng hợp các tin tức đó đây dành cho người xem phim";
			$site_keywords = Config_Model::ConfigName('site_keywords');
			include View::TemplateView('listnew');
		}
		else if($mode == 'live-tv') {
			parse_str(parse_url(Url::curRequestURL(),PHP_URL_QUERY), $data);
			$key = $data['k'];
			$id = $geturl[2];
			$id = explode('-',$id);
			$id = $id[0];
			if($key) {
				$site_title = 'Tìm kiếm kênh: '.$key;
				$sql = "symbol like '%$key%' OR name like '%$key%'";
			}else if($id) {
				$livetv = MySql::dbselect('id,symbol,name,quality,speed,viewed,content,linktv,thumb,lang','tv',"id = '$id'");
				if($livetv) MySql::dbupdate('tv',"viewed = viewed+1","id = '$id'");
				$symbol = $livetv[0][1];
				$site_title = "$symbol - Xem tivi online, kênh truyền hình trực tuyến";
				$type = '1';
				$other_meta = '<meta property="og:image" content="'.$livetv[0][8].'">';
				$other_meta2 = '<link href="'.SITE_URL.$cururl.'" rel="canonical">';
			}else {
				$site_title = 'Danh sách kênh tivi';
				$sql = 'id != 0';
			}
			$site_description = Config_Model::ConfigName('site_description');
			$site_keywords = Config_Model::ConfigName('site_keywords');
			include View::TemplateView('tv');
		}
		// Admincp
		else if($mode == ADMINCP_NAME) {
			include View::AdminView('badmin'); 
		}
		else if($mode == MEMBER_LOGIN) {
			include View::UploadView('dangnhap');
		}
		else if($mode == MEMBER_REG) {
			include View::UploadView('dangky');
		}
		else if($mode == 'dang-nhap-facebook') {
			include View::TemplateView('facebook');
		}
		else if($mode == 'quen-mat-khau') {
			include View::UploadView('forgot');
		}
		// Phần còn lại
		else if(!$mode) {
			$site_title = Config_Model::ConfigName('site_name');
			$site_description = Config_Model::ConfigName('site_description');
			$site_keywords = Config_Model::ConfigName('site_keywords');
			include View::TemplateView('home');
		}
		// Trang lỗi 404
		else {
			$site_title = 'Thông báo';
			$site_description = Config_Model::ConfigName('site_description');
			$site_keywords = Config_Model::ConfigName('site_keywords');
			include View::TemplateView('404');
		}
	}
}
