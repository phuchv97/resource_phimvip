	<div class="content__inne">
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
$admin_id = $_SESSION["RK_Adminid"];
if($mode == 'delete' && $Admingroup == '2') {
	MySql::dbdelete('episode',"id = '$epid'");
	header('Location: ?action=episode&filmid='.$filmid);
}else if($mode == 'delete' && $Admingroup !== '2') {
	header('Location: ?action=episode&filmid='.$filmid);
}
else if($mode == 'add' || $mode == 'edit') {
	if($mode == 'edit') {
		$arr = MySql::dbselect('id,name,url,subtitle,thumb,filmid,userpost,default_subtitle_id,present,download','episode',"id = '$epid'");
                $subtitles = MySql::dbselect('subtitle_url,subtitle_lang,id','subtitle',"episode_id = '$epid'"); 
		$filmid = $arr[0][5];
		$name = $arr[0][1];
		if ($arr[0][6] == $admin_id or $_SESSION["RK_Admingroup"] == '2')
			{
			$url = $arr[0][2];
			}
			else {$url = "Bạn chỉ nhìn thấy những liên kết bạn đã gửi";}
		$subtitle = $arr[0][3];
		$thumb = $arr[0][4];
        $default_subid = $arr[0][7];
		$present = $arr[0][8];
		$download = $arr[0][9];
	}
	if($mode == 'add' && $_POST['submit'] && ($Admingroup == '2' or $Admingroup == '1')) {
		$timeupdate = time();
		$filmid = RemoveHack($_POST['filmid']);
		$name = RemoveHack($_POST['name']);
		$url = RemoveHack($_POST['url']);
		if(preg_match('/(.*):\/\/drive.google.com\/file\/d\/(.*)\/view/U', $url, $fileId)
            || preg_match('/(.*):\/\/drive.google.com\/open\?id=(.+?)/U', $url, $fileId)
            || preg_match('/(.*):\/\/drive.google.com\/file\/d\/(.+?)/U', $url, $fileId)){
			add('http://116.202.26.53/addDriveId?driveId=',$fileId[2]);
		    add('http://p2pdriver.phimmoi.club/addDriveId?driveId=',$fileId[2]);
		    add('http://159.69.17.102/addDriveId?driveId=',$fileId[2]);
		}
		$thumb = RemoveHack($_POST['thumb']);
		$download = RemoveHack($_POST['download']);
		$pds = RemoveHack($_POST['default_subid']);
		$present = $_POST['present'];
		$default_subid = -1;
		date_default_timezone_set('Europe/London');
		$date12 = date('Y-m-d H:i:s');
		MySql::dbinsert("episode","filmid,name,url,thumb,subtitle,userpost,datetime_post,present,download","'$filmid','$name','$url','$thumb','$subtitle','$admin_id','$date12','$present','$download'");
		MySql::dbupdate('film',"timeupdate = '$timeupdate'","id = '$filmid'");
		$lastid = mysql_insert_id();
                $epid = $lastid; 
                $newSubtitles = Upload::newSubtitle();
                $newsub_db = array();
		for($i = 0; $i<count($newSubtitles); $i++) {
                     $lang = RemoveHack($_POST['newsub_lang'][$i]);
                     if(!empty($newSubtitles[$i]) && !empty($lang)) {
                          $newsub_db[] = array('lang'=>$lang, 'url'=>$newSubtitles[$i]);
                     } else {
                     	  $newsub_db[] = null;
                     }
                }
                if(!empty($newsub_db)) {
                	 $newSubIds = array();
                     foreach($newsub_db as $sub) {
                         if($sub) {
                         	MySql::dbinsert("subtitle","episode_id,subtitle_url,subtitle_lang","'$epid','{$sub['url']}','{$sub['lang']}'");
                         	$newSubIds[] = mysql_insert_id();
                         } else {
                         	$newSubIds[] = null;
                         }
                     }
                }
                if($pds != $default_subid) {
                	if(preg_match("/newsub/", $pds)) { 
                		$tmp = explode('newsub_', $pds);
                		$tmp2 = $tmp[1];
                		if(is_numeric($tmp2) && $newSubIds[$tmp2]) {
                			$default_subid = $newSubIds[$tmp2];
                		}
                	}
                }
                MySql::dbupdate('episode',"default_subtitle_id = $default_subid","id = '$epid'");
				
		//$subtitle = Upload::Subtitle($lastid,'subtitle');
		//if($subtitle) MySql::dbupdate('episode',"subtitle = '$subtitle'","id = '$lastid'");
		header('Location: ?action=episode&filmid='.$filmid);
	}else if($mode == 'edit' && $_POST['submit'] && ($Admingroup == '2' or $arr[0][6] == $admin_id)) {
		$filmid = RemoveHack($_POST['filmid']);
		$name = RemoveHack($_POST['name']);
		$url = RemoveHack($_POST['url']);
		if(preg_match('/(.*):\/\/drive.google.com\/file\/d\/(.*)\/view/U', $url, $fileId)
            || preg_match('/(.*):\/\/drive.google.com\/open\?id=(.+?)/U', $url, $fileId)
            || preg_match('/(.*):\/\/drive.google.com\/file\/d\/(.+?)/U', $url, $fileId)){
			add('http://116.202.26.53/addDriveId?driveId=',$fileId[2]);
		    add('http://159.69.15.87/addDriveId?driveId=',$fileId[2]);
		    add('http://159.69.17.102/addDriveId?driveId=',$fileId[2]);
		}
		$thumb = RemoveHack($_POST['thumb']);
		$subdelete = RemoveHack($_POST['subdelete']);
		$pds = RemoveHack($_POST['default_subid']);
		$present = RemoveHack($_POST['present']);
		$download = RemoveHack($_POST['download']);
		$newSubtitles = Upload::newSubtitle();
                $newsub_db = array();
		for($i = 0; $i<count($newSubtitles); $i++) {
                     $lang = RemoveHack($_POST['newsub_lang'][$i]);
                     if(!empty($newSubtitles[$i]) && !empty($lang)) {
                          $newsub_db[] = array('lang'=>$lang, 'url'=>$newSubtitles[$i]);
                     } else {
                     	  $newsub_db[] = null;
                     }
                }
                if(!empty($newsub_db)) {
                	 $newSubIds = array();
                     foreach($newsub_db as $sub) {
                         if($sub) {
                         	MySql::dbinsert("subtitle","episode_id,subtitle_url,subtitle_lang","'$epid','{$sub['url']}','{$sub['lang']}'");
                         	$newSubIds[] = mysql_insert_id();
                         } else {
                         	$newSubIds[] = null;
                         }
                     }
                }
                if(isset($_POST['subdel'])) {
                     foreach($_POST['subdel'] as $subid) {
                         $subid = RemoveHack($subid); MySql::dbdelete("subtitle", "id = $subid AND episode_id = $epid");
                     }
                }
                if($pds != $default_subid) {
                	if(preg_match("/newsub/", $pds)) {
                		$tmp = explode('newsub_', $pds);
                		$tmp2 = $tmp[1];
                		if(is_numeric($tmp2) && $newSubIds[$tmp2]) {
                			$default_subid = $newSubIds[$tmp2];
                		}
                	}
                	foreach($subtitles as $csub) {
                		$default_subid = ($pds == $csub[2]) ? $csub[2] : $default_subid;
                	}
                }	
		MySql::dbupdate('episode',"name = '$name',url = '$url',thumb = '$thumb', default_subtitle_id = '$default_subid', present = '$present', download = '$download'","id = '$epid'");
		MySql::dbupdate('film',"timeupdate = '".time()."'","id = '$filmid'");
		header('Location: ?action=episode&filmid='.$filmid);
	}else if($_POST['submit'] && $Admingroup !== '2') {
		header('Location: ?action=episode&filmid='.$filmid);
	}
?>
		<div class="card">
			<div class="card-title">
				<i class="icon-check"></i>
				<h3>Đăng / Sửa tập phim</h3>
			</div>
			<!-- /widget-header -->
			<div class="card-body">
				<form class="form-horizontal" method="post" enctype="multipart/form-data"/>
					<fieldset>
						<div class="control-group">
							<label class="control-label" for="name">Chọn phim</label>
							<div class="controls">
								<select id="filmid" class="input-large" name="filmid">
								<?php echo admin_film($filmid);?>
								</select>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="name">Tên tập phim</label>
							<div class="controls">
								<input type="text" class="input-large" name="name" id="name" value="<?php echo $name;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="url">Liên kết</label>
							<div class="controls">
								<input type="text" class="input-large" name="url" id="url" value="<?php echo $url;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="subtitle">Phụ đề</label>
							<div class="controls">
								<?php //if($subtitle) echo '<input type="text" class="input-large" value="'.$subtitle.'" disabled/>'?><!--<input type="file" class="input-large" name="subtitle" id="subtitle"/>-->
								<div id="subtitles-container">
								<?php if(!empty($subtitles)) { foreach($subtitles as $sub) {echo '<div style="margin-top: 5px;">'; if( $default_subid == $sub[2] ) { $default = 'checked="checked"'; } else {$default = '';} echo '<input type="radio" name="default_subid" value="'.$sub[2].'" '.$default.'/>Default&nbsp;&nbsp;'; echo'<input type="text" class="input-small" value="'.$sub[1].'" disabled/>'.'<input type="text" class="input-large" value="'.$sub[0].'" disabled/>'.'<input type="checkbox" name="subdel[]" value="'.$sub[2].'" />Delete</div>'; } } ?>
								</div>
								<div id="upload-btn-container" style="margin-top: 10px;"><script>newSubIndex = 0;</script>
									<input type="button" value="Add more" onclick='$("#subtitles-container").append("<div style=\"margin-top: 5px;\"><input type=\"radio\" name=\"default_subid\" value=\"newsub_"+(newSubIndex++)+"\" />Default&nbsp;&nbsp;<input type=\"text\" class=\"input-small\" placeholder=\"Ngôn ngữ\" name=\"newsub_lang[]\" /><input type=\"file\" class=\"input-large\"  name=\"newsub_file[]\" /></div>")' />
								</div>
								
								
							</div>
							<?php ///if($subtitle) echo '<div class="controls"><input type="checkbox" name="subdelete" value="1"> Xóa phụ đề hiện tại</div>';?>
						</div>
						<!--<div class="control-group">
							<label class="control-label" for="thumb">Ảnh nhỏ</label>
							<div class="controls">
								<input type="text" class="input-large" name="thumb" id="thumb" value="<?php echo $thumb;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="thumb">Link Download</label>
							<div class="controls">
								<input type="text" class="input-large" name="download" id="download" value="<?php echo $download;?>"/>
							</div>
						</div> -->
						<div class="control-group">
							<label class="control-label" for="url">Loại</label>
							<div class="controls">
						<!--<label class="custom-control custom-radio">
						<input type="radio" class="custom-control-input" name="present" id="present" value="1" <?if($present==1){?>checked<?}?> /><span class="custom-control-indicator"></span>
                                <span class="custom-control-description"> Thuyết minh</span>
                            </label><br/>
						<label class="custom-control custom-radio">
							<input type="radio" class="custom-control-input" name="present" id="present" value="2" <?if($present==2){?>checked<?}?> /><span class="custom-control-indicator"></span>
                                <span class="custom-control-description">RAW</span>
                            </label><br/>
                        <label class="custom-control custom-radio">
						<input type="radio" class="custom-control-input" name="present" id="present" value="3" <?if($present==3){?>checked<?}?> /><span class="custom-control-indicator"></span>
                                <span class="custom-control-description"> Vietsub Full</span>
                            </label><br/>
                        <label class="custom-control custom-radio">
						<input type="radio" class="custom-control-input" name="present" id="present" value="4" <?if($present==4){?>checked<?}?> /><span class="custom-control-indicator"></span>
                                <span class="custom-control-description"> #VIP</span>
                            </label><br/>    -->
                        <label class="custom-control custom-radio">
						<input type="radio" class="custom-control-input" name="present" id="present" value="0" <?if($present==0){?>checked<?}?> /><span class="custom-control-indicator"></span>
                                <span class="custom-control-description">Mặc Định</span> 
                            </label>
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
$arr = MySql::dbselect('id,name,url,subtitle,userpost,active,present','episode',"filmid = '$filmid' order by id desc LIMIT $limit,$num");
$total = MySql::dbselect('id','episode',"filmid = '$filmid'");
$allpage_site = get_allpage(count($total),$num,$page,"?action=episode&filmid=$filmid&page=");
if($_POST['submit'] && $Admingroup == '2') {
	$list_ep = implode(',',$_POST['checkbox']);
	MySql::dbdelete('episode',"id IN ($list_ep)");
	header('Location: ?action=episode&filmid='.$filmid);
}else if($_POST['submit'] && $Admingroup !== '2') {
	header('Location: ?action=episode&filmid='.$filmid);
}
if($_POST['hideep'] && $Admingroup == '2') {
	$list_ep = implode(',',$_POST['checkbox']);
	MySql::dbupdate('episode',"active = 0","id IN ($list_ep)");
	header('Location: ?action=episode&filmid='.$filmid);
}else if($_POST['submit'] && $Admingroup !== '2') {
	header('Location: ?action=episode&filmid='.$filmid);
}
if($_POST['showep'] && $Admingroup == '2') {
	$list_ep = implode(',',$_POST['checkbox']);
	MySql::dbupdate('episode',"active = 1","id IN ($list_ep)");
	header('Location: ?action=episode&filmid='.$filmid);
}if($_POST['vietsub'] && $Admingroup == '2') {
	$list_ep = implode(',',$_POST['checkbox']);
	MySql::dbupdate('episode',"present = 3","id IN ($list_ep)");
	header('Location: ?action=episode&filmid='.$filmid);
}else if($_POST['submit'] && $Admingroup !== '2') {
	header('Location: ?action=episode&filmid='.$filmid);
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
		<form id="list" method="post">
		<div class="widget stacked widget-table action-table">
			<div class="widget-header">
				<i class="icon-th-list"></i>
				<h3>Tập phim</h3><a class="btn btn-info" href="?action=episode&mode=add&filmid=<?php echo $filmid;?>">Thêm tập</a><a class="btn btn-info" href="?action=multi-episode&filmid=<?php echo $filmid;?>">Thêm nhiều tập</a>
			</div>
			<!-- /widget-header -->
			<div class="widget-content">
				<table class="table table-striped table-bordered">
				<thead>
				<tr>
					<th>
						<input type="checkbox" id="check_all"> Chọn hết
					</th>
					<th>
						Tên tập
					</th>
					<th>
						Siêu liên kết
					</th>
					<th>
						Phụ đề
					</th>
					<th>
						Trạng thái
					</th>
					<th width="120px">
						Chức năng
					</th>
				</tr>
				</thead>
				<tbody>
				<?php
					for($i=0;$i<count($arr);$i++) {
						$id = $arr[$i][0];
						$name = $arr[$i][1];
						if ($arr[$i][4] == $admin_id or $_SESSION["RK_Admingroup"] == '2')
							{
								$url = CutName($arr[$i][2],50);
							}
							else {$url = "Bạn chỉ nhìn thấy những liên kết bạn đã gửi";}
						$subtitle = CutName($arr[$i][3],50);
						$active = $arr[$i][5];
						$phude = $arr[$i][6];
				?>
				<tr>
					<td>
						<input type="checkbox" name="checkbox[]" value="<?php echo $id;?>">
					</td>
					<td>
						<?php echo $name;?>
					</td>
					<td>
						<?php echo $url;?>
					</td>
					<td>
						<?php if($phude==1)
							echo "Thuyết minh";
						elseif($phude==2)
							echo "RAW";
						elseif($phude==3)
							echo "Vietsub Full";
						elseif($phude==4)
							echo "VIP";
						?>
					</td>
					<td>
						<?php 
						if($active==1)
							echo "Hiện";
						else
							echo "Ẩn";
						?>
					</td>
					<td class="td-actions">
						<a href="?action=episode&mode=edit&epid=<?php echo $id;?>" class="btn btn-small btn-warning">
						Sửa tập
						</a>
						<a data-url="?action=episode&mode=delete&epid=<?php echo $id;?>&filmid=<?php echo $filmid?>" class="btn btn-small deletefilm">
						Xóa tập
						</a>
					</td>
				</tr>
				<?php } ?>
				</tbody>
				</table>
			</div>
			<!-- /widget-content -->
		</div>
		<input id="submit_setting" type="submit" class="btn btn-small btn-warning" name="hideep" value="Ẩn Episode"> 
		<input id="submit_setting" type="submit" class="btn btn-small btn-warning" name="showep" value="Hiện Episode">
		<input id="submit_setting" type="submit" class="btn btn-small btn-warning" name="submit" value="Xóa toàn bộ">
		<input id="submit_setting" type="submit" class="btn btn-small btn-warning" name="vietsub" value="Vietsub all">  		 
		</form>
		<?php echo $allpage_site;?>
<?php } ?>
	</div>
	