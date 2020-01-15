
    <header class="content__title">
                    <h1>Grab phim</h1>
                </header><div class="main">
	<div class="container">
	<?php 
$admin_id = $_SESSION["RK_Adminid"];
if($Admingroup == '1') echo '<pre>Lưu ý: Bạn đang nằm trong nhóm <b>hợp tác viên</b>, bạn sẽ bị hạn chế một số chức năng thêm/sửa/xóa thông tin trên website.</pre>';
?>
<script type="text/javascript" language="javascript">
$(function () {
	$('textarea#content').ckeditor();
});
</script>
		<div class="card-body">
			<!-- /widget-header -->
			<?php if(!$page) { ?>
			<div class="widget-content">
				<form class="form-horizontal" method="get"/>
					<fieldset>
						<input type="hidden" name="action" value="grabfilm">
						<div class="control-group">
							<label class="control-label" for="page">Link grab</label>
							<div class="controls">
								<input type="text" class="input-large" name="page" id="page" value=""/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="begin">Bắt đầu từ</label>
							<div class="controls">
								<input type="text" class="input-large" name="begin" id="begin" value=""/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="end">Kết thúc</label>
							<div class="controls">
								<input type="text" class="input-large" name="end" id="end" value=""/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="name">Chọn phim</label>
							<div class="controls">
								<select id="filmid" class="input-large" name="filmid">
									<option value="0">Thêm phim mới</option>
									<?php echo admin_film($filmid);?>
								</select>
							</div>
						</div>
						<div class="form-actions">
							<button type="submit" class="btn btn-danger btn">Tiếp theo</button>&nbsp;&nbsp; <button type="reset" class="btn">Làm lại</button>
						</div>
					</fieldset>
				</form>
<script type="text/javascript">
	            function notify(){
                $.notify({
                    title: 'Sever Get Link',
                    message: 'Hiện tại có thể leech info từ các site: Phimbathu.com ,Bilutv, , Phimmoi.net , Còn play phim có thể play các site:  Phimmoi.net ,Bilutv,Banhtv, Vivuphim,Vivo.vn, Drive, Facebook , GG Photos, Phimbathu.com ,.....',
                    url: ''
                },{
                    element: 'body',
                    type: 'info',
                    allow_dismiss: true,
                    offset: {
                        x: 20,
                        y: 20
                    },
                    spacing: 10,
                    z_index: 1031,
                    delay: 2500,
                    timer: 3000,
                    url_target: '_blank',
                    mouse_over: false,
                    template:   '<div data-notify="container" class="alert alert-dismissible alert-{0} alert--notify" role="alert">' +
                                    '<span data-notify="icon"></span> ' +
                                    '<span data-notify="title">{1}</span> ' +
                                    '<span data-notify="message">{2}</span>' +
                                    '<div class="progress" data-notify="progressbar">' +
                                        '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                                    '</div>' +
                                    '<a href="{3}" target="{4}" data-notify="url"></a>' +
                                    '<button type="button" aria-hidden="true" data-notify="dismiss" class="close"><span>×</span></button>' +
                                '</div>'
                });
            }
            $(window).load(notify());
</script>				
			</div>
			<?php } else { 
				$page = urldecode($page);
				$filmid = intval($_GET['filmid']);
				if(!$_POST['submit']) {
					if(preg_match('#bilutv.org/(.*?)#s', $page)) $grabtype = 'bilu'; 
					else if(preg_match('#phimbathu.com/(.*?)#s', $page)) $grabtype = 'phimbh';
					else if(preg_match('#animetvn.tv/(.*?)#s', $page)) $grabtype = 'animevs';
					else if(preg_match('#xuongphim.tv/(.*?)#s', $page)) $grabtype = 'xp';
					else if(preg_match('#hdonline.vn/(.*?)#s', $page)) $grabtype = 'hdo';
					else if(preg_match('#motphim.net/(.*?)#s', $page)) $grabtype = 'pbh';
					else if(preg_match('#phimmoi.net/(.*?)#s', $page)) $grabtype = 'phimmoi';
					else if(preg_match('#vtv16.com/(.*?)#s', $page)) $grabtype = 'vtv16';
					else if(preg_match('#gigaphim.com/(.*?)#s', $page)) $grabtype = 'giga';
					else if(preg_match('#vophim.com/(.*?)#s', $page)) $grabtype = 'vophim';
					else if(preg_match('#hdhay.net/(.*?)#s', $page)) $grabtype = 'hdhay';
					else if(preg_match('#xvideos.com/(.*?)#s', $page)) $grabtype = 'xvideos';
					include('sitegrab/_decode.php');
					include('sitegrab/_dom.php');
					$dom = new Dom();
					include "sitegrab/$grabtype.php";
                                                                               $key = VietChar($title);
                                                                               $keyhoa = mb_strtolower($title_en);
                                                                               $key2 = mb_strtolower($key, 'UTF-8');
					$keywords = "$key2,$keyhoa,$title";
					if(!$quality) $quality = 'HD';
				}else if($Admingroup == '2' || $Admingroup == '1') {
					// nhập dữ liệu vào database
					$title = RemoveHack($_POST['title']);
					$title_en = RemoveHack($_POST['title_en']);
					$director = RemoveHack($_POST['director']);
					$actor = RemoveHack($_POST['actor']);
					$category = ','.(implode(',',$_POST['category'])).',';
					$country = RemoveHack($_POST['country']);
					$duration = RemoveHack($_POST['duration']);
					$year = RemoveHack($_POST['year']);
                    $thumb_name = Replace(VietChar($title));
                    $thumb_en = Replace(VietChar($title_en));
                    $thumb = uploadurl(RemoveHack($_POST['thumb']),$thumb_name,"film");
					$filmlb = RemoveHack($_POST['filmlb']);
					$quality = RemoveHack($_POST['quality']);
					$thuyetminh = RemoveHack($_POST['thuyetminh']);
					$trailer = RemoveHack($_POST['trailer']);
                    $big_image = uploadurl(RemoveHack($_POST['big_image']),$thumb_en,"info");
					$release_time = RemoveHack($_POST['release_time']);
					$content = addslashes(UnHtmlChars(RemoveHack($_POST['content'])));
					$keywords =  RemoveHack($_POST['keywords']);
					$seotitle =  RemoveHack($_POST['seotitle']);
					$tinhtrang =  RemoveHack($_POST['tinhtrang']);
					$timeupdate = time();
					$userpost = $admin_id;
						if ($title_en) {
							// kiếm tra phim
							$check	=	MySql::dbselect("id","film","title_en = '$title_en'");
							if($check) {
								$film	=	$check[0][0];
								$filmis = $film;	
							}else {
										if($title && $filmid == '0') {
											MySql::dbinsert("film","title,title_en,director,actor,category,country,duration,year,thumb,filmlb,quality,trailer,big_image,release_time,timeupdate,userpost,seotitle,thuyetminh,tinhtrang","'$title','$title_en','$director','$actor','$category','$country','$duration','$year','$thumb','$filmlb','$quality','$trailer','$big_image','$release_time','$timeupdate','$userpost','$seotitle','$thuyetminh','$tinhtrang'");
											$filmis = mysql_insert_id();
											MySql::dbinsert("film_other","filmid,content,keywords,searchs","'$filmis','$content','$keywords','$keywords'");
										}else {
											$filmis = $filmid;
										}
							}
						}
					$epbegin = intval($_POST['epbegin']);
					$epend = intval($_POST['epend']);
					for($i=$epbegin;$i<=$epend;$i++) {
						$filmid = $filmis;
						$name = RemoveHack($_POST['epname'][$i]);
						$url = RemoveHack($_POST['epurl'][$i]);
						if(preg_match('/(.*):\/\/drive.google.com\/file\/d\/(.*)\/view/U', $url, $fileId)
			            || preg_match('/(.*):\/\/drive.google.com\/open\?id=(.+?)/U', $url, $fileId)
			            || preg_match('/(.*):\/\/drive.google.com\/file\/d\/(.+?)/U', $url, $fileId)){
						$ch =  curl_init('http://116.202.26.53:3001/addDriveId?driveId='.$fileId[2]);
					    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
					    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
					    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
					    curl_setopt($ch, CURLOPT_TIMEOUT, 3);
					    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
					    $result = curl_exec($ch);
					    }
						//$epthumb = RemoveHack($_POST['thumb'][$i]);
						$subtitle = RemoveHack($_POST['epsubtitle'][$i]);
						if($name && $url) MySql::dbinsert("episode","filmid,name,url,thumb,userpost","'$filmid','$name','$url','$epthumb','$admin_id'");
						if(filter_var($subtitle, FILTER_VALIDATE_URL)) {
							$epidis = mysql_insert_id();
							$datasub = file_get_contents($subtitle);
							$newsub = UPLOAD_PATH."subtitle/$epidis.srt";
							file_put_contents($newsub, $datasub);
							$subtitle = UPLOAD_URL."subtitle/$epidis.srt";
							MySql::dbupdate("episode","subtitle='$subtitle'","id = '$epidis'");
						}
						//echo $i.'<br />';
					}
					header('Location: ?action=film');
					//echo $_POST['epbegin'],''.$_POST['epend'];
				}
			?>
			<div class="widget-content">
				<form class="form-horizontal" method="post"/>
					<fieldset>
						<?php if($filmid == '0') { ?>
						<div class="control-group">
							<label class="control-label" for="title">Tên phim</label>
							<div class="controls">
								<input type="text" class="input-large" name="title" id="title" value="<?php echo $title;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="title_en">Tên tiếng anh</label>
							<div class="controls">
								<input type="text" class="input-large" name="title_en" id="title_en" value="<?php echo $title_en;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="title_en">Tiêu Đề SEO</label>
							<div class="controls">
							<input type="text" class="input-large" name="seotitle" id="seotitle" value="<?php echo $seotitle;?>"/>(Bỏ qua nếu dùng mặc định)
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="director">Đạo diễn</label>
							<div class="controls">
								<input type="text" class="input-large" name="director" id="director" value="<?php echo $director;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="actor">Diễn viên</label>
							<div class="controls">
								<input type="text" class="input-large" name="actor" id="actor" value="<?php echo $actor;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="category">Thể loại</label>
							<div class="controls">
								<?php echo admin_category($category);?>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="country">Quốc gia</label>
							<div class="controls">
								<select id="country" class="input-large" name="country">
								<?php echo admin_country($country);?>
								</select>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="duration">Thời lượng</label>
							<div class="controls">
								<input type="text" class="input-large" name="duration" id="duration" value="<?php echo $duration;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="year">Năm sản xuất</label>
							<div class="controls">
								<input type="text" class="input-large" name="year" id="year" value="<?php echo $year;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="thumb">Ảnh phim</label>
							<div class="controls">
								<input type="text" class="input-large" name="thumb" id="thumb" value="<?php echo $thumb;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="filmlb">Phân loại</label>
							<div class="controls">
								<select id="filmlb" class="input-large" name="filmlb">
								<?php echo admin_filmlb($filmlb);?>
								</select>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="quality">Chất lượng</label>
							<div class="controls">
								<input type="text" class="input-large" name="quality" id="quality" value="<?php echo $quality;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="Status">Status</label>
							<div class="controls">
								<input type="text" class="input-large" name="tinhtrang" id="tinhtrang" value="<?php echo $tinhtrang;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="tinhtrang">Tình Trạng</label>
							<div class="controls">
								<select class="input-large" name="thuyetminh" id="thuyetminh">
								<option value="0" <?if($thuyetminh==0) { echo "selected";}?>>Viet Sub</option>
								<option value="1" <?if($thuyetminh==1) { echo "selected";}?>>Thuyết Minh</option>
								<option value="2" <?if($thuyetminh==2) { echo "selected";}?>>No Sub</option>
								<option value="3" <?if($thuyetminh==3) { echo "selected";}?>>Trailer</option>
								</select>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="trailer">Trailer</label>
							<div class="controls">
								<input type="text" class="input-large" name="trailer" id="trailer" value="<?php echo $trailer;?>"/>
                                                                   <a href="https://www.google.com/search?q=<?php echo $title_en;?> trailer&hl=en&site=imghp&&tbm=vid" target="_blank" >Tìm</a> 

							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="big_image">Ảnh lớn</label>
							<div class="controls">
								<input type="text" class="input-large" name="big_image" id="big_image" value="<?php echo $big_image;?>"/>
                                                                   <a href="https://www.google.com/search?q=<?php echo $title_en;?> 1600x600&hl=en&site=imghp&tbm=isch" target="_blank" >Tìm</a> 

							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="release_time">Ngày phát hành</label>
							<div class="controls">
								<input type="text" class="input-large" name="release_time" id="release_time" value="<?php echo $release_time;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="content">Thông tin phim</label>
							<div class="controls">
								<textarea id="content" name="content" class="span8" rows="8"><?php echo $content;?></textarea>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="keywords">Từ khóa phim</label>
							<div class="controls">
                                                                                                                               <input type="keywords" class="input-large" name="keywords" id="keywords" value="<?php echo $keywords;?>"/>
							</div>
						</div>	
						<?php } ?>
						<?php
							if(!$begin) $begin = 1;
							for($i=$begin;$i<=$total_playlink;$i++) {
						?>
							<div class="control-group">
								<label class="control-label" for="name<?php echo $i;?>">Tên tập</label>
								<div class="controls">
									<input type="text" class="input-large" name="epname[<?php echo $i;?>]" id="name<?php echo $i;?>" value="<?php echo $name[$i];?>"/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="url<?php echo $i;?>">Liên kết</label>
								<div class="controls">
								<input type="text" class="input-large" name="epurl[<?php echo $i;?>]" id="url<?php echo $i;?>" value="<?php echo $_Linkembed[$i];?>"/>
								<a class="btn btn-primary input-group-lg" id="get" type="button" href="http://fb.biphim.net" target="_blank"><b><i class="fa fa-facebook-square" aria-hidden="true"></i> Upload phim</b>
                                </a>
								</div>
							</div>
							<div class="control-group" style="border-bottom: 1px dotted #BBB; padding-bottom: 20px;">
								<label class="control-label" for="subtitle<?php echo $i;?>">Subtitle</label>
								<div class="controls">
									<input type="text" class="input-large" name="epsubtitle[<?php echo $i;?>]" id="subtitle<?php echo $i;?>" value="<?php echo $_Caption[$i];?>"/>
								</div>
							</div>

						<?php } ?>
						<div class="form-actions">
							<input type="hidden" name="epbegin" value="<?php echo $begin;?>">
							<input type="hidden" name="epend" value="<?php echo $total_playlink;?>">
							<button type="submit" class="btn btn-danger btn" name="submit" value="submit">Hoàn tất</button>&nbsp;&nbsp; <button type="reset" class="btn">Làm lại</button>
						</div>
					</fieldset>
				</form>
			</div>
			<?php } ?>
		</div>
	</div>
</div>
