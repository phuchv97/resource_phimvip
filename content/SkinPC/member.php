<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
include View::UploadView('header');
include View::TemplateView('functions');
$page = $geturl[2];
$user = MySql::dbselect('username,email,lastlogin,lastreg,facebookid,fullname,ugroup,fav_feature,fav_playlist','user',"id = '".$_SESSION["RK_Userid"]."'");
$id = $_SESSION["RK_Userid"];
$fullname = $user[0][5];
$username = $user[0][0];
$like = $user[0][8];
$email = $user[0][1];
$lastlogin = GetDateT($user[0][2]);
$lastreg = GetDateT($user[0][3]);
$ugroup = LoginAuth::GroupUser($user[0][6]);
$facebookurl = $user[0][4];
if($facebookurl){
$getu = explode('m/',$facebookurl);
$image = 'https://graph.facebook.com/'.$getu[1].'/picture?width=250&height=250';
} else {
$image = SITE_URL.'/assets/images/noimages.png';
}
if(!$_SESSION["RK_Userid"]){
	header("Location: ".SITE_URL);
	exit;
}
?>
<body>
<div class="container-fluid">
<div class="row main">
<div class="navbar-menu">
<div class="col-xs-6 col-md-8 col-lg-8">
<div class="logo">
<a href="/">
<img src="/logo.png" class="img-responsive">
</a>
</div>
</div>
<div class="col-xs-6 col-md-4 col-lg-4 text-right">
<div class="avatar">
<a href="javascript: void(0)" data="" title="Hình đại diện"><img src="<?=$image?>"></a>
<a href="javascript: void(0)" data="" title="" class="username"><? if ($fullname) {echo $fullname ;} else {echo $username ;}?></a>
<span class="glyphicon glyphicon-chevron-down pull-right arr-down"></span>
<div class="user-section">
<div class="tip-dropdown">
<span class="arr-top"></span>
<ul>
<li>
<a href="<?=SITE_URL?>/user/profile" data="" title="capnhatthongtin">
<i class="glyphicon glyphicon-user"></i>Thông tin tài khoản
</a>
</li>
<li>
<a href="<?=SITE_URL?>/user/movies" data="" title="danhmucphimyeuthich">
<i class="fa fa-thumbs-o-up"></i></i>Phim yêu thích
</a>
</li>
<li>
<a href="<?=SITE_URL?>/user/update" data="" title="Đổi mật khẩu">
<i class="glyphicon glyphicon-lock"></i>Đổi mật khẩu
</a>
</li>
<li>
<a href="/logout/" class="username">
<i class="glyphicon glyphicon-log-out"></i>Thoát
</a>
</li>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="row profile main">
<div class="col-md-3">
<div class="profile-sidebar">
<div class="profile-userpic">
<img src="<?=$image?>" class="img-responsive" alt=""/>
</div>
<div class="profile-usertitle">
<div class="profile-usertitle-name"><?=$username?><? if ($fullname) {echo '('.$fullname.')';}?></div>
<div class="date-expired">Ngày tham gia: <?=$lastreg?></div>
</div>
<div class="profile-usermenu">
<ul class="nav">
<?php
if($page == 'profile') {
echo '<li class="active">';
} else {echo '<li class="">';
}
?>
<a href="<?=SITE_URL?>/user/profile" data="" title="Thông tin cá nhân">
<i class="glyphicon glyphicon-user"></i>
Thông tin tài khoản
</a>
</li>
<?php
if($page == 'movies') {
echo '<li class="active">';
} else {echo '<li class="">';
}
?>
<a href="<?=SITE_URL?>/user/movies" data="" title="phim yêu thích">
<i class="fa fa-thumbs-o-up"></i>
Phim yêu thích
</a>
</li>
<?php
if($page == 'update') {
echo '<li class="active">';
} else {echo '<li class="">';
}
?>
<a href="<?=SITE_URL?>/user/update" data="" title="Đổi mật khẩu">
<i class="glyphicon glyphicon-ok"></i>
Đổi mật khẩu
</a>
</li>
<li class="">
<a href="/logout/" data="" title="Thoát">
<i class="glyphicon glyphicon-ok"></i>
Thoát
</a>
</li>
</ul>
</div>
</div>
</div>
<?php
if($page == 'profile') {
?>
<div class="col-md-9">
<div class="profile-content">
<div id="personal-info-pf" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 personal-info" style="display:block">
<h3>Cập nhật thông tin</h3>
<table class="table tablenor">
<tbody><tr>
<td class="none-top" style="text-align: left">Họ tên</td>
<td class="none-top" style="text-align: left"><strong><?=$fullname?></strong></td>
</tr>
<tr>
<td>Tên đăng nhập</td>
<td><strong><?=$username?></strong></td>
</tr>
<tr>
<td>Mã tài khoản</td>
<td><span class="upgradeVip"><strong><?=$id?></strong></span></td>
</tr>
<tr>
<td>Link Facebook</td>
<td><strong><?=$facebookurl?></strong></td>
</tr>
<tr>
<td>Ngày đăng ký</td>
<td><strong><?=$lastreg?></strong></td>
</tr>
<tr>
<td>Hoạt động gần đây</td>
<td><strong><?=$lastlogin?></strong></td>
</tr>
<tr>
<td>Email</td>
<td><strong><?=$email?></strong></td>
</tr>
<tr>
<td>Loại tài khoản</td>
<td><strong>VIP PAZ</strong></td>
</tr>
<tr>
<td>Ngày hết hạn</td>
<td>
<span class="upgradeVip"><strong>Trọn Đời</strong></span>
</td>
</tr>
</tbody></table>
<div class="col-lg-7 col-md-7 col-sm-8 col-xs-8 col-xxs-12 bt-padding">
<input type="button" onclick="location.href='/user/update'" class="btn margin-button" id="change-pass-profile" style="background:#ff0000;" value="Đổi thông tin">
<span></span>
</div>
</div>
</div>
</div>
</div>
<?php } elseif($page == 'quen-mat-khau') { ?>
<div style="margin-top:70px"></div>
<div class="p-profile clearfix" id="lost_pass">
	<div class="user-info">
		<div class="middle_left" style="width:65%">
			<label class="tit">Quên mật khẩu</label>
			<div class="stat">
				<ul>
					<li><label>Email</label><span><input type="text" id="email" class="text"/></span></li>
					<li><label>Mã xác nhận</label><span style="position:relative"><input type="text" class="text" name="security" id="security"/><img src='<?php echo SITE_URL; ?>/include/lib/security.php?<?php echo time();?>' border=0 style="position: absolute;right: 5px;top: -1px;height: 20px;"/></span></li>
					<li><label></label><span><input type="submit" value="Quên mật khẩu" class="button"/></span></li>
				</ul>
			</div>
		</div>
		<div class="middle_right" style="width:35%">
			<label class="tit">Lưu ý</label>
			<div class="stat" style="color:#414141">
				 Trường hợp nếu bạn không nhớ mật khẩu của mình thì hãy cung cấp thông tin cá nhân và lịch sử nạp card và gửi về mail để hdonline hỗ trợ cho bạn.
			</div>
		</div>
	</div>
</div>
<?php } elseif($page == 'notify') { 
$arr = MySql::dbselect('nt_content,timeupdate','notice JOIN tb_user ON (tb_user.id = tb_notice.userid)',"userid='".$_SESSION["RK_Userid"]."'");
$total_mes = count($arr);
MySql::dbupdate('notice',"n_read=1","userid='".$_SESSION["RK_Userid"]."'");
?>
                    <div class="ppm-head">
                        <div class="ppmh-title">
                            <i class="fa fa-bell-o mr5"></i> Thông báo
                                                    </div>
                    </div>
                    <div class="ppm-content noti-content">
                        <ul>
					<?php
					if($total_mes){
						for($i=0;$i<count($arr);$i++) {
					?>
					<li class=""><a href="<?=SITE_URL?>/user/notify" title=""><?=$arr[$i][0]?></a><a class="time">Vào lúc <?=date('g:h:i d/m/Y',$arr[$i][1])?></a></li>
						<?}
					}else{?>
					  <li class="more">Bạn chưa có thông báo nào.</li>
					<?}?>
                                                          
                       </ul>
                    </div>
                    <div id="pagination">
                        <nav>
                                                    </nav>
                    </div>
                </div>
             
<?php }elseif($page == 'movies'){
?>

<div class="col-md-9">
<div class="profile-content">
<div id="personal-info-pf" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 personal-info">
<h3>Danh mục phim yêu thích</h3>
<div class="table-responsive">
<div class="c_content1">
<?php echo li_filmMEM(50,$user[0][8],'fav_playlist');?>   
<div class="clearfix"></div>
<div class="p-paginate">
</div>
</div>
</div>
</div>
</div>
</div>
</div> 
<?php } elseif($page == 'update') { 
if(!$_SESSION["RK_Userid"]){
	header("Location: ".SITE_URL);
	exit;
}
?>
<div class="col-md-9">
<div class="profile-content">
<div id="personal-info-pf" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 personal-info" style="display:block">
<h3>Cập nhật thông tin</h3>
<form class="form-horizontal" id="profile-form" action="<?=SITE_URL?>/user/update" enctype="multipart/form-data" method="post">
<div class="form-group">
<label class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-xxs-12 control-label">Email</label>
<div class="col-lg-9 col-md-7 col-sm-8 col-xs-8 col-xxs-12"><input type="text" id="email" name="email" value="<?=$email?>" class="form-control" placeholder="Email" disabled="disabled"/></div></div>
<div class="form-group">
<label class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-xxs-12 control-label">Username</label>
<div class="col-lg-9 col-md-7 col-sm-8 col-xs-8 col-xxs-12"><input type="text" id="username" name="username" value="<?=$username?>" class="form-control" placeholder="Email" disabled="disabled"/></div></div>
<div class="form-group">
                                        <span id="error-full_name"
                                              class="help-block error-block"></span>
<label class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-xxs-12 control-label">Họ tên</label>
<div class="col-lg-9 col-md-7 col-sm-8 col-xs-8 col-xxs-12"><input type="text" id="fullname" name="fullname" value="<?php echo $fullname;?> " class="form-control" placeholder="Họ tên"/></div></div>
<div class="form-group">
<label class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-xxs-12 control-label">Link facebook</label>
<div class="col-lg-9 col-md-7 col-sm-8 col-xs-8 col-xxs-12"><input type="url" id="facebook" name="facebook" value="<?=$facebookurl?>" class="form-control" placeholder="Link facebook"/></div></div>
<div class="form-group">
                                        <span id="error-old_password"
                                              class="help-block error-block"></span>
<label class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-xxs-12 control-label">Mật khẩu cũ(nếu muốn đổi)</label>
<div class="col-lg-9 col-md-7 col-sm-8 col-xs-8 col-xxs-12"><input type="password" id="old_password" name="old_password" class="form-control"/></div></div>
<div class="form-group">
                                        <span id="error-old_password"
                                              class="help-block error-block"></span>
<label class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-xxs-12 control-label">Mật khẩu mới(nếu muốn đổi)</label>
<div class="col-lg-9 col-md-7 col-sm-8 col-xs-8 col-xxs-12"><input type="password" id="new_password" name="new_password" class="form-control"/></div></div>
<div class="form-group" style="padding-top: 6px;">
<label class="col-lg-5 col-md-3 col-sm-3 col-xs-3 col-xxs-12 control-label"></label>
<div class="col-lg-7 col-md-7 col-sm-8 col-xs-8 col-xxs-12 bt-padding">
                                        <button id="btn-update" type="submit" style="background:#ff0000;" name="submit" class="btn">
                                            Cập nhật
                                        </button>
<span></span>
</div>
</div>                               
<script>
    $("#profile-form").submit(function (e) {
        $("#btn-update").prop("disabled", true);
        $("#submit-loading").show();
        var postData = new FormData(this);
        var formURL = $(this).attr("action");
        $.ajax({
            url: formURL,
            type: "POST",
            data: postData,
            dataType: "json",
            mimeType: "multipart/form-data",
            contentType: false,
            processData: false,
            cache: false,
            success: function (data) {
                $('.error-block').hide();
                if (data.status == 0) {
                    for (var message in data.messages) {
                        $('#error-' + message).show();
                        $('#error-' + message).text(data.messages[message]);
                    }
                    $('.csrf-token').html(data.csrf_token);
                    $("#btn-update").removeAttr("disabled");
                    $("#submit-loading").hide();
                }
                if (data.status == 1) {
                    window.location.reload();
                }
            }
        });
        e.preventDefault();
    });
</script>
<?php
}elseif($page=='billing'){
$u_billing = MySql::dbselect('bank,fullname,bankid,bank_brand,diachi,phone','user_billing',"userid = '".$_SESSION["RK_Userid"]."'");	
?>
<div class="ppm-head">
                        <div class="ppmh-title"><i class="fa fa-pencil-square-o mr5"></i> Thông tin thanh toán</div>
                    </div>
                    <div class="ppm-content update-content">
                        <div class="uc-form">
                            <form id="profile-form" action="<?=SITE_URL?>/user/billing" method="POST"
                                  class="form-horizontal" enctype="multipart/form-data">
                               
								<div class="form-group">
                                    <label for="bank" class="col-sm-4 control-label">Tên ngân hàng</label>

                                    <div class="col-sm-8">
                                        <input name="bank" type="text" class="form-control" id="full_name"
                                               value="<?=$u_billing[0][0]?>">

                                        <span id="error-full_name"
                                              class="help-block error-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="full_name" class="col-sm-4 control-label">Tên tài khoản</label>

                                    <div class="col-sm-8">
                                        <input name="fullname" type="text" class="form-control" id="full_name"
                                               value="<?=$u_billing[0][1]?>">

                                        <span id="error-full_name"
                                              class="help-block error-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="bankid" class="col-sm-4 control-label">Số tài khoản</label>

                                    <div class="col-sm-8">
                                        <input type="text" name="bankid" class="form-control" id="bankid"
                                               value="<?=$u_billing[0][2]?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="diachi" class="col-sm-4 control-label">Địa chỉ</label>

                                    <div class="col-sm-8">
                                        <input name="diachi" type="text" class="form-control" id="diachi"
                                               value="<?=$u_billing[0][4]?>">
                                    </div>
                                </div>                                
                               
                                <div class="form-group">
                                    <label for="phone" class="col-sm-4 control-label">Số điện thoại</label>

                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="phone"
                                               name="phone" value="<?=$u_billing[0][5]?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="bank_brand" class="col-sm-4 control-label">Chi nhánh</label>

                                    <div class="col-sm-8">
                                        <input name="bank_brand" type="text" class="form-control"
                                               id="bank_brand" value="<?=$u_billing[0][3]?>">

                                        
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="username" class="col-sm-4 control-label"></label>

                                    <div class="col-sm-8">
                                        <button id="btn-update" type="submit" name="submit" class="btn btn-success btn-approve mt10">
                                            Cập nhật
                                        </button>
                                        <img id="submit-loading" style="display: none;" class="ml10 mt10" height="35px"
                                             src="<?=SITE_URL?>/assets/images/ajax-loading.gif">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
<script>
    $("#profile-form").submit(function (e) {
        $("#btn-update").prop("disabled", true);
        $("#submit-loading").show();
        var postData = new FormData(this);
        var formURL = $(this).attr("action");
        $.ajax({
            url: formURL,
            type: "POST",
            data: postData,
            dataType: "json",
            mimeType: "multipart/form-data",
            contentType: false,
            processData: false,
            cache: false,
            success: function (data) {
                $('.error-block').hide();
                if (data.status == 0) {
                    for (var message in data.messages) {
                        $('#error-' + message).show();
                        $('#error-' + message).text(data.messages[message]);
                    }
                    $('.csrf-token').html(data.csrf_token);
                    $("#btn-update").removeAttr("disabled");
                    $("#submit-loading").hide();
                }
                if (data.status == 1) {
                    window.location.reload();
                }
            }
        });
        e.preventDefault();
    });
</script>
<?}elseif($page == 'payment'){?>
<div class="ppm-head">
                        <div class="ppmh-title"><i class="fa fa-dollar mr5"></i> Yêu cầu thanh toán</div>
                    </div>
                    <div class="ppm-content update-content">
					<div class="alert alert-info" role="alert">
					<i>- Số tiền tối thiểu để yêu cầu thanh toán là 100.000 vnđ</i><br/>
					<i>- Bạn có thể yêu cầu thanh toán bằng 2 cách:<br/>
						1. Chuyển khoản ngân hàng<br/>
						2. Nhận thẻ điện thoại, mã thẻ sẽ được gửi qua tin nhắn vào số điện thoại mà bạn cung cấp trong phần thông tin thanh toán.</i><br/>
					<i>- Thời gian thực hiện thanh toán trong vòng 24 - 48h kể từ khi yêu cầu.</i>
					</div>
                        <div class="uc-form">
                            <form id="profile-form" action="<?=SITE_URL?>/user/payment" method="POST"
                                  class="form-horizontal" enctype="multipart/form-data">
								<div class="form-group">
                                    <label for="bank_brand" class="col-sm-4 control-label">Số tiền thanh toán</label>

                                    <div class="col-sm-8">
                                      <input name="amount" type="text" class="form-control"
                                               id="amount" value="<?=$amount?>">                                        
                                    </div>
                                </div>
								<div class="form-group">
                                    <label for="bank_brand" class="col-sm-4 control-label">Chọn hình thức thanh toán</label>

                                    <div class="col-sm-8">
                                        <input name="payment" type="radio" id="payment" value="1"> Chuyển khoản <br/>
										<input name="payment" type="radio" id="payment" value="2"> Nhận thẻ điện thoại

                                        
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="username" class="col-sm-4 control-label"></label>

                                    <div class="col-sm-8">
									<?php
									$views = one_data("SUM(viewed) views","film","userpost = '".$_SESSION["RK_Userid"]."'");
									$tien = $views*(3000/1000);
									if($tien >=10000000){
									?>
                                        <button id="btn-update" type="submit" name="submit" class="btn btn-success btn-approve mt10">
                                            Yêu cầu thanh toán
                                        </button>
									<?}else{?>
									<button disabled class="btn btn-success btn-approve mt10">
                                            Bạn chưa đủ tiền để yêu cầu
                                        </button>
									<?}?>
                                        <img id="submit-loading" style="display: none;" class="ml10 mt10" height="35px"
                                             src="<?=SITE_URL?>/assets/images/ajax-loading.gif">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
<script>
    $("#profile-form").submit(function (e) {
        $("#btn-update").prop("disabled", true);
        $("#submit-loading").show();
        var postData = new FormData(this);
        var formURL = $(this).attr("action");
        $.ajax({
            url: formURL,
            type: "POST",
            data: postData,
            dataType: "json",
            mimeType: "multipart/form-data",
            contentType: false,
            processData: false,
            cache: false,
            success: function (data) {
                $('.error-block').hide();
                if (data.status == 0) {
                    for (var message in data.messages) {
                        $('#error-' + message).show();
                        $('#error-' + message).text(data.messages[message]);
                    }
                    $('.csrf-token').html(data.csrf_token);
                    $("#btn-update").removeAttr("disabled");
                    $("#submit-loading").hide();
                }
                if (data.status == 1) {
					alert('Yêu cầu thành công!');
                    window.location.reload();
                }
            }
        });
        e.preventDefault();
    });
</script>
<?	
}
echo '</div>
                <div class="clearfix"></div>
			</div>
        </div>
	<div class="clearfix"></div>
  </div>
</div>
';
include View::UploadView('footer');
?>
