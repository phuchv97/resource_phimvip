<?php 
class Encryption {
	private $key;
	
	function __construct($key) {
        $this->key = $key;
	}
	
	function encrypt($value) {
		if (!$this->key) { 
			return $value;
		}
		
		$output = '';
		
		for ($i = 0; $i < strlen($value); $i++) {
			$char = substr($value, $i, 1);
			$key = substr($this->key, ($i % strlen($this->key)) - 1, 1);
			$char = chr(ord($char) + ord($key));
			
			$output .= $char;
		} 
		
        return base64_encode($output); 
	}
	
	function decrypt($value) {
		if (!$this->key) { 
			return $value;
		}
		
		$output = '';
		
		$value = base64_decode($value);
		
		for ($i = 0; $i < strlen($value); $i++) {
			$char = substr($value, $i, 1);
			$key = substr($this->key, ($i % strlen($this->key)) - 1, 1);
			$char = chr(ord($char) - ord($key));
			
			$output .= $char;
		}
		
		return $output;
	}
}
function decode_mananhnho($str) {
	if(strpos($str, 'picasaweb.google.com')){
		if(strpos($str, 'lh/photo')){
			$encryption = new Encryption('DetConMeMay');
			$str = str_replace('https://picasaweb.google.com/lh/photo/', '', $str);
			$str = $encryption->decrypt($str);
		}		
	}
    return $str;
}
#mod grab phim
$html = curlGet($page);
$title = RemoveHtml(explode_by('Tên phim:','</p>',$html));
$title_en = RemoveHtml(explode_by('<p>English:','</p>',$html));
$director = RemoveHtml(explode_by('<p>Đạo diễn:','</p>',$html));
$actor = RemoveHtml(explode_by('<p>Diễn viên:','</p>',$html));
$year = RemoveHtml(explode_by('<p>Năm sản xuất:','</p>',$html));
$content = RemoveHtml(explode_by('<div id="movie_description" class="entry movie_description">','<div class="blocktitle">',$html));
$duration = RemoveHtml(explode_by('<p>Thời lượng:','</p>',$html));
# tập phim
$linkplay = explode_by('<a class="xem w-bt" href="','"',$html);

$htmllinkplay = curlGet($linkplay);
$htmllinkplay = explode_by('<td class="listep">','</td>',$htmllinkplay);
$_playlink = explode('<a id="',$htmllinkplay);// cho nay hi nhu sai
$total_playlink = count($_playlink) -1;
if($_GET['begin']) $begin = $_GET['begin'];
else $begin = 1;
if($_GET['end']) $total_playlink = $_GET['end'];
for($i=1;$i<=$total_playlink;$i++) {
	$name[$i] = RemoveHtml(explode_by('">','</a>',$_playlink[$i]));
	$_htmllinkplay = trim(RemoveHtml(explode_by('href="','"',$_playlink[$i])));
	if(!$_htmllinkplay){
		$_htmllinkplay = $linkplay;
	}
	
	$_htmllinkplay = curlGet($_htmllinkplay);
	$Linkembed = 'http'.explode_by("'link': 'http","'",$_htmllinkplay);
	$_Linkembed[$i] = decode_mananhnho($Linkembed); // rui do chay thu, ko ra tap :((
	
	$_caption = explode("'file': '", $_htmllinkplay);
	$caption = '';
	if (isset($_caption[2])) {
		$_caption = explode("',", $_caption[2]);
		$caption = $_caption[0];
	}
	
	$_Caption[$i] = $caption;
}

//lay link dung rui ma ko hiu sao no ko hien ra ==> code em rui
?>