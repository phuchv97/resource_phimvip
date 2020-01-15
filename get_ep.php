<?php
define('RK_MEDIA',true);
require('init.php');
include View::TemplateView('functions');
$filmid = $_GET['filmid'];
$films = MySql::dbselect('title','film',"id = '$filmid' AND active=1 order by id asc limit 1");
$filmname = $films[0][0];				
$episode = MySql::dbselect('id,name,url,subtitle,userpost,active,present','episode',"filmid = '$filmid' order by id asc"); 
if ($episode){
        for($i=0;$i<count($episode);$i++) {
        $epid       =   $episode[$i][0];
        $epname     =   substr(abs((int) filter_var($episode[$i][1], FILTER_SANITIZE_NUMBER_INT)),0,3);
        $fulllink = $filmname.' tap '.$epname;
        $sv = $epname.'|'.$episode[$i][2].'<br/>';
        echo $sv;
        }
    
    }