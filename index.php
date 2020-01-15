<?php
/*
BillyMovies 2.0
Source code by Billy
Writing based on PHP platform
Support: lamkhanhseo@gmail.com
*/
define('RK_MEDIA',true);
# Các tập tin quan trọng cần kết nối
require_once("phpfastcache.php");
$phpFastCache = phpFastCache();//Gọi hàm
require('init.php');
// POST data ajax
if(isset($_POST['RK_Registry'])) {
	echo LoginAuth::addUser($_POST['username'],$_POST['password'],$_POST['confirmpass'],$_POST['email'],$_POST['captcha']);
	exit();
}else if(isset($_POST['RK_Login'])) {
	echo LoginAuth::loginUser($_POST['username'],$_POST['password'],$_POST['remember']);
	exit();
}else if(isset($_POST['RK_Logout'])) {
	echo LoginAuth::logoutUser();
	exit();
}else if(isset($_POST['RK_Forgot'])) {
	echo LoginAuth::Forgot($_POST['email'],$_POST['captcha']);
	exit();
}else if(isset($_POST['RK_Votes'])) {
	echo Film_Model::Votes($_POST['filmid']);
	exit();
}else if(isset($_GET['RK_Film'])) {
	echo Film_Model::Tooltip($_GET['RK_Film']);
	exit();
}else if(isset($_POST['RK_Fav_Feature'])) {
	echo Film_Model::Fav_Feature($_POST['filmid']);
	exit();
}else if(isset($_POST['RK_Fav_Playlist'])) {
	echo Film_Model::Fav_Playlist($_POST['filmid']);
	exit();
}else if(isset($_POST['RK_Remove'])) {
	echo Film_Model::RK_Remove($_POST['filmid'],$_POST['type']);
	exit();
}else if(isset($_POST['RK_Error'])) {
	echo Film_Model::Fav_Error($_POST['epid']);
	exit();
}else if(isset($_POST['RK_Support'])) {
	echo Support_Model::AddLog($_POST['type'],$_POST['mail'],$_POST['text']);
	exit();
}else if(isset($_POST['RK_Edituser'])) {
	echo LoginAuth::Edituser($_POST['fullname'],$_POST['facebookid'],$_POST['captcha']);
	exit();
}else if(isset($_POST['RK_Download'])) {
	echo GetLink::buil_down($_POST['epid'],$type);
	exit();
}
View::output();