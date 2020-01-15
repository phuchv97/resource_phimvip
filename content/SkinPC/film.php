<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
include View::TemplateView('header');
$film = MySql::dbselect("tb_film.title,tb_film.title_en,tb_film.category,tb_film.release_time,tb_film.timeupdate,tb_film.thumb,tb_film.country,tb_film.director,tb_film.actor,tb_film.year,tb_film.duration,tb_film.viewed,tb_film_other.content,tb_film_other.keywords,tb_film.total_votes,tb_film.total_value,tb_film.trailer,tb_film.big_image,tb_film.quality,tb_film.filmlb,tb_film.link_down,tb_film.userpost,tb_film.active,tb_film.title_search,tb_film.imdb,tb_film.lichchieu,tb_film.url,tb_film.thuyetminh,tb_film.banquyen,tb_film.tinhtrang",'film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"id = '$filmid'"); 
MySql::dbupdate('film',"viewed = viewed+1, viewed_day = viewed_day+1, viewed_week = viewed_week+1, viewed_month = viewed_month+1","id = '$filmid'");
$tenphim = $film[0][0];       
$tentienganh = $film[0][1];
$breadcrumb = breadcrumb_menu($film[0][2]);
if (!$film[0][26]) {
                        $urlfilm = get_url($filmid,$tenphim,'Phim');
                        $watchurl = get_url($epwatch,$tenphim,'Xem Phim');                        	
                        $biten = $film[0][0]; 
                        }
                        else {
                        $urlfilm = get_url($filmid,$film[0][26],'Phim'); 
                        $watchurl = get_url($epwatch,$film[0][26],'Xem Phim');                        	
                        $biten = $film[0][26];
                         }                         
$thuyetminh = $film[0][27]; 
        if($thuyetminh == 1){
            $phude = 'Thuyết Minh';
        }elseif($thuyetminh == 2){
            $phude = 'Nosub';
        }elseif($thuyetminh == 3){
            $phude = 'Trailer';
        }else {
            $phude = 'Vietsub';
        }
$banquyen = $film[0][28];
$big_thumb = $film[0][17];
$capnhat = date('Y-m-d',$film[0][4]).'T00:00:00+07:00';
$anhto = $film[0][17];
if(!$big_thumb) $big_thumb = SITE_URL.'/giaodien/images/bongngoview.png';
$phathanh = $film[0][3];
$thumb = $film[0][5];
if(!$thumb) $thumb = TEMPLATE_URL.'images/grey.jpg';
$theloai = category_a($film[0][2]);
$quocgia = country_a($film[0][6]);
$genre = category_ad($film[0][2]);
$country = country_a($film[0][6]);
$daodien_a = CheckName($film[0][7]);	
$urldaodien = get_url('',$daodien_a,'search');
$daodien = Get_List_director($film[0][7]);
$dienvien = Get_List_actor($film[0][8]);
$dienvien2 = Get_List_actor2($film[0][8]);
$year = CheckName($film[0][9]);
$duration = CheckName($film[0][10]);
$viewed = $film[0][11];
$loaiphim = $film[0][19];
$content = $film[0][12];
$cutcontent = RemoveHtml(CutName($content,300));
$tags = GetTag_a($film[0][13],2);
$image_r = explode("<img ",UnHtmlChars($film[0][12]));
if($film[0][14] != 0){
	$Bstar = $film[0][14];
} else { $Bstar = '1';}
if($film[0][15] != 0){
	$Astar = $film[0][15];
} else { $Astar = '10';}
$Cstar = ($Astar/$Bstar);
$Dstar = number_format($Cstar,0);
$Cstar = number_format($Cstar,1);
for($i=1;$i<count($image_r);$i++) {
	preg_match('/src="([^"]+)"/', $image_r[$i], $image);
	$image = $image[1];
	$image_all .= "<img src=\"$image\" alt=\"$tenphim - $tentienganh\" width=\"600px\"/>";
}
for($i=1;$i<11;$i++) {
	$votes .= "<div class=\"vote-line-hv\" data-id=\"$i\"></div>";
}
if(!$film[0][16]) $tl = config_site('trailer');
else $tl = $film[0][16];
$tl1 = explode('watch?v=',$tl);
$trailer = $tl1[1];
$quality = $film[0][18];
$imdb = $film[0][24];
$lichchieu = $film[0][25];
$episodeid = $epid[0][3];
$epurl = $epid[0][3];
$epsubtitle = $epid[0][4];
$tentap = 'Tập '.$epid[0][1];
$fb = config_site('facebook_url');
if($film[0][29]){
  $trangthai = $film[0][29];
} else {
    $trangthai = $quality.' '.$phude;
}
?> 
<?php if($mode == 'xem-phim') {    
$key = $id;    
$file = $filmid;
$cachefile = CACHE_ADD.'/film/'.$file.'-'.$key.'.html';
$cachetime = 1200;
if (file_exists($cachefile) && time() - $cachetime < filemtime($cachefile)) {
include($cachefile);
exit;
}
ob_start();     
if (!$_SESSION["RK_Userid"]) {
$tuphim = 'Thêm vào tủ phim';
}
else {
$userid = $_SESSION["RK_Userid"];
$checkuser = MySql::dbselect("fav_playlist", "user", "id = '$userid' AND fav_playlist like '%|$filmid|%'");
  if(!$checkuser){
    $tuphim = 'Thêm vào tủ phim';
  } else {
    $tuphim = 'Xóa khỏi tủ phim';
  }
}
  ?> 
<div class="body"> 
<style>
.jw-rightclick { display: none !important; }
.jw-progress {
            background-color: #ba400e!important;
 }
 .jw-icon-rewind
 {
     display:none!important;
 }
.jw-time-tip::after, .jw-controlbar .jw-tooltip::after, .jw-settings-menu .jw-tooltip::after {
    background-color: #000000!important;
}

.jw-time-tip .jw-text, .jw-controlbar .jw-tooltip .jw-text, .jw-settings-menu .jw-tooltip .jw-text {
    background-color: #000000!important;
    color: #fdfdfd!important;
}
.jw-skin-seven .jw-background-color {
    background-color: rgba(0, 0, 0, .6) !important;
    font-size: 16px!important;
    text-shadow: 1px 1px 2px #000;
}
.jw-skin-seven .jw-text-duration {
    color: #fff !important
}
.jw-slider-time.jw-background-color {
    background: 0 0 !important
}
.jw-skin-seven .jw-rail {
    background: #666f82 !important
}
.jw-skin-seven .jw-buffer {
    background: #000 !important
}
@media (min-width: 1200px) {
    .jwplayer.jw-flag-aspect-mode {
    height: 500px !important;
    }
}
</style> 
<script>   
                var filmInfo = {};
                filmInfo.episodeID = parseInt('<?=$id?>');
                filmInfo.filmID = parseInt('<?=$filmid?>');
</script>
<script src="<?php echo SITE_URL;?>/bintheme/js/phimvip.public.js?v=1.1" type="text/javascript"></script>   
<section id="content">
    <div class="container-fluid clearfix">
    <div class="ads ads-floating ads-floating-left">
  </div>
        <div class="container-wrapper">
            <ul class="breadcrumb clearfix" xmlns:v="https://rdf.data-vocabulary.org/#">
                <li typeof="v:Breadcrumb"><a href="/" property="v:title" rel="v:url" title="Xem Phim Online HD"> <i class="fa fa-home"></i> Xem phim</a></li>
                                <?=$breadcrumb?>
                <li itemscope="" itemtype="https://data-vocabulary.org/Breadcrumb"><a title="<?=$tenphim?>" itemprop="url" href="<?php echo $urlfilm;?>"><span itemprop="title"><?=$tenphim?></span></a></li>
                <li><span itemprop="title" title="Xem phim">Xem phim</span></li>
            </ul>
        </div>
<div id="zoomPlayer"></div>
<div class="column-with-300">
<div id="normalPlayer">
<div id="pl-content">
            <div class="player-wrapper">
                <div class="player-container">
                    <div class="embed-responsive embed-responsive-16by9 sixteen-nine">
                        <div class="embed-responsive-item">      
                <div id="media-player-box">
                        <?php 
                      if($banquyen!='1'){ 
                        echo '<script type="text/javascript">
                        $(document).ready(function(){ binplay('.$id.'); });</script>';
                         }
                        else {
                        echo '<img src="/banquyen.png" alt="ban quyen phim '.$tenphim.'" >';
                       } 
                      ?>
                </div>
<div class="box_loading_player" style="display: none;"></div>
                        </div>
                    </div>                              
                    <div class="mt clearfix">               
<div class="pull-left">
<div id="lightOff" style="display: none;"></div>
<a class="btn btn-default btn-rounded btn-yellow" title="Tắt đèn" href="javascript:();" id="lightBtn"><i class="fa fa-lightbulb-o"></i> Tắt đèn</a>
<a style="margin-left:5px;" class="btn btn-default btn-rounded btn-yellow" title="Tải phim" href="javascript:();" onclick="downloadFilm(<?=$filmid?>);"><i class="fa fa-cloud-download"></i> Tải phim</a>
<a style="margin-left:5px;" class="btn btn-default btn-rounded btn-yellow" onclick="ZoomToggle();" id="zoomBtn" ><i class="fa fa-arrows-h"></i> Phóng to</a>
<a style="margin-left:5px;" class="btn btn-default btn-rounded btn-yellow" onclick="closeADS();"><i class="fa fa-times"></i> Tắt quảng cáo</a>
<a style="margin-left:5px;" class="btn btn-default btn-rounded btn-yellow bp-btn-error" id="btn-toggle-error" title="Báo lỗi phim <?=$tenphim?> - <?=$tentienganh?>" href="javascript:void(0)"><i class="fa fa-warning"></i> Báo lỗi</a>
<a style="margin-left:5px;" class="btn btn-default btn-rounded btn-yellow add-favorite"  href="javascript:void(0)" title="Thêm vào hộp" id="btn-add-favorite"><i class="fa fa-plus"></i> <span class="btn-text"><?=$tuphim?></span></a>
</div>
                        <div class="pull-right fb-share-player">
                              <div class="fb-save" data-uri="<?php echo $urlfilm;?>" data-size="small"></div>
                              <div class="fb-send" data-href="<?php echo $urlfilm;?>" data-layout="button_count"></div>
                              <div class="fb-like fb_iframe_widget" data-href="<?php echo $urlfilm;?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                        </div>
                    </div>
                </div> </div> 
<?if($lichchieu){?>

<div class="block mt-xl">
                <div class="block-content-alert">
                <div class="block-heading">
                    <h2 class="block-title weight-normal text-blue"> <i class="sp-movie-icon-book"></i>&nbsp;&nbsp;Lịch chiếu phim</h2>
                </div> 
                    <div class="page-content mt">
                        <p><?php echo $lichchieu; ?></p>                    
                    </div>
                </div>
            </div>
<?}?>
<div class="list-servers">
                <div class="block-heading">
                    <h2 class="block-title weight-normal text-blue"> <i class="fa fa-film"></i>&nbsp;&nbsp; <a href="<?php echo $urlfilm;?>"><?=$tenphim?> <?=$tentap?></a></h2> 
                <div class="box-rating" style="margin-top:5px;">
                            <input id="hint_current" type="hidden" value="">
                            <input id="score_current" type="hidden" value="<?=$Dstar?>">
                            <span class="text">Đánh giá phim (<?=$Dstar?>đ / <?=$Bstar?> lượt)</span>
                            <div id="star" data-score="<?=$Dstar?>" style="cursor: pointer;"></div><span id="hint"></span>
                            <meta itempop="uploadDate" content="<?=$capnhat?>" />
                            <img class="hidden" itemprop="thumbnailUrl" src="<?=$thumb?>" alt="<?=$tenphim."-".$tentienganh?>">
                            <img class="hidden" itemprop="image" src="<?=$thumb?>" alt="<?=$tenphim."-".$tentienganh?>">
                            <span class="hidden" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
			                <span itemprop="ratingValue"><?=$Dstar?></span>
			                <meta itemprop="ratingcount" content="<?=$Bstar?>">
			                <meta itemprop="bestRating" content="10"/>
			                <meta itemprop="worstRating" content="1"/>
                 </span>
                        </div> 
                </div> 
<?php 
echo list_episode($filmid,$tenphim,$id);
?> 
</div>             
</div></div> 
<div class="movie-info clearfix" style="margin-top:0;">
                <div id="before-watching"><div id="watching">
                    <div class="block mt-xl" id="block-download" style="display:none">
                        <div class="block-heading">
                            <h2 class="block-title weight-normal text-blue"> <i class="fa fa-cloud-download"></i>&nbsp;&nbsp;Tải phim <?php echo $tenphim; ?></h2>
                        </div>
                        <div class="block-content">
                            <div class="page-content mt">
                                <div class="content" id="download-link-list">
                                <div class="alert alert-teal" style="line-height:25px;">Để <b>tải phim <?php echo $tenphim; ?></b> về máy, bạn hãy nhấn vào hình download bên góc phải của trình xem phim. Hãy nhớ bật HD trước khi tải để được chất lượng tốt nhất.</div>
                                </div>
                            </div>
                        </div>  
                        <br><br>
                    </div>
                    <div id="fb-comment-before-watching">
			<div id="fb-comment-watching">
                    <div class="block mt-xl">
                                                                                              <div class="block-heading">
                        <h4 class="block-title weight-normal text-pink"> <i class="sp-movie-icon-user-review"></i>&nbsp;&nbsp;Bình luận</h4>
                                                                                              </div>
            <div class="alert alert-teal">
                <p> Các Bạn chú ý: Các bạn không nên nhấp vào các đường link ở phần bình luận, kẻ gian có thể đưa virut vào thiết bị hoặc hack mất facebook của các bạn. Thanks !!!</p>
            </div>
                        <div class="block-content pt">
                        <div class="fb-comments" data-href="<?php echo $urlfilm;?>" data-width="100%" data-num-posts="5" data-colorscheme="dark"></div>
                        </div>
                    </div>
                    </div></div>
                    <div id="hidden-download">
                                        <div class="block mt-xl">
                        <h3 class="block-title weight-normal text-pink"> <i class="fa fa-tag"></i>&nbsp;&nbsp;Tags</h3>
                        <div class="block-content block-tag pt">
                            <p><?=$tags?></p>
                        </div>
                    </div>
                    
                    <div class="block mt-xl">
                        <h4 class="block-title weight-normal text-pink"> <i class="sp-movie-icon-user-review text-pink"></i>&nbsp;&nbsp;Phim liên quan</h4>
                        <div class="block-content pt">
                            <div id="recoment-films" class="block-items row fix-row">           
<?php echo li_film1('category',12,$film[0][2]);?>           
                 
                            </div>
                        </div>
                    </div>
                    </div>
                    </div></div>

            </div>      
</div>

<div class="right-sidebar column-300 ">
        <div class="block">
        <div class="block-heading" style="border: none;">
            <h2 class="block-title"> <i class="fa fa-star"></i> Trending Phim Lẻ</h2></div>
        <div class="box-asian-tabs tab-remote">
            <ul class="nav nav-tabs nav-justified" role="tablist">
                <li role="presentation" class="active">
                    <a href="javascript:();" data-block="home-page-ple-viewsd" data-toggle="tab" class="ph top-day-ple"> <i class="fa fa-hand-o-right"></i> Top Ngày </a>
                </li>
                <li role="presentation">
                    <a href="javascript:();" data-block="home-page-ple-viewsw" data-toggle="tab" class="ph"> <i class="fa fa-hand-o-right"></i> Top Tuần </a>
                </li>
                <li role="presentation">
                    <a href="javascript:();" data-block="home-page-ple-viewsm" data-toggle="tab" class="ph"> <i class="fa fa-hand-o-right"></i> Top Tháng </a>
                </li>
            </ul>
<div class="tab-content p-none" style="position: static; zoom: 1;">
<div class="home-page-ple-viewsd" id="owl-slide">
<ul class="list-group list-group-movie clearfix">
<?php echo bxh_show("phimle","day");?>
</ul>
</div>
<div class="home-page-ple-viewsw hidden" id="owl-slide">
<ul class="list-group list-group-movie clearfix">
<?php echo bxh_show("phimle","week");?>
</ul>
</div>
<div class="home-page-ple-viewsm hidden" id="owl-slide">
<ul class="list-group list-group-movie clearfix">
<?php echo bxh_show("phimle","month");?>
</ul></div></div>
        </div>
    </div>
      <div class="block">
        <div class="block-heading" style="border: none;">
            <h2 class="block-title"> <i class="fa fa-star"></i> Trending Phim Bộ</h2></div>
        <div class="box-asian-tabs tab-remote">
            <ul class="nav nav-tabs nav-justified" role="tablist">
                <li role="presentation" class="active">
                    <a href="javascript:();" data-block="home-page-pbo-viewsd" data-toggle="tab" class="ph top-day-ple"> <i class="fa fa-hand-o-right"></i> Top Ngày </a>
                </li>
                <li role="presentation">
                    <a href="javascript:();" data-block="home-page-pbo-viewsw" data-toggle="tab" class="ph"> <i class="fa fa-hand-o-right"></i> Top Tuần </a>
                </li>
                <li role="presentation">
                    <a href="javascript:();" data-block="home-page-pbo-viewsm" data-toggle="tab" class="ph"> <i class="fa fa-hand-o-right"></i> Top Tháng </a>
                </li>
            </ul>
<div class="tab-content p-none" style="position: static; zoom: 1;">
<div class="home-page-pbo-viewsd" id="owl-slide">
<ul class="list-group list-group-movie clearfix">
<?php echo bxh_show("phimbo","day");?>
</ul>
</div>
<div class="home-page-pbo-viewsw hidden" id="owl-slide">
<ul class="list-group list-group-movie clearfix">
<?php echo bxh_show("phimbo","week");?>
</ul>
</div>
<div class="home-page-pbo-viewsm hidden" id="owl-slide">
<ul class="list-group list-group-movie clearfix">
<?php echo bxh_show("phimbo","month");?>
</ul></div></div>
        </div>
    </div>
<div class="block mt-xl">
        <div class="block-heading">
            <h2 class="block-title"> <i class="fa fa-tags"></i> Tag cloud</h2></div>
        <div class="block-content btn-group-tag bin-bg">
                            <?php echo config_site('site_keyword');?>           
        </div>
    </div>
</div>      <div class="ads ads-floating ads-floating-right"></div>
    </div></section>
<?php
}else{ 
$file = $filmid;
$cachefile = CACHE_ADD.'/film/cached-'.$file.'.html';
$cachetime = 18000;
if (file_exists($cachefile) && time() - $cachetime < filemtime($cachefile)) {
include($cachefile);
exit;
}
ob_start();  
?>
<script type="text/javascript">
        $(document).ready(function() {      
                    });
    </script>
    <input type="hidden" id="episodeName" type="text">
    <section id="content">
    <div class="container-fluid clearfix">
    <div class="ads ads-floating ads-floating-left"></div>
        <div class="container-wrapper">
            <ul class="breadcrumb clearfix" xmlns:v="https://rdf.data-vocabulary.org/#">
                <li typeof="v:Breadcrumb"><a href="/" property="v:title" rel="v:url" title="Xem Phim Online HD"> <i class="fa fa-home"></i> Xem phim</a></li>
                                <?=$breadcrumb?>
                <li itemscope="" itemtype="https://data-vocabulary.org/Breadcrumb"><a title="<?=$tenphim?>" itemprop="url" href="<?php echo $urlfilm;?>"><span itemprop="title"><?=$tenphim?></span></a></li>
                <li><span itemprop="title" title="Xem phim">Xem phim</span></li>
            </ul>
        </div>
        <div class="column-with-300">
            <div class="movie-banner">
                <div class="movie-banner-src" style="background-image:url(https://phimvip.com/anh-phim/1289-560/bin/<?=urlimg($big_thumb)?>)"></div>
                <div class="icon-play">
                    <?php 
              if ($epwatch) {
              echo '<a href="'.$watchurl.'" title="Xem phim '.$tenphim.'-'.$tentienganh.'"> <i class="sp-movie-icon-play"></i> </a>' ;
                     } else {
              echo '<a href="javascript:toastr.info(\'Phim Này Mới Chỉ Có Trailer Mời Bạn Quay Lại Sau Hoặc Thông Báo Cho Admin Qua Fanpage Của PhimVip\')" class="cover-overlay"></a>';
                     
                    }
               ?>
                
                </div>
            </div>      
            <div class="movie-info clearfix" itemscope itemtype="https://schema.org/TVSeries">
                <div id="before-watching"></div>
                <div class="column-300 pull-left pl-xxl">
                    <div class="thumbnail mb-none"> <img class="info-poster-img" data-id="<?=$filmid?>" data-name="<?=$tenphim."-".$tentienganh?>" itemprop="image" src="https://phimvip.com/anh-phim/218-320/bin/<?=urlimg($thumb)?>" alt="<?=$tenphim."-".$tentienganh?>" /></div>
                                                                               <div class="button-play">
              <?php 
              if ($epwatch) {
              echo '<a class="btn btn-red btn-rounded" title="Xem Phim '.$tenphim.'" href="'.$watchurl.'"><i class="sp-movie-icon-camera"></i> Xem Phim</a>' ;
                     }
               ?>
                    <a class="btn btn-blue btn-rounded" title="Xem Phim <?=$tenphim?>" href="javascript:trailer()"><i class="sp-movie-icon-camera"></i> Trailer</a>
                    </div>
                    <div class="block mt-xl">
                        <div class="weight-normal font-24"> <i class="sp-movie-icon-film"></i> Thông tin</div>
                        <div class="block-content movie-info-sidebar bin-bg">
                            <ul class="list-style-none list-inline"> 
                            <li class="common-list"> <span> Trạng Thái:</span> <font color="red"><?=$trangthai?></font></li>
                            <li class="common-list"> <span> Thể loại:</span> <?php echo $theloai; ?></li>
                            <li class="common-list"> <span> Năm phát hành:</span> <?php echo $year;?></li>
                            </li>
                            <li class="common-list"> <span> Đạo diễn:</span><span itemprop="director"> <?php echo $daodien; ?></span></li>
                            <li class="common-list"> <span> Thời lượng:</span> <?php echo $duration;  ?></li>
                            <li class="common-list"> <span> Upload by: </span><span itemprop="author"><?php echo username($film[0][21]);?></span></li>
                            <li class="common-list"> <span> Lượt xem:</span> <?php echo $viewed; ?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="ads ads-info-left">
                        <?php echo binads('site_ads8');?>
                    </div>
                </div>
                <div class="column-with-300 pull-right">
                    <div class="movie-info-top">
                        <h1 class="movie-title text-nowrap" itemprop="name"><?php echo $tenphim; ?> </h1>
                        <h2 class="movie-subtitle" itemprop="name"><?php echo $tentienganh; ?> (<?php echo $year;?>)</h2>
                        <div class="movie-rating">
                            <input id="hint_current" type="hidden" value="">
                            <input id="score_current" type="hidden" value="<?=$Dstar?>">
                            <div id="star" data-score="<?=$Dstar?>" style="cursor: pointer;width: auto;"></div><span id="hint"></span>
                            <meta itempop="uploadDate" content="<?=$capnhat?>" />
                            <meta itemprop="description" content="<?=$cutcontent?>" />
                            <img class="hidden" itemprop="thumbnailUrl" src="<?=$thumb?>" alt="<?=$tenphim."-".$tentienganh?>">
                            <img class="hidden" itemprop="image" src="<?=$thumb?>" alt="<?=$tenphim."-".$tentienganh?>">
                            <div class="rate-star" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating"> 
                            <i class="sp-movie-icon-star-line"></i>
                            <span itemprop="ratingValue"><?=$Dstar?></span>
							<meta itemprop="ratingcount" content="<?=$Bstar?>">
							<meta itemprop="bestRating" content="10"/>
							<meta itemprop="worstRating" content="1"/>
							</div>
                        </div>
                        <div class="movie-social-icon">
                            <ul>
                            <li>
                                <a class="facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $urlfilm;?>" target="_blank"> <i class="sp-movie-icon-facebook"></i> </a>
                            </li>
                            <li>
                                <a class="twitter" href="https://twitter.com/home?status=<?php echo $urlfilm;?>" target="_blank"> <i class="sp-movie-icon-twitter"></i> </a>
                            </li>
                            </ul>
                        </div>
                    </div>
                    <div id="fb-comment-before-watching"></div>
                    <div id="hidden-download">
                    <div class="block mt-xl">
                        <div class="block-heading">
                            <h2 class="block-title weight-normal text-blue"> <i class="sp-movie-icon-book"></i>&nbsp&nbspGiới thiệu</h2>
                            <div class="fb-share" style="position: absolute;top:0;right: 0;">
                            <div class="fb-like" data-href="<?php echo $urlfilm;?>" data-layout="button_count" data-action="like" data-size="large" data-show-faces="true" data-share="true"></div>
                            </div>
                        </div>
                        <div class="block-content bin-bg">
                            <div class="page-content mt"> 
                                <?
                                  $output = strip_tags(nl2br($content), '<a><h1><img><b><strong><br>');
                                  echo $output;?>            
                           <?php if($loaiphim != 0){ ?>
                            <p><span>Dưới đây là danh sách các tập mới nhất của phim <?=$tenphim?>:</span></p>
                              <?php echo listtap($filmid,$biten,$tenphim); ?>  
                          <?php } else { ?>  
                          <div class="gg-like" style="margin-top: 10px;"><div class="g-plus" data-action="share" data-annotation="bubble" data-height="22"></div></div>
                          <?}?>  
                          <span itemprop="author" class="hidden">@phimvip.com</span>                                                     </div>
                        </div>
                        
                    </div>
                    <div class="block mt-xl"><div class="block-heading">
                        <h2 class="block-title weight-normal"> <i class="sp-movie-icon-user-review"></i>&nbsp&nbspDiễn viên</h2>
                                                                                                                 </div>
                        <div class="block-content list-actor bin-bg">
                            <div class="items clearfix">
<?php echo $dienvien; ?>

                                                                    </div>
                        </div>
                    </div>
<?if($trailer){?>
                                        <div class="block mt-xl"><div class="block-heading">
                        <h2 class="block-title weight-normal"> <i class="sp-movie-icon-videocam text-danger"></i>&nbsp&nbspTrailers & Videos</h2>
                                                                                                                   </div>
                        <div class="block-content bin-bg">
                            <div class="row fix-row row-trailer">
                                    <div class="col-md-12">
                                        <div class="trailer">
                                            <div class="trailer-image-wrap"> <img src="https://i.ytimg.com/vi/<?=$trailer?>/hqdefault.jpg" alt="trailers">
                                                <div class="icon-play">
                                                    <a href="javascript:void(0);" rel="nofollow" data-id="<?=$trailer?>"> <i class="sp-movie-icon-play"></i> </a>
                                                </div>
                                            </div>
                                            <div class="trailer-info">
                                                <div class="trailer-info-block"> <img width="100" height="100" src="<?php echo SITE_URL;?>/iphd.php?src=<?=$thumb?>&w=218&height=320" class="thumb-img">
                                                    <h3>Trailer <?php echo $tenphim; ?></h3>
                                                    <p class="genry"><?php echo $theloai; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                                                                                
                                
                            </div>
                        </div>
                    </div>
<?} else { ?>
                                        <div class="block mt-xl" id="trailer">
<div class="block-heading">
<h2 class="block-title weight-normal"> <i class="sp-movie-icon-videocam text-danger"></i>&nbsp&nbspTrailers & Videos</h2>
</div>
                        <div class="block-content bin-bg">
                            <div class="row fix-row row-trailer">
                                                                                                    <div class="col-md-12">
                                        <div class="trailer">
                                            <div class="trailer-image-wrap"> <img src="https://i.ytimg.com/vi/<?php echo config_site('trailer');?>/hqdefault.jpg" alt="trailers">
                                                <div class="icon-play">
                                                    <a href="javascript:void(0);" rel="nofollow" data-id="<?php echo config_site('trailer');?>"> <i class="sp-movie-icon-play"></i> </a>
                                                </div>
                                            </div>
                                            <div class="trailer-info">
                                                <div class="trailer-info-block"> <img width="100" height="100" src="<?php echo SITE_URL;?>/iphd.php?src=<?=$thumb?>&w=218&height=320" class="thumb-img">
                                                    <h3>Trailer <?php echo $tenphim; ?></h3>
                                                    <p class="genry"><?php echo $theloai; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                                                                                
                                
                            </div>
                        </div>
                    </div>
<?}?>
                                        <div class="block mt-xl">
<div class="block-heading">
                        <h3 class="block-title weight-normal text-pink"> <i class="fa fa-tag"></i>&nbsp&nbspTags</h3>
</div>
                        <div class="block-content block-tag pt">
                            <p><?=$tags?> </p>
                                   <div class="alert alert-grey" style="line-height:2px;">
                     <h4>xem phim <?=$tenphim?> mới nhất, review phim <?=$tenphim?>,<?=$tenphim?> bilutv,<?=$tenphim?> phimmoi,<?=$tenphim?> motphim,<?=$tenphim?> phimbathu,<?=$tenphim?> khoaitv, phim14, hdonline, phim3s, vungtv, banhtv ,<?=$tenphim?> cam,<?=$tenphim?> thuyết minh,<?=$tenphim?> phụ đề,<?=$tenphim?> lồng tiếng,tải phim <?=$tenphim?></h4>
                     <?
                        if($loaiphim != 0){
             echo "<h4> $tenphim Tập 1, $tenphim Tập 2,$tenphim Tập 3, $tenphim Tập 4, $tenphim Tập 5, $tenphim Tập 6, $tenphim Tập 7 ,$tenphim Tập 8 , $tenphim Tập 9, $tenphim Tập 10
$tenphim Tập 10,11,12,13,14,15,16,17,18,19,20,21, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50,  $tenphim tập cuối,$tentienganh tập cuối</h4>";}                    ?>
                    </div>
                        </div>
 
                    </div>
                    <div id="fb-comment-watching">
                    <div class="block mt-xl">
<div class="block-heading">
                        <h4 class="block-title weight-normal text-pink"> <i class="sp-movie-icon-user-review"></i>&nbsp&nbspBình luận</h4>
</div>
                        <div class="block-content pt bin-bg">
                        <div class="fb-comments" data-href="<?php echo $urlfilm;?>" data-width="100%" data-num-posts="5" data-colorscheme="dark"></div>
                        </div>
                    </div>
                    </div>
                    <div class="block mt-xl">
<div class="block-heading">
                        <h4 class="block-title weight-normal text-pink"> <i class="sp-movie-icon-user-review text-pink"></i>&nbsp&nbspPhim liên quan</h4>
</div>
                        <div class="block-content pt">
                            <div id="recoment-films" class="block-items row fix-row">

<?php echo li_film1('category',12,$film[0][2]);?>
            
                 
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>
                </div>
            </div>
        <div class="column-300 ">
        <div class="block">
        <div class="block-heading" style="border: none;">
            <h2 class="block-title"> <i class="fa fa-star"></i> Trending Phim Lẻ</h2></div>
        <div class="box-asian-tabs tab-remote">
            <ul class="nav nav-tabs nav-justified" role="tablist">
                <li role="presentation" class="active">
                    <a href="javascript:();" data-block="home-page-ple-viewsd" data-toggle="tab" class="ph top-day-ple"> <i class="fa fa-hand-o-right"></i> Top Ngày </a>
                </li>
                <li role="presentation">
                    <a href="javascript:();" data-block="home-page-ple-viewsw" data-toggle="tab" class="ph"> <i class="fa fa-hand-o-right"></i> Top Tuần </a>
                </li>
                <li role="presentation">
                    <a href="javascript:();" data-block="home-page-ple-viewsm" data-toggle="tab" class="ph"> <i class="fa fa-hand-o-right"></i> Top Tháng </a>
                </li>
            </ul>
<div class="tab-content p-none" style="position: static; zoom: 1;">
<div class="home-page-ple-viewsd" id="owl-slide">
<ul class="list-group list-group-movie clearfix">
<?php echo bxh_show("phimle","day");?>
</ul>
</div>
<div class="home-page-ple-viewsw hidden" id="owl-slide">
<ul class="list-group list-group-movie clearfix">
<?php echo bxh_show("phimle","week");?>
</ul>
</div>
<div class="home-page-ple-viewsm hidden" id="owl-slide">
<ul class="list-group list-group-movie clearfix">
<?php echo bxh_show("phimle","month");?>
</ul></div></div>
        </div>
    </div>
      <div class="block">
        <div class="block-heading" style="border: none;">
            <h2 class="block-title"> <i class="fa fa-star"></i> Trending Phim Bộ</h2></div>
        <div class="box-asian-tabs tab-remote">
            <ul class="nav nav-tabs nav-justified" role="tablist">
                <li role="presentation" class="active">
                    <a href="javascript:();" data-block="home-page-pbo-viewsd" data-toggle="tab" class="ph top-day-ple"> <i class="fa fa-hand-o-right"></i> Top Ngày </a>
                </li>
                <li role="presentation">
                    <a href="javascript:();" data-block="home-page-pbo-viewsw" data-toggle="tab" class="ph"> <i class="fa fa-hand-o-right"></i> Top Tuần </a>
                </li>
                <li role="presentation">
                    <a href="javascript:();" data-block="home-page-pbo-viewsm" data-toggle="tab" class="ph"> <i class="fa fa-hand-o-right"></i> Top Tháng </a>
                </li>
            </ul>
<div class="tab-content p-none" style="position: static; zoom: 1;">
<div class="home-page-pbo-viewsd" id="owl-slide">
<ul class="list-group list-group-movie clearfix">
<?php echo bxh_show("phimbo","day");?>
</ul>
</div>
<div class="home-page-pbo-viewsw hidden" id="owl-slide">
<ul class="list-group list-group-movie clearfix">
<?php echo bxh_show("phimbo","week");?>
</ul>
</div>
<div class="home-page-pbo-viewsm hidden" id="owl-slide">
<ul class="list-group list-group-movie clearfix">
<?php echo bxh_show("phimbo","month");?>
</ul></div></div>
        </div>
    </div>
<div class="block mt-xl">
        <div class="block-heading">
            <h2 class="block-title"> <i class="fa fa-tags"></i> Tag cloud</h2></div>
        <div class="block-content btn-group-tag bin-bg">
                            <?php echo config_site('site_keyword');?>           
        </div>
    </div>
</div>      <div class="ads ads-floating ads-floating-right"></div>
    </div></section>        </div>
        </section>
<?
}?>
<script type="text/javascript">
                    var filmInfo = [];
                    filmInfo.filmID = parseInt('<?=$filmid?>');
                    function trailer(){
                        $('#trailer').fadeIn('slow');
                        $('html, body').animate({
                            scrollTop: $("#trailer").offset().top
                        }, 500);
                    }
                </script>
<script type="text/javascript" src="<?php echo SITE_URL;?>/bintheme/js/star-rating.min.js"></script>
<script type="text/javascript" src="bintheme/js/phimvip.raty.js"></script>
<script type="text/javascript" src="bintheme/js/public.film.js"></script>
<script type="text/javascript">
  var uid = '44443';
  var wid = '521459';
</script>
<?php  
include View::TemplateView('footer'); 
$cached = fopen($cachefile, 'w');
fwrite($cached, ob_get_contents());
fclose($cached);
ob_end_flush(); 
?>
