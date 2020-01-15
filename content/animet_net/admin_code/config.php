<div class="main">
	<div class="container">
<?php if($Admingroup == '1') echo '<pre>Lưu ý: Bạn đang nằm trong nhóm <b>hợp tác viên</b>, bạn sẽ bị hạn chế một số chức năng thêm/sửa/xóa thông tin trên website.</pre>';?>
<?php 
$arr = MySql::dbselect('config_name,config_content','config',"config_name != ''");
$base_url = $arr[0][1];
$site_name = $arr[9][1];
$site_description = $arr[5][1];
$site_keywords = $arr[7][1];
$site_phone = $arr[10][1];
$site_mail = $arr[8][1];
$site_codegg = $arr[11][1];
$trailer = $arr[12][1];
$site_keyword = $arr[6][1];
$list_limit = $arr[4][1];
$footer_viewmem = $arr[3][1];
$footer_text = $arr[2][1];
$facebook_url = $arr[1][1];
$site_notice = $arr[13][1];
if($_POST['submit'] && $Admingroup == '2') {
	$html = array();
	for($i=0;$i<17;$i++) {
		$config_name = $arr[$i][0];
		$post_name = stripslashes(trim($_POST[$config_name]));
		MySql::dbupdate('config',"config_content = '$post_name'","config_name = '$config_name'");
		$html[$config_name] = $post_name;
	}
	$file 				= 	CACHE_PATH."config/siteconfig".CACHE_EXT;
	$html = json_encode($html);
	Cache::END_CACHE($html,$file);
	header('Location: ?action=config');
}
else if($_POST['submit'] && $Admingroup !== '2') {
	header('Location: ?action=config');
}
?>
		<div class="widget stacked">
			<div class="widget-header">
				<i class="icon-check"></i>
				<h3>Cài đặt website</h3>
			</div>
			<!-- /widget-header -->
			<div class="widget-content">
				<form class="form-horizontal" method="post" enctype="multipart/form-data"/>
					<fieldset>
						<div class="control-group">
							<label class="control-label" for="base_url">Địa chỉ website</label>
							<div class="controls">
								<input type="text" class="input-large" name="base_url" id="base_url" value="<?php echo $base_url;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="site_name">Thông báo</label>
							<div class="controls">
								<textarea id="site_keywords" name="site_notice" class="span8" rows="3"><?php echo $site_notice;?></textarea>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="site_name">Tên trang</label>
							<div class="controls">
								<input type="text" class="input-large" name="site_name" id="site_name" value="<?php echo $site_name;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="site_description">Mô tả trang</label>
							<div class="controls">
								<textarea id="site_description" name="site_description" class="span8" rows="3"><?php echo $site_description;?></textarea>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="site_keywords">Từ khóa chính</label>
							<div class="controls">
								<textarea id="site_keywords" name="site_keywords" class="span8" rows="3"><?php echo $site_keywords;?></textarea>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="site_phone">Số điện thoại</label>
							<div class="controls">
								<input type="text" class="input-large" name="site_phone" id="site_phone" value="<?php echo $site_phone;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="site_mail">Địa chỉ email</label>
							<div class="controls">
								<input type="text" class="input-large" name="site_mail" id="site_mail" value="<?php echo $site_mail;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="site_codegg">Mã theo dõi Analytics</label>
							<div class="controls">
                              <textarea id="site_codegg" name="site_codegg" class="span8" rows="3"><?php echo $site_codegg;?></textarea>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="trailer">Trailer mặc định</label>
							<div class="controls">
								<input type="text" class="input-large" name="trailer" id="trailer" value="<?php echo $trailer;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="site_keyword">Từ khóa cuối trang</label>
							<div class="controls">
								<textarea id="site_keyword" name="site_keyword" class="span8" rows="3"><?php echo $site_keyword;?></textarea>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="list_limit">Giới hạn danh sách</label>
							<div class="controls">
								<input type="text" class="input-large" name="list_limit" id="" value="<?php echo $list_limit;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="footer_viewmem">Lượt xem mỗi ngày</label>
							<div class="controls">
								<input type="text" class="input-large" name="footer_viewmem" id="footer_viewmem" value="<?php echo $footer_viewmem;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="footer_text">Giới thiệu cuối trang</label>
							<div class="controls">
								<textarea id="footer_text" name="footer_text" class="span8" rows="3"><?php echo $footer_text;?></textarea>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="facebook_url">Fanpage Facebook</label>
							<div class="controls">
								<input type="text" class="input-large" name="facebook_url" id="facebook_url" value="<?php echo $facebook_url;?>"/>
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