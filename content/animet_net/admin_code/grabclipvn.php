<div class="main">
	<div class="container">
	<?php if($Admingroup == '1') echo '<pre>Lưu ý: Bạn đang nằm trong nhóm <b>hợp tác viên</b>, bạn sẽ bị hạn chế một số chức năng thêm/sửa/xóa thông tin trên website.</pre>';?>
<script type="text/javascript" language="javascript">
$(function () {
	$('textarea#content').ckeditor();
});
</script>
		<div class="widget stacked">
			<div class="widget-header">
				<i class="icon-check"></i>
				<h3>Grab Chap phim Clip.Vn</h3>
			</div>
			<!-- /widget-header -->
			<?php $page1 = $_GET['page']; if(!$page1) { ?>
			<div class="widget-content">
				<form class="form-horizontal" method="get"/>
					<fieldset>
						<input type="hidden" name="action" value="grabclipvn">
						<div class="control-group">
							<label class="control-label" for="page">Link Phim.Clip.Vn cần grab</label>
							<div class="controls">
								<input type="text" class="input-large" name="page" id="page" value=""/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="begin1">Lấy từ tập</label>
							<div class="controls">
								<input type="text" class="input-large" name="begin1" id="begin1" value=""/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="all2">đến tập</label>
							<div class="controls">
								<input type="text" class="input-large" name="all2" id="all2" value=""/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="filmid">nhập id film muốn thêm chap</label>
							<div class="controls">
								<input type="text" class="input-large" name="filmid" id="filmid" value=""/>
							</div>
						</div>
						<div class="form-actions">
							<button type="submit" class="btn btn-danger btn">Tiếp theo</button>&nbsp;&nbsp; <button type="reset" class="btn">Làm lại</button>
						</div>
					</fieldset>
				</form>
			</div>
			<?php } else { 
				$link = $_GET['page'];
				$filmid = intval($_GET['filmid']);

			?>
			<div class="widget-content">
				
						<?php

$htmla = file_get_contents($link);
$begin1 = $_GET['begin1'];
$all2 = $_GET['all2'];
if(preg_match_all('#<a class="episode-f"(.+?)href="(.+?)"(.+?)title="(.+?)">(.+?)</a>#is',$htmla,$data1)){
	if(empty($begin1)) {$begin1 = 0;}
	elseif(empty($all2)) {$all2 = count($data1[2])-1;}
	elseif($begin1 == 1) {$begin1 = 0;}
	else{ $begin1 = $_GET['begin1']; $all2 = $_GET['all2'];	}
	for($m = $begin1;$m <= $all2;$m++){
		$name = $data1[5][$m];
		$url = $data1[2][$m];

		MySql::dbinsert("episode","filmid,name,url","'$filmid','$name','$url'");
echo 'Thêm thanh công Chap '.$name.'<br>';

	}
}else{
	echo 'loi';
}
						 ?>
						
			</div>
			<?php } ?>
		</div>
	</div>
</div>