<?php
function add($url,$id) {
	$ch =  curl_init($url.$id);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt($ch, CURLOPT_TIMEOUT, 3);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
	$result = curl_exec($ch);
}
?>
<div class="main">
	<div class="container">
		<div class="widget stacked">
			<div class="widget-header">
				<i class="icon-check"></i>
				<h3>Đăng nhiều tâp phim</h3>
			</div>
			<!-- /widget-header -->
			<?php
			$admin_id = $_SESSION["RK_Adminid"];
$timeupdate = time();
 if(!$_POST['one']) { ?>
			<div class="widget-content">
				<form class="form-horizontal" method="post" enctype="multipart/form-data"/>
					<fieldset>
						<div class="control-group">
							<label class="control-label" for="begin">Tập bắt đầu</label>
							<div class="controls">
								<input type="text" class="input-large" name="begin" id="begin" value="1" onClick="$(this).select();"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="end">Tập kết thúc</label>
							<div class="controls">
								<input type="text" class="input-large" name="end" id="end" value="10" onClick="$(this).select();"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="endname">Tên tập cuối</label>
							<div class="controls">
								<input type="text" class="input-large" name="endname" id="endname"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="multi">Thêm tập nhanh</label>
							<div class="controls">
								<textarea id="multi" name="multi" class="span8" rows="10" placeholder="Tên tập | Liên kết‏">Tên tập | Liên kết‏</textarea>
							</div>
						</div>
						<div class="form-actions">
							<input type="hidden" name="one" value="1"/>
							<button type="submit" class="btn btn-danger btn" name="submit" value="submit">Tiếp theo</button>&nbsp;&nbsp; <button type="reset" class="btn">Làm lại</button>
						</div>
					</fieldset>
				</form>
			</div>
			<?php } else if($_POST['one'] && !$_POST['two']) { 
				$begin = $_POST['begin'];
				if(!$begin) $begin = 1;
				$end = $_POST['end'];
				if(!$end) $end = 10;
				$endname = $_POST['endname'];
				$multi = $_POST['multi'];
				if($multi) {
					$begin = 0;
					$s = explode('<br />',nl2br(trim($multi)));
					$end = count($s)-1;
				}
			?>
			<div class="widget-content">
				<form class="form-horizontal" method="post" enctype="multipart/form-data"/>
					<fieldset>
						<?php
							for($i=$begin;$i<=$end;$i++) {
								$name = $i;
								if($i == $end && $endname) $name = $endname;
								if($multi) {
									$data = explode('|',$s[$i]);
									$name = $data[0];
									$url = $data[1];
									if(!$url) {
										$name = ($i+1);
										$url = $data[0];
									}
								}
						?>
						<div class="control-group">
							<label class="control-label" for="name<?php echo $i;?>">Tên tập</label>
							<div class="controls">
								<input type="text" class="input-large" name="name[<?php echo $i;?>]" id="name<?php echo $i;?>" value="<?php echo $name;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="url<?php echo $i;?>">Liên kết</label>
							<div class="controls">
								<input type="text" class="input-large" name="url[<?php echo $i;?>]" id="url<?php echo $i;?>" value="<?php echo $url;?>"/>
							</div>
						</div>
						<div class="control-group" style="border-bottom: 1px dotted #BBB; padding-bottom: 20px;">
							<label class="control-label" for="thumb<?php echo $i;?>">Ảnh bìa</label>
							<div class="controls">
								<input type="text" class="input-large" name="thumb[<?php echo $i;?>]" id="thumb<?php echo $i;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="download<?php echo $i;?>">Link Download</label>
							<div class="controls">
								<input type="text" class="input-large" name="download[<?php echo $i;?>]" id="download<?php echo $i;?>" value="<?php echo $download;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="url">Loại</label>
							<div class="controls">
						<input type="radio" class="input-large" name="present[<?php echo $i;?>]" value="1" <?if($present==1){?>checked<?}?> /> Thuyết minh<br/>
						<input type="radio" class="input-large" name="present[<?php echo $i;?>]" value="2" <?if($present==2){?>checked<?}?> /> Vietsub<br/>
						<input type="radio" class="input-large" name="present[<?php echo $i;?>]" value="3" <?if($present==3){?>checked<?}?> /> Vietsub Full
							</div>
						</div>
						<?php } ?>
						<div class="form-actions">
							<input type="hidden" name="one" value="1"/>
							<input type="hidden" name="two" value="2"/>
							<input type="hidden" name="begin" value="<?php echo $begin;?>"/>
							<input type="hidden" name="end" value="<?php echo $end;?>"/>
							<button type="submit" class="btn btn-danger btn" name="submit" value="submit">Tiếp theo</button>&nbsp;&nbsp; <button type="reset" class="btn">Làm lại</button>
						</div>
					</fieldset>
				</form>
			</div>
			<?php } else {
				for($i=$_POST['begin'];$i<=$_POST['end'];$i++) {
					$name = $_POST['name'][$i];
					$url = $_POST['url'][$i];
					if(preg_match('/(.*):\/\/drive.google.com\/file\/d\/(.*)\/view/U', $url, $fileId)
			            || preg_match('/(.*):\/\/drive.google.com\/open\?id=(.+?)/U', $url, $fileId)
			            || preg_match('/(.*):\/\/drive.google.com\/file\/d\/(.+?)/U', $url, $fileId)){
					    add('http://p2pdriver.phimmoi.club/addDriveId?driveId=',$fileId[2]);
					}
					$thumb = $_POST['thumb'][$i];
					$present = $_POST['present'][$i];
					$download = $_POST['download'][$i];
					if($name && $url) MySql::dbinsert("episode","filmid,name,url,thumb,userpost,present,download","'$filmid','$name','$url','$thumb','$admin_id','$present','$download'");
					MySql::dbupdate('film',"timeupdate = '".time()."'","id = '$filmid'");
					header('Location: ?action=episode&filmid='.$filmid);
					/* test echo
					echo $name.' | '.$url.' | '.$thumb.'<br />'; 
					*/
				}
			}
			?>
		</div>
	</div>
</div>