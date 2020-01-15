<?php 
$arr = MySql::dbselect('nt_content,timeupdate,nt_id','notice JOIN tb_user ON (tb_user.id = tb_notice.userid)',"userid='".$_SESSION["RK_Userid"]."'");
$total_mes = count($arr);
MySql::dbupdate('notice',"n_read=1","userid='".$_SESSION["RK_Userid"]."'");
if($mode == 'delete') {
			MySql::dbdelete('notice',"nt_id = '$nt_id'");
			MySql::dbdelete('notice',"nt_id != 0");
		    header('Location: ?action=thongbao');
	}
if($mode == 'deleteall') {
			MySql::dbdelete('notice',"nt_id != 0");
		    header('Location: ?action=thongbao');
	}	
?>
<div class="content__inner">
<header class="content__title">
                        <h1>Thông Báo</h1>
                    </header>

                    <div class="card">
                           <div class="toolbar toolbar--inner">
                            <div class="toolbar__nav">
                                <a class="active" href="<?php echo SITE_URL ;?>/badmin/?action=thongbao&mode=deleteall">Xóa Tất cả</a>
                                
                            </div>
                            </div>
                        <div class="listview listview--bordered issue-tracker">
<?php
					if($total_mes){
						for($i=0;$i<count($arr);$i++) {
						$id = explode(':', $arr[$i][0])	;
					?>
					<div class="listview__item">
                                <img src="demo/img/contacts/3.jpg" class="listview__img hidden-sm-down" alt="">

                                <div class="listview__content text-truncate">
                                    <p><?=$arr[$i][0]?></p>
                                </div>

                                <div class="issue-tracker__item">
                                    <a href="<?php echo SITE_URL ;?>/badmin/?action=episode&mode=edit&epid=<?=$id[1]?>"><span class="issue-tracker__tag bg-blue">SỬA</span></a>
                                    <a href="<?php echo SITE_URL ;?>/badmin/?action=thongbao&mode=delete&nt_id=<?=$arr[$i][2]?>"><span class="issue-tracker__tag bg-blue">XONG</span></a>
                                </div>

                                <div class="issue-tracker__item hidden-lg-down">
                                    <i class="zmdi zmdi-time"></i><?=date('g:h:i d/m/Y',$arr[$i][1])?>
                                </div>

                            </div>
						<?}
					}else{?>
					 <div class="listview__item"> Bạn chưa có thông báo nào. hãy duy trì link phim NGON như này nhé =)) </div>
					<?}?>

                            <div class="clearfix m-4"></div>
                        </div>
                    </div>	
</div>
