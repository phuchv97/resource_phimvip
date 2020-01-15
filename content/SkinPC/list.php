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
$page       =   $page[1];
$num        =   '24';
$num        =   intval($num);
$page       =   intval($page);
if (!$page)     $page = 1;
$limit      =   ($page-1)*$num;
if($limit<0)    $limit=0;
$arr = MySql::dbselect('tb_film.id,tb_film.title,tb_film.title_en,tb_film.thumb,tb_film.year,tb_film.big_image,tb_film.quality,tb_film.year,tb_film.duration,tb_film.filmlb,tb_film.thuyetminh,tb_film.category,tb_film.url','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"$sql $orderby LIMIT $limit,$num");
$total = MySql::dbselect('tb_film.id','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"$sql");
$allpage_site = get_allpage(count($total),$num,$page,$url_page.'/page-');
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
                <div class="row">
<div class="col-md-2">  <select id="cat" name="cat" class="form-control">
<option value="">Thể Loại</option>
<?php
                        $cat = MySql::dbselect('id,name','category','id != 0');
                        for($i=0;$i<count($cat);$i++) {
                            $name = $cat[$i][1];                        
                            echo "<option value='".$cat[$i][0]."'>$name</option>";
                        }
                        ?>
</select>
</div>
<div class="col-md-2">
<select class="form-control" id="country" name="country">
<option value="">Quốc gia</option>
<?php
                        $country = MySql::dbselect('id,name','country','id != 0');
                        for($i=0;$i<count($country);$i++) {
                            $name = $country[$i][1];                        
                            echo "<option value='".$country[$i][0]."'>$name</option>";
                        }
                        ?>
</select>
</div>
<div class="col-md-2">
<select id="year" name="year" class="form-control">
<option value="">Năm phát hành</option>
 <?php
                        for($i=0;$i<12;$i++) {
                            $name = (2019-$i);
                            
                            echo "<option value='$name'>$name</option>";
                        }
                        ?>
</select>
</div>
<div class="col-md-2">
                            <select id="type" name="type" class="form-control">
                        <option value="">Ngôn Ngữ</option>
                        <option value="0">Phụ Đề</option>
                        <option value="1">Thuyết Minh</option>

                            </select>
                        </div>
<div class="col-md-2">
<select class="form-control" id="byorder" name="byorder">
<option value="">Sắp xếp</option>    
<option value="timeupdate">Thời gian cập nhật</option>
<option value="viewed">Lượt xem</option>
<option value="year">Năm sản xuất</option>
</select>
</div>
<div class="col-md-2">
<select class="form-control" id="hinhthuc" name="hinhthuc">
<option value="">Hình thức</option>
<option value="phim-le">Phim lẻ</option>
<option value="phim-bo">Phim bộ</option>
</select>
</div>
<div class="clearfix"></div>
<div class="col-md-2">
            <span class="btn btn-primary" onclick="loc();">Lọc Phim</span>
        </div>

</div>
            <div class="block" id="binlist">
                <div class="block-heading">
                    <h1 class="block-title"> <img class="ico" src="<?php echo SITE_URL;?>/bintheme/images/movie.png">Danh Sách <?php echo $title_page;?></h1></div>
                <div class="block-content">
                    <div class="block-items row fix-row">
                        <?php 
            for($i=0;$i<count($arr);$i++) {
                $filmid = $arr[$i][0];
                $name = $arr[$i][1];
                $filmlb = $arr[$i][10];
                $name_en = $arr[$i][2];
                $quality = $arr[$i][7];
                $year = $arr[$i][4];
                $duration = $arr[$i][8];
                $thumb = $arr[$i][3];
                $thuyetminh = $arr[$i][10];
                $cat = $arr[$i][11];
                $content = CutName(RemoveHtml(UnHtmlChars($arr[$i][6])),220);
                 if ($arr[$i][12]) {
                        $url = get_url($arr[$i][0],$arr[$i][12],'Phim');
                        } 
                        else {
                        $url = get_url($arr[$i][0],$name,'Phim');
                         }
                $episode = MySql::dbselect('id,name','episode',"filmid = '$filmid' order by id desc limit 1");
                $epname = $episode[0][1];
                    if($thuyetminh == 1){
                        $phude = 'Thuyết Minh';
                                    $code = '<div class="thuyetminhviet" title="Phim có thuyết minh"></div>';
                    }elseif($thuyetminh == 2){
                        $phude = 'Nosub';
                    }elseif($thuyetminh == 3){
                        $phude = 'Trailer';
                    }else {
                        $phude = 'Vietsub';
                    }
                if($arr[$i][9]!=0){
                    $type[$i] = 'phimbo';
                }
                if($arr[$i][9]!=0) { $epnames[$i] = "<span class=\"badge\">Tập ". substr(abs((int) filter_var($epname, FILTER_SANITIZE_NUMBER_INT)),0,3)."-$phude</span>";
                } else {$epnames[$i] = "<span class=\"badge\">HD-$phude</span>";}

echo '<div id="film-'.$filmid.'" class="col-xlg-2 col-lg-15 col-md-3 col-sm-4 col-xs-6">
                <div class="item">
                    <a class="inner" href="'.$url.'" title="'.$name.' - '.$name_en.'"> 
                        <img data-src="'.SITE_URL.'/anh-phim/218-320/bin/'.urlimg($thumb).'" alt="'.$name.' - '.$name_en.'" class="lazyload movie-thumb" /> 
                        <span class="thumb-icon"> <i class="sp-movie-icon-play"></i> </span> <span class="overlay"></span>
                            <div class="description">
                                <h3 class="text-nowrap">'.$name.' </h3>
                                <div class="meta clearfix"> <span class="pull-left"> '.$year.' </span> <span class="pull-right">'.$duration.'</span></div>
                        </div> '.$epnames[$i].'
                    </a>
                </div> 
            </div>';

}
if($id=='phimle'){
    $flb = 0;
}elseif($id=='phimbo'){
    $flb = 0;
}
if (!$arr) echo 'Không có phim nào ! Bạn có thể tìm bằng tên tiếng anh hoặc từ khóa không dẫu';
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
</div>        <div class="ads ads-floating ads-floating-right"></div>
    </div>
</section>      </div>
        </section>
<script type="text/javascript">
    function loc(page) {
        if (!page){
        page = 1;
           }
        var cat = $("#cat").val();
        var country = $("#country").val();
        var year = $("#year").val();
        var type = $("#type").val();
        var byorder = $("#byorder").val();  
        var hinhthuc = $("#hinhthuc").val();
        var dataString = 'cat='+ cat + '&country=' + country + '&year=' + year + '&type=' + type + '&byorder=' + byorder + '&hinhthuc='+ hinhthuc +'&page='+ page ;
        $.ajax({
            type:"POST",                
            url: base_url+"ajax/get_filter_box/",
            data: dataString,
            success: function(e){
                $("#binlist").html(e);
                toastr.success('Đã lọc phim thành công, mời bạn xem danh sách phim bên dưới');
            }
        });
    };
</script>
<?php
include View::TemplateView('footer');
?> 