<div class="main">
	<div class="container">
<?php 
if($mode == 'delete') {
	MySql::dbdelete('media',"id = '$mediaid'");
	header('Location: ?action=media');
}
else if($mode == 'add' || $mode == 'edit') {
	if($mode == 'edit') {
		$arr = MySql::dbselect('name,url,duration,thumb','media',"id = '$mediaid'");
		$name = $arr[0][0];
		$url = $arr[0][1];
		$duration = $arr[0][2];
		$thumb = $arr[0][3];
	}
	if($mode == 'edit' && $_POST['submit']) {
		$name = RemoveHack($_POST['name']);
		$url = RemoveHack($_POST['url']);
		$duration = RemoveHack($_POST['duration']);
		$thumb = RemoveHack($_POST['thumb']);
		$timeupdate = time();
		MySql::dbupdate('media',"name = '$name',url = '$url',thumb = '$thumb',duration = '$duration',timeupdate = '$timeupdate'","id = '$mediaid'");
		header("Location: ?action=media&mode=edit&mediaid=$mediaid");
	}else if($mode == 'add' && $_POST['submit']) {
		$name = RemoveHack($_POST['name']);
		$url = RemoveHack($_POST['url']);
		$duration = RemoveHack($_POST['duration']);
		$thumb = RemoveHack($_POST['thumb']);
		$timeupdate = time();
		if(!$name) {
			$data = cURL::getYoutube($url);
			$name = RemoveHack($data[0]);
			$duration = RemoveHack($data[1]);
			$thumb = RemoveHack($data[2]);
		}
		MySql::dbinsert("media","name,url,thumb,duration,timeupdate","'$name','$url','$thumb','$duration','$timeupdate'");
		header("Location: ?action=media");
	}
?>
		<div class="widget stacked">
			<div class="widget-header">
				<i class="icon-check"></i>
				<h3>Đăng / Sửa video</h3>
			</div>
			<!-- /widget-header -->
			<div class="widget-content">
				<form class="form-horizontal" method="post" enctype="multipart/form-data"/>
					<fieldset>
						<div class="control-group">
							<label class="control-label" for="name">Tên video</label>
							<div class="controls">
								<input type="text" class="input-large" name="name" id="name" value="<?php echo $name;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="url">Siêu liên kết</label>
							<div class="controls">
								<input type="text" class="input-large" name="url" id="url" value="<?php echo $url;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="duration">Thời lượng</label>
							<div class="controls">
								<input type="text" class="input-large" name="duration" id="duration" value="<?php echo $duration;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="thumb">Ảnh video</label>
							<div class="controls">
								<input type="text" class="input-large" name="thumb" id="thumb" value="<?php echo $thumb;?>"/>
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
$num		=  30;
$num 		= 	intval($num);
$page 		= 	intval($page);
if (!$page) 	$page = 1;
$limit 		= 	($page-1)*$num;
if($limit<0) 	$limit=0;
if($mode == 'slide') $sql = 'slide = 1';
else $sql = 'id != 0';
$arr = MySql::dbselect('id,name,url,duration','media',"$sql order by id desc LIMIT $limit,$num");
$total = MySql::dbselect('id','media',"id != 0");
$allpage_site = get_allpage(count($total),$num,$page,"?action=media&page=");
if($_POST['submit']) {
	$list_media = implode(',',$_POST['checkbox']);
	if($_POST['videosetting'] == 'slide'){
		MySql::dbupdate('media',"slide = '1'","id IN ($list_media)");
	}else if($_POST['videosetting'] == 'unslide'){
		MySql::dbupdate('media',"slide = '0'","id IN ($list_media)");
	}else if($_POST['videosetting'] == 'delete'){
		MySql::dbdelete('media',"id IN ($list_media)");
	}
	header('Location: ?action=media');
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
		<form id="list" method="post">
		<div class="widget stacked widget-table action-table">
			<div class="widget-header">
				<i class="icon-th-list"></i>
				<h3>Video</h3>
			</div>
			<!-- /widget-header -->
			<div class="widget-content">
				<table class="table table-striped table-bordered">
				<thead>
				<tr>
					<th>
						<input type="checkbox" id="check_all"> Chọn hết
					</th>
					<th>
						Tên video
					</th>
					<th>
						Siêu liên kết
					</th>
					<th>
						Thời lượng
					</th>
					<th width="130px">
						Chức năng
					</th>
				</tr>
				</thead>
				<tbody>
				<?php
					for($i=0;$i<count($arr);$i++) {
						$id = $arr[$i][0];
						$name = $arr[$i][1];
						$url = CutName($arr[$i][2],50);
						$duration = $arr[$i][3];
				?>
				<tr>
					<td>
						<input type="checkbox" name="checkbox[]" value="<?php echo $id;?>">
					</td>
					<td>
						<?php echo $name;?>
					</td>
					<td>
						<?php echo $url;?>
					</td>
					<td>
						<?php echo $duration;?>
					</td>
					<td class="td-actions">
						<a href="?action=media&mode=edit&mediaid=<?php echo $id;?>" class="btn btn-small btn-warning">
						Sửa video
						</a>
						<a data-url="?action=media&mode=delete&mediaid=<?php echo $id;?>" class="btn btn-small deletefilm">
						Xóa video
						</a>
					</td>
				</tr>
				<?php } ?>
				</tbody>
				</table>
			</div>
			<!-- /widget-content -->
		</div>
		<select name="videosetting" style="margin-top: 10px;"><option>Chọn...</option>
			<option value="slide">Video trên slide</option>
			<option value="unslide">Bỏ video trên slide</option>
			<option value="delete">Xóa</option>
		</select>
		<input id="submit_setting" type="submit" class="btn btn-small btn-warning" name="submit" value="Thực hiện">
		</form>
		<?php echo $allpage_site;?>
<?php } ?>
	</div>
</div>