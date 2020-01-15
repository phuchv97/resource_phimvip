<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
include View::TemplateView('header');
if($geturl[2]) {
	$page = explode('-',$geturl[2]);
}
$page		= 	$page[1];
$num		= 	40;
$num 		= 	intval($num);
$page 		= 	intval($page);
if (!$page) 	$page = 1;
$limit 		= 	($page-1)*$num;
if($limit<0) 	$limit=0;
$arr = MySql::dbselect('id,title,seotitle,content,thumb','news',"id != 0 order by id desc LIMIT $limit,$num");
$total = MySql::dbselect('id','news',"id != 0");
$allpage_site = get_allpage(count($total),$num,$page,SITE_URL."/tin-tuc/page-");
?>
<section id="content">
    <div class="container-fluid clearfix">
        <div class="ads ads-floating ads-floating-left"></div>
        <div class="container-wrapper">
            <ul class="breadcrumb clearfix" xmlns:v="https://rdf.data-vocabulary.org/#">
                <li typeof="v:Breadcrumb"><a href="/" property="v:title" rel="v:url" title="Trang chủ"> <i class="fa fa-home"></i> Trang chủ</a></li>
                <li><span>Tin Tức</span></li>
            </ul>
        </div>
            <div class="column-with-300">
                <div class="block">
                    <div class="block-heading">
                    <h1 class="block-title" style="text-transform:none!important"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Tin Tức Mới Nhất</h1></div>
                    <div class="block-content">
                        <div id="listNewsPager">
                            <div class="list-box-news">
<?php
    for($i=0;$i<count($arr);$i++) {
        $name = $arr[$i][1];
                $seotitle = $arr[$i][2];
        if($seotitle){
            $url = SITE_URL.'/post/'.$seotitle.'/';
        }  else {
            $url = get_url(NULL,$name,'post');
        }
        $thumb = $arr[$i][4];
        $content = $arr[$i][3];
        if(!$thumb) $thumb = TEMPLATE_URL.'images/bgcatft.jpg';
        $name_cut = CutName($name,25);
                                $contentt = CutName(RemoveHtml(UnHtmlChars($arr[$i][3])),200);
                                $num = i+1;
                                 echo '<article class="media row">
                                    <a href="'.$url.'" class="col-lg-5 col-md-6 col-sm-4 col-xs-6" title="'.$name.'"> 
                                    <img src="'.$thumb.'" alt="'.$name.'" class="img-responsive"> </a>
                                    <div class="media-body col-lg-7 col-md-6 col-sm-8 col-xs-6">
                                        <h2 class="media-heading"> <a href="'.$url.'" title="'.$name.'"> '.$name.'</a></h2>
                                        <div class="user-post clearfix">
                                            <div class="pull-left mr-lg"><i class="fa fa-clock-o"></i> <span>PhimVip NEWS</span></div>
                                        </div>
                                        <div class="media-post pt">'.$contentt.'</div>
                                    </div>
                                </article>
                                ';
}

?>                                
                                                            </div>
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
</div>      </div>

        <div class="ads ads-floating ads-floating-right"></div>
    </div>
</section>      </div>
        </section>

<?php
include View::TemplateView('footer');
?>
