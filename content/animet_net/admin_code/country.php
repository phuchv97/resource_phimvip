<div class="main">
	<div class="container">
<?php if($Admingroup == '1') echo '<pre>Lưu ý: Bạn đang nằm trong nhóm <b>hợp tác viên</b>, bạn sẽ bị hạn chế một số chức năng thêm/sửa/xóa thông tin trên website.</pre>';?>
<?php 
if($mode == 'delete' && $Admingroup == '2') {
	MySql::dbdelete('country',"id = '$cid'");
	header('Location: ?action=country');
}else if($mode == 'delete' && $Admingroup !== '2') {
	header('Location: ?action=country');
}
else if($mode == 'add' || $mode == 'edit') {
	if($mode == 'edit') {
		$arr = MySql::dbselect('name,name_seo,seotitle','country',"id = '$cid'");
		$name = $arr[0][0];
		$name_seo = $arr[0][1];
		$seotitle = $arr[0][2];
	}
	if($mode == 'edit' && $_POST['submit'] && $Admingroup == '2') {
		$name = $_POST['name'];
		$name_seo = RemoveHack($_POST['name_seo']);
		$seotitle = RemoveHack($_POST['seotitle']);
		MySql::dbupdate('country',"name = '$name',name_seo='$name_seo',seotitle='$seotitle'","id = '$cid'");
		header("Location: ?action=country&mode=edit&cid=$cid");
	}else if($mode == 'add' && $_POST['submit'] && $Admingroup == '2') {
		$name = RemoveHack($_POST['name']);
		$name_seo = RemoveHack($_POST['name_seo']);
		$seotitle = RemoveHack($_POST['seotitle']);
		MySql::dbinsert("country","name,name_seo,seotitle","'$name','$name_seo','$seotitle'");
		header("Location: ?action=country");
	}else if($_POST['submit'] && $Admingroup !== '2') {
		header("Location: ?action=country");
	}
?>
		<div class="widget stacked">
			<div class="widget-header">
				<i class="icon-check"></i>
				<h3>Đăng / Sửa quốc gia</h3>
			</div>
			<!-- /widget-header -->
			<div class="widget-content">
				<form class="form-horizontal" method="post" enctype="multipart/form-data"/>
					<fieldset>
						<div class="control-group">
							<label class="control-label" for="name">Tên quốc gia</label>
							<div class="controls">
								<input type="text" class="input-large" name="name" id="name" value="<?php echo $name;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="name_seo">Url Seo</label>
							<div class="controls">
								<input type="text" class="input-large" name="name_seo" id="name_seo" value="<?php echo $name_seo;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="seotitle">Tiêu đề SEO</label>
							<div class="controls">
						<input type="text" class="input-large" name="seotitle" id="seotitle" value="<?php echo $seotitle;?>"/>(Bỏ qua nếu dùng mặc định)
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
$arr = MySql::dbselect('id,name,name_seo','country',"id != 0 order by id desc LIMIT $limit,$num");
$total = MySql::dbselect('id','country',"id != 0");
$allpage_site = get_allpage(count($total),$num,$page,"?action=country&page=");
if($_POST['submit'] && $Admingroup == '2') {
	$list_media = implode(',',$_POST['checkbox']);
	MySql::dbdelete('country',"id IN ($list_media)");
	header('Location: ?action=country');
}else if($_POST['submit'] && $Admingroup !== '2') {
	header('Location: ?action=country');
}
?>
<script type="text/javascript" language="javascript">
$(function () {
	$('.deletefilm').live('click', function (e) {
		var url = $(this).attr('data-url');
		$.msgbox("Bạn có chắc muốn xóa quốc gia này?", {
		type: "confirm",
		buttons : [
			{type: "submit", value: "Đồng ý"},
			{type: "cancel", value: "Hủy bỏ"}
		]}, function(result) {
			if(result !== false) window.location.href = url;
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
		<a href="?action=country&mode=add" class="btn btn-small btn-warning" style="margin-bottom:10px"> Thêm quốc gia</a>
		<form id="list" method="post">
		<div class="widget stacked widget-table action-table">
			<div class="widget-header">
				<i class="icon-th-list"></i>
				<h3>Quôc gia</h3>
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
						Tên quốc gia
					</th>
					<th>
						Seo
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
						$name_seo = $arr[$i][2];
				?>
				<tr>
					<td>
						<input type="checkbox" name="checkbox[]" value="<?php echo $id;?>">
					</td>
					<td>
						<?php echo $name;?>
					</td>
					<td>
						<?php echo $name_seo;?>
					</td>
					<td class="td-actions">
						<a href="?action=country&mode=edit&cid=<?php echo $id;?>" class="btn btn-small btn-warning">
						Sửa
						</a>
						<a data-url="?action=country&mode=delete&cid=<?php echo $id;?>" class="btn btn-small deletefilm">
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