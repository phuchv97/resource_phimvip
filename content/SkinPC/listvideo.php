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
$arr = MySql::dbselect('id,name,url,duration,thumb','media',"id != 0 order by id desc LIMIT $limit,$num");
$total = MySql::dbselect('id','media',"id != 0");
$allpage_site = get_allpage(count($total),$num,$page,SITE_URL."/video/page-");
?>
<div class="clearfix"></div>
<div id="wrap_content">
    <div class="container">
        <div class="content" id="content">
            <div class="group filmrelated">
                <div class="filmrelated-detail">
                    <div class="group-title-bg">
                        <div class="group-title"><span class=""><a><h3><?php echo $title_page;?></h3></a></span>
                        </div>
                    </div>
                    <center><?php echo binads('site_ads2');  ?> </center> 

                    <!-- Bộ lọc -->
                    <div class="filter_film">
                        <form action="<?=SITE_URL?>/danh-sach/phim-moi/" method="GET">
                            <select id="filter-category" name="bycat" class="form-control-filter col-xs-12">
                        <option value="">Thể loại</option>
                        <?php
                        $cat = MySql::dbselect('id,name','category','id != 0');
                        for($i=0;$i<count($cat);$i++) {
                            $name = $cat[$i][1];                        
                            echo "<option value='".$cat[$i][0]."'>$name</option>";
                        }
                        ?>
                        </select>
                            </select>
                            <select class="form-control-filter col-xs-12" id="filter-country" name="bycountry">
                        <option value="">Quốc gia</option>
                        <?php
                        $country = MySql::dbselect('id,name','country','id != 0');
                        for($i=0;$i<count($country);$i++) {
                            $name = $country[$i][1];                        
                            echo "<option value='".$country[$i][0]."'>$name</option>";
                        }
                        ?>
                        </select>
                            </select>
                            <select id="filter-year" name="byyear" class="form-control-filter col-xs-12">
                        <option value="">Năm sản xuất</option>
                        <?php
                        for($i=0;$i<14;$i++) {
                            $name = (2016-$i);
                            
                            echo "<option value='$name'>$name</option>";
                        }
                        ?>
                            </select>
                            <select id="filter-year" name="byquality" class="form-control-filter col-xs-12">
                        <option value="all">Chất Lượng</option>
                        <option value="hd">HD</option>
                        <option value="sd">SD</option>
                        <option value="cam">CAM</option>

                            </select>
                            <select id="filter-year" name="bytype" class="form-control-filter col-xs-12">
                        <option value="all">Vietsub</option>
                        <option value="0">Phụ Đề</option>
                        <option value="1">Thuyết Minh</option>

                            </select>
                            <input type="submit" value="Lọc Phim" class="btn btn-sm btn-primary"> </form>
                    </div>
                    <!-- //Bộ Lọc -->

                    <div id="ctl00_ContentList_UpdatePanel2">
                                                            <?php
                        for($i=0;$i<count($arr);$i++) {
                            $id = $arr[$i][0];
                            $title = $arr[$i][1];
                            $url = get_url($id,$title,'Xem Video');
                            $duration = $arr[$i][3];
                            $thumb = $arr[$i][4];
                            echo '
 <div class="block-base movie">
                            <a href="'.$url.'" class="poster ntips" rel="'.$url.'" title="'.$title.'">
 <img class="thumb" src="'.$thumb.'" alt="'.$title.'" width="180px" height="256px" />
 <span class="tag "></span> <span class="rating"><span class="rate">'.$duration.'</span></span></a> 
<a href="'.$url.'" class="film-name"><h2>'.$title.'</h2>'.$title_en.'</a>
                        </div>
';
}

?>  

                        <div class="clear"></div>

                    </div>

                    <div class="clear"></div>

                    <div class="p-paginate">
                        <ul class="pagination">
<?=$allpage_site?>
 </span>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="sidebar" id="sidebar">
            <!--topphim-->
                        <div class="group-title-bg">
                            <div class="group-title"> <span class="title"><a href="javascript:void(0);">XEM NHIỀU</a></span> <span class="tabs" id="TabTopView"><a href="#content_f1day" onclick="ajaxContentBox('topview-today')" class="tab active">NGÀY</a><a href="#content_f7day" onclick="ajaxContentBox('topview-week')" class="tab">THÁNG</a><a onclick="ajaxContentBox('topview-week')" href="#content_f30day" class="tab">TOP</a></span> </div>
                        </div>
                        <div class="maintabcontent block-secondary box-topday">
                            <div id="content_f1day" class="tabcontent">
                                <h3>PHIM XEM NHIỀU TRONG NGÀY</h3>
                                <ul>
<?php echo bxh_show1("day");?>
                                </ul>
                            </div>
                            <div id="content_f7day" class="tabcontent deactive">
                                <h3>PHIM XEM NHIỀU TRONG THÁNG</h3>
                                <ul>
<?php echo bxh_show1("week");?>
                                </ul>
                            </div>
                            <div id="content_f30day" class="tabcontent deactive"> 
                                <h3>PHIM XEM NHIỀU NHẤT</h3>
                                <ul>
<?php echo bxh_show1("month");?>
                                </ul>
                            </div>
                        </div>
                    </div>
            <!--//topphim-->
        </div>
    </div>
                    <script type="text/javascript">
                        activetab2('#TabTopFilmDeCu');
                        activetab2('#TabTopNewFilm');
                        activetab2('#TabTopNews');
                        activetab2('#TabTopView');
                    </script>

<?php
include View::TemplateView('footer');
?>