<div class="main">
	<div class="container">
<?php 
if($mode == 'delete') {
	MySql::dbdelete('tv',"id = '$cid'");
	header('Location: ?action=tv');
}
else if($mode == 'add' || $mode == 'edit') {
	if($mode == 'edit') {
		$arr = MySql::dbselect('symbol,name,quality,speed,viewed,content,linktv,thumb,lang','tv',"id = '$cid'");
		$symbol = $arr[0][0];
		$name = $arr[0][1];
		$quality = $arr[0][2];
		$speed = $arr[0][3];
		$viewed = $arr[0][4];
		$content = $arr[0][5];
		$linktv = $arr[0][6];
		$thumb = $arr[0][7];
		$lang = $arr[0][8];
	}
	if($mode == 'edit' && $_POST['submit']) {
		$symbol = RemoveHack($_POST['symbol']);
		$name = RemoveHack($_POST['name']);
		$quality = RemoveHack($_POST['quality']);
		$speed = RemoveHack($_POST['speed']);
		$content = RemoveHack($_POST['content']);
		$linktv = RemoveHack($_POST['linktv']);
		$thumb = RemoveHack($_POST['thumb']);
		$lang = RemoveHack($_POST['lang']);
		MySql::dbupdate('tv',"symbol = '$symbol',name='$name',quality='$quality',speed='$speed',content='$content',linktv='$linktv',thumb='$thumb',lang='$lang'","id = '$cid'");
		header("Location: ?action=tv&mode=edit&cid=$cid");
	}else if($mode == 'add' && $_POST['submit']) {
		$symbol = RemoveHack($_POST['symbol']);
		$name = RemoveHack($_POST['name']);
		$quality = RemoveHack($_POST['quality']);
		$speed = RemoveHack($_POST['speed']);
		$content = RemoveHack($_POST['content']);
		$linktv = RemoveHack($_POST['linktv']);
		$thumb = RemoveHack($_POST['thumb']);
		$lang = RemoveHack($_POST['lang']);
		MySql::dbinsert("tv","symbol,name,quality,speed,content,linktv,thumb,lang","'$symbol','$name','$quality','$speed','$content','$linktv','$thumb','$lang'");
		header("Location: ?action=tv");
	}
?>
		<div class="widget stacked">
			<div class="widget-header">
				<i class="icon-check"></i>
				<h3>Đăng / Sửa kênh</h3>
			</div>
			<!-- /widget-header -->
			<div class="widget-content">
				<form class="form-horizontal" method="post" enctype="multipart/form-data"/>
					<fieldset>
						<div class="control-group">
							<label class="control-label" for="symbol">Ký hiệu</label>
							<div class="controls">
								<input type="text" class="input-large" name="symbol" id="symbol" value="<?php echo $symbol;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="name">Tên kênh</label>
							<div class="controls">
								<input type="text" class="input-large" name="name" id="name" value="<?php echo $name;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="quality">Chất lượng</label>
							<div class="controls">
								<input type="text" class="input-large" name="quality" id="quality" value="<?php echo $quality;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="speed">Tốc độ</label>
							<div class="controls">
								<input type="text" class="input-large" name="speed" id="speed" value="<?php echo $speed;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="content">Nội dung</label>
							<div class="controls">
								<textarea id="content" name="content" class="span8" rows="3"><?php echo $content;?></textarea>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="linktv">Siêu liên kết</label>
							<div class="controls">
								<textarea id="linktv" name="linktv" class="span8" rows="3"><?php echo $linktv;?></textarea>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="thumb">Ảnh nhỏ</label>
							<div class="controls">
								<input type="text" class="input-large" name="thumb" id="thumb" value="<?php echo $thumb;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="lang">Ngôn ngữ</label>
							<div class="controls">
								<input type="text" class="input-large" name="lang" id="lang" value="<?php echo $lang;?>"/>
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
$arr = MySql::dbselect('id,symbol,name','tv',"id != 0 order by id desc LIMIT $limit,$num");
$total = MySql::dbselect('id','tv',"id != 0");
$allpage_site = get_allpage(count($total),$num,$page,"?action=tv&page=");
if($_POST['submit']) {
	$list_media = implode(',',$_POST['checkbox']);
	MySql::dbdelete('tv',"id IN ($list_media)");
	header('Location: ?action=tv');
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
		<a href="?action=tv&mode=add" class="btn btn-small btn-warning" style="margin-bottom:10px"> Thêm kênh</a>
		<form id="list" method="post">
		<div class="widget stacked widget-table action-table">
			<div class="widget-header">
				<i class="icon-th-list"></i>
				<h3>Live TV</h3>
			</div>
			<!-- /widget-header -->
			<div class="widget-content">
				<table class="table table-striped table-bordered">
				<thead>
				<tr>
					<th width="100px">
						<input type="checkbox" id="check_all"> Chọn hết
					</th>
					<th>
						Ký hiệu
					</th>
					<th>
						Tên kênh
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
						$symbol = $arr[$i][1];
						$name = $arr[$i][2];
				?>
				<tr>
					<td>
						<input type="checkbox" name="checkbox[]" value="<?php echo $id;?>">
					</td>
					<td>
						<?php echo $symbol;?>
					</td>
					<td>
						<?php echo $name;?>
					</td>
					<td class="td-actions">
						<a href="?action=tv&mode=edit&cid=<?php echo $id;?>" class="btn btn-small btn-warning">
						Sửa
						</a>
						<a data-url="?action=tv&mode=delete&cid=<?php echo $id;?>" class="btn btn-small deletefilm">
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