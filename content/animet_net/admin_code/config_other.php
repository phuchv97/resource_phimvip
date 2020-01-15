<div class="main">
	<div class="container">
<?php if($Admingroup == '1') echo '<pre>Lưu ý: Bạn đang nằm trong nhóm <b>hợp tác viên</b>, bạn sẽ bị hạn chế một số chức năng thêm/sửa/xóa thông tin trên website.</pre>';?>
<?php 
$arr = MySql::dbselect('config_name,config_content','config_other',"config_name != ''");
$category_title = $arr[2][1];
$category_keywords = $arr[1][1];
$category_description = $arr[0][1];
$country_title = $arr[5][1];
$country_keywords = $arr[4][1];
$country_description = $arr[3][1];
$list_title = $arr[8][1];
$list_keywords = $arr[7][1];
$list_description = $arr[6][1];
$search_title = $arr[11][1];
$search_keywords = $arr[10][1];
$search_description = $arr[9][1];
if($_POST['submit'] && $Admingroup == '2') {
	$html = array();
	for($i=0;$i<count($arr);$i++) {
		$config_name = $arr[$i][0];
		$post_name = $_POST[$config_name];
		MySql::dbupdate('config_other',"config_content = '$post_name'","config_name = '$config_name'");
		$html[$config_name] = $post_name;
	}
	$file 				= 	CACHE_PATH."config/siteconfig_other".CACHE_EXT;
	$html = json_encode($html);
	Cache::END_CACHE($html,$file);
	header('Location: ?action=config_other');
}
else if($_POST['submit'] && $Admingroup !== '2') {
	header('Location: ?action=config_other');
}
?>
		<div class="widget stacked">
			<div class="widget-header">
				<i class="icon-check"></i>
				<h3>Cài đặt nâng cao</h3>
			</div>
			<!-- /widget-header -->
			<div class="widget-content">
				<form class="form-horizontal" method="post" enctype="multipart/form-data"/>
					<fieldset>
						<div class="control-group">
							<label class="control-label" for="category_title">Tiêu đề thể loại</label>
							<div class="controls">
								<input type="text" class="input-large" name="category_title" id="category_title" value="<?php echo $category_title;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="category_keywords">Từ khóa thể loại</label>
							<div class="controls">
								<textarea id="category_keywords" name="category_keywords" class="span8" rows="3"><?php echo $category_keywords;?></textarea>
							</div>
						</div>
						<div class="control-group" style="border-bottom: 1px dotted #BBB; padding-bottom: 20px;">
							<label class="control-label" for="category_description">Mô tả thể loại</label>
							<div class="controls">
								<textarea id="category_description" name="category_description" class="span8" rows="3"><?php echo $category_description;?></textarea>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="country_title">Tiêu đề quốc gia</label>
							<div class="controls">
								<input type="text" class="input-large" name="country_title" id="country_title" value="<?php echo $country_title;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="country_keywords">Từ khóa Quốc gia</label>
							<div class="controls">
								<textarea id="country_keywords" name="country_keywords" class="span8" rows="3"><?php echo $country_keywords;?></textarea>
							</div>
						</div>
						<div class="control-group" style="border-bottom: 1px dotted #BBB; padding-bottom: 20px;">
							<label class="control-label" for="country_description">Mô tả quốc gia</label>
							<div class="controls">
								<textarea id="country_description" name="country_description" class="span8" rows="3"><?php echo $country_description;?></textarea>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="list_title">Tiêu đề danh sách</label>
							<div class="controls">
								<input type="text" class="input-large" name="list_title" id="list_title" value="<?php echo $list_title;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="list_keywords">Từ khóa danh sách</label>
							<div class="controls">
								<textarea id="list_keywords" name="list_keywords" class="span8" rows="3"><?php echo $list_keywords;?></textarea>
							</div>
						</div>
						<div class="control-group" style="border-bottom: 1px dotted #BBB; padding-bottom: 20px;">
							<label class="control-label" for="list_description">Mô tả danh sách</label>
							<div class="controls">
								<textarea id="list_description" name="list_description" class="span8" rows="3"><?php echo $list_description;?></textarea>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="search_title">Tiêu đề tìm kiếm</label>
							<div class="controls">
								<input type="text" class="input-large" name="search_title" id="search_title" value="<?php echo $search_title?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="search_keywords">Từ khóa tìm kiếm</label>
							<div class="controls">
								<textarea id="search_keywords" name="search_keywords" class="span8" rows="3"><?php echo $search_keywords;?></textarea>
							</div>
						</div>
						<div class="control-group" style="border-bottom: 1px dotted #BBB; padding-bottom: 20px;">
							<label class="control-label" for="search_description">Mô tả tìm kiếm</label>
							<div class="controls">
								<textarea id="search_description" name="search_description" class="span8" rows="3"><?php echo $search_description;?></textarea>
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