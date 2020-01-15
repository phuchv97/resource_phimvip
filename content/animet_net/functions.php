<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
function config_site($config_name) {
	$arr = MySql::dbselect('config_content','config',"config_name = '$config_name'");
	$data = $arr[0][0];
	return $data;
}
function one_data($item,$table,$con) {
	$arr = MySql::dbselect("$item","$table","$con");
	$data = $arr[0][0];
	return $data;
}
function admin_film($filmid) {
	$arr = MySql::dbselect('id,title,title_en','film',"id != '0' order by id desc");
	for($i=0;$i<count($arr);$i++) {
		$id = $arr[$i][0];
		$name = $arr[$i][1];
		if($id == $filmid) $active[$i] = ' selected';
        $html .= "<option value=\"$id\"".$active[$i]."/>$name</option>";
	}
	return $html;
}
function category_a($list, $num = 0) {
    $list = substr($list, 1);
    $list = substr($list, 0, -1);
    $category  = MySql::dbselect("name", "category", "id IN (" . $list . ")");
    for($i=0;$i<count($category);$i++) {
        $name = $category[$i][0];
        $html .= "$name, ";
    }
	$html = substr($html,0,-2);
    return $html;
}
function username($id) {
    $user  = MySql::dbselect("username", "user", "id = '" . $id . "'");    
	$html = $user[0][0];
    return $html;
}
function user_menu() {
	$userid = $_SESSION["RK_Adminid"];
	$username = one_data('username','user',"id = '$userid'");
	$email = one_data('email','user',"id = '$userid'");
	$html = '<div class="user">
                        <div class="user__info" data-toggle="dropdown">
                            <img class="user__img" src="https://phimvip.com/content/billy/bin/img/5.jpg" alt="">
                            <div>
                                <div class="user__name">'.$username.'</div>
                                <div class="user__email">'.$email.'</div>
                            </div>
                        </div>

                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="?action=user&mode=edit&cid='.$userid.'">Sửa thông tin</a>
                            <a class="dropdown-item" href="?action=logout">Logout</a>
                        </div>
                    </div>
	';
	return $html;
}
function admin_category($list) {
	$category  = MySql::dbselect("id,name", "category", "id != '0'");
	$list_category = explode(',', $list);
    for($i=0;$i<count($category);$i++) {
		if (in_array($category[$i][0], $list_category)) {
            $checked[$i] = " checked=\"checked\"";
        }
		$id = $category[$i][0];
		$name = $category[$i][1];
        $html .= "<label class=\"custom-control custom-checkbox\"><input type=\"checkbox\" class=\"custom-control-input\" name=\"category[]\" value=\"$id\"".$checked[$i]."/><span class=\"custom-control-indicator\"></span><span class=\"custom-control-description\">$name</span></label>";
    }
    return $html;
}
function admin_country($idcountry) {
	$country  = MySql::dbselect("id,name", "country", "id != '0'");
    for($i=0;$i<count($country);$i++) {
		$id = $country[$i][0];
		$name = $country[$i][1];
		if($idcountry == $id) $active[$i] = ' selected';
        $html .= "<option value=\"$id\"".$active[$i]."/>$name</option>";
    }
    return $html;
}

function admin_checktap($id,$name,$url) {
	$country  = MySql::dbselect("film,name,url", "tb_episode", "filmid = '$id',name = '$name',url = '$url'");
    for($i=0;$i<count($country);$i++) {
		$id = $country[$i][0];
		$name = $country[$i][1];
		if($idcountry == $id) $active[$i] = ' selected';
        $html .= "<option value=\"$id\"".$active[$i]."/>$name</option>";
    }
    return $html;
}



function admin_ugroup($idg) {
    for($i=0;$i<4;$i++) {
		$id = $i;
		$name = LoginAuth::GroupUser($id);
		if($idg == $id) $active[$i] = ' selected';
        $html .= "<option value=\"$id\"".$active[$i]."/>$name</option>";
    }
    return $html;
}
function admin_filmlb($id) {
	if($id == 0) $phimle = ' selected';
	if($id == 1) $phimbo1 = ' selected';
	if($id == 2) $phimbo2 = ' selected';
    $html .= "<option value=\"0\"$phimle/>Phim lẻ</option>";
	$html .= "<option value=\"1\"$phimbo1/>Phim bộ đã hoàn thành</option>";
	$html .= "<option value=\"2\"$phimbo2/>Phim bộ chưa hoàn thành</option>";
    return $html;
}


function admin_decu($id) {
	if($id == 0) $decu0 = ' selected';
	if($id == 1) $decu1 = ' selected';
    $html .= "<option value=\"0\"$decu0/>không</option>";
	$html .= "<option value=\"1\"$decu1/>có</option>";
    return $html;
}


function admin_slider($id) {
	if($id == 0) $slide1 = ' selected';
	if($id == 1) $slide2 = ' selected';
    $html .= "<option value=\"0\"$slide1 />Không hiển thị ở Slider</option>";
	$html .= "<option value=\"1\"$slide2 />Hiển thị ở Slider</option>";
    return $html;
}

function filmlb_a($id) {
	if($id == '0') $html = 'Phim lẻ';
	elseif($id == '2') $html = 'Phim bộ chưa hoàn thành';
	else $html = 'Phim bộ đã hoàn thành';
    return $html;
}
function get_allpage($ttrow, $limit, $page, $url, $type = '') {
    $total = ceil($ttrow / $limit);
    if ($total <= 1)
        return '';
	$main .= '<nav><ul class="pagination">';
    if ($page <> 1) {
        $main .= "<li class='page-item pagination-prev'><a title='Sau' class='page-link' href='" . $url . ($page - 1) . "'></a></li>";
    }
    for ($num = 1; $num <= $total; $num++) {
        if ($num < $page - 1 || $num > $page + 4)
            continue;
        if ($num == $page)
            $main .= "<li class=\"page-item active\"><a href='javascript:void()' class='page-link'>$num</a></li>";
        else {
            $main .= "<li class='page-item'><a class='page-link' href=\"$url$num\">$num</a></li>"; 
        }
    }
    if ($page <> $total) {
        $main .= "<li class='page-item pagination-next'><a title='Tiếp' class='page-link' href='" . $url . ($page + 1) . "'></a></li>";
    }
	$main .= '</ul></nav>';
    return $main;
}
// Xử lý dữ liệu và chuyển thành liên kết
function get_url($id,$name,$type) {
	$url = Url::get($id,$name,$type);
	return $url;
}
function xem_web($url)
{
	$ch = @curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	$head[] = "Connection: keep-alive";
	$head[] = "Keep-Alive: 300";
	$head[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
	$head[] = "Accept-Language: en-us,en;q=0.5";
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36');
	curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_TIMEOUT, 60);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
	$page = curl_exec($ch);
	curl_close($ch);
	return $page;
}
?>