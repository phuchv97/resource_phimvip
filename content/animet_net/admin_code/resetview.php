<?php 
if($_POST['submit']) {
	if($_POST['viewed_day']) MySql::dbupdate('film',"viewed_day = 0","id != 0");
	if($_POST['viewed_week']) MySql::dbupdate('film',"viewed_week = 0","id != 0");
	if($_POST['viewed_month']) MySql::dbupdate('film',"viewed_month = 0","id != 0");
	header('Location: ?action=resetview');
}
?>
<script type="text/javascript" language="javascript">
$(function () {
	$('form#resetviewed').on('submit', function(e) {
		if (confirm('Bạn có chắc muốn thực hiện hành động này?')) {
			return true;
		} else {
			return false;
		}
	});
});
</script>
<div class="main">
	<div class="container">
	<?php if($Admingroup == '1') echo '<pre>Lưu ý: Bạn đang nằm trong nhóm <b>hợp tác viên</b>, bạn sẽ bị hạn chế một số chức năng thêm/sửa/xóa thông tin trên website.</pre>';?>
		<div class="widget stacked">
			<div class="widget-header">
				<i class="icon-check"></i>
				<h3>Cập nhật lại lượt xem</h3>
			</div>
			<!-- /widget-header -->
			<div class="widget-content">
				<form id="resetviewed" class="form-horizontal" method="post"/>
					<div class="control-group">
						<label class="control-label" for="subtitle<?php echo $i;?>">Chọn thống kê</label>
						<div class="controls">
							<label class="checkbox"><input type="checkbox" name="viewed_day" value="1">Xem nhiều trong ngày</label>
							<label class="checkbox"><input type="checkbox" name="viewed_week" value="1">Xem nhiều trong tuần</label>
							<label class="checkbox"><input type="checkbox" name="viewed_month" value="1">Xem nhiều trong tháng</label>
						</div>
					</div>
					<div class="form-actions">
						<button type="submit" class="btn btn-danger btn" name="submit" value="submit">Hoàn tất</button>&nbsp;&nbsp; <button type="reset" class="btn">Làm lại</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>