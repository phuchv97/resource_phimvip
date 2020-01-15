<div class="main">
	<div class="container">
	<?php
function grab($url){
    $curl = curl_init();
    curl_setopt ($curl, CURLOPT_URL, $url);
    curl_setopt ($curl, CURLOPT_USERAGENT, "Mozilla/17.0");;
    curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt ($curl, CURLOPT_ENCODING, "");
    $data= curl_exec ($curl);
    curl_close ($curl);
    return $data;
}
 if($Admingroup == '1') echo '<pre>Lưu ý: Bạn đang nằm trong nhóm <b>hợp tác viên</b>, bạn sẽ bị hạn chế một số chức năng thêm/sửa/xóa thông tin trên website.</pre>';?>

		<div class="widget stacked">
			<div class="widget-header">
				<i class="icon-check"></i>
				<h3>Grab Chap phim Zing Tv</h3>
			</div>
			<!-- /widget-header -->
			
			<div class="widget-content">
				<form class="form-horizontal" method="get">
					<fieldset>
						<input type="hidden" name="action" value="grabzingtv">
						<div class="control-group">
							<label class="control-label" for="page">Link Series Zing Tv cần grab</label>
							<div class="controls">
								<input type="text" class="input-large" name="page" id="page" value=""/>
							</div>
						</div>
<div class="control-group">
							<label class="control-label" for="filmid">nhập id film muốn thêm chap</label>
							<div class="controls">
<select name="filmid">
<option value="0">Tự nhập id film</option>
<?php echo admin_film(); ?>
</select>
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
<?php if(isset($_GET['page'])) { 

				?>
			<?php 
				$link = $_GET['page'];
if($_GET['filmid'] == 0){
$filmid = intval($_GET['filmid2']);
}else{
$filmid = intval($_GET['filmid']);
}
				
			?>
			<div class="widget-content">
					
						<?php
						$html = grab($link);
if(preg_match_all('#<li><span>(.+?)</span></li>#is',$html,$totalpage)){
print_r($totalpage);
preg_match('#<a(.+?)href="(.+?)"(.+?)>Cuối</a>#is',$totalpage[1][1],$page);
$numpage = explode('=',$page[2]);
if(empty($numpage[1]) || $numpage[1] == NULL){
$html2 = grab($link);
if(preg_match('#<div class="subtray block-item video-item">(.+?)</div><!--END .subtray-->#is',$html2,$data)){
preg_match_all('#<h3><a href="(.+?)">(.+?)</a></h3>#is',$data[1],$contents);
for($a = count($contents[1])-1; $a >= 0;$a--){
$name = $contents[2][$a];
$url = 'http://tv.zing.vn'.$contents[1][$a];
MySql::dbinsert("episode","filmid,name,url","'$filmid','$name','$url'");
echo 'Thêm thanh công Chap '.$contents[2][$a].'<br>';



}
}
}else{
for($i = $numpage[1]; $i >= 1;$i--){
$html2 = grab($link.'?p='.$i);
if(preg_match('#<div class="subtray block-item video-item">(.+?)</div><!--END .subtray-->#is',$html2,$data)){
preg_match_all('#<h3><a href="(.+?)">(.+?)</a></h3>#is',$data[1],$contents);
for($a = count($contents[1])-1; $a >= 0;$a--){
	$name = $contents[2][$a];
$url = 'http://tv.zing.vn'.$contents[1][$a];
MySql::dbinsert("episode","filmid,name,url","'$filmid','$name','$url'");

echo 'Thêm thanh công Chap '.$contents[2][$a].'<br>';

}
}

}
}
}elseif(preg_match_all('#<li><a title="Trang ([0-9]+)" href="(.+?)([0-9]+)">([0-9]+)</a></li>#is',$html,$totalpage)){
$numpage = max($totalpage[4]);
if(empty($numpage) || $numpage == 1 || $numpage == NULL){
$html2 = grab($link);
if(preg_match('#<div class="subtray block-item video-item">(.+?)</div><!--END .subtray-->#is',$html2,$data)){
preg_match_all('#<h3><a href="(.+?)">(.+?)</a></h3>#is',$data[1],$contents);
for($a = count($contents[1])-1; $a >= 0;$a--){
$name = $contents[2][$a];
$url = 'http://tv.zing.vn'.$contents[1][$a];
MySql::dbinsert("episode","filmid,name,url","'$filmid','$name','$url'");
echo 'Thêm thanh công Chap '.$contents[2][$a].'<br>';



}
}
}else{
for($i = $numpage; $i >= 1;$i--){
$html2 = grab($link.'?p='.$i);
if(preg_match('#<div class="subtray block-item video-item">(.+?)</div><!--END .subtray-->#is',$html2,$data)){
preg_match_all('#<h3><a href="(.+?)">(.+?)</a></h3>#is',$data[1],$contents);
for($a = count($contents[1])-1; $a >= 0;$a--){
	$name = $contents[2][$a];
$url = 'http://tv.zing.vn'.$contents[1][$a];
MySql::dbinsert("episode","filmid,name,url","'$filmid','$name','$url'");

echo 'Thêm thanh công Chap '.$contents[2][$a].'<br>';

}
}

}
}
}else{

	echo 'lỗi';
}

						 ?>
					
			</div>
			<?php } ?>
		</div>
	</div>
</div>