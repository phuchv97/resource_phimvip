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
function upload_film($filmid,$userid) {
	$arr = MySql::dbselect('id,title,title_en','film',"id != '0' AND userpost = '".$_SESSION['RK_Userid']."' order by id desc");
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
function user_menu() {
	$userid = $_SESSION["RK_Uploadid"];
	$username = one_data('username','user',"id = '$userid'");
	$html = '<li class="dropdown">
	<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
	<i class="icon-user"></i> '.$username.' <b class="caret"></b>
	</a>
	<ul class="dropdown-menu">			
		<li><a href="?action=logout">Thoát ra</a></li>
	</ul>
	</li>';
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
        $html .= "<label class=\"checkbox\"><input type=\"checkbox\" name=\"category[]\" value=\"$id\"".$checked[$i]."/>$name</label>";
		if ($i == 15){
					$html .= "</td><td style=\"vertical-align:top;width:150px;\">";
					} elseif ($i ==30) {
					$html .= "</td><td style=\"vertical-align:top;width:150px;\">";
					} elseif ($i ==45) {
					$html .= "</td><td style=\"vertical-align:top;width:150px;\">";
					} elseif ($i ==60) {
					$html .= "</td><td style=\"vertical-align:top;width:150px;\">";
					} 
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

function upload_nhomdich($idnhomdich) {
	$nhomdich  = MySql::dbselect("id,name", "actor", "id != '0'");
    for($i=0;$i<count($nhomdich);$i++) {
		$id = $nhomdich[$i][0];
		$name = $nhomdich[$i][1];
		if($idnhomdich == $id) $active[$i] = ' selected';
        $html .= "<option value=\"$id\"".$active[$i]."/>$name</option>";
    }
    return $html;
}
function admin_ugroup($idg) {
    for($i=0;$i<3;$i++) {
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
	$main .= '<div class="pagination"><ul>';
    if ($page <> 1) {
        $main .= "<li><a title='Sau' href='" . $url . ($page - 1) . "'>←</a></li>";
    }
    for ($num = 1; $num <= $total; $num++) {
        if ($num < $page - 1 || $num > $page + 4)
            continue;
        if ($num == $page)
            $main .= "<li class=\"active\"><a href='javascript:void()' class='current'>Trang $num</a></li>";
        else {
            $main .= "<li><a href=\"$url$num\">Trang $num</a></li>";
        }
    }
    if ($page <> $total) {
        $main .= "<li><a title='Tiếp' href='" . $url . ($page + 1) . "'>→</a></li>";
    }
	$main .= '</ul></div>';
    return $main;
}
// Xử lý dữ liệu và chuyển thành liên kết
function get_url($id,$name,$type) {
	$url = Url::get($id,$name,$type);
	return $url;
}
?>