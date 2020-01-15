<?php
header('Content-type: text/html; charset=UTF-8');
if (!defined('RK_MEDIA')) die("You does have access to this!");
include View::TemplateView('functions');
?>
<!DOCTYPE html>
<html lang="vn">
<head>
    <title><?php echo $site_title;?></title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <meta http-equiv="content-language" content="vi" />    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="keywords" content="<?php echo $site_keywords;?>" />
    <meta name="description" content="<?php echo $site_description;?>" />
	<meta http-equiv="refresh" content="1200" />

    <meta name="revisit-after" content="1 days">
    <meta name="ROBOTS" content="index,follow,noodp" />
    <meta name="googlebot" content="index,follow" />
    <meta name="BingBOT" content="index,follow" />
    <meta name="yahooBOT" content="index,follow" />
    <meta name="slurp" content="index,follow" />
    <meta name="msnbot" content="index,follow" />
    <meta property="og:site_name" content="phimvip.com" />
    <meta name="google-site-verification" content="VpmKTjb2ToPtleqZlTUKepD3TV-wAftOcqxKlCsZ908" />
    <meta property="og:locale" content="vi_VN" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <meta property="og:title" content="<?php echo $site_title;?>">
    <meta property="og:description" content="<?php echo $meta_de;?>">
    <meta property="og:type" content="video.movie">
    <meta property="og:url" content="<?php echo SITE_URL.$cururl;?>">
    <meta property="fb:app_id" content="1001025843422893" />
    <meta property="fb:admins" content="100006916982772"/>
    <?php echo $other_meta;?>
    <base href="<?php echo SITE_URL; ?>/" />
        <script>
            var base_url = '<?php echo SITE_URL;?>/';
            var is_login = '<?php echo IS_LOGIN;?>';
            var SITE_URL  = "<?php echo SITE_URL;?>";
        </script> 
    <link rel="stylesheet" type="text/css" href="<?php echo SITE_URL; ?>/bintheme/css/stylephimvip.css?v=1.9.876" rel="preconnect"/>
    <link rel="stylesheet" type="text/css" href="<?php echo SITE_URL; ?>/bintheme/css/responsivepv.css" rel="preconnect"/>
    <script type="text/javascript" src="<?php echo SITE_URL; ?>/bintheme/js/jquery.min.js"></script>
    <?php echo config_site('$site_codegg');?>
    <script type="application/ld+json">
    { 
      "@context": "https://schema.org",
      "@type": "WebSite",
      "url": "<?php echo SITE_URL.$cururl;?>",
      "potentialAction": {
        "@type": "SearchAction",
        "target": "https://phimvip.com/tim-kiem/{search_term_string}/",
        "query-input": "required name=search_term_string"
      }
    }
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-142529272-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-142529272-1');
    </script>
<style>
@media only screen and (max-width: 1025px) {
.hidemobile{ display: none !important; }
}
@media only screen and (min-width: 1026px) {
.hidedesktop{display:none!important;}
}
.autocomplete-suggestions{
    max-height: 700px !important;
}
</style>
</head>
<?php if($mode=='phim' || $mode=='xem-phim' || $mode=='xem-video'){ echo '<body class="FilmPlay">';}else{ echo '<body class="DefaultIndex">';}?>

    <header id="header" class="clearfix hidden-sm hidden-xs">
        <nav class="header-top navbar navbar-custom navbar-fixed-top" role="navigation">
            <div class="container-fluid clearfix">
                <div class="navbar-table">
                    <div class="navbar-cell tight">
                        <div class="navbar-header"> <a href="/" class="navbar-brand"><h1 class="logo"> Xem phim Online, Phim HD Online</h1></a> <span style="width:100%"></span>
                            <div> <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="true"> <span class="fa fa-bars"></span> </button></div>
                        </div>
                    </div>
                    <div class="navbar-cell stretch navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li>
                                <a href="/" title="Xem phim Online, Phim HD Viet Sub, Phim Online HD"> <i class="fa fa-home"></i> Trang chủ</a>
                            </li>
                            <li>
                                <a href="/tong-hop/phim-le/" title="Phim lẻ"> <i class="fa fa-camera"></i> Phim lẻ</a>
                            </li>
                            <li>
                                <a href="/tong-hop/phim-bo/" title="Phim bộ"> <i class="fa fa-tasks"></i> Phim bộ</a>
                            </li>
                            <li class="dropdown mega-dropdown has-submenu">
                                <a href="javascript:();" title="Thể loại"> <i class="fa fa-folder-open"></i> Thể loại</a>
                                <ul class="dropdown-menu mega-dropdown-menu clearfix with-column-3-200" role="menu">
<?php echo li_category(); ?>
</ul>

                            <li class="dropdown mega-dropdown has-submenu">
                                <a href="javascript:();" title="Quốc gia"> <i class="fa fa-globe"></i> Quốc gia</a>
                                <ul class="dropdown-menu mega-dropdown-menu clearfix with-column-3-200" role="menu">
<?php echo li_country(); ?>
                        </ul>
                            <li>
                                <a href="/tin-tuc/" title="Tin Tức Điện Ảnh"> <i class="fa fa-newspaper-o"></i> Tin Điện Ảnh</a> 
                            </li>
</ul>
                    </div>
                    <div class="navbar-cell stretch">
                        <meta itemprop="url" content="/" />
                        <form method="post"  class="form-search" action="javascript:MakeSearch();">
                            <div class="input-group mb-sm"> 
                            <input name="get-key"  type="text" class="form-control input-search desktop tukhoaxlc" placeholder="Nhập tên phim cần tìm" value="" />
                              <span class="input-group-addon btn-search"> <i class="fa fa-search"></i> </span></div>
                        </form>
                    </div>
                    <div class="navbar-cell stretch" >
                        <div class="user-acount">
                                               <div id="top-user">
                        </div>
                    </div>
                    
                </div>
            </div>
        </nav>
    </header> 
    <div id="mobile-header" class="visible-sm visible-xs sb-slide">
        <form method="post" class="form-search" action="javascript:MakeSearch();" itemprop="potentialAction">
            <div class="input-group input-group-lg"> <input itemprop="query-input"name="get-key" type="text"  class="form-control input-search mobile tukhoaxlc" placeholder="Nhập tên phim cần tìm..." value="" />
             <span class="input-group-addon btn-search"> <i class="fa fa-search"></i> </span></div>
        </form>
        <div class="navbar-table">
            <div class="navbar-cell tight">
                <div class="sb-toggle-left navbar-left"> <i class="fa fa-bars"></i></div>
                <a href="/" class="sb-header-text"> <img src="mlogo.png" /> </a>
                <div class="open-search navbar-right"> <i class="fa fa-search"></i></div>
                <div class="user-acount mobile"><div id="top-user">
                        </div></div>
            </div>
        </div>
    </div>
        <div id="sb-site" style="-webkit-transform: none;-moz-transform: unset;-o-transform: unset;transform: none;">
        <div style="padding-top: 50px;"></div>
        <div class="light-overlay"></div>