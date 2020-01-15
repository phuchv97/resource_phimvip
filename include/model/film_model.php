<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
class Film_Model {
	public static function get($id,$item) {
		$arr = MySql::dbselect("$item",'film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"id = '$id'");
		if($arr) return $arr[0][0];
	}
	
	public static function LoadVotes($filmid) {
				$filmid = intval($filmid);
				$arr = MySql::dbselect('total_votes,total_value','film',"id = '$filmid'");
				$Astar = $arr[0][1];
				$Bstar = $arr[0][0];
				$Cstar = ($Astar/$Bstar);
				$Cstar = number_format($Cstar,1);
				$err = $Cstar."/10 - $Bstar";
				$err = '<div id="movie-mark"></div>
<div class="clearfix"></div>
<script type="text/javascript">
    $(document).ready(function () {
        var $input = $(\'input.rating\'), count = Object.keys($input).length;
        if (count > 0) {
            $input.rating();
        }
    });
    $(\'#movie-mark\').raty({
    start: '.$Cstar.' 
    
    });
    $(\'input[name=rating]\').change(function () {
        if (is_login) {
            var mark = $(this).val();
            var movie_id = $(this).attr(\'movie-id\');
            $.ajax({
                url: base_url + \'ajax/user_rating\',
                method: \'POST\',
                data: {movie_id: movie_id, mark: mark},
                dataType: \'json\',
                success: function (data) {
                    if (data.status == 1) {
                        $(\'.mv-rating\').html(data.html);
                    }
                }
            })
        } else {
            $(\'#pop-login\').modal(\'show\');
        }
    });
</script>';
		return $err;
	}
	public static function Votes($filmid,$star) {
		 $userid = $_SESSION["RK_Userid"];
		 $filmid = intval($filmid);
		 $star = intval($star);
		if(!$userid) {
		  MySql::dbupdate('film',"total_votes = total_votes+1, total_value = total_value+'$star'","id = '$filmid'");
		  $err = '{"status":1,"message":"Da danh gia thanh cong"}';
		}
		else {
			$checkuser = MySql::dbselect("vote_star", "user", "id = '$userid' AND vote_star like '%|$filmid|%'");
			if($checkuser) $err = '{"status":0,"message":"Ban da danh gia phim nay roi"}';
			else {
				MySql::dbupdate('film',"total_votes = total_votes+1, total_value = total_value+'$star'","id = '$filmid'");
				$getuser = MySql::dbselect("vote_star", "user", "id = '$userid'");
				$fav_feature = "|$filmid|".$getuser[0][0];
				MySql::dbupdate('user',"vote_star = '$fav_feature'","id = '$userid'");
				$err = '{"status":1,"message":"Da danh gia thanh cong"}';
			}
		}
		return $err;

	}
	public static function Tooltip($filmid) {
		$filmid = intval($filmid);
		$film = MySql::dbselect("
				tb_film.title,
				tb_film.title_en,
				tb_film.category,
				tb_film.release_time,
				tb_film.timeupdate,
				tb_film.thumb,
				tb_film.country,
				tb_film.director,
				tb_film.actor,
				tb_film.year,
				tb_film.duration,
				tb_film.viewed,
				tb_film_other.content,
				tb_film_other.keywords,
				tb_film.total_votes,
				tb_film.total_value,
				tb_film.trailer,
				tb_film.quality,
				tb_film.thuyetminh
				",'film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"id = '$filmid'");
		$tenphim = $film[0][0];
		$tentienganh = $film[0][1];
		$trailer = $film[0][16];
		$chatluong = $film[0][17];
		if($trailer) $trailer = '<a href="'.$trailer.'" onclick="$.prettyPhoto.open(this.href);return false;"> Xem trailer </a>';
		$urlfilm = Url::get($filmid,$tenphim,'Phim');
		$year = CheckName($film[0][9]);
		$content = CutName(RemoveHtml(UnHtmlChars($film[0][12])),200);
		$Astar = $film[0][15];
		$Bstar = $film[0][14];
		$Cstar = ($Astar/$Bstar);
		$Dstar = number_format($Cstar,0);
		$Cstar = number_format($Cstar,1);
		$image_r = explode("<img ",UnHtmlChars($film[0][12]));
		preg_match('/src="([^"]+)"/', $image_r[1], $image);
		$image = $image[1];
		$thoiluong = $film[0][10];
		if(!$image) $image = $film[0][5];
		$country = $film[0][6];
		$country1  = MySql::dbselect("name", "country", "id = '" . $country . "'");
		for($i=0;$i<count($country1);$i++) {
			$name = $country1[$i][0];
			$url = Url::get(0,$name,'Quốc gia');
			$qg .= "<a href=\"$url\" title=\"Phim $name\">$name</a>";
		}
		$quocgia = $qg;
		$catlist = substr($film[0][2], 1);
		$catlist = substr($catlist, 0, -1);
		$category  = MySql::dbselect("name", "category", "id IN (" . $catlist . ")");
		for($i=0;$i<count($category);$i++) {
			$name = $category[$i][0];
			$url = Url::get(0,$name,'Thể Loại');
			$cat[] = "<a href=\"$url\" title=\"Phim $name\">$name</a>";
		}
		$theloai = @implode(", ",$cat);
		$thuyetminh = $film[0][18];
		if($thuyetminh == 1){
			$phude = 'Thuyết minh';
		}else{
			$phude = 'Vietsub';
		}
		$html = '<div class="jtip-quality">'.$chatluong.'</div>
<div class="jtip-top">
    <div class="jt-info jt-imdb">'.number_format($film[0][11]).'</div>
	<div class="jt-info">'.$phude.'</div>
    <div class="jt-info">'.$year.'</div>
    <div class="jt-info">'.$thoiluong.'</div>	
    <div class="clearfix"></div>
</div>
<p class="f-desc">'.$content.'</p>

    <div class="block">Quốc gia:
        '.$quocgia.'    </div>
    <div class="block">Thể loại:
        '.$theloai.'   </div>
   
<div class="jtip-bottom">
    <a href="'.$urlfilm.'"
       class="btn btn-block btn-success"><i
            class="fa fa-play-circle mr10"></i>Xem phim</a>
        <button onclick="favorite('.$filmid.',1)"
            class="btn btn-block btn-default mt10 btn-favorite-'.$filmid.' add-favorite">
        Yêu thích    </button>
</div>';
		
		return $html;
	}
	public static function Fav_Feature($filmid) {
		$userid = $_SESSION["RK_Userid"];
		$filmid = intval($filmid);
		if(!$userid) $err = 'user';
		else {
			$checkuser = MySql::dbselect("fav_feature", "user", "id = '$userid' AND fav_feature like '%|$filmid|%'");
			if($checkuser) $err = 'err';
			else {
				$getuser = MySql::dbselect("fav_feature", "user", "id = '$userid'");
				$fav_feature = "|$filmid|".$getuser[0][0];
				MySql::dbupdate('user',"fav_feature = '$fav_feature'","id = '$userid'");
				$err = '{"status":1,"message":"The film has been added to your favorite list."}';
			}
		}
		return $err;
	}
	public static function Fav_Playlist($filmid) {
		 $userid = $_SESSION["RK_Userid"];
		 $filmid = intval($filmid);
		if(!$userid) $err = '1';
		else {
			$checkuser = MySql::dbselect("fav_playlist", "user", "id = '$userid' AND fav_playlist like '%|$filmid|%'");
			if($checkuser) {
				$list = str_replace("|$filmid|",'',$checkuser[0][0]);
		        MySql::dbupdate('user',"fav_playlist = '$list'","id = '$userid'");
				$err = '2';
			}
			else {
				$getuser = MySql::dbselect("fav_playlist", "user", "id = '$userid'");
				$fav_feature = "|$filmid|".$getuser[0][0];
				MySql::dbupdate('user',"fav_playlist = '$fav_feature'","id = '$userid'");
				$err = '3';
			}
		}
		return $err;
	}
	public static function Fav_Error($filmid,$epid) {
		$id = intval($epid);
		$filmid = intval($filmid);
		if ($filmid) {
		$episode = MySql::dbselect('title,userpost','film',"id = '$filmid'");
		$filmname = $episode[0][0];
		$userid = $episode[0][1];
		$timeupdate = time();
		MySql::dbupdate('film',"error = '1'","id = '$filmid'");
		MySql::dbupdate('episode',"error = '1'","id = '$id'");
		Mysql::dbinsert('notice',"nt_content,userid,timeupdate","'Bạn đã được thông báo lỗi phim $filmname,Mời bạn kiểm tra lại. ID của tập lỗi là:$id','$userid','$timeupdate'");
		return 1;
		} else return 0;
		
	}
	public static function RK_Remove($filmid,$type) {
		$userid = $_SESSION["RK_Userid"];
		$filmid = intval($filmid);
		$getuser = MySql::dbselect("$type", "user", "id = '$userid'");
		$list = str_replace("|$filmid|",'',$getuser[0][0]);
		MySql::dbupdate('user',"$type = '$list'","id = '$userid'");
		return 1;
	}
	public static function ResetViewed() {
		if(timex('d')!= Config_Model::ConfigName('site_day')){
			MySql::dbupdate('film',"viewed_day = '0'","1>0");
			MySql::dbupdate('config',"config_content = '".timex('d')."'","config_name='site_day'");
		}
		if(timex('W')!= Config_Model::ConfigName('site_week')){
			MySql::dbupdate('film',"viewed_week = '0'","1>0");
			MySql::dbupdate('config',"config_content = '".timex('W')."'","config_name='site_week'");
		}
		if(timex('m')!= Config_Model::ConfigName('site_month')){
			MySql::dbupdate('film',"viewed_month = '0'","1>0");
			MySql::dbupdate('config',"config_content = '".timex('m')."'","config_name='site_month'");
		}
		return false;
	}
	
}
