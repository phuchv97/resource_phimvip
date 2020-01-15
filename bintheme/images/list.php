<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
include View::TemplateView('header');
$title_page = $name;
// Bộ lọc
parse_str(parse_url(Url::curRequestURL(),PHP_URL_QUERY), $filter);
if($filter['bycat'] || $filter['bycountry'] || $filter['byquality'] || $filter['byyear'] || $filter['bytype']) {
	if($filter['bycat']) {
		$catid =$filter['bycat'];
		$sql .= " AND category like '%,$catid,%'";
	}if ($filter['bycountry']) {
		$couid = $filter['bycountry'];
		$sql .= " AND country = '$couid'";
	}if ($filter['byquality']!="" && $filter['byquality']!="all") {
		$qualityid = $filter['byquality'];
		$sql .= " AND quality = '$qualityid'";
	}if ($filter['byyear']!="" && $filter['byyear']!="all") {
		$getyear = $filter['byyear'];
		$sql .= " AND year = '$getyear'";
	}if ($filter['bytype']!="" && $filter['bytype']!="all") {
		$gettype = $filter['bytype'];
		$sql .= " AND thuyetminh = '$gettype'";
	}if ($filter['byorder']) {
		$byorder = $filter['byorder'];
		if($byorder == 'timeupdate') $byorder = 'timeupdate';
		else if($byorder == 'year') $byorder = 'year';
		else if($byorder == 'title') $byorder = 'title';
		else if($byorder == 'viewed') $byorder = 'viewed';
		else $byorder = 'timeupdate';
	}
}
$orderby = 'ORDER BY '.$byorder.' DESC';
if(!$byorder) $orderby = 'ORDER BY timeupdate DESC';
if($geturl[3]) {
	$page = explode('-',$geturl[3]);
}
$page		= 	$page[1];
$num		= 	'40';
$num 		= 	intval($num);
$page 		= 	intval($page);
if (!$page) 	$page = 1;
$limit 		= 	($page-1)*$num;
if($limit<0) 	$limit=0;
$arr = MySql::dbselect('tb_film.id,tb_film.title,tb_film.title_en,tb_film.thumb,tb_film.year,tb_film.big_image,tb_film.quality,tb_film.year,tb_film.duration,tb_film.filmlb,tb_film.thuyetminh,tb_film.category,trailer','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"$sql $orderby LIMIT $limit,$num");
$total = MySql::dbselect('tb_film.id','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"$sql");
$allpage_site = get_allpage(count($total),$num,$page,$url_page.'page-');
?>
			<section id="content">
    <div class="container-fluid clearfix">
        <div class="ads ads-floating ads-floating-left"></div>
        <div class="container-wrapper">
            <ul class="breadcrumb clearfix" xmlns:v="https://rdf.data-vocabulary.org/#">
				<li typeof="v:Breadcrumb"><a href="/" property="v:title" rel="v:url" title="Trang chủ"> <i class="fa fa-home"></i> Trang chủ</a></li>
				<li><span><?php echo $title_page;?></span></li>
			</ul>
        </div>
        <div class="column-with-300"> 
            <div class="block"> 
                <div class="block-heading">
                    <h1 class="block-title"> <img class="ico" src="https://iphimhd.com/assets/images/movie.png"><?php echo $title_page;?></h1></div>
                <div class="block-content">
                    <div class="block-items row fix-row"> 
				
		<?php 
			for($i=0;$i<count($arr);$i++) {
				$filmid = $arr[$i][0];
				$title = $arr[$i][1];
				$filmlb = $arr[$i][10];
				$title_en = $arr[$i][2];
				$quality = $arr[$i][7];
				$year = $arr[$i][8];
				$duration = $arr[$i][9];
				$thumb = $arr[$i][3];
				$thuyetminh = $arr[$i][11];
				$cat = $arr[$i][12];
				$content = CutName(RemoveHtml(UnHtmlChars($arr[$i][6])),220);
				$url = get_url($arr[$i][0],$title,'Phim');
				$episode = MySql::dbselect('id,name','episode',"filmid = '$filmid' order by id desc limit 1");
				$epname = $episode[0][1];
				if($thuyetminh == 1){
					$phude = 'Thuyết Minh';
				}else{
					$phude = 'Viet Sub';
				}
				if($arr[$i][9]!=0){
					$type[$i] = 'phimbo';
				}
				if($arr[$i][9]!=0) { $epnames[$i] = "<span class=\"badge\">Tập ". substr(abs((int) filter_var($epname, FILTER_SANITIZE_NUMBER_INT)),0,3)."-$phude</span>";
				} else {$epnames[$i] = "<span class=\"badge\">HD-$phude</span>";}

echo '
			<div id="film-'.$filmid.'" class="col-xlg-2 col-lg-15 col-md-3 col-sm-4 col-xs-6">
				<div class="item">
					<a class="inner" href="'.$url.'" title="'.$title.'"> 
						<img src="/iphd.php?src='.$thumb.'&w=218&height=320" alt="'.$title.'" class="movie-thumb" /> 
						<span class="thumb-icon"> <i class="sp-movie-icon-play"></i> </span> <span class="overlay"></span>
							<div class="description">
								<h3 class="text-nowrap">'.$title.'</h3>
								<div class="meta clearfix"> <span class="pull-left"> '.$year.' </span> <span class="pull-right">'.$duration.'</span></div>
						</div> '.$epnames[$i].'
					</a>
					
				</div>
			</div> ';

}
if($id=='phimle'){
	$flb = 0;
}elseif($id=='phimbo'){
	$flb = 0;
}
		?>		
			                           
                    </div>
                    <div class="text-center">
                        <ul class='pagination'>
<?=$allpage_site?>
</ul>                    </div>
                </div>
            </div>
        </div>
		<div class="column-300 ">
	
		<div class="block">
		<div class="block-heading" style="border: none;">
			<h2 class="block-title"> <i class="fa fa-star"></i> Phim xem nhiều</h2></div>
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
<?php echo bxh_show("day");?>
</ul>
</div>
<div class="home-page-ple-viewsw hidden" id="owl-slide">
<ul class="list-group list-group-movie clearfix">
<?php echo bxh_show("week");?>
</ul>
</div>
<div class="home-page-ple-viewsm hidden" id="owl-slide">
<ul class="list-group list-group-movie clearfix">
<?php echo bxh_show("month");?>
</ul></div></div>
		</div>
	</div>
		<div class="block mt-xl">
		<div class="block-heading">
			<h2 class="block-title"> <i class="fa fa-tags"></i> Tag cloud</h2></div>
		<div class="block-content btn-group-tag"> 
                            <?php echo config_site('site_keyword');?> 			
</div>
	</div>
	<div class="ads ads-sidebar ads-below-tag"></div>
</div>        <div class="ads ads-floating ads-floating-right"></div>
    </div>
</section>		</div>
        </section>
<?php
include View::TemplateView('footer');
?>