<?php 
define('RK_MEDIA',true);
require_once('phpfastcache.php');
$phpFastCache = phpFastCache();
require('init.php');
include View::TemplateView('functions');
if(isset($_POST['qcao'])){
	    global $phpFastCache;
        $name = 'bin-'.$_POST['qcao'];
        $data_cache = $phpFastCache->get($name);
        if($data_cache != null){
            $html = $data_cache; 
        }else{
		    $id = RemoveHack($_POST['qcao']);
		    $html = player($id);
		    if($html != '') $phpFastCache->set($name,$html,2400);
        }
    return $html; 
} else {
    echo '<img class="player_loading" src="https://i.imgur.com/AAZ8bge.gif"/>';
}

 ?>