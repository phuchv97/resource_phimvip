<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
include View::TemplateView('header');
?>

            <section id="content">
    <div class="container-fluid clearfix">
        <div class="ads ads-floating ads-floating-left"></div>
        <div class="container-wrapper">
            <ul class="breadcrumb clearfix" xmlns:v="https://rdf.data-vocabulary.org/#">
                <li typeof="v:Breadcrumb"><a href="/" property="v:title" rel="v:url" title="Trang chủ"> <i class="fa fa-home"></i> Trang chủ</a></li>
                <li typeof="v:Breadcrumb"> <a href="/tin-tuc/" title="Danh sách tin tức" property="v:title" rel="v:url">Tin Tức</a>
                    </li>
                                   <li> <span> <?php echo $title;?></span></li>
            </ul>
        </div>
                              

            <div class="column-with-300">
                <div class="block">
                    <div class="block-heading">
                    <h1 class="block-title" style="text-transform:none!important"><?php echo $title;?></h1></div>
                    <div class="block-content post-detail">
                        <div class="post-body-content">
                            <?php echo $content;?>
                            <div class="fb-like" data-href="<?php echo $url;?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div>
                        </div>
                    </div>
                </div>
                <div class="block">
                    <div class="block-heading">
                    <h1 class="block-title" style="text-transform:none!important">Bình luận</h1></div>
                    <div class="block-content">
                        <div class="fb-comments" data-colorscheme="dark" data-href="<?php echo $url;?>" data-width="100%" data-numposts="5"></div>
                    </div>
                </div>
                <div class="block">
                    <div class="block-heading">
                    <h1 class="block-title" style="text-transform:none!important">Bài liên quan</h1></div>
                    <div class="block-content">
                        <div id="listNewsPager">
                            <div class="list-box-news">
                                                                                                    <?php echo li_tintuc();?>
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
</div>      </div>

        <div class="ads ads-floating ads-floating-right"></div>
    </div>
</section>      </div>
        </section>
<?php
include View::TemplateView('footer');
?>