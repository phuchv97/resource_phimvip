<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
include View::TemplateView('header');
$fb = config_site('facebook_url');
?>
    <div class="clearfix"></div>
    <div class="player-wrapper">
        <div class="container">
            <div class="player-container">
                <div class="embed-responsive embed-responsive-16by9">
                    <div class="embed-responsive-item">
<div style="width: 100%;height: 100%;" id="media-player">
<div class="overlay">&nbsp;</div>
<script type="text/javascript">jwplayer("media-player").setup({
    file: "<?=$url?>",
    logo: {
    file: "/logo.png",
    link: "https://biphim.net",
    position: "top-right",
    opacity: ""
    },
        skin: { name: "seven", background: "transparent", },
        autostart: "true",
  height: "100%",
        width: "100%",
        title: "xemlaco.net",
        abouttext:"iphimhd",
        aboutlink:"https://biphim.net",
    tracks: [{file: "'.$subtitle.'",
                label: "Vie",
                    kind: "captions",
                    "default": true }],
                      captions: {
                      color: "#FFFFFF",
                      backgroundOpacity: 70
                       }});
    $('.overlay').click(function() {
                 jwplayer("media-player").play(true);
                 $(this).hide();
        });
     </script>
</div>
                    </div>
                    <input type="hidden" id="Epid" value="164048" />
                </div>
                <div class="mt clearfix">
                    <button type="button" class="btn btn-dark btn-sm pull-left CloseAds"> <i class="glyphicon glyphicon-remove"></i> &nbsp; Tắt quảng cáo </button>
                    <button type="button" class="btn btn-dark btn-sm pull-left LightOff"> <i class="glyphicon glyphicon-remove"></i> &nbsp; Tắt đèn </button>
                    <div class="pull-right">
                        <div class="fb-like fb_iframe_widget" data-href="<?php echo $urlvideo;?>" data-layout="button_count" data-action="like" data-size="large" data-show-faces="true" data-share="true" fb-xfbml-state="rendered" fb-iframe-plugin-query="action=like&amp;app_id=1482880478662825&amp;container_width=0&amp;href=http://xemvn.net/phim/cau-be-rung-xanh-7132.html&amp;layout=button_count&amp;locale=vi_VN&amp;sdk=joey&amp;share=true&amp;show_faces=true&amp;size=large"></div>
                    </div>
                </div>
                <div class="ads_xemvn">
                <?php echo binads('site_ads9');  ?> 
                </div> 
                <div class="list-servers" id="videoLists">
                    <ul class="list_episode">
             <div id="list-eps">
                </div>
                        </ul</div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div> 
    <section id="content_watch">
        <div class="pageContent clearfix">
            <div class="container-wrapper" style="background: #1C1C1C;margin-bottom: 5px;height: 45px;">
                <ul class="breadcrumb clearfix" xmlns:v="http://rdf.data-vocabulary.org/#">
                    <li typeof="v:Breadcrumb">
                        <a href="/" property="v:title" rel="v:url" title="Trang chủ"> <i class="fa fa-home"></i> Home </a>
                    </li>
                   
                    <li typeof="v:Breadcrumb"> <a href="/video/" title="Danh sách video" property="v:title" rel="v:url">Video</a>
                    </li>
                    <li> <span><?=$name?></span>
                    </li>
                </ul>
            </div>
            <div class="page-col-left">
                <div class="alert alert-teal">
                    <div class="fb-save" data-uri="<?php echo $urlvideo;?>" data-size="large"></div>
                    <p> Các Bạn Lưu Ý: Không dẫn link hoặc đăng link qua các web xem Online khác. Vi phạm ban nick vĩnh viễn ngay lập tức và có thể cấm luôn IP ko cho vào Web xem phim nữa, Bình Luận Lịch sự văn hóa chứng tỏ là người văn mình nhé, Thanks !!!</p>
                </div>
                <div class="fb-comments" data-href="<?php echo $urlvideo;?>" data-width="728px" data-num-posts="5" data-colorscheme="dark"></div>
            </div>
            <div class="page-col-right">
                <!--quangcao-->
                <!--//quangcao-->
                <div class="block mt-xl">
                    <div class="block-heading">
                        <h2 class="block-title"> <i class="fa fa-tags"></i> FANPAGE</h2>
                    </div>
                    <div class="block-content btn-group-tag btn-group-tag-dark pt-xl">
                        <div class="fb-page" data-href="<?=$fb?>" data-tabs="timeline" data-width="300" data-height="300" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                            <blockquote cite="<?=$fb?>" class="fb-xfbml-parse-ignore"><a href="<?=$fb?>">BIPHIM FANPAGE</a>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
include View::TemplateView('footer');
?>