<div class="main">
	<div class="container">
<?php 
if($mode == 'delete') {
	MySql::dbdelete('log',"id = '$cid'");
	header('Location: ?action=log');
}
else if($mode == 'view') {
	$arr = MySql::dbselect('id,title,content','log',"id = '$cid'");
	$title = $arr[0][1];
	$content = $arr[0][2];
	
?>
		<div class="widget stacked">
			<div class="widget-header">
				<i class="icon-check"></i>
				<h3><?php echo $title;?></h3>
			</div>
			<!-- /widget-header -->
			<div class="widget-content">
				<?php echo $content;?>
			</div>
		</div>
<?php } else { 
$num		= 	config_site('list_limit');
$num 		= 	intval($num);
$page 		= 	intval($page);
if (!$page) 	$page = 1;
$limit 		= 	($page-1)*$num;
if($limit<0) 	$limit=0;
$arr = MySql::dbselect('id,title','log',"id != 0 order by id desc LIMIT $limit,$num");
$total = MySql::dbselect('id','log',"id != 0");
$allpage_site = get_allpage(count($total),$num,$page,"?action=log&page=");
if($_POST['submit']) {
	$list_media = implode(',',$_POST['checkbox']);
	MySql::dbdelete('log',"id IN ($list_media)");
	header('Location: ?action=log');
}
if($arr) {
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
		<form id="list" method="post">
		<div class="widget stacked widget-table action-table">
			<div class="widget-header">
				<i class="icon-th-list"></i>
				<h3>Yêu cầu / Báo lỗi</h3>
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
						Tiêu đề
					</th>
					<th>
						Gửi từ
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
						$username = explode(' | ',$arr[$i][1]);
						$title = $username[0];
						$username = $username[1];
				?>
				<tr>
					<td>
						<input type="checkbox" name="checkbox[]" value="<?php echo $id;?>">
					</td>
					<td>
						<?php echo $title;?>
					</td>
					<td>
						<?php echo $username;?>
					</td>
					<td class="td-actions">
						<a href="?action=log&mode=view&cid=<?php echo $id;?>" class="btn btn-small btn-warning">
						Xem
						</a>
						<a data-url="?action=log&mode=delete&cid=<?php echo $id;?>" class="btn btn-small deletefilm">
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
<?php } else { ?>
		<div class="row"><div><div class="widget stacked "><div class="widget-header"><i class="icon-th-large"></i><h3>Thông báo</h3></div><div class="widget-content">Không có tin nào được liệt kê</div></div></div></div>
<?php } } ?>
	</div>
</div>