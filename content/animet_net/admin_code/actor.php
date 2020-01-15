<div class="main">
	<div class="container">
<?php 
if($mode == 'delete') {
	MySql::dbdelete('actor',"id = '$cid'");
	header('Location: ?action=actor');
}
else if($mode == 'add' || $mode == 'edit') {
	if($mode == 'edit') {
		$arr = MySql::dbselect('name,site_title,site_description,ngheNghiep,ngaySinh,quocGia,chieuCao,canNang,ngonNgu,gioiThieu,thumb','actor',"id = '$cid'");
		$name = $arr[0][0];
		$site_title = $arr[0][1];
		$site_description = $arr[0][2];	
		$thumb = $arr[0][10];
		$ngheNghiep = $arr[0][3];
		$ngaySinh = $arr[0][4];
		$quocGia = $arr[0][5];
		$chieuCao = $arr[0][6];
		$canNang = $arr[0][7];
		$ngonNgu = $arr[0][8];
		$gioiThieu = $arr[0][9];
		
	}
	if($mode == 'edit' && $_POST['submit']) {

		$name = RemoveHack($_POST['name']);
		$ngheNghiep = RemoveHack($_POST['ngheNghiep']);
		$site_title = RemoveHack($_POST['site_title']);
		$site_description = RemoveHack($_POST['site_description']);	
		$ngaySinh = RemoveHack($_POST['ngaySinh']);
		$quocGia = RemoveHack($_POST['quocGia']);
		$chieuCao = RemoveHack($_POST['chieuCao']);
		$canNang = RemoveHack($_POST['canNang']);
		$ngonNgu = RemoveHack($_POST['ngonNgu']);
		$gioiThieu = addslashes($_POST['content']);

		$thumb = RemoveHack($_POST['thumb']);
		$image_params = getimagesize($_FILES["thumb-upload"]["tmp_name"]);
	    if($image_params !== false) {
	    	$thumb_name = Replace(VietChar($name));
	    	$thumb = IMG_URL."images/film/".$thumb_name.".jpg";
	    	move_uploaded_file($_FILES["thumb-upload"]['tmp_name'], UPLOAD_PATH."images/film/".$thumb_name.".jpg");
	    }
		MySql::dbupdate('actor',"name='$name',ngheNghiep='$ngheNghiep',site_title='$site_title',thumb='$thumb',site_description='$site_description',ngaySinh='$ngaySinh',quocGia='$quocGia',chieuCao='$chieuCao',canNang='$canNang',ngonNgu='$ngonNgu',gioiThieu='$gioiThieu'","id = '$cid'");
		header("Location: ?action=actor&mode=edit&cid=$cid");
	}
	else if($mode == 'add' && $_POST['submit']) {

		$name = RemoveHack($_POST['name']);
		$ngheNghiep = RemoveHack($_POST['ngheNghiep']);
		$site_title = RemoveHack($_POST['site_title']);
		$site_description = RemoveHack($_POST['site_description']);	
		$ngaySinh = RemoveHack($_POST['ngaySinh']);
		$quocGia = RemoveHack($_POST['quocGia']);
		$chieuCao = RemoveHack($_POST['chieuCao']);
		$canNang = RemoveHack($_POST['canNang']);
		$ngonNgu = RemoveHack($_POST['ngonNgu']);
		$gioiThieu = addslashes($_POST['content']);

		$thumb = RemoveHack($_POST['thumb']);
		$image_params = getimagesize($_FILES["thumb-upload"]["tmp_name"]);
	    if($image_params !== false) {
	    	$thumb_name = Replace(VietChar($name));
	    	$thumb = IMG_URL."images/film/".$thumb_name.".jpg";
	    	move_uploaded_file($_FILES["thumb-upload"]['tmp_name'], UPLOAD_PATH."images/film/".$thumb_name.".jpg");
	    }
		MySql::dbinsert("actor","name,site_title,site_description,ngheNghiep,ngaySinh,quocGia,chieuCao,canNang,ngonNgu,gioiThieu,thumb","'$name','$site_title','$site_description','$ngheNghiep','$ngaySinh','$quocGia','$chieuCao','$canNang','$ngonNgu','$gioiThieu','$thumb'");
		header("Location: ?action=actor");
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

// ClassicEditor.create(document.getElementById('content'));
$(function () {
	$('textarea#content').ckeditor();
});
CKEDITOR.replace('content');
</script>
		<div class="widget stacked">
			<div class="widget-header">
				<i class="icon-check"></i>
				<?php if($mode == 'edit'){ echo "<h3>Sửa đạo diễn - diễn viên</h3>";}else if($mode == 'add'){echo "<h3>Thêm đạo diễn - diễn viên</h3>";}?>
			</div>
			<!-- /widget-header -->
			<div class="widget-content">
				<form class="form-horizontal" method="post" enctype="multipart/form-data"/>
					<fieldset>
						<div class="control-group">
							<label class="control-label" for="name">Tên</label>
							<div class="controls">
								<input type="text" class="input-large" name="name" id="name" value="<?php echo $name;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="site_title">Site title</label>
							<div class="controls">
								<textarea id="site_title" name="site_title" class="span8" rows="2"><?php echo $site_title;?></textarea>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="site_description">Site Description</label>
							<div class="controls">
								<textarea id="site_description" name="site_description" class="span8" rows="2"><?php echo $site_description;?></textarea>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="thumb">Ảnh đại diện</label>
							<div class="controls">
								<input type="text" class="input-large" name="thumb" id="thumb" value="<?php echo $thumb;?>"/>
								<br />
								<input type="file" name="thumb-upload" id="thumb-upload"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="ngheNghiep">Nghề Nghiệp</label>
							<div class="controls">
								<input type="text" class="input-large" name="ngheNghiep" id="ngheNghiep" value="<?php echo $ngheNghiep;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="ngaySinh">Ngày Sinh</label>
							<div class="controls">
								<input type="text" class="input-large" name="ngaySinh" id="ngaySinh" value="<?php echo $ngaySinh;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="quocGia">Quốc Gia</label>
							<div class="controls">
								<input type="text" class="input-large" name="quocGia" id="quocGia" value="<?php echo $quocGia;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="canNang">Cần Nặng</label>
							<div class="controls">
								<input type="text" class="input-large" name="canNang" id="canNang" value="<?php echo $canNang;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="chieuCao">Chiều Cao</label>
							<div class="controls">
								<input type="text" class="input-large" name="chieuCao" id="chieuCao" value="<?php echo $chieuCao;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="ngonNgu">Ngôn Ngữ</label>
							<div class="controls">
								<input type="text" class="input-large" name="ngonNgu" id="ngonNgu" value="<?php echo $ngonNgu;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="content">Giới Thiệu</label>
							<div class="controls">
								<textarea id="content" name="content" class="span20" rows=""><?php echo $gioiThieu;?></textarea>
							</div>
						</div>
						<div class="form-actions">
							<button type="submit" class="btn btn-danger btn" name="submit" value="submit">Hoàn tất</button>&nbsp;&nbsp; <button type="reset" class="btn">Làm lại</button>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
<?php } else { 
$num		= 	config_site('list_limit');
$num 		= 	intval($num);
$page 		= 	intval($page);
if (!$page) 	$page = 1;
$limit 		= 	($page-1)*$num;
if($limit<0) 	$limit=0;
if($mode == 'search') {
	$sql = "name like '%$search%'";
	//echo $search;
}else {
	$sql = 'id != 0';
}
if($mode == "searchActor") {
	$name = $_POST["name"];
	$sql = "name like '%$name%'";
}
$arr = MySql::dbselect('id,name,urlmore','actor',"$sql order by id desc LIMIT $limit,$num");
$total = MySql::dbselect('id','actor',"$sql");
if($mode == 'searchActor') {
	$allpage_site = get_allpage(count($total),$num,$page,"?action=actor&mode=search&search=$search&page=");
}else {
	$allpage_site = get_allpage(count($total),$num,$page,"?action=actor&page=");
}
$allpage_site = get_allpage(count($total),$num,$page,"?action=actor&page=");
if($_POST['submit']) {
	$list_media = implode(',',$_POST['checkbox']);
	MySql::dbdelete('actor',"id IN ($list_media)");
	if($mode) $aaa = "&mode=search&search=$search";
	header("Location: ?action=actor$aaa");
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
	$('#check_all').live('click', function (e) {
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
		
		<div class="widget stacked widget-table action-table">
			<div class="widget-header">
				<i class="icon-th-list"></i>
				<h3>Đạo diễn - Diễn viên</h3>
			</div>
			<form action="?action=actor&mode=searchActor" method="post">
				<div class="search__inner">
					<input type="text" class="search__text" name="name" placeholder=" Tìm kiếm diễn viên...">
					
				</div>
			</form>
			<!-- /widget-header -->
			<form id="list" method="post">
			<div class="widget-content">
				<table class="table table-striped table-bordered">
				<thead>
				<tr>
					<th width="100px">
						<input type="checkbox" id="check_all"> Chọn hết
					</th>
					<th>
						Tên đạo diễn - diễn viên
					</th>
					<th>
						Liên kết ngoài
					</th>
					<th width="150px">
					<a href="?action=actor&mode=add" class="btn btn-primary">Thêm diễn viên</a>
					</th>
				</tr>
				</thead>
				<tbody>
				<?php
					for($i=0;$i<count($arr);$i++) {
						$id = $arr[$i][0];
						$name = $arr[$i][1];
						$urlmore = $arr[$i][2];
				?>
				<tr>
					<td>
						<input type="checkbox" name="checkbox[]" value="<?php echo $id;?>">
					</td>
					<td>
						<?php echo $name;?>
					</td>
					<td>
						<?php echo $urlmore;?>
					</td>
					<td class="td-actions">
						<a href="?action=actor&mode=edit&cid=<?php echo $id;?>" class="btn btn-small btn-warning">
						Sửa
						</a>
						<a data-url="?action=actor&mode=delete&cid=<?php echo $id;?>" class="btn btn-small deletefilm">
						Xóa
						</a>
					</td>
				</tr>
				<?php } ?>
				</tbody>
				</table>
			</div>
			<!-- /widget-content -->
		</div>
		<input id="submit_setting" type="submit" class="btn btn-small btn-warning" name="submit" value="Xóa toàn bộ"> 
		</form>
		<?php echo $allpage_site;?>
<?php } ?>
	</div>
</div>