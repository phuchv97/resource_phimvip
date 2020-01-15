<div class="main">
	<div class="container">
<?php if($Admingroup == '1') echo '<pre>Lưu ý: Bạn đang nằm trong nhóm <b>hợp tác viên</b>, bạn sẽ bị hạn chế một số chức năng thêm/sửa/xóa thông tin trên website.</pre>';?>
<?php 
if($mode == 'delete' && $Admingroup == '2') {
	MySql::dbdelete('user',"id = '$cid'");
	header('Location: ?action=user');
} else if($mode == 'delete' && $Admingroup !== '2') {
	header('Location: ?action=user');
}
else if($mode == 'add' || $mode == 'edit') {
	if($mode == 'edit') {
		$arr = MySql::dbselect('username,email,ugroup,fullname','user',"id = '$cid'");
		$username = $arr[0][0];
		$email = $arr[0][1];
		$ugroup = $arr[0][2];
		$fullname = $arr[0][3];
	}
	if($mode == 'edit' && $_POST['submit'] && $Admingroup == '2') {
		$username = RemoveHack($_POST['username']);
		$email = RemoveHack($_POST['email']);
		$ugroup = RemoveHack($_POST['ugroup']);
		$fullname = RemoveHack($_POST['fullname']);
		$password = RemoveHack($_POST['password']);
		MySql::dbupdate('user',"username = '$username',email='$email',ugroup = '$ugroup',fullname = '$fullname'","id = '$cid'");
		if($password) {
			$codesecurity = rand(1000,9999);
			$password =	md5(md5($password).$codesecurity);
			MySql::dbupdate('user',"password = '$password',codesecurity = '$codesecurity'","id = '$cid'");
		}
		header("Location: ?action=user&mode=edit&cid=$cid");
	}else if($mode == 'add' && $_POST['submit'] && $Admingroup == '2') {
		$username = RemoveHack($_POST['username']);
		$email = RemoveHack($_POST['email']);
		$ugroup = RemoveHack($_POST['ugroup']);
		$fullname = RemoveHack($_POST['fullname']);
		$password = RemoveHack($_POST['password']);
		$codesecurity = rand(1000,9999);
		$passwordc =	md5(md5($password).$codesecurity);
		MySql::dbinsert("user","username,email,ugroup,fullname,password,codesecurity","'$username','$email','$ugroup','$fullname','$passwordc','$codesecurity'");
		header("Location: ?action=user");
	}else if($_POST['submit'] && $Admingroup !== '2') {
		header("Location: ?action=user");
	}
?>
		<div class="widget stacked">
			<div class="widget-header">
				<i class="icon-check"></i>
				<h3>Thêm / Sửa thành viên</h3>
			</div>
			<!-- /widget-header -->
			<div class="widget-content">
				<form class="form-horizontal" method="post" enctype="multipart/form-data"/>
					<fieldset>
						<div class="control-group">
							<label class="control-label" for="username">Tên tài khoản</label>
							<div class="controls">
								<input type="text" class="input-large" name="username" id="username" value="<?php echo $username;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="password">Mật khẩu</label>
							<div class="controls">
								<input type="password" class="input-large" name="password" id="password"/> (Nhập nếu nuốn đổi)
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="email">Email</label>
							<div class="controls">
								<input type="text" class="input-large" name="email" id="email" value="<?php echo $email;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="ugroup">Nhóm</label>
							<div class="controls">
								<select id="ugroup" name="ugroup">
									<?php echo admin_ugroup($ugroup);?>
								</select>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="fullname">Tên đầy đủ</label>
							<div class="controls">
								<input type="text" class="input-large" name="fullname" id="fullname" value="<?php echo $fullname;?>"/>
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
$num		= 	30;
$num 		= 	intval($num);
$page 		= 	intval($page);
if (!$page) 	$page = 1;
$limit 		= 	($page-1)*$num;
if($limit<0) 	$limit=0;
if($_POST['search']){
	$kw = $_POST['search'];
	$sql = "username LIKE '%$kw%' OR email LIKE '%$kw%'";
}else{
	$sql = "id != 0";
}
$arr = MySql::dbselect('id,username,email,ugroup,token','user',"$sql order by id desc LIMIT $limit,$num");
$total = MySql::dbselect('id','user',"id != 0");
$allpage_site = get_allpage(count($total),$num,$page,"?action=user&page=");
if($_POST['submit'] && $Admingroup == '2') {
	$list_media = implode(',',$_POST['checkbox']);
	MySql::dbdelete('user',"id IN ($list_media)");
	header('Location: ?action=user');
}else if($_POST['submit'] && $Admingroup !== '2') {
	header('Location: ?action=user');
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
		<a href="?action=user&mode=add" class="btn btn-small btn-warning" style="margin-bottom:10px"> Thêm thành viên</a>
		<div style="float:right">
		<form action="" method="post">
		<input type="text" name="search" placeholder="Tìm thành viên">
		</form>
		</div>
		<form id="list" method="post">
		<div class="widget stacked widget-table action-table">
			<div class="widget-header">
				<i class="icon-th-list"></i>
				<h3>Thành viên</h3>
			</div>
			<!-- /widget-header -->
			<div class="widget-content">
				<table class="table table-striped table-bordered">
				<thead>
				<tr>
					<th width="80px">
						<input type="checkbox" id="check_all"> Chọn hết
					</th>
					<th>
						Tài khoản
					</th>
					
					<th>
						Phim đã up
					</th>
					<th>
						Hiện có
					</th>
					<th>
						Nhóm
					</th>
					<th>
						Email
					</th>
					<th width="80px">
						Chức năng
					</th>
				</tr>
				</thead>
				<tbody>
				<?php
					for($i=0;$i<count($arr);$i++) {
						$id = $arr[$i][0];
						$username = $arr[$i][1];
						$email = $arr[$i][2];
						$ugroup = LoginAuth::GroupUser($arr[$i][3]);
						$token = $arr[$i][4];
						$views = one_data("COUNT(id)","episode","userpost = '".$id."'");
				?>
				<tr>
					<td>
						<input type="checkbox" name="checkbox[]" value="<?php echo $id;?>">
					</td>
					<td>
						<?php echo $username;?>
					</td>
					
					<td>
					<?php echo one_data("COUNT(id)","film","userpost = '".$id."'");?>  phim,<?php echo one_data("COUNT(id)","episode","userpost = '".$id."'");?> Tập
					</td>
					<td>
						<?php echo number_format($views*(1000000/1000));?> <font color="red">đ </font>
					</td>
					<td>
						<?php echo $ugroup;?>
					</td>
					<td>
					<?=$email?>
					</td>
					<td class="td-actions">
						<a href="?action=user&mode=edit&cid=<?php echo $id;?>" class="btn btn-small btn-warning">
						Sửa
						</a>
						<a data-url="?action=user&mode=delete&cid=<?php echo $id;?>" class="btn btn-small deletefilm">
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