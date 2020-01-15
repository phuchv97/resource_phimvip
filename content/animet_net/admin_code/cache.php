<?php if($Admingroup == '1') echo '<pre>Lưu ý: Bạn đang nằm trong nhóm <b>hợp tác viên</b>, bạn sẽ bị hạn chế một số chức năng thêm/sửa/xóa thông tin trên website.</pre>';?>
<?php
if(isset($_POST['submitcache'])){
	if($Admingroup == '2') {
        $Key = 'site-'.$_POST['cache_key'];
		if($_POST['cacheTYPE'] == 1){
			array_map('unlink', glob(CACHE_BIN."/pl/*"));
		}
		else if($_POST['cacheTYPE'] == 2){
			$phpFastCache->clean();
		    array_map('unlink', glob(CACHE_ADD."/film/*"));
		    array_map('unlink', glob(CACHE_ADD."/img/*"));
		    $path = CACHE_PATH;
			array_map('unlink', glob($path."config/*"));
			array_map('unlink', glob($path."xml/*"));
		}	
		else if($_POST['cacheTYPE'] == 3){
		  $phpFastCache->delete($Key);
		}
		else if($_POST['cacheTYPE'] == 4){
		  array_map('unlink', glob(CACHE_ADD."/film/*"));
		   }
	 echo "<script type=\"text/javascript\">
	            function notify(){
                $.notify({
                    title: 'Xong !',
                    message: 'Đã Cập Nhật Cache Thành Công',
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
                    template:   '<div data-notify=\"container\" class=\"alert alert-dismissible alert-{0} alert--notify\" role=\"alert\">' +
                                    '<span data-notify=\"icon\"></span> ' +
                                    '<span data-notify=\"title\">{1}</span> ' +
                                    '<span data-notify=\"message\">{2}</span>' +
                                    '<div class=\"progress\" data-notify=\"progressbar\">' +
                                        '<div class=\"progress-bar progress-bar-{0}\" role=\"progressbar\" aria-valuenow=\"0\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: 0%;\"></div>' +
                                    '</div>' +
                                    '<a href=\"{3}\" target=\"{4}\" data-notify=\"url\"></a>' +
                                    '<button type=\"button\" aria-hidden=\"true\" data-notify=\"dismiss\" class=\"close\"><span>×</span></button>' +
                                '</div>'
                });
            }
            $(window).load(notify());
</script>";
  }
   else {
	echo 'Chức năng này chỉ dảnh cho Quản trị viên';
   }
	
}		?>

                <div class="content__inner">
                    <header class="content__title">
                        <h1>Cập Nhật Cache Site</h1>
                    </header>

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Chọn Hình Thức</h4>

			                  <form class="form-horizontal" method="post">
							  <div class="form-group">
								  <div class="col-sm-10">
								  	Xóa cache Get Link Play<input type="radio" value="1"  name="cacheTYPE">
								    Xóa toàn bộ <input type="radio" value="2" checked name="cacheTYPE">
			                        Xóa trong list <input type="radio" value="3"  name="cacheTYPE">
			                        Xóa cache page info phim và xem phim <input type="radio" value="4"  name="cacheTYPE">
								 </div>
			                    </div>
							  <div class="form-group">
			                      <label class="col-sm-2 control-label">Danh sách (Chọn nếu Xóa Trong List)</label>
								  <div class="col-sm-10"> 
			<select name="cache_key" class="form-control m-b">
				<option value="slide">Phim Trên Silde</option>
				<option value="decu">Phim Đề Cử</option>
				<option value="homephimle">Phim Lẻ</option>
				<option value="homephimbo">Phim Bộ</option>
				<option value="phimlemoi">Phim Lẻ Mới(Dưới Đề Cử)</option>
				<option value="topphimbo">Phim Bộ Mới(Dưới Đề Cử)</option>
				<option value="phimbofull">Phim Bộ Hoàn Thành(Dưới Đề Cử)</option>
				<option value="phimchieurap">Phim Chiếu Rạp</option>
				<option value="phimsapchieu">Phim Sắp Chiếu</option>
				<option value="phimle">Top Phim Lẻ</option>
				<option value="phimbo">Top Phim Bộ</option>
				<option value="category">Menu Thể Loại</option>
				<option value="year">Menu Year</option>
				<option value="country">Menu Quốc Gia</option>
				<option value="map">Site Map</option>

			</select>					   </div>
			                    </div>
			                    <div class="line line-dashed line-lg pull-in"></div><div class="form-group">
			                      <div class="col-sm-4 col-sm-offset-2">
			                        <button type="submit" name="submitcache" class="btn btn-primary">Update</button>
			                      </div>
			                    </div>
			                  </form>
                
                        </div>
                    </div>

                </div>
