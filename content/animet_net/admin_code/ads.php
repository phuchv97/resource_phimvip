<div class="main">
	<div class="container">
<?php if($Admingroup == '1') echo '<pre>Lưu ý: Bạn đang nằm trong nhóm <b>hợp tác viên</b>, bạn sẽ bị hạn chế một số chức năng thêm/sửa/xóa thông tin trên website.</pre>';?>
<?php 
$arr = MySql::dbselect('config_name,config_content','config',"config_name != ''");
$site_ads1 = $arr[17][1];
$site_ads2 = $arr[18][1];
$site_ads3 = $arr[19][1];
$site_ads4 = $arr[20][1];
$site_ads5 = $arr[21][1];
$site_ads6 = $arr[22][1];
$site_ads7 = $arr[23][1];
$site_ads8 = $arr[24][1];
$site_ads9 = $arr[25][1];
if($_POST['submit'] && $Admingroup == '2') {
	$html = array();
	for($i=17;$i<count($arr);$i++) {
		$config_name = $arr[$i][0];
		$post_name = stripslashes(trim($_POST[$config_name]));
		MySql::dbupdate('config',"config_content = '$post_name'","config_name = '$config_name'");
		$html[$config_name] = $post_name;
	}
	$file 				= 	CACHE_PATH."config/ads".CACHE_EXT;
	$html = json_encode($html);
	Cache::END_CACHE($html,$file);
	header('Location: ?action=ads');
}
else if($_POST['submit'] && $Admingroup !== '2') {
	header('Location: ?action=ads');
}
?>
		<div class="widget stacked">
			<div class="widget-header">
				<i class="icon-check"></i>
				<h3>Quản Lí Quảng Cáo</h3>
			</div>
			<!-- /widget-header -->
			<div class="widget-content">
				<form class="form-horizontal" method="post" enctype="multipart/form-data"/>
					<fieldset>
						<div class="control-group">
							<label class="control-label" for="site_ads1">Code dưới Slide</label>
							<div class="controls">
								<textarea id="site_ads1" name="site_ads1" class="span8" rows="4"><?php echo $site_ads1;?></textarea>

							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="site_ads2">Code List Phim</label>
							<div class="controls">
								<textarea id="site_ads2" name="site_ads2" class="span8" rows="4"><?php echo $site_ads2;?></textarea>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="site_ads3">Code SideBar</label>
							<div class="controls">
								<textarea id="site_ads3" name="site_ads3" class="span8" rows="4"><?php echo $site_ads3;?></textarea>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="site_ads4">Code Trên Phim Lẻ</label>
							<div class="controls">
								<textarea id="site_ads4" name="site_ads4" class="span8" rows="4"><?php echo $site_ads4;?></textarea>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="site_ads5">Code Trên Phim Bộ</label>
							<div class="controls">
								<textarea id="site_ads5" name="site_ads5" class="span8" rows="4"><?php echo $site_ads5;?></textarea>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="site_ads6">Code Info Phim Top</label>
							<div class="controls">
								<textarea id="site_ads6" name="site_ads6" class="span8" rows="4"><?php echo $site_ads6;?></textarea>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="site_ads7">Code Info Phim (Trên comment)</label>
							<div class="controls">
								<textarea id="site_ads7" name="site_ads7" class="span8" rows="4"><?php echo $site_ads7;?></textarea>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="site_ads8">Code Xem Phim (trên player)</label>
							<div class="controls">
                         <textarea id="site_ads8" name="site_ads8" class="span8" rows="4"><?php echo $site_ads8;?></textarea>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="site_ads9">Code Xem Phim (Dưới player)</label>
							<div class="controls">
								<textarea id="site_ads9" name="site_ads9" class="span8" rows="4"><?php echo $site_ads9;?></textarea>
							</div>
						</div>
						<div class="form-actions">
							<button type="submit" class="btn btn-danger btn" name="submit" value="submit">Hoàn tất</button>&nbsp;&nbsp; <button type="reset" class="btn">Làm lại</button>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>