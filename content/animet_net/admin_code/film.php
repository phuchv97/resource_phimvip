<div class="content__inner">
	<?php if($Admingroup == '1') echo '<pre>Lưu ý: Bạn đang nằm trong nhóm <b>hợp tác viên</b>, bạn sẽ bị hạn chế một số chức năng thêm/sửa/xóa thông tin trên website.</pre>';?>
<?php
$admin_id = $_SESSION["RK_Adminid"];
	if($mode == 'delete') {
		if($Admingroup == '2') {
			MySql::dbdelete('film',"id = '$filmid'");
			MySql::dbdelete('film_other',"filmid = '$filmid'");
			MySql::dbdelete('episode',"filmid = '$filmid'");
		}
		header('Location: ?action=film');
	} else if($mode == 'add' || $mode == 'edit') {
		$timeupdate = time();
		$title = RemoveHack($_POST['titlevn']);
		$title_en = RemoveHack($_POST['Title']);
		$imdb = RemoveHack($_POST['imdb']);
		$title_search = VietChar($title);
		$director = RemoveHack($_POST['Director']);
		$actor = RemoveHack($_POST['Actors']);
		$category = ','.(implode(',',$_POST['category'])).',';
		$country = RemoveHack($_POST['country']);
		$duration = RemoveHack($_POST['Runtime']);
		$year = RemoveHack($_POST['Year']);
		$thumb = RemoveHack($_POST['thumb']);
		$image_params = getimagesize($_FILES["thumb-upload"]["tmp_name"]);
	    if($image_params !== false) {
	    	$thumb_name = Replace(VietChar($title));
	    	$thumb = IMG_URL."images/film/".$thumb_name.".jpg";
	    	move_uploaded_file($_FILES["thumb-upload"]['tmp_name'], UPLOAD_PATH."images/film/".$thumb_name.".jpg");
	    }
		$filmlb = RemoveHack($_POST['filmlb']);
		$quality = RemoveHack($_POST['quality']);
		$thuyetminh = RemoveHack($_POST['thuyetminh']);
		$trailer = RemoveHack($_POST['trailer']);
		$big_image = RemoveHack($_POST['big_image']);
		$big_params = getimagesize($_FILES["big-upload"]["tmp_name"]);
	    if($big_params !== false) {
	    	$big_name = Replace(VietChar($title_en));
	    	$big_image = IMG_URL."images/info/".$big_name.".jpg";
	    	move_uploaded_file($_FILES["big-upload"]['tmp_name'], UPLOAD_PATH."images/info/".$big_name.".jpg");
	    }
		$release_time = RemoveHack($_POST['release_time']);
		$content = addslashes($_POST['content']);
		$link_down = $_POST['link_down'];
		$keywords = RemoveHack($_POST['keywords']);
        $seotitle = RemoveHack($_POST['seotitle']);
		$lichchieu = addslashes($_POST['lichchieu']);
		$url = addslashes($_POST['url']);
		$url301 = addslashes($_POST['url301']);	
		$banquyen = RemoveHack($_POST['banquyen']);
		$tinhtrang = RemoveHack($_POST['tinhtrang']);	
		$seodescription = RemoveHack($_POST['seodescription']);	
		if($filmid && !$_POST['submit']) {
			$arr = MySql::dbselect('
				tb_film.title,
				tb_film.title_en,
				tb_film.imdb,
				tb_film.director,
				tb_film.actor,
				tb_film.category,
				tb_film.country,
				tb_film.duration,
				tb_film.year,
				tb_film.thumb,
				tb_film.filmlb,
				tb_film.quality,
				tb_film.trailer,
				tb_film.big_image,
				tb_film.release_time,
				tb_film_other.content,
				tb_film_other.keywords,
				tb_film.userpost,
				tb_film_other.searchs,
				tb_film.thuyetminh,
				tb_film.link_down,
				tb_film.lichchieu,
				tb_film.seotitle,
				tb_film.url,
				tb_film.url301,
				tb_film.banquyen,
				tb_film.tinhtrang,
				tb_film.seodescription
				','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"filmid = '$filmid'");
			$title = RemoveHack($arr[0][0]);
			$title_en = RemoveHack($arr[0][1]);
			$imdb = RemoveHack($arr[0][2]);
			$director = RemoveHack($arr[0][3]);
			$actor = RemoveHack($arr[0][4]);
			$category = RemoveHack($arr[0][5]);
			$country = RemoveHack($arr[0][6]);
			$duration = RemoveHack($arr[0][7]);
			$year = RemoveHack($arr[0][8]);
			$thumb = RemoveHack($arr[0][9]);
			$filmlb = RemoveHack($arr[0][10]);
			$quality = RemoveHack($arr[0][11]);
			$trailer = RemoveHack($arr[0][12]);
			$big_image = RemoveHack($arr[0][13]);
			$release_time = RemoveHack($arr[0][14]);
			$content = $arr[0][15];
			$keywords = RemoveHack($arr[0][16]);
			$userpost = $arr[0][17];
			$thuyetminh = RemoveHack($arr[0][19]);
			$link_down = $arr[0][20];
			$lichchieu = $arr[0][21];
			$seotitle = $arr[0][22];
			$url = $arr[0][23];
			$url301 = $arr[0][24];
			$banquyen = $arr[0][25];
			$tinhtrang = $arr[0][26];
			$seodescription = $arr[0][27];
		}
	if($mode == 'add' && $_POST['submit'] && ($Admingroup == '2' or $Admingroup == '1')) {
		$timeupdate = time();
		MySql::dbinsert("film",
		"title,title_en,imdb,title_search,director,actor,category,country,duration,year,thumb,filmlb,quality,trailer,big_image,release_time,timeupdate,userpost,thuyetminh,link_down,lichchieu,seotitle,url,seodescription",
		"'$title','$title_en','$imdb','$title_search','$director','$actor','$category','$country','$duration','$year','$thumb','$filmlb','$quality','$trailer','$big_image','$release_time','$timeupdate','$admin_id','$thuyetminh','$link_down','$lichchieu','$seotitle','$url','$seodescription'");
		$filmis = mysql_insert_id();
		MySql::dbinsert("film_other","filmid,content,keywords,searchs","'$filmis','$content','$keywords','$keywords'");
		header('Location: ?action=film');
	}else if($mode == 'edit' && $_POST['submit'] && ($Admingroup != 0)) {
		//echo UPLOAD_PATH;
		$lin = CACHE_ADD.'/film/cached-'.$filmid.'.html';
		unlink($lin);
		array_map('unlink', glob(CACHE_ADD."/film/".$filmid."-*"));
		$timeupdate = time();
		MySql::dbupdate('film',"
			title = '$title',
			title_en = '$title_en',
                        imdb = '$imdb',
			title_search = '$title_search',
			director = '$director',
			actor = '$actor',
			category = '$category',
			country = '$country',
			duration = '$duration',
			year = '$year',
			thumb = '$thumb',
			filmlb = '$filmlb',
			quality = '$quality',
			trailer = '$trailer',
			big_image = '$big_image',
			release_time = '$release_time',
			timeupdate = '$timeupdate',
			thuyetminh = '$thuyetminh',
			link_down  = '$link_down',
            lichchieu = '$lichchieu',
            seotitle = '$seotitle',
            url = '$url',
            url301 = '$url301',
            banquyen = '$banquyen',
			tinhtrang = '$tinhtrang',
			seodescription = '$seodescription'
			","id = '$filmid'");
		MySql::dbupdate('film_other',"
			content = '$content',
			keywords = '$keywords'
			","filmid = '$filmid'");
		header('Location: ?action=film');
	}else if($_POST['submit'] && $Admingroup !== '2') {
		header('Location: ?action=film');
	}
?>
<script type="text/javascript" language="javascript">
	CKFinder.setupCKEditor();
            
			CKEDITOR.replace('content',{
                filebrowserBrowseUrl: '<?php echo ADMINCP_URL;?>/ckfinder/ckfinder.html',
                filebrowserImageBrowseUrl: '<?php echo ADMINCP_URL;?>/ckfinder/ckfinder.html?type=Images',
                filebrowserUploadUrl:
                '<?php echo ADMINCP_URL;?>/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&currentFolder=/archive/',
                filebrowserImageUploadUrl:
                '<?php echo ADMINCP_URL;?>/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images&currentFolder=/cars/'
			});
			CKEDITOR.replace('lichchieu',{
                filebrowserBrowseUrl: '<?php echo ADMINCP_URL;?>/ckfinder/ckfinder.html',
                filebrowserImageBrowseUrl: '<?php echo ADMINCP_URL;?>/ckfinder/ckfinder.html?type=Images',
                filebrowserUploadUrl:
                '<?php echo ADMINCP_URL;?>/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&currentFolder=/archive/',
                filebrowserImageUploadUrl:
                '<?php echo ADMINCP_URL;?>/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images&currentFolder=/cars/'
			});
			
$(function () {

	$('textarea#content').ckeditor();
        $('textarea#lichchieu').ckeditor();
});
</script>
		<div class="card">
			<div class="card-title">
				<i class="icon-check"></i>
				<h3>Đăng / Sửa phim</h3>
			</div>
			<!-- /widget-header -->
			<div class="card-body">
				<form class="form-horizontal" method="post" enctype="multipart/form-data"/>
					<fieldset>

						<div class="control-group">
							<label class="control-label" for="title">Tên phim</label>
							<div class="controls">
								<input type="text" class="input-large" name="titlevn" id="titlevn" value="<?php echo $title;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="Title">Tên tiếng anh</label>
							<div class="controls">
								<input type="text" class="input-large" name="Title" id="title_en" value="<?php echo $title_en;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="Title">Tiêu Đề SEO</label>
							<div class="controls">
								<input type="text" class="input-large" name="seotitle" id="seotitle" value="<?php echo $seotitle;?>"/>(Bỏ qua nếu dùng mặc định)
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="Title">SEO Thẻ Meta Description </label>
							<div class="controls">
								<input type="text" class="input-large" name="seodescription" id="seodescription" value="<?php echo $seodescription;?>"/>(Cần thiết cho seo meta description (có thể bỏ qua))
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="Title">URL SEO</label>
							<div class="controls">
								<input type="text" class="input-large" name="url" id="url" value="<?php echo $url;?>"/>(chỉ thêm khi dính DMCA url)
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="Title">URL 301</label>
							<div class="controls">
					    <input type="text" class="input-large" name="url301" id="url301" value="<?php echo $url301;?>"/>(chỉ thêm khi dính DMCA url)
							</div>
						</div>						
						<div class="control-group">
							<label class="control-label" for="Title">Điểm IMDB</label>
							<div class="controls">
								<input type="text" class="input-large" name="imdb" id="imdb" value="<?php echo $imdb;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="director">Đạo diễn</label>
							<div class="controls">
								<input type="text" class="input-large" name="Director" id="director" value="<?php echo $director;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="actor">Diễn viên</label>
							<div class="controls">
								<input type="text" class="input-large" name="Actors" id="actor" value="<?php echo $actor;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="category">Thể loại</label>
							<div class="controls">
								<?php echo admin_category($category);?>
							</div>
						</div>                            
						<div class="control-group">
							<label class="control-label" for="country">Quốc gia</label>
							<div class="controls">
								<select class="input-large" id="country" name="country">
								<?php echo admin_country($country);?>
								</select>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="duration">Thời lượng</label>
							<div class="controls">
								<input type="text" class="input-large" name="Runtime" id="duration" value="<?php echo $duration;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="year">Năm sản xuất</label>
							<div class="controls">
								<input type="text" class="input-large" name="Year" id="year" value="<?php echo $year;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="thumb">Ảnh phim</label>
							<div class="controls">
								<input type="text" class="input-large" name="thumb" id="thumb" value="<?php echo $thumb;?>"/>
								<br />
								<input type="file" name="thumb-upload" id="thumb-upload"/>
                                <!--button class="btn" type="button">Change Content</button-->
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="filmlb">Phân loại</label>
							<div class="controls">
								<select class="input-large" id="filmlb" name="filmlb">
								<?php echo admin_filmlb($filmlb);?>
								</select>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="quality">Chất lượng</label>
							<div class="controls">
								<input type="text" class="input-large" name="quality" id="quality" value="<?php echo $quality;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="Status">Status</label>
							<div class="controls">
								<input type="text" class="input-large" name="tinhtrang" id="tinhtrang" value="<?php echo $tinhtrang;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="quality">Tình Trạng</label>
							<div class="controls">
								<select class="input-large" name="thuyetminh">
								<option value="0" <?if($thuyetminh==0) { echo "selected";}?>>Viet Sub</option>
								<option value="1" <?if($thuyetminh==1) { echo "selected";}?>>Thuyết Minh</option>
								<option value="2" <?if($thuyetminh==2) { echo "selected";}?>>No Sub</option>
								<option value="3" <?if($thuyetminh==3) { echo "selected";}?>>Trailer</option>
								</select>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="copyright">Bản Quyền</label>
							<div class="controls">
								<select class="input-large" name="banquyen">
								<option value="0" <?if($banquyen==0) { echo "selected";}?>>Không Vi Phạm</option>
								<option value="1" <?if($banquyen==1) { echo "selected";}?>>Vi Phạm</option>
								</select>
							</div>
						</div>						
						<div class="control-group">
							<label class="control-label" for="trailer">Trailer</label>
							<div class="controls">
								<input type="text" class="input-large" name="trailer" id="trailer" value="<?php echo $trailer;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="trailer">Link Download</label>
							<div class="controls">
								<input type="text" class="input-large" name="link_down" id="link_down" value="<?php echo $link_down;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="big_image">Ảnh lớn</label>
							<div class="controls">
								<input type="text" class="input-large" name="big_image" id="big_image" value="<?php echo $big_image;?>"/>
<br />
								<input type="file" name="big-upload" id="big-upload"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="release_time">Ngày phát hành</label>
							<div class="controls">
								<textarea id="release_time" name="Released" class="input-large"><?php echo $release_time;?></textarea>								
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="content">Thông tin phim</label>
							<div class="controls">
								<textarea id="content" name="content" class="input-large" rows="8"><?php echo $content;?></textarea>
								
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="content">Lịch chiếu phim</label>
							<div class="controls">
								<textarea id="lichchieu" name="lichchieu" class="input-large" rows="6"><?php echo $lichchieu;?></textarea>
								
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="keywords">Từ khóa phim</label>
							<div class="controls">
								<textarea id="keywords" name="keywords" class="input-large" rows="3"><?php echo $keywords;?></textarea>
							</div>
						</div>
						<div class="form-actions">
							<button type="submit" class="btn btn-danger btn" name="submit" value="submit">Hoàn tất</button>&nbsp;&nbsp; <button type="reset" class="btn">Làm lại</button>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
<?php }else { 
if($mode == 'phimle') {
	$sql = 'filmlb = 0 AND active!=2';
	$list_title = 'phim mới';
	$url_page = '?action=film&mode=phimle';
}elseif($mode == 'phimbo') {
	$sql = 'filmlb = 1 AND active!=2';
	$list_title = 'phim đã hoàn thành';
	$url_page = '?action=film&mode=phimbo';
}elseif($mode == 'phimbochuahoanthanh') {
	$sql = 'filmlb = 2 AND active!=2';
	$list_title = 'phim chưa hoàn thành';
	$url_page = '?action=film&mode=phimbochuahoanthanh';
}elseif($mode == 'decu') {
	$sql = 'decu = 1 AND active!=2';
	$list_title = 'phim đề cử';
	$url_page = '?action=film&mode=decu';
}elseif($mode == 'slider') {
	$sql = "slider = '1 AND active!=2'";
	$list_title = 'phim trên slider';
	$url_page = '?action=film&mode=slider';
}elseif($mode == 'error') {
	$sql = "error = '1 AND active!=2'";
	$list_title = 'phim bị lỗi';
	$url_page = '?action=film&mode=error';
}elseif($mode == 'bigthumb') {
	$sql = "big_image != ' AND active!=2'";
	$list_title = 'phim có ảnh lớn';
	$url_page = '?action=film&mode=bigthumb';
}elseif($mode == 'trailer') {
	$sql = "category LIKE '%,42,%' AND active!=2";
	$list_title = 'phim Trailer';
	$url_page = '?action=film&mode=trailer'; 
}elseif($mode == 'film_member') {
	$sql = "active = '2'";
	$list_title = 'phim thành viên đăng';
	$url_page = '?action=film&mode=film_member';
}elseif($mode == 'userpost') {
	$sql = "userpost = '".$_REQUEST['id']."' AND active!=2";
	$list_title = 'Danh sách phim của '.username($_REQUEST['id']).' đã đăng';
	$url_page = '?action=film&mode=userpost&id='.$_REQUEST['id'];
}elseif($search) {
	$sql = "title like '%$search%' OR title_en like '%$search%' AND active!=2";
	$list_title = "phim có từ khóa: $search";
	$url_page = "?action=film&search=$search";
}else {
	$sql = 'id != 0 AND active!=2';
	$list_title = 'phim mới';
	$url_page = '?action=film';
}
$num		= 	30;
$num 		= 	intval($num);
$page 		= 	intval($page);
if (!$page) 	$page = 1;
$limit 		= 	($page-1)*$num;
if($limit<0) 	$limit=0;
$arr = MySql::dbselect('
	tb_film.id,
	tb_film.title,
	tb_film.title_en,
	tb_film.thumb,
	tb_film.year,
	tb_film.big_image,
	tb_film_other.content,
	tb_film.quality,
	tb_film.country,
	tb_film.category,
	tb_film.filmlb,
	tb_film.viewed,
	tb_film.active,
	tb_film.userpost,
	tb_film.imdb,
	tb_film.url,
	tb_film.url301,
	tb_film.seodescription
	','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"$sql order by id desc LIMIT $limit,$num");
$total = MySql::dbselect('tb_film.id','film JOIN tb_film_other ON (tb_film_other.filmid = tb_film.id)',"$sql");
$allpage_site = get_allpage(count($total),$num,$page,$url_page.'&page=');
if($_POST['submit'] && ($Admingroup == '2' or $Admingroup == '1')) {
	$idlist = implode(',',$_POST['checkbox']);
	if($_POST['filmsetting'] == 'hide') MySql::dbupdate('film',"active = '0'","id IN ($idlist)");
	if($_POST['filmsetting'] == 'show') MySql::dbupdate('film',"active = '1'","id IN ($idlist)");
	if($_POST['filmsetting'] == 'decu') MySql::dbupdate('film',"decu = '1'","id IN ($idlist)");
	if($_POST['filmsetting'] == 'undecu') MySql::dbupdate('film',"decu = '0'","id IN ($idlist)");
	if($_POST['filmsetting'] == 'slider') MySql::dbupdate('film',"slider = '1'","id IN ($idlist)");
	if($_POST['filmsetting'] == 'unslider') MySql::dbupdate('film',"slider = '0'","id IN ($idlist)");
	if($_POST['filmsetting'] == 'phimle') MySql::dbupdate('film',"filmlb = '0'","id IN ($idlist)");
	if($_POST['filmsetting'] == 'phimbo') MySql::dbupdate('film',"filmlb = '1'","id IN ($idlist)");
	if($_POST['filmsetting'] == 'phimbochuahoanthanh') MySql::dbupdate('film',"filmlb = '2'","id IN ($idlist)");
	if($_POST['filmsetting'] == 'unerror') MySql::dbupdate('film',"error = '0'","id IN ($idlist)");
    if($_POST['filmsetting'] == 'delbilly') {
    	MySql::dbdelete('film',"id IN ($idlist)");
    	MySql::dbdelete('film_other',"filmid IN ($idlist)");
    	MySql::dbdelete('episode',"filmid IN ($idlist)");
    }
	header('Location: '.$url_page);
} else if($_POST['submit'] && $Admingroup !== '2'){
	header('Location: '.$url_page);
}
?>
<script type="text/javascript" language="javascript">
$(function () {
	$('.deletefilm').live('click', function (e) {
		var url = $(this).attr('data-url');
		$.msgBox({
		title: "Bạn có chắc muốn xóa phim này?",	
		type: "confirm",
		buttons : [{ value: "Yes" }, { value: "No" }],
		success: function (result) {
		if (result == "Yes") {
		window.location.href = url;
		}
		}
	});
		});
	$('form#list').on('submit', function(e) {
		if (confirm('Bạn có chắc muốn thực hiện hành động này?')) {
			return true;
		} else {
			return false;
		}
	});
	var check_all = false;
	$('#check_all').change(function (e) {
		if(check_all == false) {
			$('form#list input:checkbox').attr('checked',true); 
			$(this).html('Bỏ chọn'); 
			check_all = true;
		} else {
			$('form#list input:checkbox').attr('checked',false); 
			$(this).html('Chọn hết'); 
			check_all = false;
		}
	});
});
</script>

	<div class="card">
                    <div class="card-body">
			<div>
				<?php if($arr) { ?>
				<form id="list" method="post">
				<div class="table-responsive">
					<section id="tables">
					<h3>Danh sách <?php echo $list_title?></h3>
					<table class="table table-bordered table-striped table-highlight">
					<thead>
					<tr>
						<th width="70px">
							<label class="custom-control custom-checkbox">
                             <input id="check_all" type="checkbox" class="custom-control-input">
                                    Chọn hết
                                    <span class="custom-control-indicator"></span>
                            </label>
						</th>
						<th width="80px"><label>Ảnh phim</label></th>
						<th width="66%"><label>Tên phim</label></th>
						<th><label>Chức năng</label></th>
					</tr>
					</thead>
					<tbody>
					<?php
						for($i=0;$i<count($arr);$i++) {
							$id = $arr[$i][0];
							$title = $arr[$i][1];
							$title_en = $arr[$i][2];
							$thumb = $arr[$i][3];
							$year = $arr[$i][4];
							$filmlb = filmlb_a($arr[$i][10]);
							$viewed = $arr[$i][11];
							$active = $arr[$i][12];
							$userpost = $arr[$i][13];
							$seodescription = $arr[$i][17];
							$lastep =  MySql::dbselect('name','episode',"filmid = '$id' order by id desc LIMIT 1");
							$last = $lastep[0][0];
							$category = category_a($arr[$i][9]);
									if ($arr[$i][15]) {
					        	$urlfilm = get_url($arr[$i][0],$arr[$i][15],'Phim');
					            }
					        	else {
		                        $urlfilm = get_url($arr[$i][0],$title,'Phim');
					        	 }
							$country = one_data('name','country',"id = '".$arr[$i][8]."'");
							if(!$thumb) $thumb = TEMPLATE_URL.'images/grey.jpg';
					?>
					<tr>
						<td>
							<label class="custom-control custom-checkbox">
							<input class="custom-control-input" type="checkbox" name="checkbox[]" value="<?php echo $id;?>">
							<span class="custom-control-indicator"></span></label></td>
						<td><img src="<?php echo $thumb;?>" alt="<?php echo $title.' - '.$title_en;?>" height="120px" width="80px"></td>
						<td>
							<a href="<?php echo $urlfilm;?>" target="_blank"><?php echo $title.' - '.$title_en;?></a><br />
							Tập mới nhất: <?php echo $last;?><br />
							Phân loại: <?php echo $filmlb?> (<i>Hiện đang : <?if($active==1) echo "Hiện"; else echo "Ẩn";?></i>) <br />
							Thể loại: <?php echo $category;?><br />
							Quốc gia: <?php echo $country;?><br />
							Người đăng: <a href="?action=film&mode=userpost&id=<?=$userpost?>"><?php echo username($userpost);?></a><br />
                            Lượt xem: <?php echo $viewed;?>
						</td>
						<td>
							<p class="text-center">
								<a class="btn btn-info" href="?action=multi-episode&filmid=<?php echo $id;?>">Thêm nhiều tập</a>
							</p>
							<p class="bin">
								<a class="btn btn-outline-success" href="?action=film&mode=edit&filmid=<?php echo $id;?>">Sửa phim</a>&nbsp;&nbsp;
								<a class="btn btn-outline-danger deletefilm" data-url="?action=film&mode=delete&filmid=<?php echo $id;?>">Xóa phim</a>
							</p>
							<p class="bin">
								<a class="btn btn-outline-success" href="?action=episode&mode=add&filmid=<?php echo $id;?>">Thêm tập</a>&nbsp;&nbsp;
								<a class="btn btn-outline-success" href="?action=episode&filmid=<?php echo $id;?>">Tập phim</a>
							</p>
						</td>
					</tr>
					<?php } ?>
					</tbody>
					<?php echo $allpage_site;?>
					</table>
					</section>
				</div>
				<select name="filmsetting" class="input-large" style="margin-top: 10px;">
					<option>Chọn...</option>
					<option value='delbilly'>Xóa Phim</option>
					<option value='hide'>Ẩn phim</option>
					<option value='show'>Hiện phim</option>
					<option value='decu'>Phim đề cử</option>
					<option value='undecu'>Bỏ phim đề cử</option>
					<option value='slider'>Phim trên slider</option>
					<option value='unslider'>Bỏ phim trên slider</option>
					<option value='phimle'>Chọn phim lẻ</option>
					<option value='phimbo'>Chọn phim đã hoàn thành</option>
					<option value='phimbochuahoanthanh'>Chọn phim bộ chưa hoàn thành</option>
					<option value='unerror'>Phim đã sửa lỗi</option>
				</select>
				<input id="submit_setting" type="submit" class="btn btn-small btn-warning" name="submit" value="Thực hiện"> 
				</form>
				<?php echo $allpage_site;?>
				<?php } else { ?>
				<div class="widget stacked ">
					<div class="widget-header">
						<i class="icon-th-large"></i>
						<h3>Thông báo</h3>
					</div>
					<div class="widget-content">
						Không có phim nào được liệt kê
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
<?php } ?>
	</div>
</div>