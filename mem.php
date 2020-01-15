<?php 
ini_set('max_execution_time', 0);
//token của bạn
$token = "EAAAAUaZA8jlABAHVspJszMtop45EcKtZC4Ywcll8wNpzzCpglyKj7383xbV2rtMcSCeO2ZCk6WzKtr20JBnKLyZB2NJTnYd0GdZCNZA6F8NlYuopISRIBIeaqA51GOPPFjU4TydXZCMpMWy9htV5AeMTKcWKY0uCQQoYVWuZCSyCfs2caM4qDTce";
//id nhóm
$id_nhom = "462160484183014";
$url = "https://graph.facebook.com/$id_nhom/members?limit=10&fields=id,administrator&access_token=$token";
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
	if(isset($response["data"]) && count($response["data"])>0){
		$array_fb = $response["data"];
	}
	else{
		break;
	}
	foreach ($array_fb as $each){
echo $each['id'].'<br>'.$each['administrator'];
	}
	if(!empty($response['paging']['next'])){
		$url = $response['paging']['next'];
	}
	else{
		break;
	}
}