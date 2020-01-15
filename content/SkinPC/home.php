<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
include View::TemplateView('header');
?>
 <div class="container-fluid clearfix">  
    <div class="top-content">
        <!-- slider -->
        <div id="slider">
            <div class="swiper-wrapper">
<?php echo slider_film("slider = '1'",8);?>
</div>
            <div class="swiper-pagination"></div>
            <div class="clearfix"></div>
        </div>
        <!--/slider -->
        
        <!--top news-->
<div id="top-news">
            <div class="top-news">
                    <div class="box-asian-tabs tab-remote">
                        <ul class="nav nav-tabs nav-justified" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#" data-block="news" data-toggle="tab" class="ph list-v" title="Tin tức"> <i class="fa fa-book"></i> Tin tức</a>
                            </li>
<li role="presentation" class="">
<a href="javascript:();" data-block="coming-episodes" data-toggle="tab" class="ph" title="Thông báo"> 
<i class="fa fa-bell-o"></i> Thông Báo </a></li>
                        </ul>
                        <div class="tab-content" style="position: static; zoom: 1;">
                        <div class="news" id="owl-slide">
<div class="tab-lists clearfix">                    
    <?php echo li_news();?>             

                </div></div>
                            <div id="owl-slide" class="coming-episodes">
<div class="tab-lists clearfix">
<?php echo config_site('site_notice');?>
</div>
                            </div>
</div>
                    </div>
            </div>
        </div>
        <!--/top news-->
        <div class="clearfix"></div>
    </div>
</div>      <section id="content">
            <div class="container-fluid clearfix">
                <div class="ads ads-floating ads-floating-left"></div>
                <div class="column-with-300 mt-lg">
                    <div class="block">
                        <div class="block-heading with-tabs">
                            <div class="block-title"> <a href="/tong-hop/phim-hot" title="Phim hot"><h2 class="block-title"> <i class="sp-movie-icon-cup"></i>Phim Hay Đề Cử </h2></a></div>
                        </div>
                        <div class="block-content">
                            <div id="owl-slide" class="row-fluid ">
                                <div id="phim-rap" class="block-items row fix-row">                                             
<?php echo decu1();?>           
                  
                                </div>                          
                            </div>                      
                        </div>
                    </div>
                    <div class="block">
                        <div class="block-heading with-tabs">
                            <div class="block-title"> <a href="" title="Tập Phim Mới Cập Nhật"> <h2 class="block-title"><i class="sp-movie-icon-film"></i> Tập Phim Mới Cập Nhật </h2></a></div>
                        </div>
                        <div class="block-content">
                            <div id="owl-slide" class="home-page-pbo">
                                <div id="new-video" class="block-items row fix-row collections">                                   
<?php echo li_episode('tb_film.id != 0','24');?>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="block">
                        <div class="block-heading with-tabs">
                            <div class="block-title"> <a href="/the-loai/phim-chieu-rap" title="Phim chiếu rạp"><h2 class="block-title"> <i class="sp-movie-icon-film"></i> Phim chiếu rạp </h2></a></div>
                        </div>
                        <div class="block-content">
                            <div id="owl-slide" class="home-page-pbo">
                                <div id="phim-hoat-hinh" class="block-items row fix-row">
<?php echo li_film1('phimchieurap','24');?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block">
                        <div class="block-heading with-tabs">
                            <div class="block-title"> <a href="/tong-hop/phim-le" title=" Phim lẻ mới"><h2 class="block-title"> <i class="sp-movie-icon-videocam"></i>  Phim lẻ mới </h2></a></div>
                            <div class="box-asian-tabs">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"> <a href="/tong-hop/phim-le" title="Phim lẻ mới" data-block="home-page-ple" data-toggle="tab"> All </a></li>
                                    <li role="presentation"> <a href="/the-loai/phim-hanh-dong" title="Hành Động" data-block="home-page-ple-1" data-toggle="tab"> Hành Động </a></li><li role="presentation"> <a href="the-loai/phim-hoat-hinh" title="Hoạt Hình" data-block="home-page-ple-2" data-toggle="tab"> Hoạt Hình </a></li><li role="presentation"> <a href="the-loai/phim-hai-huoc" title="Phiêu Lưu" data-block="home-page-ple-3" data-toggle="tab"> Hài Hước </a></li>
                                    <li role="presentation"> <a href="the-loai/phim-ma-kinh-di" title="Ma - Kinh Dị" data-block="home-page-ple-4" data-toggle="tab"> Ma - Kinh Dị </a></li>                                  
                                </ul>
                            </div>
                        </div>
                        <div class="block-content">
                            <div id="owl-slide" class="home-page-ple">
                                <div id="phim-le" class="block-items row fix-row">
<?php echo li_film1('phimle','24');?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block">
                        <div class="block-heading with-tabs">
                            <div class="block-title"> <a href="/tong-hop/phim-bo" title="Phim bộ mới"> <h2 class="block-title"><i class="sp-movie-icon-film"></i> Phim bộ mới</h2></a></div>
                            <div class="box-asian-tabs">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"> <a href="tong-hop/phim-bo" title="Phim bộ mới" data-block="home-page-pbo" data-toggle="tab"> All </a></li>
                                    <li role="presentation"> <a href="quoc-gia/han-quoc" title="Hàn Quốc" data-block="home-page-pbo-1" data-toggle="tab"> Hàn Quốc </a></li><li role="presentation"> <a href="quoc-gia/trung-quoc" title="Trung Quốc" data-block="home-page-pbo-2" data-toggle="tab"> Trung Quốc </a></li><li role="presentation"> <a href="quoc-gia/au-my" title="Mỹ -  Châu Âu" data-block="home-page-pbo-3" data-toggle="tab"> Mỹ -  Châu Âu </a></li>                                 
                                </ul>
                            </div>
                        </div>
                        <div class="block-content">
                            <div id="owl-slide" class="home-page-pbo">
                                <div id="phim-bo" class="block-items row fix-row">                                   
<?php echo li_film1('phimbo','24');?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column-300 mt-lg">
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
            <h2 class="block-title"> <i class="fa fa-tags"></i> Phim Sắp Chiếu</h2></div>
        <div class="block-content bin-bg">
<div id="owl-slide"><ul class="list-group list-group-movie clearfix">
<?php echo li_film1('phimsapchieu','6');?>
</ul></div>     
        </div>
    </div>    
<div class="block mt-xl">
        <div class="block-heading">
            <h2 class="block-title"> <i class="fa fa-tags"></i> Tag cloud</h2></div>
        <div class="block-content btn-group-tag bin-bg">
                            <?php echo config_site('site_keyword');?>           
        </div>
    </div>
    <div class="ads ads-sidebar ads-below-tag"></div>
</div>      <div class="ads ads-floating ads-floating-right"></div>
    </div></section>        </div>
        </section>

<?php
include View::TemplateView('footer');
?>