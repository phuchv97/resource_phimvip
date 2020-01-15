<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
include View::TemplateView('header');
$actor = MySql::dbselect("name,thumb,ngheNghiep,ngaySinh,quocGia,chieuCao,canNang,ngonNgu,soThich,gioiThieu","actor","name like '%$id%' order by id desc limit 1"); 
$tenDienVien = $actor[0][0];
$urlAvatar = $actor[0][1];
$ngheNghiep = $actor[0][2];
$ngaySinh = $actor[0][3];
$quocGia = $actor[0][4];
$chieuCao = $actor[0][5];
$canNang = $actor[0][6];
$ngonNgu = $actor[0][7];
$soThich = $actor[0][8];
$gioiThieu = $actor[0][9];
$watchurl = get_url_actor($tenDienVien,'tim-kiem-dien-vien');
$urlfilm =  get_url_actor($tenDienVien,'dien-vien');

$fb = config_site('facebook_url');

?> 
<?php if($mode == 'dien-vien'){ 
$file = $tenDienVien;
$cachefile = CACHE_ADD.'/actor/cached-'.$file.rand(1000,10000).'.html';
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
                                
                <li itemscope="" itemtype="https://data-vocabulary.org/Breadcrumb"><a title="<?=$tenDienVien?>" itemprop="url" href="<?php echo $urlfilm;?>"><span itemprop="title"><?=$tenDienVien?></span></a></li>
                
            </ul>
        </div>
        <div class="column-with-300">
            <div class="movie-banner">
                <div class="movie-banner-src" ></div>
                <div class="icon-play">
                    <?php 
              echo '<a href="'.$watchurl.'" title="Xem phim của diễn viên '.$tenDienVien.'"> <i class="sp-movie-icon-play"></i> </a>' ;
            
               ?>
                
                </div>
            </div>      
            <div class="movie-info clearfix" itemscope itemtype="https://schema.org/TVSeries">
                <div id="before-watching"></div>
                
                <div class="column-300 pull-left pl-xxl">
                    <div class="thumbnail mb-none"> <img class="info-poster-img" data-name="<?=$tenDienVien?>" itemprop="image" src="<?php if($urlAvatar){echo $urlAvatar;}else{echo "https://phimvip.com/bintheme/images/dienvien.png";}?>" alt="<?=$tenDienVien?>" /></div>
                                                                               <div class="button-play">
              <?php 
              echo '<a class="btn btn-red btn-rounded" title="Xem phim của '.$tenDienVien.'" href="'.$watchurl.'"><i class="sp-movie-icon-camera"></i> Xem Phim</a>' ;
              ?>      
                    </div>
                    <div class="block mt-xl">
                        <div class="weight-normal font-24"> <i class="sp-movie-icon-film"></i> Thông tin</div>
                        <div class="block-content movie-info-sidebar bin-bg">
                            <ul class="list-style-none list-inline"> 
                            <li class="common-list"> <span> Nghề Nghiệp:</span> <?php if($ngheNghiep){ echo $ngheNghiep;}else{ echo "Đang cập nhật";}  ?></li>
                            <li class="common-list"> <span> Ngày Sinh:</span> <?php if($ngaySinh){ echo $ngaySinh;}else{ echo "Đang cập nhật";}  ?></li>
                            <li class="common-list"> <span> Quốc Gia:</span> <?php if($quocGia){ echo $quocGia;}else{ echo "Đang cập nhật";} ?></li>
                            </li>
                            <li class="common-list"> <span> Chiều Cao:</span><?php if($chieuCao){ echo $chieuCao." m";}else{ echo "Đang cập nhật";}  ?></li>
                            <li class="common-list"> <span> Cân Nặng:</span> <?php if($canNang){ echo $canNang." kg";}else{ echo "Đang cập nhật";}   ?></li>
                            <li class="common-list"> <span> Ngôn Ngữ: </span><?php if($ngonNgu){ echo $ngonNgu;}else{ echo "Đang cập nhật";} ?></li>
                            <li class="common-list"> <span> Lượt xem:</span> <?php echo rand(100,2000)." view"; ?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="ads ads-info-left">
                        <?php echo binads('site_ads8');?>
                    </div>
                </div>
                <div class="column-with-300 pull-right">
                    <div class="movie-info-top">
                        <h1 class="movie-title text-nowrap" itemprop="name"><?php echo $tenDienVien; ?> </h1>
                        
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
                                  $output = strip_tags(nl2br($gioiThieu), '<a><h1><img><b><strong><br>');
                                  echo $output;?>
                          <div class="gg-like" style="margin-top: 10px;"><div class="g-plus" data-action="share" data-annotation="bubble" data-height="22"></div></div>
                          
                          <span itemprop="author" class="hidden">@phimvip.com</span>                                                     </div>
                        </div>
                        
                    </div>
					
                                        <div class="block mt-xl">
<div class="block-heading">
                        <h3 class="block-title weight-normal text-pink"> <i class="fa fa-tag"></i>&nbsp&nbspTags</h3>
</div>
                        <div class="block-content block-tag pt">
                                   <div class="alert alert-grey" style="line-height:2px;">
                     <h4><?=$tenDienVien?>,xem phim của <?=$tenDienVien?> mới nhất, diễn viên <?=$tenDienVien?>,<?=$tenDienVien?> bilutv,<?=$tenDienVien?> phimmoi,<?=$tenDienVien?> motphim,<?=$tenDienVien?> phimbathu,<?=$tenDienVien?> khoaitv, phim14, hdonline, phim3s, vungtv, banhtv ,<?=$tenDienVien?> cam,<?=$tenDienVien?> thuyết minh,<?=$tenDienVien?> phụ đề,<?=$tenDienVien?> lồng tiếng,tải phim của <?=$tenDienVien?></h4>
                     
                    </div>
                        </div>
 
                    </div>
                    <div class="block mt-xl">
<div class="block-heading">
                        <h4 class="block-title weight-normal text-pink"> <i class="sp-movie-icon-user-review text-pink"></i>&nbsp&nbspPhim liên quan của <?php echo $tenDienVien; ?></h4>
</div>
                        <div class="block-content pt">
                            <div id="recoment-films" class="block-items row fix-row">

<?php echo li_film1('actor',12,$actor[0][0]);?>
            
                 
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
                    
                    </div>
                    </div>
                </div>
            </div>
<!-- sidebar -->			
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
