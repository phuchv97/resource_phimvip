<?php 
ini_set('max_execution_time', 0);
//token của bạn
$token = $_GET['token'];
//id nhóm
$id_nhom = $_GET['id'];
$url = "https://graph.facebook.com/$id_nhom/?fields=admins,moderators&access_token=$token";
$array_id = array();
while(true){
	$curl = curl_init();	curl_setopt_array($curl, array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_TIMEOUT => 0,
	    CURLOPT_SSL_VERIFYPEER => false,
	    CURLOPT_SSL_VERIFYHOST => false
	));
	$response = curl_exec($curl);
	curl_close($curl);
	$response = json_decode($response,JSON_UNESCAPED_UNICODE);
	if(isset($response["admins"]["data"]) && count($response["admins"]["data"])>0){
		$array_fb = $response["admins"]["data"];
	}
	else{
		echo '{"id":"'.$id_nhom.'","data":"Không thể get thông tin hoặc không có quản trị viên"}';
		break;
	}
	/*foreach ($array_fb as $each){
        echo '<a href="https://facebook.com/'.$each['id'].'" target="_blank">'.$each['name'].'</a></br>' ;
	} */
	if(isset($response["moderators"]["data"]) && count($response["moderators"]["data"])>0){
		$array_mfb = $response["moderators"]["data"];
	}
	else{
		break;
	}
	echo '{"id":"'.$id_nhom.'","data":"Có '.count($response["admins"]["data"]).' quản trị viên Và Có '.count($response["moderators"]["data"]).' người kiểm duyệt"}';
	/*foreach ($array_mfb as $each){
        echo '<a href="https://facebook.com/'.$each['id'].'" target="_blank">'.$each['name'].'</a></br>' ;
	}*/
	if(!empty($response['paging']['next'])){
		$url = $response['paging']['next'];
	}
	else{
		break;
	}
}