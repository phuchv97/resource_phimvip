<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
 
include View::AdminView('functions');
if(!IS_ADMIN) include View::AdminView('login');
else { 
$Adminid = $_SESSION["RK_Adminid"];
$Admingroup = $_SESSION["RK_Admingroup"];
$arr = MySql::dbselect('nt_content,timeupdate','notice JOIN tb_user ON (tb_user.id = tb_notice.userid)',"userid='".$Adminid."' AND n_read=0 LIMIT 10");
                    $total_mes = count($arr);
                    if($total_mes){
                        $noti = '<li class="dropdown top-nav__notifications">
                        <a href="" data-toggle="dropdown" class="top-nav__notify">
                            <i class="zmdi zmdi-notifications"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu--block">
                            <div class="dropdown-header">
                                <a href="'.SITE_URL.'/badmin/?action=thongbao"> Thông Báo </a>

                                <div class="actions">
                                    <a href="" class="actions__item zmdi zmdi-check-all" data-sa-action="notifications-clear"></a>
                                </div>
                            </div>

                            <div class="listview listview--hover">
                                <div class="listview__scroll scrollbar-inner">';
                        for($i=0;$i<count($arr);$i++) {
                            $noti .= '<a href="'.SITE_URL.'/badmin/?action=thongbao" class="listview__item">
                                    <img src="demo/img/profile-pics/5.jpg" class="listview__img" alt="">

                                    <div class="listview__content">
                                        <div class="listview__heading">
                                            <small>'.$arr[$i][1].'</small>
                                        </div>
                                        <p>'.$arr[$i][0].'</p>
                                    </div>
                                </a>
                            ';
                        }
                        $noti .= '</div>

                                <div class="p-1"></div>
                            </div>
                        </div>
                    </li>';
                    }else{
                        $noti .= '<li class="dropdown top-nav__notifications top-nav__notifications--cleared"> <a href="" data-toggle="dropdown" class="" aria-expanded="false"> <i class="zmdi zmdi-notifications"></i> </a> <div class="dropdown-menu dropdown-menu-right dropdown-menu--block" x-placement="bottom-end" style="position: absolute; transform: translate3d(-270px, 37px, 0px); top: 0px; left: 0px; will-change: transform;"> <div class="dropdown-header"><a href="'.SITE_URL.'/badmin/?action=thongbao"> Thông Báo </a><div class="actions"> <a href="" class="actions__item zmdi zmdi-check-all" data-sa-action="notifications-clear" style="display: none;"></a> </div> </div> <div class="listview listview--hover"> <div class="scroll-wrapper listview__scroll scrollbar-inner" style="position: relative;"><div class="listview__scroll scrollbar-inner scroll-content" style="height: 350px; margin-bottom: 0px; margin-right: 0px; max-height: none;">         </div><div class="scroll-element scroll-x"><div class="scroll-element_outer"><div class="scroll-element_size"></div><div class="scroll-element_track"></div><div class="scroll-bar" style="width: 100px; left: 0px;"></div></div></div><div class="scroll-element scroll-y"><div class="scroll-element_outer"><div class="scroll-element_size"></div><div class="scroll-element_track"></div><div class="scroll-bar" style="height: 100px; top: 0px;"></div></div></div></div> <div class="p-1"></div> </div> </div> </li>';
                    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<title>Hệ thống</title>
<base href="<?php echo SITE_URL.'/'.ADMINCP_NAME.'/'?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<meta name="apple-mobile-web-app-capable" content="yes"/>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet"/>
<link href="<?php echo ADMINCP_URL;?>css/font-awesome.min.css" rel="stylesheet"/>
<!--<link href="<?php echo ADMINCP_URL;?>/css/ui-lightness/jquery-ui-1.10.0.custom.min.css" rel="stylesheet"/>
    <link href="<?php echo ADMINCP_URL;?>css/bootstrap.min.css" rel="stylesheet"/>
<link href="<?php echo ADMINCP_URL;?>css/bootstrap-responsive.min.css" rel="stylesheet"/>
<link href="<?php echo ADMINCP_URL;?>css/base-admin-2.css" rel="stylesheet"/>
<link href="<?php echo ADMINCP_URL;?>css/base-admin-2-responsive.css" rel="stylesheet"/>
<link href="<?php echo ADMINCP_URL;?>css/pages/dashboard.css" rel="stylesheet"/>
<link href="<?php echo ADMINCP_URL;?>css/custom.css" rel="stylesheet"/> -->
<link href="<?php echo ADMINCP_URL;?>js/plugins/msgGrowl/css/msgGrowl.css" rel="stylesheet" />
<link href="<?php echo ADMINCP_URL;?>js/plugins/lightbox/themes/evolution-dark/jquery.lightbox.css" rel="stylesheet" /> 
<link href="<?php echo ADMINCP_URL;?>bin/vendors/bower_components/jquery/dist/msgBoxLight.css" rel="stylesheet" /> 
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->


<script src="<?php echo ADMINCP_URL;?>bin/vendors/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo ADMINCP_URL;?>js/libs/jquery-ui-1.10.0.custom.min.js"></script>
<script src="<?php echo ADMINCP_URL;?>bin/vendors/bower_components/popper.js/dist/umd/popper.min.js"></script> 
<script src="<?php echo ADMINCP_URL;?>bin/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo ADMINCP_URL;?>js/plugins/msgGrowl/js/msgGrowl.js"></script>
<script src="<?php echo ADMINCP_URL;?>js/plugins/lightbox/jquery.lightbox.min.js"></script>
<script src="<?php echo ADMINCP_URL;?>bin/vendors/bower_components/jquery/dist/jquery.msgBox.min.js"></script>
<script type="text/javascript" src="<?php echo ADMINCP_URL;?>bin/vendors/bower_components/remarkable-bootstrap-notify/dist/bootstrap-notify.min.js"></script>
<script src="<?php echo ADMINCP_URL;?>js/Application.js"></script>
<script src="<?php echo ADMINCP_URL;?>/ckfinder/ckfinder.js"></script>
        <script src="<?php echo ADMINCP_URL;?>ckeditor-new/ckeditor.js"></script>
        <script src="<?php echo ADMINCP_URL;?>ckeditor-new/config.js"></script>
        <script src="<?php echo ADMINCP_URL;?>ckeditor-new/adapters/jquery.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
                <link rel="stylesheet" href="<?php echo ADMINCP_URL;?>bin/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">
        <link rel="stylesheet" href="<?php echo ADMINCP_URL;?>bin/vendors/bower_components/animate.css/animate.min.css">
        <link rel="stylesheet" href="<?php echo ADMINCP_URL;?>bin/vendors/bower_components/jquery.scrollbar/jquery.scrollbar.css">
        <link rel="stylesheet" href="<?php echo ADMINCP_URL;?>bin/vendors/bower_components/fullcalendar/dist/fullcalendar.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo ADMINCP_URL;?>bin/vendors/bower_components/sweetalert2/dist/sweetalert2.min.css">  


        <!-- App styles -->
        <link rel="stylesheet" href="<?php echo ADMINCP_URL;?>bin/css/app.min.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body data-sa-theme="3">
        <main class="main">
            <div class="page-loader">
                <div class="page-loader__spinner">
                    <svg viewBox="25 25 50 50">
                        <circle cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
                    </svg>
                </div>
            </div>

            <header class="header">
                <div class="navigation-trigger hidden-xl-up" data-sa-action="aside-open" data-sa-target=".sidebar">
                    <i class="zmdi zmdi-menu"></i>
                </div>

                <div class="logo hidden-sm-down">
                    <h1><a href="/">Bin Admin 2.0</a></h1>
                </div>

                <form class="search" method="get">
                    <div class="search__inner">
                        <input type="hidden"name="action" value="film"/>
                        <input type="text" class="search__text" name="search" placeholder=" Tìm kiếm phim...">
                        <i class="zmdi zmdi-search search__helper" data-sa-action="search-close"></i>
                    </div>
                </form>

                <ul class="top-nav">
                   <? echo $noti; ?>
                    <li class="hidden-xl-up"><a href="" data-sa-action="search-open"><i class="zmdi zmdi-search"></i></a></li>
                    <li class="dropdown hidden-xs-down">
                        <a href="" data-toggle="dropdown"><i class="zmdi zmdi-more-vert"></i></a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="" class="dropdown-item" data-sa-action="fullscreen">Fullscreen</a>
                            <a href="?action=cache" class="dropdown-item">Clear Cache</a>
                            <a href="?action=config" class="dropdown-item">Settings</a>
                        </div>
                    </li>

                    <li class="hidden-xs-down">
                        <a href="" class="top-nav__themes" data-sa-action="aside-open" data-sa-target=".themes"><i class="zmdi zmdi-palette"></i></a>
                    </li>
                </ul>

                <div class="clock hidden-md-down">
                    <div class="time">
                        <span class="time__hours"></span>
                        <span class="time__min"></span>
                        <span class="time__sec"></span>
                    </div>
                </div>
            </header>

            <aside class="sidebar">
                <div class="scrollbar-inner">
<?php echo user_menu();?>
                    <ul class="navigation">
                    <li>
                    <a href="<?php echo SITE_URL.'/'.ADMINCP_NAME.'/';?>">
                    <i class="zmdi zmdi-home"></i>Trang chủ </a></li>
                    <li><a tabindex="-1" href="?action=grabfilm"><i class="zmdi zmdi-square-down"></i> Leech Phim</a></li>
                    <li><a tabindex="-1" href="?action=film&mode=add"><i class="zmdi zmdi-plus"></i> Thêm Phim Mới</a></li>
                     <li class="navigation__sub">
                            <a href=""><i class="zmdi zmdi-movie"></i> Phim</a>

                            <ul>
                            <li><a href="?action=film"><i class="zmdi zmdi-plus"></i> Danh sách phim</a></li> 
                            <li><a tabindex="-1" href="?action=film&mode=phimle"><i class="zmdi zmdi-plus"></i> Phim lẻ</a></li>
                            <li><a tabindex="-1" href="?action=film&mode=phimbo"><i class="zmdi zmdi-plus"></i> Phim bộ đã hoàn thành</a></li>
                            <li><a tabindex="-1" href="?action=film&mode=phimbochuahoanthanh"><i class="zmdi zmdi-plus"></i> Phim bộ chưa hoàn thành</a></li>
                            <li><a tabindex="-1" href="?action=film&mode=trailer"><i class="zmdi zmdi-plus"></i> Phim Trailer</a></li>
                            <li><a tabindex="-1" href="?action=film&mode=film_member"><i class="zmdi zmdi-plus"></i> Phim thành viên đăng</a></li>
                            <li><a tabindex="-1" href="?action=film&mode=decu"><i class="zmdi zmdi-plus"></i> Phim đề cử</a></li>
                            <li><a tabindex="-1" href="?action=film&mode=slider"><i class="zmdi zmdi-plus"></i> Phim slider</a></li>
                            <li><a tabindex="-1" href="?action=film&mode=bigthumb"><i class="zmdi zmdi-plus"></i> Phim có ảnh lớn</a></li>
                            <li><a tabindex="-1" href="?action=film&mode=error"><i class="zmdi zmdi-plus"></i> Phim bị lỗi</a></li>
                            </ul>
                        </li>
                          <li class="navigation__sub">
                            <a href=""><i class="zmdi zmdi-collection-video"></i> Video</a>

                            <ul>
                            <li><a tabindex="-1" href="?action=media&mode=add"><i class="zmdi zmdi-plus"></i> Thêm video</a></li>
                            <li><a tabindex="-1" href="?action=media"><i class="zmdi zmdi-plus"></i> Danh sách video</a></li>
                            <li><a tabindex="-1" href="?action=media&mode=slide"><i class="zmdi zmdi-plus"></i> Video trên slide</a></li>
                            </ul>
                        </li>
                        <li><a href="?action=category"><i class="zmdi zmdi-view-list-alt"></i>
Thể loại</a></li>
                        <li><a href="?action=country"><i class="zmdi zmdi-city"></i>Quốc gia</a></li>
                          <li class="navigation__sub">
                            <a href=""><i class="zmdi zmdi-rss"></i> Tin Tức</a>
                            <ul>
                        <li><a href="?action=news&mode=add"><i class="zmdi zmdi-plus"></i> Thêm bài viết</a></li>
                        <li><a href="?action=news"><i class="zmdi zmdi-plus"></i> Danh sách bài viết</a></li>
                            </ul>
                        </li>
                        <?php if ($Admingroup == '2') { ?>
                            <li class="navigation__sub">
                            <a href=""><i class="zmdi zmdi-view-list"></i> Khác</a>

                            <ul>
                        <li><a href="?action=actor"><i class="zmdi zmdi-plus"></i> Đạo diễn & Diễn viên</a></li>
                        <li><a href="?action=user"><i class="zmdi zmdi-plus"></i> Thành viên</a></li>
                        <li><a href="?action=log"><i class="zmdi zmdi-plus"></i> Quản lý yêu cầu</a></li>
                        <li><a href="?action=config"><i class="zmdi zmdi-plus"></i> Cài đặt</a></li>
                        <li><a href="?action=config_other"><i class="zmdi zmdi-plus"></i> Cài đặt nâng cao</a></li>
                        <li><a href="?action=ads"><i class="zmdi zmdi-plus"></i> Quản Lí Quảng Cáo</a></li>
                        <li><a href="?action=resetview"><i class="zmdi zmdi-plus"></i> Reset lượt xem</a></li>
                        <li><a href="?action=cache"><i class="zmdi zmdi-plus"></i> Xóa Cache</a></li>
                            </ul>
                        </li>
                    <? } ?>
                    </ul>
                </div>
            </aside>

            <div class="themes">
    <div class="scrollbar-inner">
        <a href="" class="themes__item active" data-sa-value="1"><img src="<?php echo ADMINCP_URL;?>bin/img/bg/1.jpg" alt=""></a>
        <a href="" class="themes__item" data-sa-value="2"><img src="<?php echo ADMINCP_URL;?>bin/img/bg/2.jpg" alt=""></a>
        <a href="" class="themes__item" data-sa-value="3"><img src="<?php echo ADMINCP_URL;?>bin/img/bg/3.jpg" alt=""></a>
        <a href="" class="themes__item" data-sa-value="4"><img src="<?php echo ADMINCP_URL;?>bin/img/bg/4.jpg" alt=""></a>
        <a href="" class="themes__item" data-sa-value="5"><img src="<?php echo ADMINCP_URL;?>bin/img/bg/5.jpg" alt=""></a>
        <a href="" class="themes__item" data-sa-value="6"><img src="<?php echo ADMINCP_URL;?>bin/img/bg/6.jpg" alt=""></a>
        <a href="" class="themes__item" data-sa-value="7"><img src="<?php echo ADMINCP_URL;?>bin/img/bg/7.jpg" alt=""></a>
        <a href="" class="themes__item" data-sa-value="8"><img src="<?php echo ADMINCP_URL;?>bin/img/bg/8.jpg" alt=""></a>
        <a href="" class="themes__item" data-sa-value="9"><img src="<?php echo ADMINCP_URL;?>bin/img/bg/9.jpg" alt=""></a>
        <a href="" class="themes__item" data-sa-value="10"><img src="<?php echo ADMINCP_URL;?>bin/img/bg/10.jpg" alt=""></a>
    </div>
</div>

            <section class="content">
<?php
    parse_str(parse_url(Url::curRequestURL(),PHP_URL_QUERY), $RK);
    $action = $RK['action'];
    $filmid = $RK['filmid'];
    $nt_id = $RK['nt_id'];
    $epid = $RK['epid'];
    $mediaid = $RK['mediaid'];
    $userid = $RK['userid'];
    $groupid = $RK['groupid'];
    $mode = $RK['mode'];
    $page = $RK['page'];
    $search = $RK['search'];
    $page = $RK['page'];
    $cid = $RK['cid'];
    switch ($action) {
        case 'film':
            include View::AdminView('admin_code/film');
            break;
                case 'grabfilm':
            include View::AdminView('admin_code/grabfilm');
            break;
        case 'grabzingtv':
            include View::AdminView('admin_code/grabzingtv');
            break;
        case 'grabclipvn':
            include View::AdminView('admin_code/grabclipvn');
            break;  
        case 'episode':
            include View::AdminView('admin_code/episode');
            break;
        case 'multi-episode':
            include View::AdminView('admin_code/multi_episode');
            break;
        case 'user':
            include View::AdminView('admin_code/user');
            break;
        case 'category':
            include View::AdminView('admin_code/category');
            break;
        case 'country':
            include View::AdminView('admin_code/country');
            break;
        case 'config':
            include View::AdminView('admin_code/config');
            break;
        case 'config_other':
            include View::AdminView('admin_code/config_other');
            break;
        case 'ads':
            include View::AdminView('admin_code/ads');
            break;
        case 'hotmenu':
            include View::AdminView('admin_code/hotmenu');
            break;
        case 'media':
            include View::AdminView('admin_code/media');
            break;
        case 'news':
            include View::AdminView('admin_code/news');
            break;
        case 'actor':
            include View::AdminView('admin_code/actor');
            break;
        case 'log':
            include View::AdminView('admin_code/log');
            break;
        case 'cache':
            include View::AdminView('admin_code/cache');
            break;
        case 'tv':
            include View::AdminView('admin_code/tv');
            break;
        case 'resetview':
            include View::AdminView('admin_code/resetview');
            break;
        case 'thongbao':
            include View::AdminView('admin_code/thongbao');
            break;    
        case 'logout':
            if(LoginAuth::logoutAdmin() == 1) header('Location: '.SITE_URL.'/'.ADMINCP_NAME);
            break;
        default:
            include View::AdminView('home');
    }
?>
                    <footer class="footer hidden-xs-down">
                    <p>© Bin Admin. All rights reserved.</p>

                    <ul class="nav footer__nav">
                        <a class="nav-link" href="">Homepage</a>

                        <a class="nav-link" href="">Company</a>

                        <a class="nav-link" href="">Support</a>

                        <a class="nav-link" href="">News</a>

                        <a class="nav-link" href="">Contacts</a>
                    </ul>
                </footer>
            </section>
        </main>

<!--        <script src="<?php echo ADMINCP_URL;?>bin/vendors/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="<?php echo ADMINCP_URL;?>bin/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    -->
        <script src="<?php echo ADMINCP_URL;?>bin/vendors/bower_components/popper.js/dist/umd/popper.min.js"></script>
        <script src="<?php echo ADMINCP_URL;?>bin/vendors/bower_components/jquery.scrollbar/jquery.scrollbar.min.js"></script>
        <script src="<?php echo ADMINCP_URL;?>bin/vendors/bower_components/jquery-scrollLock/jquery-scrollLock.min.js"></script>
        <script src="<?php echo ADMINCP_URL;?>bin/vendors/bower_components/salvattore/dist/salvattore.min.js"></script>
        <script src="<?php echo ADMINCP_URL;?>bin/vendors/bower_components/flot/jquery.flot.js"></script>
        <script src="<?php echo ADMINCP_URL;?>bin/vendors/bower_components/flot/jquery.flot.resize.js"></script>
        <script src="<?php echo ADMINCP_URL;?>bin/vendors/bower_components/flot.curvedlines/curvedLines.js"></script>
        <script src="<?php echo ADMINCP_URL;?>bin/vendors/bower_components/jqvmap/dist/jquery.vmap.min.js"></script>
        <script src="<?php echo ADMINCP_URL;?>bin/vendors/bower_components/jqvmap/dist/maps/jquery.vmap.world.js"></script>
        <script src="<?php echo ADMINCP_URL;?>bin/vendors/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
        <script src="<?php echo ADMINCP_URL;?>bin/vendors/bower_components/peity/jquery.peity.min.js"></script>
        <script src="<?php echo ADMINCP_URL;?>bin/vendors/bower_components/moment/min/moment.min.js"></script>
        <script src="<?php echo ADMINCP_URL;?>bin/vendors/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>

        <!-- App functions and actions -->
        <script src="<?php echo ADMINCP_URL;?>bin/js/app.min.js"></script>
</body>
</html>
<?php
}
?>